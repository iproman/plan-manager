let gulp = require('gulp');
let sourceMap = require('gulp-sourcemaps');
let sass = require('gulp-sass');
let autoPrefix = require('gulp-autoprefixer');
let concat = require('gulp-concat');
let cleanCss = require('gulp-clean-css');
let notify = require('gulp-notify');

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

let config = {
    path: {
        scssWatch: './web/source/scss/**/*.scss',
        scss: './web/source/scss/site.scss',
    },
    output: {
        cssName: 'site.css',
        path: './web/css',
    },
    outputMin: {
        cssName: 'site.min.css',
        path: './web/css',
    },
};

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

gulp.task('scss', function () {
    return gulp.src(config.path.scss)
        .pipe(sourceMap.init())
        .pipe(sass())
        .pipe(concat(config.output.cssName))
        .pipe(autoPrefix('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(sourceMap.write())
        .pipe(gulp.dest(config.output.path))
        .pipe(concat(config.outputMin.cssName))
        .pipe(cleanCss())
        .pipe(gulp.dest(config.outputMin.path))
        .pipe(notify('Compiled'))
        ;
});
gulp.task('watch', function () {
    gulp.watch(config.path.scssWatch, gulp.series('scss'));
});

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

gulp.task('default', gulp.series('scss', 'watch'));
