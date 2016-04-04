module.exports = {
	main: {
		options: {
			mode: 'zip',
			archive: './release/wp-svg-helpers.<%= pkg.version %>.zip'
		},
		expand: true,
		cwd: 'release/<%= pkg.version %>/',
		src: ['**/*'],
		dest: 'wp-svg-helpers/'
	}
};
