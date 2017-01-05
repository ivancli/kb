var del = require('del');
var elixir = require('laravel-elixir');
var gulp = require('gulp');
var task = elixir.Task;

elixir.extend('remove', function (path) {
    new task('remove', function () {
        return del(path);
    });
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.remove([
        'public/js',
        'public/css',
        'public/fonts',
        'public/images',
        'public/img',
        'public/videos',
        'public/build'
    ]);

    mix.styles([
        "resources/assets/external/sa/css/bootstrap.min.css",
        "resources/assets/external/sa/css/style.css",
        "resources/assets/external/sa/css/generics.css"
    ], "public/css/error.css", "./");

    mix.styles([
        "resources/assets/external/sa/css/bootstrap.min.css",
        "resources/assets/external/sa/css/form.css",
        "resources/assets/external/sa/css/style.css",
        "resources/assets/external/sa/css/animate.css",
        "resources/assets/external/sa/css/generics.css"
    ], "public/css/login.css", "./");

    mix.styles([
        "resources/assets/external/sa/css/bootstrap.min.css",
        "resources/assets/external/sa/css/animate.min.css",
        "resources/assets/external/sa/css/font-awesome.min.css",
        "resources/assets/external/sa/css/form.css",
        "resources/assets/external/sa/css/calendar.css",
        "resources/assets/external/sa/css/style.css",
        "resources/assets/external/sa/css/icons.css",
        "resources/assets/external/sa/css/generics.css"
    ], "public/css/sa.css", "./");

    mix.styles([
        "resources/assets/external/package/DataTables-1.10.12/media/css/dataTables.bootstrap.min.css"
    ], "public/css/DataTables-1.10.12.css", "./");

    mix.styles([
        "resources/assets/external/package/Cropper/cropper.css"
    ], "public/css/Cropper.css", "./");

    mix.styles([
        "resources/assets/internal/css/app.css"
    ], "public/css/app.css", "./");

    mix.scripts([
        "resources/assets/external/sa/js/jquery.min.js",
        "resources/assets/external/sa/js/bootstrap.min.js",
        "resources/assets/external/sa/js/icheck.js",
        "resources/assets/external/sa/js/functions.js"
    ], "public/js/login.js", "./");

    mix.scripts([
        "resources/assets/external/sa/js/jquery.min.js",
        "resources/assets/external/sa/js/jquery-ui.min.js",
        "resources/assets/external/sa/js/jquery.easing.1.3.js",
        "resources/assets/external/sa/js/bootstrap.min.js",
        "resources/assets/external/sa/js/icheck.js",
        "resources/assets/external/sa/js/scroll.min.js",
        "resources/assets/external/sa/js/calendar.min.js",
        "resources/assets/external/sa/js/feeds.min.js",
        "resources/assets/external/sa/js/functions.js"
    ], "public/js/sa.js", "./");

    mix.scripts([
        "resources/assets/external/package/DataTables-1.10.12/media/js/jquery.dataTables.min.js",
        "resources/assets/external/package/DataTables-1.10.12/media/js/dataTables.bootstrap.min.js"
    ], "public/js/DataTables-1.10.12.js", "./");

    mix.scripts([
        "resources/assets/external/package/Cropper/cropper.js"
    ], "public/js/Cropper.js", "./");

    mix.styles([
        "resources/assets/internal/js/commonFunctions.js"
    ], "public/js/commonFunctions.js", "./");

    mix.styles([
        "resources/assets/internal/js/html5_file_upload.js"
    ], "public/js/html5_file_upload.js", "./");

    mix.scripts([
        "resources/assets/external/sa/js/datetimepicker.min.js",
        "resources/assets/external/sa/js/chosen.min.js"
    ], "public/js/profile.js", "./");

    mix.copy('resources/assets/external/package/DataTables-1.10.12/media/images', 'public/images/');
    mix.copy('resources/assets/external/sa/img', 'public/img/');
    mix.copy('resources/assets/internal/img', 'public/img');
    mix.copy('resources/assets/external/sa/fonts', 'public/fonts/');

    mix.copy('public/img', 'public/build/img');
    mix.copy('public/images', 'public/build/images');
    mix.copy('public/fonts', 'public/build/fonts');

    mix.version([
        "public/css", "public/js"
    ]);
});
