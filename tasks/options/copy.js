module.exports = {
	// Copy the theme to a versioned release directory
	main: {
		expand: true,
		src:  [
			'**',
			'!**/.*',
			'!**/readme.md',
			'!node_modules/**',
			'!vendor/**',
			'!release/**',
			'!bower.json',
			'!composer.json',
			'!composer.lock',
			'!Gruntfile.js',
			'!package.json'
		],
		dest: 'release/<%= pkg.version %>/'
	}
};
