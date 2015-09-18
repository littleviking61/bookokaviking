module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        // appComponents : [
        //     'webroot/js/vendor/skrollr.min.js',
        //     'webroot/js/elements/loading.js'
        // ],

        watch: {

            sass: {
                files: ['scss/**/*.{scss,sass}'],
                tasks: ['sass:dist'],
            },

            js : {
                files: ['js/**/*.js'],
                tasks: ['jshint'],
                options: {
                    livereload: true,
                    livereloadOnError: false,
                    spawn: false
                }
            },

            // appjs : {
            //     files: '<%= appComponents %>',
            //     tasks: [ 'jshint', 'uglify'],
            //     ptions: {
            //         livereload: true,
            //         livereloadOnError: false,
            //         spawn: false
            //     }
            // },

            other: {
                files: ['**/*.php', 'css/*.css', '!css/style.css'],
                options: {
                    livereload: true,
                    livereloadOnError: false,
                    spawn: false
                }
            }
        },

        // uglify: {
        //     options: {
        //         sourceMap: true,
        //     },
        //     app: {
        //         sourceMapName: 'webroot/js/app.min.map',
        //         files: {
        //             'webroot/js/app.min.js': '<%= appComponents %>'
        //         }
        //     }
        // },

        jshint: {
            all: ['js/**/*.js', '!js/foundation/**/*.js', '!js/vendor/**/*.js']
        },

        sass: {
            dist: {
                files: {
                    'css/style.css': 'scss/style.scss'
                }
            },
            options: {
                compass: true,
                //quiet: true,
                style: 'nested',
                require: [ 'susy', 'font-awesome-sass']
            }
        }

    });

    grunt.registerTask('default', ['watch']);
};