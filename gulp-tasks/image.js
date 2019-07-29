import chalk from 'chalk';
import gulp from 'gulp';
import image from 'gulp-image';

const log = console.log;

/**
 * Function to compress all theme images.
 *
 * @param {Object} atts - An Object of file properties.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('image', () => {
  const opts = {
    dest: './dist/images',
    src: ['./src/images/**/*']
  };

  log(chalk.green('--- Compressing Theme Images ---'));

  return gulp.src(opts.src)
    .pipe(image({
      pngquant: true,
      optipng: false,
      zopflipng: true,
      jpegRecompress: false,
      mozjpeg: true,
      guetzli: false,
      gifsicle: true,
      svgo: true,
      concurrent: 10,
      quiet: true
    }))
    .pipe(gulp.dest(opts.dest));
});

