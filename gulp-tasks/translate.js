import chalk from 'chalk';
import gulp from 'gulp';
import notify from 'gulp-notify';
import sort from 'gulp-sort';
import wpPot from 'gulp-wp-pot';
import image from 'gulp-image';

const log = console.log;

/**
 * Function to generate a WordPress POT Translatiojn file.
 *
 * @param {Oject} atts - An Object of file properties.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('translate', () => {
  const opts = {
    dest: './languages',
    src: './**/*.php'
  };

  log(chalk.blue('--- Generating the translation file ---'));

  return gulp.src(opts.src)
    .pipe(
      wpPot({
        domain: 'wp-svg-helpers',
        package:'WP SVG Helpers',
        bugReport: 'https://github.com/allenmoore/wp-svg-helpers/issues',
        lastTranslator: 'Allen Moore <am@allenmoore.co>',
        team: 'Allen Moore <am@allenmoore.co>'
      })
    )
    .pipe(gulp.dest(`${opts.dest}/wp-svg-helpers.pot`))
    .pipe(notify({message: '\n\n✅  ===> TRANSLATE — completed!\n', onLast: true}));
});


