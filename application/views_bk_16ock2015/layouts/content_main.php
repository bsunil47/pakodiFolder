<!DOCTYPE html>
<html lang="en">
    <head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PAKODI</title>
        <link type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>css/theme.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='<?php echo base_url(); ?>css/fonts.css' rel='stylesheet'>
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
        a:active {
    background-color:#E01E1C;
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
.popup-content{
    border: 4px solid #f6f6f6;
}
.popup img{
    width: auto;
    height: auto;
}
.popup video{
    width: 500px;
    height: auto;
}
</style>
    </head>
    <body>
        <script>
		var base_url = "<?php echo base_url(); ?>";
        var uriseg = "<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>";
        </script>
        <div class="navbar navbar-fixed-top">
            <?php
            if(isset($this->session->userdata['user_type']) && $this->session->userdata['user_type'] <= 1){
                $this->load->view('includes/header');
            }elseif(!empty($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 3){
                $this->load->view('includes/moderator_header');
            }elseif(!empty($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 4){
                $this->load->view('includes/header_content_main');
            }
            ?>
            <?php //$this->load->view('includes/header_content_main'); ?>

        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <?php
                        if(isset($this->session->userdata['user_type']) && $this->session->userdata['user_type'] <= 1){
                            $this->load->view('includes/leftmenu');
                        }elseif(!empty($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 3){
                            $this->load->view('includes/moderator_leftmenu');
                        }elseif(!empty($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 4){
                            $this->load->view('includes/leftmenu_content');
                        }
                        ?>
                        <?php //$this->load->view('includes/leftmenu_content'); ?>
                    </div>
                    <div align="center" class="<?php echo $this->session->flashdata('type'); ?>"><?php echo $this->session->flashdata('msg'); ?></div>
                    <div class="span9">
                        <?php echo $content_for_layout; ?>
                    </div>
                    <!--/.span9-->
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
        <script src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js" type="text/javascript"></script>
       <script>
$(document).on('click', '.test', function () {
     jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
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
$(document).ready(function(){
    $(".close-button").click(function(){
         $(".popup-content").html("");
         $('.overlay').hide();
         $('.popup').hide();
         $('body').css('overflow-y','visible');
    });
    $('.overlay').click(function(){
        $(".popup-content").html("");
         $('.overlay').hide();
         $('.popup').hide();
         $('body').css('overflow-y','visible');
    });
});
               </script>
       
    </body>
</html>