/*
 * grunt-comment-media-queries
 * https://github.com/stephband/grunt.comment-media-queries
 */

'use strict';

module.exports = function(grunt) {

	// Please see the Grunt documentation for more information regarding task
	// creation: http://gruntjs.com/creating-tasks

	grunt.registerMultiTask('comment-media-queries', 'Comment out media queries.', function() {

		// Iterate over all specified file groups.
		this.files.forEach(function(f) {
			// Concat specified files.
			var src = f.src.filter(function(filepath) {
				// Warn on and remove invalid source files (if nonull was set).
				if (!grunt.file.exists(filepath)) {
					grunt.log.warn('Source file "' + filepath + '" not found.');
					return false;
				} else {
					return true;
				}
			}).map(function(filepath) {
				var array = grunt.file.read(filepath).split('\n'),
					count = 0;

				return array.map(function(line) {
					if (/^\s*@media/.test(line)) {
						++count;
						return '/* ' + line + ' */';
					}

					if (count) {
						return line.replace(/\{|\}/g, function($0, $1) {
							if ($0 === '{') {
								++count;
								return $0;
							}
							else {
								--count;
								return count === 0 ? '/* ' + $0 + ' */' : $0 ;
							}
						});
					}

					return line;
				}).join('\n');
			}).join('\n');

			// Write the destination file.
			grunt.file.write(f.dest, src);

			// Print a success message.
			grunt.log.writeln('File "' + f.dest + '" created.');
		});
	});
};
