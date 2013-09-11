module.exports = function(grunt) {
	var gruntConfig = {
		pkg: grunt.file.readJSON('package.json'),
		
		// SASS
		sass : {
			dev : {
				options : { 
					style : 'compressed',
					noCache: true
				},
				files : {
					'css/main.css' : 'css/sass/main.scss'
				}
			}
		},

		// Watch
		watch: { 
			options: {
				livereload: 1337
			},
			css: {
				files: ['css/main.css']
			},
			sass: {
				files: ['css/sass/*.scss'],
				tasks: ['sass']
			}
		}
	};
	grunt.initConfig(gruntConfig);

	// Plugins do Grunts
	grunt.loadNpmTasks( 'grunt-contrib-concat' )
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-comment-media-queries' );
	grunt.loadNpmTasks( 'grunt-contrib-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );

	grunt.registerTask('default', ['sass', 'uglify'] );

	grunt.registerTask( 'w', [ 'watch' ] );
};