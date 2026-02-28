/*!
* Admin Scripts
*/
jQuery(document).ready(function(f){f(".wp-admin")&&acf&&acf.add_filter("color_picker_args",function(f,d){return f.palettes=["#000000","#ffffff","#f4f4f4","#dddddd"],f})});