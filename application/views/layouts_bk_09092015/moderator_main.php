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
    </head>
    <body>
        <script>
			var base_url = "<?php echo base_url(); ?>";
			var uriseg = "<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>";
		</script>
        <div class="navbar navbar-fixed-top">
            <?php $this->load->view('includes/moderator_header'); ?>
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <?php $this->load->view('includes/moderator_leftmenu'); ?>
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
        <?php $this->load->view('includes/footer'); ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/additional-methods.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--        <script src="<?php echo base_url(); ?>js/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/flot/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url(); ?>js/flot/jquery.flot.pie.js" type="text/javascript"></script>-->
        <script src="<?php echo base_url(); ?>js/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/common.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/form_validation.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js" type="text/javascript"></script>
		 <style>
            #txtinput{width:400px;height: 30px;border-radius:8px;border:1px solid #999;}
            .ui-autocomplete {
                max-height: 100px;
                overflow-y: auto;
                /* prevent horizontal scrollbar */
                overflow-x: hidden;
            }
        </style>
        </body> 
</html>