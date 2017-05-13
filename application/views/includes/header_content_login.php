<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse"><i class="icon-reorder shaded"></i></a>
        <a class="brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" style="height:70px"/></a>
        <div class="nav-collapse collapse navbar-inverse-collapse">
            <ul class="nav pull-right">
                <?php if ($this->router->fetch_method() == 'index') { ?>
<!--                    <li><a href="--><?php //echo base_url(); ?><!--frontend/forgotpassword" class="forgot">Forgot Password?</a></li>-->
                <?php } else if ($this->router->fetch_method() == 'forgotpassword')  { ?>
                    <li><a href="<?php echo base_url(); ?>" class="forgot">Login</a></li>
                <?php } ?>
            </ul>
        </div><!-- /.nav-collapse -->
    </div>
</div><!-- /navbar-inner -->