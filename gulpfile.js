var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');
var useref = require('gulp-useref');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var cleanCSS = require('gulp-clean-css');
const imagemin = require('gulp-imagemin');
var runSequence = require('run-sequence');
var del = require('del');
var cache = require('gulp-cache');


gulp.task('compress', function () {
	return gulp.src('app/images/*')
		.pipe(cache(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}]
		})))
		.pipe(gulp.dest('dist/images'));
});

gulp.task('sass', function () {
  return gulp.src('app/scss/**/*.scss')
    .pipe(sass({
          includePaths: require('node-normalize-scss').includePaths
      }))
    .pipe(gulp.dest('app/css'))
    .pipe(gulp.dest('dist/css'))
    .pipe(browserSync.reload({
      stream: true
    }));
});

gulp.task('useref', function(){
  return gulp.src('app/*.html')
        .pipe(useref())
        .pipe(gulpif('*.js', uglify()))
        .pipe(gulp.dest('dist'));
});

gulp.task('fonts', function() {
  return gulp.src('app/fonts/**/*')
  .pipe(gulp.dest('dist/fonts'))
});

gulp.task('favicons', function() {
  return gulp.src('app/favicons/**/*')
  .pipe(gulp.dest('dist/favicons'))
})

gulp.task('other', function() {
  gulp.src(['app/browserconfig.xml', 'app/manifest.json'])
      .pipe(gulp.dest('dist'))
  gulp.src(['app/js/jquery-1.11.0.min.js', 'app/js/modernizr.js'])
      .pipe(gulp.dest('dist/js'));
});


gulp.task('minify-css', function() {
    return gulp.src('app/css/*.css')
        .pipe(cleanCSS({debug: true}, function(details) {
            console.log(details.name + ': ' + details.stats.originalSize);
            console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
        .pipe(gulp.dest('dist/css'));
});


gulp.task('browserSync', function() {
  browserSync({
    server: {
      baseDir: 'app'
    },
  })
})

gulp.task('watch', ['browserSync', 'sass'], function (){
  gulp.watch('app/scss/**/*.scss', ['sass']);
  gulp.watch('app/*.html', browserSync.reload); 
  gulp.watch('app/js/**/*.js', browserSync.reload); 
});

gulp.task('clean', function() {
  return del.sync('dist').then(function(cb) {
    return cache.clearAll(cb);
  });
})

gulp.task('clean:dist', function() {
  return del.sync(['dist/**/*', '!dist/images', '!dist/images/**/*']);
});

gulp.task('build', function (callback) {
  runSequence('clean:dist', ['sass', 'useref', 'compress', 'fonts','favicons','other'], 'minify-css', callback)
})

gulp.task('default', function (callback) {
  runSequence(['sass','browserSync', 'watch'], callback)
})