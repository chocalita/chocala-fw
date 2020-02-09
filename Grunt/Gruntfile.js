module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                src: [
                    "../App/public/js/jquery-2.1.1.js",
                    "../App/public/js/jquery.cookie.js",
                    "../App/public/js/bootstrap.min.js",
                    "../App/public/js/plugins/metisMenu/jquery.metisMenu.js",
                    "../App/public/js/plugins/slimscroll/jquery.slimscroll.min.js",
                    "../App/public/js/plugins/jquery-ui/jquery-ui.min.js",
                    "../App/public/js/plugins/datapicker/bootstrap-datepicker.js",
                    "../App/public/js/plugins/datapicker/locales/bootstrap-datepicker.es.js",
                    "../App/public/js/inspinia.js",
                    "../App/public/js/plugins/pace/pace.min.js",
                    "../App/public/js/plugins/wow/wow.min.js",
                    "../App/public/js/jquery/jquery.loadmask.js",
                    "../App/public/js/jquery/jquery.modal.js",
                    "../App/public/js/jquery/jquery.modal.auth.js",
                    "../App/public/js/jquery/jquery.facebook.js",
                    "../App/public/js/jquery/jquery.validationEngine.js",
                    "../App/public/js/jquery/jquery.validationEngine-es.js",
                    "../App/public/js/jquery/jquery.formAjaxPost.js",
                    "../App/public/js/jquery/jquery.btnloader.js"
                ],
                dest: '../App/public/js/jquery/app.min.js'
            }
        },

        cssmin: {
            css: {
                src: [
                    "../App/public/css/bootstrap.min.css",
                    "../App/public/css/animate.css",
                    "../App/public/css/style.css",
                    "../App/public/css/site.css",
                    "../App/public/js/plugins/jquery-ui/jquery-ui.min.css",
                    "../App/public/js/plugins/datapicker/datepicker3.css",
                    "../App/public/js/jquery/jquery.empleos-loadmask.css",
                    "../App/public/js/jquery/jquery.modal.css",
                    "../App/public/js/jquery/jquery.validationEngine.css"

                ],
                dest: '../App/public/css/app.min.css'
            }
        }

    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    // Default task(s).
    grunt.registerTask('default', ['uglify','cssmin']);

};
