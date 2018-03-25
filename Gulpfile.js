"use strict";

// Gulp
var gulp = require('gulp');

// Sass/CSS stuff
var sass = require('gulp-sass');
var prefix = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');

// JavaScript
var uglify = require('gulp-uglify');

// Images
var svgmin = require('gulp-svgmin');
var imagemin = require('gulp-imagemin');

// Stats and Things
var size = require('gulp-size');
var notify = require('gulp-notify');

// Compile handlebars templates
var handlebars = require('gulp-handlebars');
var wrap = require('gulp-wrap');
var concat = require('gulp-concat');
var declare = require('gulp-declare');

// Livereload
var liveReload = require('gulp-livereload');

var onError = function(error) {
    console.log("Error happened");

    notify({
        title: "Scss task error",
        message: "Check the console"
    }).write(error);

    console.error(error.toString());
};

// compile all your Sass
gulp.task('sass', function () {

    gulp.src(['resources/scss/style.scss'])

        .pipe(sass({
            includePaths: ['resources/sass'],
            outputStyle: 'expanded',
            errLogToConsole: false
        })).on("error", onError)

        .pipe(prefix(
            "last 2 version", "> 1%", "ie 8", "ie 7"
        ))

        .pipe(gulp.dest('public_html/css'))
});

// Uglify JS
gulp.task('uglify', function () {
    gulp.src('public_html/scripts/**/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('dist/public_html/scripts'));
});

// Images
gulp.task('imagemin', function () {
    gulp.src('public_html/images/**/*')
        .pipe(imagemin())
        .pipe(gulp.dest('dist/public_html/images'));
});

// Stats and Things
gulp.task('stats', function () {
    gulp.src('dist/**/*')
        .pipe(size())
        .pipe(gulp.dest('dist'));
});

// Compile handlebars
gulp.task('handlebars', function() {
    gulp.src('resources/templates/**/*.handlebars')
        .pipe(handlebars())
        .pipe(wrap('Handlebars.template(<%= contents %>)'))
        .pipe(declare({
            namespace: 'Handlebars.templates',
            noRedeclare: true,
            processName: function(filePath) {
                return declare.processNameByPath(filePath.replace('resources/templates/', ''));
            }
        }))
        .pipe(concat('templates.js'))
        .pipe(gulp.dest('public_html/views/'));
});

gulp.task('default', ["sass", "handlebars"], function () {
    liveReload.listen();

    // watch me getting Sassy
    gulp.watch("./resources/scss/**/*.scss", ["sass", "stats"]);
    gulp.watch("./resources/scss/**/*.css", ["sass", "stats"]);

    //watch handlebars templates
    gulp.watch("./resources/templates/**/*.handlebars", ["handlebars"]);

    //livereload
    gulp.watch(["./app/**/*.*", "./resources/**/*.*", "./public_html/**/*.*"]).on('change', function (file) {
        liveReload.changed(file.path);
    });
});

gulp.task('production', ["sass", "handlebars", "uglify", "imagemin"], function() {
    gulp.src([
        'public_html/**/*.*',
        'public_html/**/.*',
        '!public_html/{images,images/**}',
        '!public_html/{scripts,scripts/**}',
        '!public_html/{uploads,uploads/**}'
    ])
        .pipe(gulp.dest('dist/public_html'));

    gulp.src('composer.json').pipe(gulp.dest('dist'));
    gulp.src(['app/**/*.*', 'app/**/.*']).pipe(gulp.dest('dist/app'));
    gulp.src(['bootstrap/**/*.*', 'bootstrap/**/.*']).pipe(gulp.dest('dist/bootstrap'));
    gulp.src(['resources/views/**/*.*', 'resources/views/**/.*']).pipe(gulp.dest('dist/resources/views'));
    gulp.src(['vendor/**/*.*', 'vendor/**/.*']).pipe(gulp.dest('dist/vendor'));

    gulp.src('public_html/css')
        .pipe(minifycss())
        .pipe(gulp.dest('dist/public_html'));
});
