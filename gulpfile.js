const gulp = require('gulp');
const concat = require('gulp-concat');
const cleanCss = require('gulp-clean-css');
const imagemin = require('gulp-imagemin');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const stylus = require('gulp-stylus');
const uglify = require('gulp-uglify');
const del = require('del');
const bsp = require('bulma-stylus-plus');
const fas = require('font-awesome-stylus');

// mueve los archivos php de src -> dist
gulp.task('static', () => {
    return gulp.src('src/**/*.php')
        .pipe(
            gulp.dest('dist')
        );
});

// Mueve los fonts en assets/fonts de src -> dist 
gulp.task('static_fonts', () => {
    return gulp.src('src/assets/fonts/*')
        .pipe(
            gulp.dest('dist/assets/fonts')
        );
});

// compila todos los documentos stylus y los junta en uno minimifado 
gulp.task('stylus', () => {
    return gulp.src('src/assets/stylus/*.styl')
        .pipe(sourcemaps.init())
        .pipe(stylus({
            "use" : [bsp(), fas()],

            "import": ["bulma-stylus-plus", "font-awesome-stylus"]
        }))
        .pipe(cleanCss())
        .pipe(concat('style.css'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(sourcemaps.write())
        .pipe(
            gulp.dest('dist/assets/css')
        );
});
gulp.task('css', () => {
    return gulp.src('src/assets/css/**/*.css')
        .pipe(sourcemaps.init())
        .pipe(cleanCss())
        .pipe(concat('imports.css'))
        .pipe(rename({
                suffix: '.min'
        }))
        .pipe(sourcemaps.write())
        .pipe(
                gulp.dest('dist/assets/css')
        );
});

// usando la libreria imagemin comprime las imagenes en el directorio assets/img/.
gulp.task('imgmin', () => {
    return gulp.src([
        'src/assets/img/**/*.svg',
        'src/assets/img/**/*.png', 
        'src/assets/img/**/*.jpg', 
        'src/assets/img/**/*.webp', //En realidad imagemin no soporta webp pero lo dejo porque en el futuro lo haran
        'src/assets/img/**/*.jpeg'
    ])
        .pipe(imagemin())
        .pipe(
            gulp.dest('dist/assets/img')
        )
});

// Junta todos los archivos js y minimifica el archivo concatenado
gulp.task('js', () => {
    return gulp.src('src/assets/js/*.js')
        .pipe(sourcemaps.init())
        .pipe(concat('all.js'))
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(sourcemaps.write())
        .pipe(
            gulp.dest('dist/assets/js')
        )
});

// Elimina todas las imagenes de dist/assets/img
gulp.task('imgclean', (cb) => {
    return del('dist/assets/img/', cb);
});

// Conjunto de las dos tareas de imagen
gulp.task('img', 
    gulp.series(['imgclean', 'imgmin'])
);

// Tarea para vigilar cambios y correr la tarea correspondiente.
gulp.task('watch', () => {
    gulp.watch('src/assets/js/**/*.js', gulp.series(['js']));
    gulp.watch('src/assets/stylus/*.styl', gulp.series(['stylus']));
    gulp.watch('src/assets/css/**(*.css', gulp.series(['css']));
    gulp.watch('src/**/*.php', gulp.series(['static']));
});

// Tarea por defecto.
gulp.task('default', gulp.series([
   gulp.parallel(
       [
           'static', 
           'js', 
           'stylus', 
           'static_fonts',
           'css'
        ]),
    'watch'
]));
