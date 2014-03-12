module.exports = function (grunt) {

    // Configuration goes here

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        uglify: {
            options: {
                mangle: false,
                beautify: true,
                banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
                    '<%= grunt.template.today("yyyy-mm-dd") %> */'
            },
            build: {
                files: {
                    'public/site/js/site.min.js': ['public/site/js/main.js'],
                    'public/admin/js/admin.min.js': ['public/admin/js/main.js']
                }
            }
        },

        less: {
            development: {
                options: {
                    paths: ["assets/css"]
                },
                files: {
                    "public/site/css/main.css": "public/site/css/less/main.less",
                    "public/admin/css/main.css": "public/admin/css/less/main.less"
                }
            },
            production: {
                options: {
                    paths: ["assets/css"],
                    cleancss: true,
                    compress: true
                },
                files: {
                    "public/site/css/main.css": "public/site/css/less/main.less",
                    "public/admin/css/main.css": "public/admin/css/less/main.less"
                }
            }
        },

        watch: {
            files: [
                'public/site/js/*.js',
                'public/admin/js/*.js',
                'public/site/css/less/*.less',
                'public/admin/css/less/*.less'
            ],
            tasks: [
                'uglify:build',
                'less:production'
            ]
        }
    });


    // Load plugins here
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-less');

    // Define your tasks here
};