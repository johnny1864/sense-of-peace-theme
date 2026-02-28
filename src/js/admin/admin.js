/*!
* Admin Scripts
*/
jQuery(document).ready(function ($) {
    var AdminScripts = (function () {
        if (!$('.wp-admin')) return;

        if (acf) {
            acf.add_filter('color_picker_args', function (args, field) {
                // do something to args
                args.palettes = [
                    '#000000', // $black
                    '#ffffff', // $white
                    '#f4f4f4', // $xxlgray
                    '#dddddd', // $lgray
                ]

                // return
                return args;
            });
        }
    }());
});