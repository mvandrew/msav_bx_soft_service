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
    strip               = require('gulp-strip-comments'), // Удаление js комментариев
    stripCssComments    = require('gulp-strip-css-comments'),
    browserSync         = require('browser-sync'),
    reload              = browserSync.reload,
    notify              = require('gulp-notify');

var workFiles           = [
    './../../../**/*.php',
    './../../../**/*.css',
    './../../../**/*.js',
    './../../../**/*.+(jpeg|jpg|gif|png|svg)',

    // Exclude system and core files
    '!./src/*',
    '!./node_modules/*',
    '!./../../../bitrix/*',
    '!./../../../auth/*',
    '!./../../../upload/*'
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
        .pipe( gulp.dest('./fonts/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Fonts task complete', onLast: true }) );
});

gulp.task('vendor-css', function () {
    return gulp.src( './src/vendor/font-awesome/css/font-awesome.css' )
        .pipe( stripCssComments({preserve: false}) )
        .pipe( cssnano() )
        .pipe( concat('vendor-css.min.css') )
        .pipe( gulp.dest('./css/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Vendor styles task complete', onLast: true }) );
});

gulp.task('sass', function () {
    return gulp.src( './src/sass/**/*.scss' )
        .pipe( sass() )
        .pipe( autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }) )
        .pipe( gulp.dest('./') )
        .pipe( cssnano() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest('./') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Styles task complete', onLast: true }) );
});

gulp.task('coffee', function() {
    gulp.src( './src/coffee/**/*.coffee' )
        .pipe( coffee({bare: true}) )
        .pipe( gulp.dest('./js/') )
        .pipe( uglify() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest('./js/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Javascript task complete', onLast: true }) );
});

gulp.task('pug', function buildHTML() {
    return gulp.src( ['./src/pug/**/*.pug', '!./src/pug/libs/**/*.pug'] )
        .pipe(plumber())
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

gulp.task('watch', ['fonts', 'vendor-css', 'sass', 'pug', 'coffee', 'browser-sync'], function () {
    gulp.watch('src/sass/**/*.scss', ['sass']);
    gulp.watch('./src/pug/**/*.pug', ['pug']);
    gulp.watch('./src/coffee/**/*.coffee', ['coffee']);

    var contentFiles = [
        '**/*.php',
        // Exclude system and core files
        '!local/*',
        '!bitrix/*',
        '!auth/*',
        '!upload/*'
    ];
    //gulp.watch(contentFiles, [reload({stream:true})]);
});

gulp.task("default", ["watch"]);