var gulp                = require("gulp"),
    sass                = require("gulp-sass"),
    cssnano             = require("gulp-cssnano"),
    autoprefixer        = require("gulp-autoprefixer"),
    coffee              = require('gulp-coffee'),
    rename              = require('gulp-rename'),
    pug                 = require('gulp-pug'),
    pugPHPFilter        = require('pug-php-filter'),
    plumber             = require('gulp-plumber'),
    uglify              = require('gulp-uglify'),
    concat              = require('gulp-concat'),
    stripComments       = require('gulp-strip-comments'), // Удаление js комментариев
    stripCssComments    = require('gulp-strip-css-comments'),
    browserSync         = require('browser-sync'),
    reload              = browserSync.reload,
    notify              = require('gulp-notify'),
    remoteSrc           = require('gulp-remote-src'),
    imagemin            = require('gulp-imagemin'),
    imageminPngquant    = require('imagemin-pngquant'),
    cache               = require('gulp-cache'),
    spritesmith         = require('gulp.spritesmith'),
    buffer              = require('vinyl-buffer'),
    merge               = require('merge-stream'),
    imageResize         = require('gulp-image-resize'),
    gcmq                = require('gulp-group-css-media-queries');


/**
 * Определение структуры каталогов проекта
 *
 * @type {{src: string, dist: string, build: string, assets: string}}
 */
var dirs = {
    src: './src/',
    dist: './',
    build: './build/',
    assets: './../../../assets/'
};

/**
 * Определение структуры каталогов проекта специфичных для конкретного сайта
 *
 * @type {{src: string, dist: string}}
 */
var dirs_assets = {
    src: dirs.assets + 'src/',
    dist: dirs.assets
};


/**
 * Список файлов для сборки решения в production
 *
 * @type {string[]}
 */
var build_files = [
    '**',
    '!build',
    '!build/**',
    '!node_modules',
    '!node_modules/**',
    '!bower_components',
    '!bower_components/**',
    '!dist',
    '!dist/**',
    '!sass',
    '!sass/**',
    '!.git',
    '!.git/**',
    '!package.json',
    '!package-lock.json',
    '!bower.json',
    '!**/*.arj',
    '!**/*.rar',
    '!**/*.zip',
    '!.gitignore',
    '!gulpfile.js',
    '!.editorconfig',
    '!.jshintrc',
    '!src',
    '!src/**',
    '!**/*.log'
];


/**
 * Рабочие файлы для контроля вносимых изменений.
 * В первую очередь нужны для нормальной работы Browser-Sync.
 *
 * @type {string[]}
 */
var workFiles           = [
    './**/*.php',
    './../../../**/*.php',
    './**/*.css',
    './../../../assets/css/*.css',
    './js/**/*.js',
    './../../../**/*.+(jpeg|jpg|gif|png|svg)',

    // Exclude system and core files
    '!./src/**/*',
    '!./node_modules/**/*',
    '!./../../../bitrix/**/*',
    '!./../../../auth/**/*',
    '!./../../../upload/**/*'
];


/**
 * Запуск Browser-Sync
 */
gulp.task('browser-sync', function () {
    browserSync.init(workFiles, {
        proxy: {
            target: 'http://www.1c-program-msk.ru/'
        },
        injectChanges: true
    });
});


/**
 * Копируем файлы шрифтов
 */
gulp.task('fonts', function () {
    return gulp.src( dirs.src + 'vendor/font-awesome/fonts/**/*.+(otf|eot|svg|ttf|woff|woff2)' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( gulp.dest( dirs.dist + 'fonts/' ) )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Fonts task complete', onLast: true }) );
});


/**
 * Сборка общего CSS из стилей библиотек поставщиков
 */
gulp.task('vendor-css', function () {
    return gulp.src( [
        dirs.src + 'vendor/font-awesome/css/font-awesome.css',
        dirs.src + 'vendor/normalize-css/normalize.css'
    ] )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( stripCssComments({preserve: false}) )
        .pipe( cssnano() )
        .pipe( concat('vendor-css.min.css') )
        .pipe( gulp.dest(dirs.dist + 'css/') )
        .pipe( notify({ message: 'Vendor styles task complete', onLast: true }) );
});


/**
 * Сборка общего JS из скриптов библиотек поставщиков
 */
gulp.task('vendor-js', function () {
    return gulp.src([
        dirs.src + 'vendor/jquery/dist/jquery.min.js',
        dirs.src + 'vendor/device.js/lib/device.min.js',
        dirs.src + 'vendor/matchHeight/dist/jquery.matchHeight-min.js'
    ])
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( stripComments() )
        .pipe( concat('vendor-js.min.js') )
        .pipe( uglify() )
        .pipe( gulp.dest( dirs.dist + 'js/' ) )
        .pipe( notify({ message: 'Vendor Javascripts task complete', onLast: true }) );
});


/**
 * Компиляция собственных стилей из SCSS проекта
 */
gulp.task('sass', function () {
    return gulp.src( dirs.src + 'sass/**/*.scss' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( sass() )
        .pipe( autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }) )
        .pipe( gcmq() )
        .pipe( gulp.dest( dirs.dist ) )
        .pipe( cssnano() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest( dirs.dist ) )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Styles task complete', onLast: true }) );
});


/**
 * Компиляция стилей специфичных для конкретного сайта
 */
gulp.task('assets-sass', function () {
    return gulp.src( dirs_assets.src + 'sass/**/*.scss' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( sass() )
        .pipe( autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }) )
        .pipe( gcmq() )
        .pipe( gulp.dest( dirs_assets.dist + 'css/' ) )
        .pipe( cssnano() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest( dirs_assets.dist + 'css/' ) )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Assets Styles task complete', onLast: true }) );
});


/**
 * Компиляция JS файлов из Coffee script
 */
gulp.task('coffee', function() {
    gulp.src( dirs.src + 'coffee/**/*.coffee' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( coffee({bare: true}) )
        .pipe( gulp.dest( dirs.dist + 'js/' ) )
        .pipe( uglify() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest( dirs.dist + 'js/' ) )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Javascript task complete', onLast: true }) );
});


/**
 * Компиляция JS файлов из Coffee script специфичных для конкретного сайта
 */
gulp.task('assets-coffee', function() {
    gulp.src( dirs_assets.src + 'coffee/**/*.coffee' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( coffee({bare: true}) )
        .pipe( gulp.dest( dirs_assets.dist + 'js/' ) )
        .pipe( uglify() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest( dirs_assets.dist + 'js/' ) )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Assets JavaScript task complete', onLast: true }) );
});


/**
 * Компиляция шаблонов из PUG файлов
 */
gulp.task('pug', function buildHTML() {
    return gulp.src( [ dirs.src + 'pug/**/*.pug', '!' + dirs.src + 'pug/libs/**/*.pug'] )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( pug({
            pretty: "\t",
            filters: {
                php: pugPHPFilter
            }
        }) )
        .pipe(rename(function (path) {
            path.extname = '.php'
        }))
        .pipe( gulp.dest( dirs.dist ) )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Pug(Jade) task complete', onLast: true }) );
});


/**
 * Сжатие и оптимизация изображений темы оформления
 */
gulp.task('img', function() {
    return gulp.src( dirs.src + 'img/**/*' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( cache(imagemin({
                interlaced: true,
                progressive: true,
                svgoPlugins: [{removeViewBox: false}],
                use: [imageminPngquant()]
            }))
        )
        .pipe( gulp.dest( dirs.dist + 'img/' ) )
        .pipe( notify({ message: 'Theme Images task complete', onLast: true }) );
});


/**
 * Сжатие и оптимизация изображений темы оформления специфичных для конкретного сайта
 */
gulp.task('assets-img', function() {
    return gulp.src( dirs_assets.src + 'img/**/*')
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( cache(imagemin({
                interlaced: true,
                progressive: true,
                svgoPlugins: [{removeViewBox: false}],
                use: [imageminPngquant()]
            }))
        )
        .pipe( gulp.dest( dirs_assets.dist + 'img/' ) )
        .pipe( notify({ message: 'Assets Images task complete', onLast: true }) );
});


/**
 * Сборка спрайтов иконок специфичных для конкретного сайта (размер 64px)
 */
gulp.task('icons-sprite', function () {

    var spriteData = gulp.src( dirs_assets.src + 'resource/icons/*.png')
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe(imageResize({
            width: 64,
            height: 64,
            crop: true,
            upscale: true,
            imageMagick: true
        }))
        .pipe(spritesmith({
                imgName: 'icons.png',
                cssName: '_icons.scss',
                cssFormat: 'scss',
                algorithm: 'binary-tree',
                cssVarMap: function(sprite) {
                    sprite.name = 'ico-' + sprite.name
                }
            })
        );

    var imgStream = spriteData.img
        .pipe( buffer() )
        .pipe( cache(imagemin({
                interlaced: true,
                progressive: true,
                svgoPlugins: [{removeViewBox: false}],
                use: [imageminPngquant()]
            }))
        )
        .pipe( gulp.dest( dirs_assets.dist + 'img/') );

    var cssStream = spriteData.css
        .pipe( gulp.dest( dirs_assets.src + 'sass/') );

    return merge(imgStream, cssStream)
        .pipe( notify({ message: 'Assets Icons 64px Sprite task complete', onLast: true }) );
});


/**
 * Сборка спрайтов иконок специфичных для конкретного сайта (размер 84px)
 */
gulp.task('icons-sprite-84', function () {

    var spriteData = gulp.src( dirs_assets.src + 'resource/icons/*.png')
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe(imageResize({
            width: 84,
            height: 84,
            crop: true,
            upscale: true,
            imageMagick: true
        }))
        .pipe(spritesmith({
                imgName: 'icons-84.png',
                cssName: '_icons-84.scss',
                cssFormat: 'scss',
                algorithm: 'binary-tree',
                cssVarMap: function(sprite) {
                    sprite.name = 'ico84-' + sprite.name
                }
            })
        );

    var imgStream = spriteData.img
        .pipe( buffer() )
        .pipe( cache(imagemin({
                interlaced: true,
                progressive: true,
                svgoPlugins: [{removeViewBox: false}],
                use: [imageminPngquant()]
            }))
        )
        .pipe( gulp.dest( dirs_assets.dist + 'img/') );

    var cssStream = spriteData.css
        .pipe( gulp.dest( dirs_assets.src + 'sass/') );

    return merge(imgStream, cssStream)
        .pipe( notify({ message: 'Assets Icons 84px Sprite task complete', onLast: true }) );
});


/**
 * Очистка кэш для Gulp
 */
gulp.task('clear', function (done) {
    return cache.clearAll(done);
});


/**
 * Задача по-умолчанию
 */
gulp.task('watch', [ 'fonts', 'vendor-css', 'vendor-js', 'sass', 'pug', 'coffee', 'img',
        'assets-sass', 'assets-coffee', 'assets-img', 'browser-sync' ], function () {

    gulp.watch( dirs.src + 'sass/**/*.scss', ['sass'] );
    gulp.watch( dirs.src + 'pug/**/*.pug', ['pug'] );
    gulp.watch( dirs.src + 'coffee/**/*.coffee', ['coffee'] );

    gulp.watch( dirs_assets.src + 'sass/**/*.scss', ['assets-sass'] );
    gulp.watch( dirs_assets.src + 'coffee/**/*.coffee', ['assets-coffee'] );
});

gulp.task("default", ["watch"]);
