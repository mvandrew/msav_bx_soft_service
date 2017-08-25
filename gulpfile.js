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
    gutil               = require('gulp-util'),
    remoteSrc           = require('gulp-remote-src'),
    imagemin            = require('gulp-imagemin'),
    imageminPngquant    = require('imagemin-pngquant'),
    cache               = require('gulp-cache'),
    spritesmith         = require('gulp.spritesmith'),
    buffer              = require('vinyl-buffer'),
    merge               = require('merge-stream'),
    imageResize         = require('gulp-image-resize'),
    gcmq                = require('gulp-group-css-media-queries');

var workFiles           = [
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

gulp.task('browser-sync', function () {
    browserSync.init(workFiles, {
        proxy: {
            target: 'http://www.1c-program-msk.ru/'
        },
        injectChanges: true
    });
});

gulp.task('fonts', function () {
    return gulp.src( './src/vendor/font-awesome/fonts/**/*.+(otf|eot|svg|ttf|woff|woff2)' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( gulp.dest('./fonts/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Fonts task complete', onLast: true }) );
});

gulp.task('google-fonts', function () {
    return remoteSrc(
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&subset=cyrillic,cyrillic-ext,latin-ext',
        {
            base: null
        }
    )
        .pipe( concat('google-fonts.css') )
        .pipe( gulp.dest('./css/') );
});

gulp.task('vendor-css', function () {
    return gulp.src( [
        './src/vendor/font-awesome/css/font-awesome.css',
        './src/vendor/normalize-css/normalize.css'
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
        .pipe( gulp.dest('./css/') )
        .pipe( notify({ message: 'Vendor styles task complete', onLast: true }) );
});

gulp.task('vendor-js', function () {
    return gulp.src([
        './src/vendor/jquery/dist/jquery.min.js',
        './src/vendor/device.js/lib/device.min.js',
        './src/vendor/matchHeight/dist/jquery.matchHeight-min.js'
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
        .pipe( gulp.dest('./js/') )
        .pipe( notify({ message: 'Vendor Javascripts task complete', onLast: true }) );
});

gulp.task('sass', function () {
    return gulp.src( './src/sass/**/*.scss' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( sass() )
        //.on( 'error', gutil.log )
        .pipe( autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }) )
        .pipe( gcmq() )
        .pipe( gulp.dest('./') )
        .pipe( cssnano() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest('./') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Styles task complete', onLast: true }) );
});

gulp.task('assets-sass', function () {
    return gulp.src( './../../../assets/src/sass/**/*.scss' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( sass() )
        .pipe( autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }) )
        .pipe( gcmq() )
        .pipe( gulp.dest('./../../../assets/css/') )
        .pipe( cssnano() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest('./../../../assets/css/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Assets Styles task complete', onLast: true }) );
});

gulp.task('coffee', function() {
    gulp.src( './src/coffee/**/*.coffee' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( coffee({bare: true}) )
        .pipe( gulp.dest('./js/') )
        .pipe( uglify() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest('./js/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Javascript task complete', onLast: true }) );
});

gulp.task('assets-coffee', function() {
    gulp.src( './../../../assets/src/coffee/**/*.coffee' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( coffee({bare: true}) )
        .pipe( gulp.dest('./../../../assets/js/') )
        .pipe( uglify() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest('./../../../assets/js/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Javascript task complete', onLast: true }) );
});

gulp.task('pug', function buildHTML() {
    return gulp.src( ['./src/pug/**/*.pug', '!./src/pug/libs/**/*.pug'] )
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
        .pipe(gulp.dest('./'))
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Pug(Jade) task complete', onLast: true }) );
});

gulp.task('img', function() {
    return gulp.src('./src/img/**/*')
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
        .pipe( gulp.dest('./img/') )
        .pipe( notify({ message: 'Theme Images task complete', onLast: true }) );
});

gulp.task('assets-img', function() {
    return gulp.src('./../../../assets/src/img/**/*')
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
        .pipe( gulp.dest('./../../../assets/img/') )
        .pipe( notify({ message: 'Assets Images task complete', onLast: true }) );
});

gulp.task('icons-sprite', function () {

    var spriteData = gulp.src('./../../../assets/src/resource/icons/*.png')
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
        .pipe( gulp.dest('./../../../assets/img/') );

    var cssStream = spriteData.css
        .pipe( gulp.dest('./../../../assets/src/sass/') );

    return merge(imgStream, cssStream)
        .pipe( notify({ message: 'Icons 64px Sprite task complete', onLast: true }) );
});

gulp.task('clear', function (done) {
    return cache.clearAll(done);
});

gulp.task('watch', [ 'fonts', 'vendor-css', 'vendor-js', 'sass', 'pug', 'coffee', 'img',
        'assets-sass', 'assets-coffee', 'assets-img', 'browser-sync' ], function () {

    gulp.watch('./src/sass/**/*.scss', ['sass']);
    gulp.watch('./src/pug/**/*.pug', ['pug']);
    gulp.watch('./src/coffee/**/*.coffee', ['coffee']);

    gulp.watch('./../../../assets/src/sass/**/*.scss', ['assets-sass']);
    gulp.watch('./../../../assets/src/coffee/**/*.coffee', ['assets-coffee']);
});

gulp.task("default", ["watch"]);