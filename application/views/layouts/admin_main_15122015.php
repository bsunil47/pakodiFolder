<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAKODI</title>
    <link type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>css/theme.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='<?php echo base_url(); ?>css/fonts.css' rel='stylesheet'>
    <link type="text/css" href='<?php echo base_url(); ?>bootstrap/css/bootstrap-datetimepicker-standalone.css' rel='stylesheet'>
    <link type="text/css" href='<?php echo base_url(); ?>bootstrap/css/bootstrap-datetimepicker.min.css' rel='stylesheet'>
<!--   <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--css/lightbox.css" type="text/css" media="screen" />-->
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
     <style>
        .pakodi{
            background: #E01E1C;
            text-align: center;
            color: white;
        }
        a{
            padding-left: 2px;
            padding-right: 2px;
            margin-top: -3px;
        }
		.iconred{
		color: red;			
		}
		.icongreen{
		color: green;			
		}
		.col1{
		float:left;width: 4%;  padding-left:15px;	
		}
		.col2{
		float:left;width: 28%;	
		}
		.col3{
		float:left;width: 33%;	
		}
		
        
    #html5-watermark{
        display: none !important;
    }
    </style>
    <style>
.overlay {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:105%;
    z-index:1000;
    background-color:#313131;
    filter:alpha(opacity=70);
    -moz-opacity:0.5;
    -khtml-opacity: 0.5;
    opacity: 0.5;
    z-index: 100;
    display: none;
}
.popup{
    position: absolute;
    left: 27%;
    top: 20%;
    margin-left: -32px; /* -1 * image width / 2 */
    margin-top: -32px;  /* -1 * image height / 2 */
    display: none;
    z-index: 101;
    background: rgb(246, 246, 246) none repeat scroll 0 0;
    opacity: 1;
    width: auto;
    max-width: 45%;
    height: auto;
}
.report-popup{
    width: 500px;
    position: absolute;
    left: 27%;
    top: 20%;
    margin-left: -32px; /* -1 * image width / 2 */
    margin-top: -32px;  /* -1 * image height / 2 */
    display: none;
    z-index: 101;
    background: rgb(246, 246, 246) none repeat scroll 0 0;
    opacity: 1;
    width: auto;
    max-width: 47%;
    height: auto;
}
.play-popup{
     position: absolute;
        left: 27%;
        margin-left: -32px; /* -1 * image width / 2 */
        margin-top: -32px; /* -1 * image height / 2 */
        display: none;
        z-index: 101;
        background: rgb(246, 246, 246) none repeat scroll 0 0;
        opacity: 1;
        width: 370px;
        max-width: 100%;
      //border: 4px solid #f6f6f6;
        border: 4px solid;
       // overflow-y: scroll !important;
}
.play-popup-content {
    border: 4px solid #f6f6f6;
}
.popup-content{
    border: 4px solid #f6f6f6;
}
.report-popup-content > .btn-box{
    margin-right: 30px;
}
.popup img{
    width: auto;
    height: auto;
}
.popup video{

    width: auto;
    max-width: 500px;
    height: auto;
    max-height: 500px;
}
.tric{height:auto;} .tric .redo{ position:relative; top:-25px;height:auto;opacity:0.8;}.redo b{text-align: center; color: white;margin-left: 28px;} 
.input-group {
    border-collapse: separate;
    display: table;
    position: relative;
}
.input-group-addon {
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
    color: #555;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    padding: 6px 12px;
    text-align: center;
}
.form-inline .input-group {
    display: inline-table;
    vertical-align: middle;
}
.form-inline .input-group .input-group-addon, .form-inline .input-group .input-group-btn, .form-inline .input-group .form-control {
    width: auto;
}
.form-inline .input-group > .form-control {
    width: 100%;
}
.btn-toolbar .btn-group, .btn-toolbar .input-group {
    float: left;
}
.btn-toolbar > .btn, .btn-toolbar > .btn-group, .btn-toolbar > .input-group {
    margin-left: 5px;
}
.input-group {
    border-collapse: separate;
    display: table;
    position: relative;
}
.input-group[class*="col-"] {
    float: none;
    padding-left: 0;
    padding-right: 0;
}
.input-group .form-control {
    float: left;
    margin-bottom: 0;
    position: relative;
    /*width: 100%;*/
    z-index: 2;
}
.input-group-lg > .form-control, .input-group-lg > .input-group-addon, .input-group-lg > .input-group-btn > .btn {
    border-radius: 6px;
    font-size: 18px;
    height: 46px;
    line-height: 1.33;
    padding: 10px 16px;
}
select.input-group-lg > .form-control, select.input-group-lg > .input-group-addon, select.input-group-lg > .input-group-btn > .btn {
    height: 46px;
    line-height: 46px;
}
textarea.input-group-lg > .form-control, textarea.input-group-lg > .input-group-addon, textarea.input-group-lg > .input-group-btn > .btn, select.input-group-lg[multiple] > .form-control, select.input-group-lg[multiple] > .input-group-addon, select.input-group-lg[multiple] > .input-group-btn > .btn {
    height: auto;
}
.input-group-sm > .form-control, .input-group-sm > .input-group-addon, .input-group-sm > .input-group-btn > .btn {
    border-radius: 3px;
    font-size: 12px;
    height: 30px;
    line-height: 1.5;
    padding: 5px 10px;
}
select.input-group-sm > .form-control, select.input-group-sm > .input-group-addon, select.input-group-sm > .input-group-btn > .btn {
    height: 30px;
    line-height: 30px;
}
textarea.input-group-sm > .form-control, textarea.input-group-sm > .input-group-addon, textarea.input-group-sm > .input-group-btn > .btn, select.input-group-sm[multiple] > .form-control, select.input-group-sm[multiple] > .input-group-addon, select.input-group-sm[multiple] > .input-group-btn > .btn {
    height: auto;
}

.input-group-addon, .input-group-btn {
    vertical-align: middle;
    white-space: nowrap;
    /*position: absolute;*/
    height:30px;
    /*width: 1%;*/
}
.input-group-addon {
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
    color: #555;
    font-size: 14px;
    font-weight: 400;
    line-height: 2.3;
    padding: 5px 4px 4px 8px;
    text-align: center;
}
.input-group-addon.input-sm {
    border-radius: 3px;
    font-size: 12px;
    padding: 5px 10px;
}
.input-group-addon.input-lg {
    border-radius: 6px;
    font-size: 18px;
    padding: 10px 16px;
}
.input-group-addon input[type="radio"], .input-group-addon input[type="checkbox"] {
    margin-top: 0;
}
.input-group .form-control:first-child, .input-group-addon:first-child, .input-group-btn:first-child > .btn, .input-group-btn:first-child > .btn-group > .btn, .input-group-btn:first-child > .dropdown-toggle, .input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle), .input-group-btn:last-child > .btn-group:not(:last-child) > .btn {
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
}
.input-group-addon:first-child {
    border-right: 0 none;
}
.input-group .form-control:last-child, .input-group-addon:last-child, .input-group-btn:last-child > .btn, .input-group-btn:last-child > .btn-group > .btn, .input-group-btn:last-child > .dropdown-toggle, .input-group-btn:first-child > .btn:not(:first-child), .input-group-btn:first-child > .btn-group:not(:first-child) > .btn {
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
}
.input-group-addon:last-child {
    border-left: 0 none;
}
.input-group-btn {
    font-size: 0;
    position: relative;
    white-space: nowrap;
}
.input-group-btn > .btn {
    position: relative;
}
.input-group-btn > .btn + .btn {
    margin-left: -1px;
}
.input-group-btn > .btn:hover, .input-group-btn > .btn:focus, .input-group-btn > .btn:active {
    z-index: 2;
}
.input-group-btn:first-child > .btn, .input-group-btn:first-child > .btn-group {
    margin-right: -1px;
}
.input-group-btn:last-child > .btn, .input-group-btn:last-child > .btn-group {
    margin-left: -1px;
}
.navbar-form .input-group {
    display: inline-table;
    vertical-align: middle;
}
.navbar-form .input-group .input-group-addon, .navbar-form .input-group .input-group-btn, .navbar-form .input-group .form-control {
    width: auto;
}
.navbar-form .input-group > .form-control {
    width: 100%;
}
.bootstrap-datetimepicker-widget > ul > li{
            float:left;
            width:50%
}

.dropdown-menu.pull-right {
    right: 0;
    left: auto;
}
html {
    font-family: sans-serif;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
}

table {
    border-spacing: 0;
    border-collapse: collapse;
}
td,
th {
    padding: 0;
}

* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
*:before,
*:after {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}


ul,
ol {
    margin-top: 0;
    margin-bottom: 10px;
}
ul ul,ol ul,ul ol,ol ol {
    margin-bottom: 0;
}

.list-unstyled {
    padding-left: 0;
    list-style: none;
}
.list-inline {
    padding-left: 0;
    margin-left: -5px;
    list-style: none;
}
.list-inline > li {
    display: inline-block;
    padding-right: 5px;
    padding-left: 5px;
}

.row {
    margin-right: -15px;
    margin-left: -15px;
}

input{
    height: auto !important;
}


.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
    float: left;
}
.col-xs-12 {
    width: 100%;
}
.col-xs-11 {
    width: 91.66666667%;
}
.col-xs-10 {
    width: 83.33333333%;
}
.col-xs-9 {
    width: 75%;
}
.col-xs-8 {
    width: 66.66666667%;
}
.col-xs-7 {
    width: 58.33333333%;
}
.col-xs-6 {
    width: 50%;
}
.col-xs-5 {
    width: 41.66666667%;
}
.col-xs-4 {
    width: 33.33333333%;
}
.col-xs-3 {
    width: 25%;
}
.col-xs-2 {
    width: 16.66666667%;
}
.col-xs-1 {
    width: 8.33333333%;
}
.col-xs-pull-12 {
    right: 100%;
}
.col-xs-pull-11 {
    right: 91.66666667%;
}
.col-xs-pull-10 {
    right: 83.33333333%;
}
.col-xs-pull-9 {
    right: 75%;
}
.col-xs-pull-8 {
    right: 66.66666667%;
}
.col-xs-pull-7 {
    right: 58.33333333%;
}
.col-xs-pull-6 {
    right: 50%;
}
.col-xs-pull-5 {
    right: 41.66666667%;
}
.col-xs-pull-4 {
    right: 33.33333333%;
}
.col-xs-pull-3 {
    right: 25%;
}
.col-xs-pull-2 {
    right: 16.66666667%;
}
.col-xs-pull-1 {
    right: 8.33333333%;
}
.col-xs-pull-0 {
    right: auto;
}
.col-xs-push-12 {
    left: 100%;
}
.col-xs-push-11 {
    left: 91.66666667%;
}
.col-xs-push-10 {
    left: 83.33333333%;
}
.col-xs-push-9 {
    left: 75%;
}
.col-xs-push-8 {
    left: 66.66666667%;
}
.col-xs-push-7 {
    left: 58.33333333%;
}
.col-xs-push-6 {
    left: 50%;
}
.col-xs-push-5 {
    left: 41.66666667%;
}
.col-xs-push-4 {
    left: 33.33333333%;
}
.col-xs-push-3 {
    left: 25%;
}
.col-xs-push-2 {
    left: 16.66666667%;
}
.col-xs-push-1 {
    left: 8.33333333%;
}
.col-xs-push-0 {
    left: auto;
}
.col-xs-offset-12 {
    margin-left: 100%;
}
.col-xs-offset-11 {
    margin-left: 91.66666667%;
}
.col-xs-offset-10 {
    margin-left: 83.33333333%;
}
.col-xs-offset-9 {
    margin-left: 75%;
}
.col-xs-offset-8 {
    margin-left: 66.66666667%;
}
.col-xs-offset-7 {
    margin-left: 58.33333333%;
}
.col-xs-offset-6 {
    margin-left: 50%;
}
.col-xs-offset-5 {
    margin-left: 41.66666667%;
}
.col-xs-offset-4 {
    margin-left: 33.33333333%;
}
.col-xs-offset-3 {
    margin-left: 25%;
}
.col-xs-offset-2 {
    margin-left: 16.66666667%;
}
.col-xs-offset-1 {
    margin-left: 8.33333333%;
}
.col-xs-offset-0 {
    margin-left: 0;
}
@media (min-width: 768px) {
    .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
        float: left;
    }
    .col-sm-12 {
        width: 100%;
    }
    .col-sm-11 {
        width: 91.66666667%;
    }
    .col-sm-10 {
        width: 83.33333333%;
    }
    .col-sm-9 {
        width: 75%;
    }
    .col-sm-8 {
        width: 66.66666667%;
    }
    .col-sm-7 {
        width: 58.33333333%;
    }
    .col-sm-6 {
        width: 50%;
    }
    .col-sm-5 {
        width: 41.66666667%;
    }
    .col-sm-4 {
        width: 33.33333333%;
    }
    .col-sm-3 {
        width: 25%;
    }
    .col-sm-2 {
        width: 16.66666667%;
    }
    .col-sm-1 {
        width: 8.33333333%;
    }
    .col-sm-pull-12 {
        right: 100%;
    }
    .col-sm-pull-11 {
        right: 91.66666667%;
    }
    .col-sm-pull-10 {
        right: 83.33333333%;
    }
    .col-sm-pull-9 {
        right: 75%;
    }
    .col-sm-pull-8 {
        right: 66.66666667%;
    }
    .col-sm-pull-7 {
        right: 58.33333333%;
    }
    .col-sm-pull-6 {
        right: 50%;
    }
    .col-sm-pull-5 {
        right: 41.66666667%;
    }
    .col-sm-pull-4 {
        right: 33.33333333%;
    }
    .col-sm-pull-3 {
        right: 25%;
    }
    .col-sm-pull-2 {
        right: 16.66666667%;
    }
    .col-sm-pull-1 {
        right: 8.33333333%;
    }
    .col-sm-pull-0 {
        right: auto;
    }
    .col-sm-push-12 {
        left: 100%;
    }
    .col-sm-push-11 {
        left: 91.66666667%;
    }
    .col-sm-push-10 {
        left: 83.33333333%;
    }
    .col-sm-push-9 {
        left: 75%;
    }
    .col-sm-push-8 {
        left: 66.66666667%;
    }
    .col-sm-push-7 {
        left: 58.33333333%;
    }
    .col-sm-push-6 {
        left: 50%;
    }
    .col-sm-push-5 {
        left: 41.66666667%;
    }
    .col-sm-push-4 {
        left: 33.33333333%;
    }
    .col-sm-push-3 {
        left: 25%;
    }
    .col-sm-push-2 {
        left: 16.66666667%;
    }
    .col-sm-push-1 {
        left: 8.33333333%;
    }
    .col-sm-push-0 {
        left: auto;
    }
    .col-sm-offset-12 {
        margin-left: 100%;
    }
    .col-sm-offset-11 {
        margin-left: 91.66666667%;
    }
    .col-sm-offset-10 {
        margin-left: 83.33333333%;
    }
    .col-sm-offset-9 {
        margin-left: 75%;
    }
    .col-sm-offset-8 {
        margin-left: 66.66666667%;
    }
    .col-sm-offset-7 {
        margin-left: 58.33333333%;
    }
    .col-sm-offset-6 {
        margin-left: 50%;
    }
    .col-sm-offset-5 {
        margin-left: 41.66666667%;
    }
    .col-sm-offset-4 {
        margin-left: 33.33333333%;
    }
    .col-sm-offset-3 {
        margin-left: 25%;
    }
    .col-sm-offset-2 {
        margin-left: 16.66666667%;
    }
    .col-sm-offset-1 {
        margin-left: 8.33333333%;
    }
    .col-sm-offset-0 {
        margin-left: 0;
    }
}
@media (min-width: 992px) {
    .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
        float: left;
    }
    .col-md-12 {
        width: 100%;
    }
    .col-md-11 {
        width: 91.66666667%;
    }
    .col-md-10 {
        width: 83.33333333%;
    }
    .col-md-9 {
        width: 75%;
    }
    .col-md-8 {
        width: 66.66666667%;
    }
    .col-md-7 {
        width: 58.33333333%;
    }
    .col-md-6 {
        width: 50%;
    }
    .col-md-5 {
        width: 41.66666667%;
    }
    .col-md-4 {
        width: 33.33333333%;
    }
    .col-md-3 {
        width: 25%;
    }
    .col-md-2 {
        width: 16.66666667%;
    }
    .col-md-1 {
        width: 8.33333333%;
    }
    .col-md-pull-12 {
        right: 100%;
    }
    .col-md-pull-11 {
        right: 91.66666667%;
    }
    .col-md-pull-10 {
        right: 83.33333333%;
    }
    .col-md-pull-9 {
        right: 75%;
    }
    .col-md-pull-8 {
        right: 66.66666667%;
    }
    .col-md-pull-7 {
        right: 58.33333333%;
    }
    .col-md-pull-6 {
        right: 50%;
    }
    .col-md-pull-5 {
        right: 41.66666667%;
    }
    .col-md-pull-4 {
        right: 33.33333333%;
    }
    .col-md-pull-3 {
        right: 25%;
    }
    .col-md-pull-2 {
        right: 16.66666667%;
    }
    .col-md-pull-1 {
        right: 8.33333333%;
    }
    .col-md-pull-0 {
        right: auto;
    }
    .col-md-push-12 {
        left: 100%;
    }
    .col-md-push-11 {
        left: 91.66666667%;
    }
    .col-md-push-10 {
        left: 83.33333333%;
    }
    .col-md-push-9 {
        left: 75%;
    }
    .col-md-push-8 {
        left: 66.66666667%;
    }
    .col-md-push-7 {
        left: 58.33333333%;
    }
    .col-md-push-6 {
        left: 50%;
    }
    .col-md-push-5 {
        left: 41.66666667%;
    }
    .col-md-push-4 {
        left: 33.33333333%;
    }
    .col-md-push-3 {
        left: 25%;
    }
    .col-md-push-2 {
        left: 16.66666667%;
    }
    .col-md-push-1 {
        left: 8.33333333%;
    }
    .col-md-push-0 {
        left: auto;
    }
    .col-md-offset-12 {
        margin-left: 100%;
    }
    .col-md-offset-11 {
        margin-left: 91.66666667%;
    }
    .col-md-offset-10 {
        margin-left: 83.33333333%;
    }
    .col-md-offset-9 {
        margin-left: 75%;
    }
    .col-md-offset-8 {
        margin-left: 66.66666667%;
    }
    .col-md-offset-7 {
        margin-left: 58.33333333%;
    }
    .col-md-offset-6 {
        margin-left: 50%;
    }
    .col-md-offset-5 {
        margin-left: 41.66666667%;
    }
    .col-md-offset-4 {
        margin-left: 33.33333333%;
    }
    .col-md-offset-3 {
        margin-left: 25%;
    }
    .col-md-offset-2 {
        margin-left: 16.66666667%;
    }
    .col-md-offset-1 {
        margin-left: 8.33333333%;
    }
    .col-md-offset-0 {
        margin-left: 0;
    }
}
@media (min-width: 1200px) {
    .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
        float: left;
    }
    .col-lg-12 {
        width: 100%;
    }
    .col-lg-11 {
        width: 91.66666667%;
    }
    .col-lg-10 {
        width: 83.33333333%;
    }
    .col-lg-9 {
        width: 75%;
    }
    .col-lg-8 {
        width: 66.66666667%;
    }
    .col-lg-7 {
        width: 58.33333333%;
    }
    .col-lg-6 {
        width: 50%;
    }
    .col-lg-5 {
        width: 41.66666667%;
    }
    .col-lg-4 {
        width: 33.33333333%;
    }
    .col-lg-3 {
        width: 25%;
    }
    .col-lg-2 {
        width: 16.66666667%;
    }
    .col-lg-1 {
        width: 8.33333333%;
    }
    .col-lg-pull-12 {
        right: 100%;
    }
    .col-lg-pull-11 {
        right: 91.66666667%;
    }
    .col-lg-pull-10 {
        right: 83.33333333%;
    }
    .col-lg-pull-9 {
        right: 75%;
    }
    .col-lg-pull-8 {
        right: 66.66666667%;
    }
    .col-lg-pull-7 {
        right: 58.33333333%;
    }
    .col-lg-pull-6 {
        right: 50%;
    }
    .col-lg-pull-5 {
        right: 41.66666667%;
    }
    .col-lg-pull-4 {
        right: 33.33333333%;
    }
    .col-lg-pull-3 {
        right: 25%;
    }
    .col-lg-pull-2 {
        right: 16.66666667%;
    }
    .col-lg-pull-1 {
        right: 8.33333333%;
    }
    .col-lg-pull-0 {
        right: auto;
    }
    .col-lg-push-12 {
        left: 100%;
    }
    .col-lg-push-11 {
        left: 91.66666667%;
    }
    .col-lg-push-10 {
        left: 83.33333333%;
    }
    .col-lg-push-9 {
        left: 75%;
    }
    .col-lg-push-8 {
        left: 66.66666667%;
    }
    .col-lg-push-7 {
        left: 58.33333333%;
    }
    .col-lg-push-6 {
        left: 50%;
    }
    .col-lg-push-5 {
        left: 41.66666667%;
    }
    .col-lg-push-4 {
        left: 33.33333333%;
    }
    .col-lg-push-3 {
        left: 25%;
    }
    .col-lg-push-2 {
        left: 16.66666667%;
    }
    .col-lg-push-1 {
        left: 8.33333333%;
    }
    .col-lg-push-0 {
        left: auto;
    }
    .col-lg-offset-12 {
        margin-left: 100%;
    }
    .col-lg-offset-11 {
        margin-left: 91.66666667%;
    }
    .col-lg-offset-10 {
        margin-left: 83.33333333%;
    }
    .col-lg-offset-9 {
        margin-left: 75%;
    }
    .col-lg-offset-8 {
        margin-left: 66.66666667%;
    }
    .col-lg-offset-7 {
        margin-left: 58.33333333%;
    }
    .col-lg-offset-6 {
        margin-left: 50%;
    }
    .col-lg-offset-5 {
        margin-left: 41.66666667%;
    }
    .col-lg-offset-4 {
        margin-left: 33.33333333%;
    }
    .col-lg-offset-3 {
        margin-left: 25%;
    }
    .col-lg-offset-2 {
        margin-left: 16.66666667%;
    }
    .col-lg-offset-1 {
        margin-left: 8.33333333%;
    }
    .col-lg-offset-0 {
        margin-left: 0;
    }
}
.form-control{
    height:auto !important;
}
        .nohover{
            cursor: default;
        }
        .nohover:hover{
            color:#E01E1C;
        }
.nohover:hover > i{
    color:#E01E1C;
}

</style>
    </head>
<body>
<script>
    var base_url = "<?php echo base_url(); ?>";
    var uriseg = "<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>";
</script>
<div class="navbar navbar-fixed-top">
    <?php $this->load->view('includes/header'); ?>
</div>
<!-- /navbar -->
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="span3"><?php if($this->router->fetch_method() != 'testnotifications'){ $this->load->view('includes/leftmenu'); }?></div>
            <div align="center" class="<?php echo $this->session->flashdata('type'); ?>"><?php echo $this->session->flashdata('msg'); ?></div>
            <div class="span9"><?php echo $content_for_layout; ?></div>
        </div>
    </div>
    <!--/.container-->
</div>
<!--/.wrapper-->
<div class="overlay"></div>
<div class="popup" id="popup">
    <div style="position:absolute;width:100%; z-index: 102"><span class="close-button"><img class="close-button" src="<?php echo base_url(); ?>appimages/lightbox-close.png" style="float: right;"/></span></div>
    <div class="popup-content"></div>
</div>
<div class="report-popup span8">
    <div style="position:absolute;width:100%; z-index: 102"><span class="close-button"><img class="close-button" src="<?php echo base_url(); ?>appimages/lightbox-close.png" style="float: right;"/></span></div>
    <div class="span7 report-popup-content">
       <div class="clear" style="width: 100%; height: 20px"></div>
        <a class="btn-box small span3" href="javascript:void(0);"><i class=" icon-group"></i><b id="view-count">76</b><button class="btn pakodi">View Count</button></a>
        <a class="btn-box small span3" href="javascript:void(0);"><i class="icon-download"></i><b id="download-count">24386</b><button class="btn pakodi">Downloads Count</button></a>
        <a class="btn-box small span3" href="javascript:void(0);"><i class="icon-film"></i><b id="dub-count">1296</b><button class="btn pakodi">Dubs Count</button></a>
        <a class="btn-box small span3" href="javascript:void(0);"><i class="icon-book"></i><b id="share-count">1296</b><button class="btn pakodi">Share Count</button></a>
    </div>
</div>
<div class="play-popup">
    <div style="position:absolute;width:380px; z-index: 102; margin-top: -20px;"><span class="close-button"><img class="close-button" src="<?php echo base_url(); ?>appimages/lightbox-close.png" style="float: right;"/></span></div> 
<div class="play-popup-content">
    <audio id="media_file" src='http://sprintmedia.s3.amazonaws.com/audios/' controls></audio>    
    </div>
</div>
<?php $this->load->view('includes/footer'); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-migrate-1.2.1.min.js"></script>

<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/common.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/form_validation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
 <script>
$(document).on('click', '.test', function () {
     jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 3) +
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 1.6) +
                                               $(window).scrollLeft()) + "px");
         //this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2)) + "px");
         //this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2)) + "px");
    return this;
    }
      //var idd=  '#'+ $(this).attr('id');
       $(this).clone().removeClass('test').appendTo(".popup-content"); 
       
       $('.overlay').show();
       $('.overlay').center();
        $('.popup').show();
        $('.popup').center();
        //$('.popup-content').next('.test').removeClass('test');
        $('body').css('overflow-y','hidden');

        });
$(document).on('click', '.report-content', function () {
    jQuery.fn.center = function () {
        this.css("position","absolute");
        this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
                $(window).scrollTop()) + "px");
        this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                $(window).scrollLeft()) + "px");
        return this;
    }
    //var idd=  '#'+ $(this).attr('id');
    //$(this).removeClass('test').appendTo(".report-popup-content");

    $('.overlay').show();
    $('.overlay').center();
    $('#share-count').html($(this).attr('data-sharecount'));
    $('#download-count').html($(this).attr('data-downloadcount'));
    $('#view-count').html($(this).attr('data-viewcount'));
    $('#dub-count').html($(this).attr('data-dubscount'));
    $('.report-popup').show();
    $('.report-popup').center();
    //$('.popup-content').next('.test').removeClass('test');
    $('body').css('overflow-y','hidden');

});
//$.datetimepicker.setLocale('en');
$(document).on('click', '.play-content', function () {
    jQuery.fn.center = function () {
        this.css("position","absolute");
        this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
                $(window).scrollTop()) + "px");
        this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                $(window).scrollLeft()) + "px");
        return this;
    }
    //var idd=  '#'+ $(this).attr('id');
    //$(this).removeClass('test').appendTo(".report-popup-content");

    $('.overlay').show();
    $('.overlay').center();
    $("#ctype").html($(this).attr('data-contenttype'));
    var file=$(this).attr('data-media');
	var typec=$(this).attr('data-contenttype');
	if(typec == '3'){
	$('#media_file').attr('src',"http://sprintmedia.s3.amazonaws.com/dubs/"+file);
	}else{
	$('#media_file').attr('src',"http://sprintmedia.s3.amazonaws.com/audios/"+file);
	}
    $('#media_file').attr('autoplay',true);
    $('.play-popup').show();
    $('.play-popup').center();
    //$('.popup-content').next('.test').removeClass('test');
    $('body').css('overflow-y','hidden');

});
$(document).ready(function(){
    var today = new Date();
    //$("#push_time").datetimepicker();
    $("#push_time").datetimepicker({
        format:"YYYY-MM-DD HH:mm:ss",
        minDate: new Date(),
        sideBySide: true,
        enabledHours:[08,09,10,11,12,13,14,15,16,17,18,19,20],
        keepOpen: false,
    });
	$("#from_date").datetimepicker({
        format:"MM/DD/YYYY HH:mm:ss",
        //minDate: new Date(),
        sideBySide: true,
        //enabledHours:[08,09,10,11,12,13,14,15,16,17,18,19,20],
        keepOpen: false,
    });

	$("#to_date").datetimepicker({
        format:"MM/DD/YYYY HH:mm:ss",
        //minDate: new Date(),
        sideBySide: true,
        //enabledHours:[08,09,10,11,12,13,14,15,16,17,18,19,20],
        keepOpen: false,
    });
    $(".close-button").click(function(){
         $(".popup-content").html("");
         $('.overlay').hide();
         $('.popup').hide();
		 $('.popupp').hide();
        $('.report-popup').hide();
		$('.play-popup').hide();
        $('audio').each(function(){
         this.pause(); // Stop playing
            });
         $('body').css('overflow-y','visible');
    });
	
   $('.overlay').click(function(){
        $(".popup-content").html("");
       //$(".popup-content").html("");
         $('.overlay').hide();
         $('.popup').hide();
		 $('.play-popup').hide();
        $('audio').each(function(){
         this.pause(); // Stop playing
            });
       $('.report-popup').hide();
          if($('.popupp').length > 0){
               $('.popupp').hide();
               if(!empty($('#m_id').val()) && !empty($('#c_id').val())){
                   $('#m_id').val("");
                   $('#c_id').val("");
               }
           }
         $('body').css('overflow-y','visible');
    });
});
               </script>
    <?php if($this->router->fetch_class() == 'cms'){ ?>
<script src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js" type="text/javascript"></script>
<?php } ?>
<?php  if ($this->router->fetch_method() == 'dashboard') { ?>
    <script type="text/javascript">
        function show(v){//user-show
            for(var i=1; i<5; i++){
                $("#show"+i).hide();
            }
            $("#show"+v).show();
            switch(v){
                case 1: getusersbyyearly();
                    break;
                case 2: getusersbymonthly();
                    break;
                case 3: getusersbyweekly();
                    break;
                case 4: getusersbydaily();
                    break;
            }
        }
        function dshow(v){//dub-show
            for(var i=1; i<5; i++){
                $("#dshow"+i).hide();
            }
            $("#dshow"+v).show();
            switch(v){
                case 1: getdubsbyyearly();
                    break;
                case 2: getdubsbymonthly();
                    break;
                case 3: getdubsbyweekly();
                    break;
                case 4: getdubsbydaily();
                    break;
            }
        }
    </script>
    <!--USERS statistics-->
    <script type="text/javascript">
        function getusersbyyearly(){//Users by Yearly
            var year = $("#year").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getusers",
                data: {'rangetype': 'yearly', 'year': year},
                type: "post",
                success: function(data){
                    $("#graph_users").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getusersbymonthly(){//Users by Monthly
            var monthyear = $("#usermonth").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getusers",
                data: {'rangetype': 'monthly', 'monthyear': monthyear},
                type: "post",
                success: function(data){
                    $("#graph_users").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getusersbyweekly(){//Users by Weekly
            var userweek = $("#userweek").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getusers",
                data: {'rangetype': 'weekly', 'userweek': userweek},
                type: "post",
                success: function(data){
                    $("#graph_users").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getusersbydaily(){//Users by Daily
            var userday = $("#userday").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getusers",
                data: {'rangetype': 'daily', 'userday': userday},
                type: "post",
                success: function(data){
                    $("#graph_users").html(data);
                    drawChart();
                }
            });//ajax
        }
    </script>
    <!--DUBS Stattistics-->
    <script type="text/javascript">
        function getdubsbyyearly(){ //Dubs by Yearly
            var year = $("#dyear").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getdubstats",
                data: {'rangetype': 'yearly', 'year': year},
                type: "post",
                success: function(data){
                    $("#graph_dubs").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getdubsbymonthly(){//Dubs by Monthly
            var monthyear = $("#dubmonth").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getdubstats",
                data: {'rangetype': 'monthly', 'monthyear': monthyear},
                type: "post",
                success: function(data){
                    $("#graph_dubs").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getdubsbyweekly(){//Dubs by Weekly
            var dubweek = $("#dubweek").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getdubstats",
                data: {'rangetype': 'weekly', 'dubweek': dubweek},
                type: "post",
                success: function(data){
                    $("#graph_dubs").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getdubsbydaily(){//Dubs by Daily
            var dubday = $("#dubday").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getdubstats",
                data: {'rangetype': 'daily', 'dubday': dubday},
                type: "post",
                success: function(data){
                    $("#graph_dubs").html(data);
                    drawChart();
                }
            });//ajax
        }
    </script>
    <script>
        $(document).ready(function() {
            $(function() {

                $("#userday").datepicker({ firstDay: 1 });
                $("#dubday").datepicker({ firstDay: 1 });
                $('#usermonth').datepicker({//Users Month Picker;
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy'
                }).focus(function() {
                    var thisCalendar = $(this);
                    $('.ui-datepicker-calendar').detach();
                    $('.ui-datepicker-close').click(function() {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        thisCalendar.datepicker('setDate', new Date(year, month, 1));
                    });
                });
                $('#dubmonth').datepicker({//Dubs Month Picker;
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy'
                }).focus(function() {
                    var thisCalendar = $(this);
                    $('.ui-datepicker-calendar').detach();
                    $('.ui-datepicker-close').click(function() {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        thisCalendar.datepicker('setDate', new Date(year, month, 1));
                    });
                });
            });//function
        });//ready
    </script>
    <!--Users Week-datepicker-->
    <script type="text/javascript">
        $(function() {
            var startDate;
            var endDate;
            var selectCurrentWeek = function() {
                window.setTimeout(function () {
                    $('.userweek-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
                }, 1);
            }
            $('.userweek-picker').datepicker( {
                showOtherMonths: true,
                selectOtherMonths: true,
                firstDay: 1,
                onSelect: function(dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1));
                    endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1) + 6);
                    var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                    var sdate = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                    var edate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                    $('#userweek').val(sdate+'-'+edate);
                    selectCurrentWeek();
                },
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day != 0), ''];
                }
            });
            $('.userweek-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
            $('.userweek-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
        });
    </script>
    <!--Dubs Week-datepicker-->
    <script type="text/javascript">
        $(function() {
//            var curr = new Date; // get current date
//            var first = curr.getDate() - (curr.getDay()-1); // First day is the day of the month - the day of the week
//            var last = first + 6; // last day is the first day + 6
//            var firstday = new Date(curr.setDate(first)).toUTCString();
//            var lastday = new Date(curr.setDate(last)).toUTCString();
//            var sdate = $.datepicker.formatDate('mm/dd/yy', new Date(firstday));
//            var edate = $.datepicker.formatDate('mm/dd/yy', new Date(lastday));
            var date = new Date;
            var startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1));
            var endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1) + 6);
            var sdate = $.datepicker.formatDate( 'mm/dd/yy', startDate );
            var edate = $.datepicker.formatDate( 'mm/dd/yy', endDate);
            $('#dubweek').val(sdate+'-'+edate);
            $('#userweek').val(sdate+'-'+edate);
            var startDate;
            var endDate;
            var selectCurrentWeek = function() {//current week 
                window.setTimeout(function () {
                    $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
                }, 1);
            }
            $('.week-picker').datepicker( {
                showOtherMonths: true,
                selectOtherMonths: true,
                firstDay: 1,
                onSelect: function(dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1));
                    endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1) + 6);
                    var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                    var sdate = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                    var edate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                    $('#dubweek').val(sdate+'-'+edate);
                    selectCurrentWeek();
                },
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day != 0), ''];
                }
            });
            $('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
            $('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#bar').click(function() {
                $('#donutchart').hide();
                $('#number_format_chart').show();
            });
            $('#pie').click(function() {
                $('#number_format_chart').hide();
                $('#donutchart').show();
            });
        });
    </script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Categories', 'Categories in Pakodi'],
                ['Emotions', <?php echo $emotions->count; ?>],
                ['Comedy', <?php echo $comedy->count; ?>],
                ['Satire', <?php echo $satire->count; ?>],
                ['Cinema', <?php echo $cinema->count; ?>],
                ['Romance', <?php echo $romance->count; ?>],
                ['Songs', <?php echo $songs->count; ?>],
                ['Classics', <?php echo $classic->count; ?>],
                ['Quotes', <?php echo $motivational->count; ?>],
                ['ENG', <?php echo $eng->count; ?>],
                ['UGC', <?php echo $ugc->count; ?>],
            ]);
            var options = {
                pieSliceText:'value',
                tooltip:{text:'value'},
                pieHole: 0.1,
            };
            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript"
            src="https://www.google.com/jsapi?autoload={
                    'modules':[{
                    'name':'visualization',
                    'version':'1',
                    'packages':['corechart']
                    }]
            }"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawStuff);
        function drawStuff() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Category');
            data.addColumn('number', 'count');
            var data = google.visualization.arrayToDataTable([
                ['Element', 'Density', { role: 'style' }],
                ['Emotions', <?php echo $emotions->count; ?>, '#e5e4e'],
                ['Comedy', <?php echo $comedy->count; ?>, '#8B1D3B'],
                ['Satire', <?php echo $satire->count; ?>, '#ff6a00'],
                ['Cinema', <?php echo $cinema->count; ?>, '#1DA13A'],
                ['Romance', <?php echo $romance->count; ?>, '#B822B1'],
                ['Songs', <?php echo $songs->count; ?>, '#228EB8'],
                ['Classics', <?php echo $classic->count; ?>, '#21115A'],
                ['Quotes', <?php echo $motivational->count; ?>, '#A1CBAB'],
                ['ENG', <?php echo $eng->count; ?>, '#59B79F'],
                ['UGC', <?php echo $ugc->count; ?>, '#777BB0'],
            ]);
            var options = {
                width: 800,
                height: 300,
                legend: 'none',
                bar: {groupWidth: '45%'},
                hAxis: {title: 'Category', titleTextStyle: {color: '#0000'}},
                vAxis: {title: 'Count', titleTextStyle: {color: '#0000'}, gridlines: { count: 4 } }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart'));
            chart.draw(data, options);
            document.getElementById('format-select').onchange = function() {
                options['vAxis']['format'] = this.value;
                chart.draw(data, options);
            };
        };
    </script>
    <div id="graph_users">
        <script type="text/javascript">
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Year', 'Active Users', 'Registered Users'],
                    <?php foreach ($datesn as $key=>$value){ ?>
                    ['<?php echo date('D j M-Y', strtotime($value)) ?>',  <?php echo $activecount[$key]; ?>, <?php echo $registercount[$key]; ?>],
                    <?php } ?>
                ]);
                var options = {
                    title: 'User Activity and Registered Users',
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    height: 350,
                    hAxis: { title: 'Weeks' },
                    vAxis: { title: 'Count' }
                };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                chart.draw(data, options);
            }
        </script>
    </div>
    <div id="graph_dubs">
        <script type="text/javascript">
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Year', 'Private', 'Public'],
                    <?php foreach ($dates as $key=>$value){ ?>
                    ['<?php echo date('D j M-Y', strtotime($value)) ?>',  <?php echo $private_dubs[$key]; ?>, <?php echo $public_dubs[$key]; ?>],
                    <?php } ?>

                ]);
                var options = {
                    title: 'Dubs Statistics',
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    height: 350,
                    hAxis: { title: 'Weeks' },
                    vAxis: { title: 'Count' }
                };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));
                chart.draw(data, options);
            }
        </script>
    </div>

<?php }//end of dashboard ?>

<script type="text/javascript">
    $(document).ready(function() {
        <?php
          if(!empty($content) && $content->content_type == 2){ ?>
        document.getElementById("multipleupload").style.display = 'block';
        document.getElementById("file1").value = '';
        document.getElementById("note").innerHTML = 'Upload only mp3 or aac files';
        document.getElementById("filetitle").innerHTML = 'Upload Audio';
        <?php }
          if(!empty($content) && $content->content_type == 1){ ?>
        document.getElementById("multipleupload").style.display = 'block';
        document.getElementById("file1").value='';
        document.getElementById("note").innerHTML = 'Upload only mp4 or aac files';
        document.getElementById("filetitle").innerHTML = 'Upload Video';
        <?php } ?>

    });//ready
</script>
<script>
    var checked = [] ;
    $('#select_all1').click(function(event) {

        if($('input[name="select_all"]').prop('checked') ==  true){
            $('input:checkbox').attr('checked', true);
            $("input[name='approve[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
        }else{
            $('input:checkbox').attr('checked', false);
            checked=[];
        }

    });
    function chk(e){
        if($('#'+$(e).attr('id')).attr('checked')== 'checked'){
            checked =[];
            $("input[name='approve[]']:checked").each(function ()
            {

                checked.push(parseInt($(this).val()));
            });
        }else{
            checked.remove($(this).val());
        }
    }
    $('#approve_button').click(function(){
        var jsonString = JSON.stringify(checked);
        // alert(jsonString);
        $.ajax({
            type:'POST',
            url: base_url +'Admin/content/waitapprove',
            data:{'content':jsonString},
            success:function(data){
                location.reload();
            }
        });
    });
    $('#reject_button').click(function(){
        var jsonString = JSON.stringify(checked);
        // alert(jsonString);
        $.ajax({
            type:'POST',
            url: base_url +'Admin/content/waitreject',
            data:{'content':jsonString},
            success:function(data){
                location.reload();
            }
        });
    });

</script>
</body>
</html>