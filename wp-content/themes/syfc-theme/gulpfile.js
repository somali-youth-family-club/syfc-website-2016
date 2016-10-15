var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    cleanCSS = require('gulp-clean-css'),
    jshint = require('gulp-jshint'),
    rename = require('gulp-rename'),
    size = require('gulp-size'),
    sourcemaps = require('gulp-sourcemaps'),
    pkg = require('./package.json');

var paths = {
  styles: ['./scss/style.scss'],
  scripts: ['./js/main.js']
};

gulp.task('styles', ['components'], function () {
  return sass(paths.styles, { sourcemap: false })
  .on('error', function (err) {
    console.error('Error', err.message);
  })
  .pipe(rename('app.css'))
  .pipe(gulp.dest('css/'))
  .pipe(rename('app.min.css'))
  .pipe(cleanCSS())
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('css/'));
});

gulp.task('components', function() {
  return gulp.src(['./components/normalize.css/normalize.css'])
  .pipe(rename('_normalize.scss'))
  .pipe(gulp.dest('./components/normalize.css/'));
});

gulp.task('scripts', ['lint'], function() {
  gulp.src(paths.scripts)
    .pipe(concat('app.js'))
    .pipe(gulp.dest('./js/'))
    .pipe(rename('app.min.js'))
    .pipe(uglify({ preserveComments: 'some' }))
    .pipe(size())
    .pipe(gulp.dest('./js/'));
});

gulp.task('lint', function () {
  return gulp.src('./js/main.js')
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('jshint-stylish'));
});

// Rerun the task when a file changes
gulp.task('watch', function() {
  gulp.watch(['./js/main.js'], ['scripts']);
  gulp.watch('./scss/*.scss', ['styles']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['styles', 'scripts']);
