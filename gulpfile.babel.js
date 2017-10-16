/**
 * 2016年04月29日10:51:34
 * Julian
 */
import gulp from 'gulp';
import uglify from 'gulp-uglify';
import sass from 'gulp-sass';
import prefix from 'gulp-autoprefixer';
import rename from 'gulp-rename';
import minifycss from 'gulp-minify-css';

import concat from 'gulp-concat';
import notify from 'gulp-notify';
import babel from 'gulp-babel';
import browserSync from 'browser-sync';
const  reload  = browserSync.create().reload;
const buildSrc = './build/';
const minjs = 'app.js';



gulp.task('sass', () => {
    return gulp.src('./src/scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(prefix(['last 15 versions', '> 1%', 'ie 8'], { cascade: true }))
        .pipe(rename('app.css'))
		.pipe(minifycss())
        .pipe(gulp.dest('./build/css/'))
        .pipe(browserSync.reload({stream:true}));
});

gulp.task('scripts',() => {
    return gulp.src('./src/js/*.js')
        .pipe(concat(minjs))
        .pipe(gulp.dest('./.tmp/js'))
        .pipe(uglify())
        .pipe(gulp.dest(buildSrc+'/js/'))
        .pipe(browserSync.reload({stream:true}))
        .pipe(notify("Found file: <%= file.relative %>!"));
});


gulp.task('watch', () => {

    // browserSync.init({
    //     server: './'
    // });
    
    browserSync({
        server: {
            baseDir: './'
        },
        notify: false
    });
    
    gulp.watch('./src/scss/**', ['sass']);
    // 看守所有.js档
    gulp.watch('./src/js/*.js', ['scripts']);
    gulp.watch('./*.html',['scripts']);
    
});


gulp.task('default', ['scripts','sass','watch'], () => {});