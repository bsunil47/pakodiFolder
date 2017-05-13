<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
            <i class="icon-reorder shaded"></i></a><a class="brand" href="<?php echo base_url(); ?>content" style="padding: 0;"><img src="<?php echo base_url(); ?>images/logo.png" style="height:70px"/> </a>
        <div class="nav-collapse collapse navbar-inverse-collapse">
            <ul class="nav pull-right">
                <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo "CONTENT OWNER-".$this->session->userdata('co_name'); ?>
                        <?php if($this->session->userdata('co_profile_picture') != ''){ ?>
                        <img src="http://sprintmedia.s3.amazonaws.com/userimages/<?php echo $this->session->userdata('co_profile_picture'); ?>" class="nav-avatar" />
                        <?php } else { ?>
                         <img src="<?php echo base_url(); ?>images/default_user.png" class="nav-avatar" />
                        <?php } ?>
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        <li><a href="<?php echo base_url(); ?>frontend/changepassword" <?php
                            if ($this->router->fetch_class() == 'frontend' && $this->router->fetch_method() == 'changepassword') {
                                echo 'style="display:block; color:#ff6a00;"';
                            }
                            ?>>Change Password</a></li>
							<li><a href="<?php echo base_url(); ?>frontend/profile" <?php
                            if ($this->router->fetch_class() == 'frontend' && $this->router->fetch_method() == 'profile') {
                                echo 'style="display:block; color:#ff6a00;"';
                            }
                            ?>>Edit Profile</a></li>
							<li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>frontend/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
                     