const { src, dest, watch, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin'); // Minificar imagenes 
const notify = require('gulp-notify');
const cache = require('gulp-cache');
const webp = require('gulp-webp');
const avif = require('gulp-avif');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*.{png,jpg}',
    svg:'src/img/**/*.svg'
}

const build = {
    css: 'build/css',
    js: '/build/js',
    img: 'build/img'
}

function css() {
    return src(paths.scss)
        // .pipe(sourcemaps.init())
        .pipe(sass())
        // .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(sourcemaps.write('.'))
        .pipe(dest('build/css'));
}

function javascript(done) {
    src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js'))         // final output file name
      .pipe(terser())
      .pipe(rename({ suffix: '.min' })) // Primero se renombra el fichero javascript
      .pipe(sourcemaps.write('.'))      // Ahora se crea el map, para el fichero definitivo
      .pipe(dest('./build/js'));
    done();
}

function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('build/img'));
        // .pipe(notify({ message: 'Imagen Completada' }));
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe(webp())
        .pipe(dest('build/img'));
        // .pipe(notify({ message: 'Imagen Completada' }));
}

function versionSVG( ){
    return src(paths.svg)               
        .pipe( dest('build/img') );
}

function versionAvif() {
    return src(paths.imagenes)
        .pipe(avif())
        .pipe(dest('build/img'));
        // .pipe(notify({ message: 'Imagen Completada' }));
}

function watchArchivos() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch(paths.imagenes, imagenes);
    watch(paths.svg, versionSVG);
    watch(paths.imagenes, versionWebp);
}

exports.css = css;
exports.watchArchivos = watchArchivos;
exports.default = parallel(css, javascript, imagenes, versionSVG, versionWebp, watchArchivos); 