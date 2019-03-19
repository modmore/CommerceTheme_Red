// gulpfile.js
var gulp = require("gulp"),
    sass = require("gulp-sass"),
    postcss = require("gulp-postcss"),
    autoprefixer = require("autoprefixer"),
    cssnano = require("cssnano"),
    sourcemaps = require("gulp-sourcemaps");

var paths = {
    styles: {
        src: "scss/**/*.scss",
        dest: "css"
    }
};

function style() {
  return (
    gulp
    .src(paths.styles.src)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .on("error", sass.logError)
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(paths.styles.dest))
  );
};

  
function watch(){
    gulp.watch(paths.styles.src, style)
};

exports.default = watch;
exports.style = style;
exports.watch = watch;