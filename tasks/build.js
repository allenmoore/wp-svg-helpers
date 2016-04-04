module.exports = function (grunt) {
	grunt.registerTask( 'build', ['clean', 'copy', 'compress'] );
};
