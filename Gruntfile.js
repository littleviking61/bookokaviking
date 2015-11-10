module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        appComponents : [
            'js/vendor/TweenMax.js',
            'js/vendor/audioplayer.js',
            'js/vendor/jquery.slimscroll.js',
            'js/vendor/jquery.fullPage.js',
            'js/vendor/jquery.vide.js',
            'js/vendor/jquery.cookie.js',
            'js/vendor/sweetalert.js'
        ],

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

            other: {
                files: ['**/*.php', 'css/*.css', '!css/style.css'],
                options: {
                    livereload: true,
                    livereloadOnError: false,
                    spawn: false
                }
            }
        },

        uglify: {
            app: {
                files: {
                    'js/vendor/plugins.min.js': '<%= appComponents %>',
                    'js/main.min.js': 'js/main.js'
                }
            }
        },

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