import atImport from 'postcss-import';
import chalk from 'chalk';
import gulp from 'gulp';
import pixrem from 'pixrem';
import postcss from 'gulp-postcss';
import presetEnv from 'postcss-preset-env';
import rename from 'gulp-rename';
import rgbaFallback from 'postcss-color-rgba-fallback';
import sourcemaps from 'gulp-sourcemaps';

const log = console.log;

/**
 * Function to run PostCSS against files in a src directory.
 *
 * @param {Object} atts - An Object of file properties.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('postcss', () => {
  const opts = {
    dest: './dist/css',
    src: [
      './src/css/style.css'
    ]
  };
  log(chalk.redBright('--- Running PostCSS Goodness ---'));

  return gulp.src(opts.src)
    .pipe(sourcemaps.init({loadMaps: true}))
	  .pipe(postcss([
      atImport(),
      presetEnv({
        stage: 2,
        features: {
          'custom-media-queries': true,
          'custom-properties': true,
          'image-set-function': true,
          'matches-pseudo-class': true,
          'media-query-ranges': true,
          'nesting-rules': true,
          'not-pseudo-class': true
        }
      }),
      pixrem(),
      rgbaFallback()
    ]))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(opts.dest));
});

