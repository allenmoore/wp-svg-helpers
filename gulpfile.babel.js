import gulp from 'gulp';
import {release} from 'gulp-release-it';
import requireDir from 'require-dir';

requireDir('./gulp-tasks');

/**
 * Gulp task to run the Clean process.
 *
 * @param {string} 'clean-files' - The task name.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('clean-files', gulp.series('clean', (done) => {
  done();
}));

/**
 * Gulp task to run all JavaScript processes in a sequential order.
 *
 * @param {string} 'css' - The task name.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('css', gulp.series('postcss', (done) => {
  done();
}));

/**
 * Gulp task to compress all theme images.
 *
 * @param {string} 'imagemin' - The task name.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('imagemin', gulp.series(['image'], (done) => {
  done();
}))

/**
 * Gulp task to run all minification processes in a sequential order.
 *
 * @param {string} 'minify' - The task name.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('minify', gulp.series(['cssnano'], (done) => {
  done();
}));

/**
 * Gulp task to run all translation processes in a sequential order.
 *
 * @param {string} 'wppot' - The task name.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('wppot', gulp.series(['translate'], (done) => {
  done();
}));

/**
 * Gulp task to run the default build processes in a sequential order.
 *
 * @param {string} 'default' - The task name.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('default', gulp.series(['clean-files', 'css', 'imagemin', 'minify']));

release(gulp);
