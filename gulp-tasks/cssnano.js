import chalk from 'chalk';
import cssnano from 'gulp-cssnano';
import filter from 'gulp-filter';
import gulp from 'gulp';
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';

const log = console.log;

/**
 * Function to concat all files in a src directory.
 *
 * @param {Object} atts - An Object of file properties.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('cssnano', () => {
  log(chalk.magenta('--- Minifying CSS with CSSNano ---'));

  return gulp.src(['./dist/css/style.css'])
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(cssnano({
      autoprefixer: false,
      preset: 'advanced',
      mergeRules: false,
      zindex: false,
      convertValues: true
    }))
    .pipe(rename((path) => {
      path.extname = '.min.css'
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./dist/css'))
    .pipe(filter('**/*.css'));
});
