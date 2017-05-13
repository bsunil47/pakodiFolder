<style>
    .collapse.in{
        border-color: #d5d5d5;
        border-width: 1px;
        border-style: solid;
    }
</style>
<div class="sidebar">
    <ul class="widget widget-menu unstyled ">
        <li class= "<?php if ($this->router->fetch_method() == 'dashboard') { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/users/dashboard"><i class="menu-icon icon-dashboard"></i>Dashboard</a></li>
        <li><a class="<?php if (($this->router->fetch_class() != 'users' && $this->router->fetch_method() == 'dashboard')|| $this->router->fetch_class() != 'randomusers' ) { ?>collapsed<?php } ?>" data-toggle="collapse" href="#togglePages2"><i class="menu-icon icon-user"></i>
              <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>Users</a>
            <ul id="togglePages2" class="unstyled <?php if (($this->router->fetch_class() == 'users' && $this->router->fetch_method() != 'dashboard')  ||$this->router->fetch_class() == 'randomusers' ) { ?>in<?php } ?> collapse">
        <?php if($this->session->userdata('user_type')==0){?><li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'adminuserlist' ||  $this->router->fetch_method() == 'adupdate')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/users/adminuserlist"><i class="menu-icon icon-user"></i>Admin Users</a></li><?php }?>
        <li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'moderatoruserlist' || $this->router->fetch_method() == 'modupdate')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/users/moderatoruserlist"><i class="menu-icon icon-user"></i>Moderators</a></li>
        <li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'contentownerlist' || $this->router->fetch_method() == 'coupdate')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/users/contentownerlist"><i class="menu-icon icon-user"></i>Contentowners</a></li>
        <li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'userlist' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/users/userlist"><i class="menu-icon icon-user"></i>App Users</a></li>   
        <li class= "<?php if ($this->router->fetch_class() == 'randomusers' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/randomusers"><i class="menu-icon icon-random"></i>Random Users</a></li>
        <li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'add')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/users/add"><i class="menu-icon icon-user-md"></i>Add Users</a></li>
            </ul>
        </li>
     <?php //echo $this->router->fetch_method();exit;?>
<li><a class="<?php if (($this->router->fetch_class()!= 'content' ) && ($this->router->fetch_method()== 'recommend') || ($this->router->fetch_method()== 'recupdate')) { ?>collapsed<?php } ?>" data-toggle="collapse" href="#togglePages8"><i class="menu-icon icon-screenshot"></i>
            <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>Content List</a>
            <ul id="togglePages8" class="unstyled <?php if ((($this->router->fetch_class() == 'content')&& ($this->router->fetch_method()!= 'recommend')&& ($this->router->fetch_method()!= 'recupdate')) || ($this->router->fetch_class()== 'content' && ($this->router->fetch_method() == 'update')&& ($this->router->fetch_method()!= 'recommend') && ($this->router->fetch_method()!= 'recupdate'))) { ?>in<?php } ?> collapse">
				<li class= "<?php if ($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/content"><i class="menu-icon icon-book"></i>Approved Content</a></li>
				<li class= "<?php if ($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'deletedcontentlist' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/content/deletedcontentlist"><i class="menu-icon icon-book"></i>Deleted Content</a></li>
 <li class= "<?php if ($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'waitning' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/content/waiting"><i class="menu-icon icon-book"></i>Waiting for Approve</a></li>
            </ul>
        </li>
       
<!--        <li class= "<?php if ($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/content"><i class="menu-icon icon-book"></i>ContentList</a></li>-->
        <li><a class="<?php if ($this->router->fetch_class() != 'cms') { ?>collapsed<?php } ?>" data-toggle="collapse" href="#togglePages5"><i class="menu-icon icon-desktop"></i>
              <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>CMS</a>
            <ul id="togglePages5" class="unstyled <?php if ($this->router->fetch_class() == 'cms') { ?>in<?php } ?> collapse">
                <li class= "<?php if ($this->router->fetch_class() == 'cms' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'edit')) { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>Admin/cms"><i class="menu-icon icon-folder-open"></i>About Us</a></li>
                <li class= "<?php if ($this->router->fetch_class() == 'cms' && ($this->router->fetch_method() == 'terms' || $this->router->fetch_method() == 'termsedit')) { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>Admin/cms/terms"><i class="menu-icon icon-info-sign"></i>Terms & Conditions</a></li>
            </ul>
        </li>
        <li class= "<?php if ($this->router->fetch_class() == 'reports') { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/reports"><i class="menu-icon icon-envelope"></i>User ContactUs</a></li>
        <?php /*<li class= "<?php if ($this->router->fetch_class() == 'dubbedusers') { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/dubbedusers"><i class="menu-icon icon-film"></i>User Dubs</a></li>*/?>
	<li><a class="<?php if ($this->router->fetch_class() != 'dubbedusers') { ?>collapsed<?php } ?>" data-toggle="collapse" href="#togglePages6"><i class="menu-icon icon-film"></i>
              <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>Moderations</a>
            <ul id="togglePages6" class="unstyled <?php if ($this->router->fetch_class() == 'dubbedusers') { ?>in<?php } ?> collapse">
                <li class= "<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>Admin/dubbedusers"><i class="menu-icon icon-film"></i>User Dubs</a></li>
                <li class= "<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'records' || $this->router->fetch_method() == 'recordupdate')) { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>Admin/dubbedusers/records"><i class="menu-icon icon-film"></i>Records</a></li>
           <li class= "<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'deleteddubs' || $this->router->fetch_method() == 'dubdelupdate')) { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>Admin/dubbedusers/deleteddubs"><i class="menu-icon icon-film"></i>Deleted Dubs</a></li>
            <li class= "<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'deletedrecords' || $this->router->fetch_method() == 'dubdelrecupdate')) { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>Admin/dubbedusers/deletedrecords"><i class="menu-icon icon-film"></i>Deleted Records</a></li>
                <li class= "<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'ugc' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>Admin/dubbedusers/ugc"><i class="menu-icon icon-film"></i>UGC Content</a></li>
            </ul>
        </li>
        <li class= "<?php if ($this->router->fetch_class() == 'carousal') { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/carousal"><i class="menu-icon icon-facetime-video"></i>Carousal</a></li>
        <li><a class="<?php if (($this->router->fetch_class()!= 'settings') && ($this->router->fetch_class()!= 'content') && ($this->router->fetch_class()!= 'appversion') && ($this->router->fetch_class()!= 'category') && ($this->router->fetch_class()!= 'languages')) { ?>collapsed<?php } ?>" data-toggle="collapse" href="#togglePages7"><i class="menu-icon icon-screenshot"></i>
            <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>Settings</a>
            <ul id="togglePages7" class="unstyled <?php if (($this->router->fetch_class() == 'settings') || ($this->router->fetch_class()== 'content' && ($this->router->fetch_method() == 'recommend' || $this->router->fetch_method() == 'recupdate' )) || ($this->router->fetch_class()== 'appversion') || ($this->router->fetch_class()== 'category') || ($this->router->fetch_class()== 'languages')) { ?>in<?php } ?> collapse">
<!--                <li class= "--><?php //if ($this->router->fetch_class() == 'settings' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update')) { ?><!--active--><?php //} ?><!--" ><a href="--><?php //echo base_url(); ?><!--Admin/settings"><i class="menu-icon icon-cog"></i>Api Limit</a></li>-->
				<li class= "<?php if ($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'recommend'|| $this->router->fetch_method() == 'recupdate')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/content/recommend"><i class="menu-icon icon-comments"></i>Recommends</a></li>
				<li class= "<?php if ($this->router->fetch_class() == 'appversion' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/appversion"><i class="menu-icon icon-cog"></i>App Version</a></li>
				<li class= "<?php if ($this->router->fetch_class() == 'category' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/category"><i class="menu-icon icon-folder-open"></i>Categories</a></li>
				<li class= "<?php if ($this->router->fetch_class() == 'languages' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/languages"><i class="menu-icon icon-folder-close-alt"></i>Languages</a></li>
            </ul>
        </li>

       <li class= "<?php if ($this->router->fetch_class() == 'flags' && $this->router->fetch_method() == 'index') { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/flags"><i class="menu-icon icon-flag"></i>Flags</a></li>
        <li class= "<?php if ($this->router->fetch_class() == 'alerts' && $this->router->fetch_method() == 'index') { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>Admin/alerts"><i class="menu-icon icon-flag"></i>Alerts</a></li>
        <li class= "<?php if ($this->router->fetch_class() == 'dubscontent' && $this->router->fetch_method() == 'dubsupload') { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>Admin/dubscontent/dubsupload"><i class="menu-icon icon-arrow-up"></i>Create Dubs</a></li>
		</ul>
</div>