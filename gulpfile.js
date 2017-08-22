var gulp            = require("gulp"),
    sass            = require("gulp-sass"),
    cssnano         = require("gulp-cssnano"),
    autoprefixer    = require("gulp-autoprefixer"),
    coffee          = require('gulp-coffee'),
    rename          = require('gulp-rename'),
    pug             = require('gulp-pug'),
    pugPHPFilter    = require('pug-php-filter'),
    plumber         = require('gulp-plumber'),
    uglify          = require('gulp-uglify'),
    concat          = require('gulp-concat');

gulp.task('fonts', function () {
    return gulp.src( './src/vendor/font-awesome/fonts/**/*.+(otf|eot|svg|ttf|woff|woff2)' )
        .pipe( gulp.dest('./fonts/') );
});

gulp.task('vendor-css', function () {
    return gulp.src( './src/vendor/font-awesome/css/font-awesome.css' )
        .pipe( cssnano() )
        .pipe( concat('vendor-css.min.css') )
        .pipe( gulp.dest('./css/') );
});

gulp.task('sass', function () {
    return gulp.src( './src/sass/**/*.scss' )
        .pipe( sass() )
        .pipe( autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }) )
        .pipe( gulp.dest('./') )
        .pipe( cssnano() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest('./') );
});

gulp.task('coffee', function() {
    gulp.src('./src/coffee/**/*.coffee')
        .pipe(coffee({bare: true}))
        .pipe(gulp.dest('./js/'))
        .pipe(uglify())
        .pipe( rename({suffix: '.min'}) )
        .pipe(gulp.dest('./js/'));
});

gulp.task('pug', function buildHTML() {
    return gulp.src('./src/pug/**/*.pug')
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
        .pipe(gulp.dest('./'));
});

gulp.task('watch', ['fonts', 'vendor-css', 'sass', 'pug', 'coffee'], function () {
    gulp.watch('src/sass/**/*.scss', ['sass']);
    gulp.watch('./src/pug/**/*.pug', ['pug']);
    gulp.watch('./src/coffee/**/*.coffee', ['coffee']);
});

gulp.task("default", ["watch"]);