require('dotenv').config();

var gulp = require('gulp'),
    concat = require('gulp-concat'),
    sass = require('gulp-sass'),
    cleanCss = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    watch = require('gulp-watch'),
    gutil = require( 'gulp-util' ),
    ftp = require( 'vinyl-ftp' ),
    sftp = require('gulp-sftp'),
    jshint = require('gulp-jshint'),
    themePath = `wp_data/wp-content/themes/${process.env.THEME_NAME}/css`,
    user = '',
    password = '', 
    host = '', 
    port = 21,
    localFilesGlob = [
      themePath + '/**/*',
      themePath + '/global.css'
    ],
    remoteFolder = '/srv/htdocs/wp-content/themes/';

function getFtpConnection() {  
    return ftp.create({
        host: host,
        port: port,
        user: user,
        password: password,
        parallel: 10,
        log: gutil.log
    });
}

var sass_paths = [
  themePath + '/src/reset.scss',
  themePath + '/src/global.scss',
]

// Watch sass to css
gulp.task('sass', function () {
  gulp.watch(sass_paths)
  .on('change', function(file) {
  return gulp.src(sass_paths)
    	.pipe(sass())
      .pipe(autoprefixer({
        browsers: ['last 3 versions'],
        cascade: false
      }))
      .pipe(concat('global.css'))
      .pipe(cleanCss({
        aggressiveMerging: false
      }))
      .pipe(gulp.dest(themePath + '/'));
    });
});


// Watch files to uploaded
gulp.task('ftp', function() {
  var conn = getFtpConnection();
  gulp.watch(localFilesGlob)
  .on('change', function(file) {
    return gulp.src( localFilesGlob, { base: '.', buffer: false } )
    .pipe( conn.newer( remoteFolder ) ) // only upload newer files 
      .pipe( conn.dest( remoteFolder ) )
    ;
  });
});

gulp.task('default', gulp.series('sass'),function(){
    gulp.watch(sass_paths, ['sass']);
});