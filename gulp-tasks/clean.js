import chalk from 'chalk';
import del from 'del';
import gulp from 'gulp';

const log = console.log;

/**
 * Function to clean the CSS dist folder.
 *
 * @param {Oject} atts - An Object of file properties.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('clean', (cb) => {
  log(chalk.blue('--- Cleaning dist folders ---'));
  del(['./dist/css/**/*']);
  cb();
});


