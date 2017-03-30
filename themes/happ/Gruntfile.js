/*
 How to setup grunt:
 - cd to theme directory
 - Execute the following: (jshint may not be needed!)
 npm install grunt-contrib-uglify --save-dev
 npm install grunt-contrib-jshint --save-dev
 npm install grunt-contrib-concat  --save-dev
 npm install grunt-contrib-less --save-dev
 npm install less-plugin-clean-css --save-dev
 npm install grunt --save-dev

 - In mac you can download and install this app:  https://pngmini.com/
 - Execute grunt to  generate JS and CSS:
 grunt
 - or using the samdog command
 samdog grunt nzicrec nzic --v
 */
module.exports = function (grunt) {
    var concat = {}, watch = {};

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        meta: {
            banner: '/*Happ Design Limited | Copyright 2017*/'
        },
        uglify: {
            my_task: {
                files: {
                    'js/job-details.js': [
                        "resources/js/base.js"
                    ],
                    'js/job-listing.js': [
                        "resources/js/base.js",
                        "resources/js/categories-list.js"
                    ],
                    'js/uglify-full-page.js': [
                        "resources/js/base.js",
                        "resources/js/3d-images.js",
                        "resources/js/onscreen.js",
                        'resources/js/homepage-menu.js',
                        'resources/js/banner.js',
                        'resources/js/shutter.js',
                        'resources/js/information.js'
                    ],
                    'js/base-scripts.js': [
                        "resources/js/base.js"
                    ]
                }
            }
        },
        concat: {
            options: {
                separator: '\n;'
            },
            dist: {
                src: [
                    'resources/js/lib/logosDistort.js',
                    'resources/js/lib/jquery.vide.min.js',
                    //'resources/js/lib/parallax.min.js',
                    'js/uglify-full-page.js'
                ],
                dest: 'js/homepage.js'
            }
        },
        less: {
            development: {},
            production: {
                options: {
                    compress: true,
                    paths: ["resources/less"],
                    plugins: [
                        new (require('less-plugin-clean-css'))({
                            advanced: true,
                            s1: true,
                            compatibility: "ie8"
                        })
                    ]
                },
                files: {
                    "css/base-styles.css": "resources/less/styles.less",
                    "css/homepage.css": "resources/less/calendarpage.less"
                }
            }
        },
        watch: watch
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');

    grunt.registerTask('default', ['uglify', 'less', 'concat']);
};
