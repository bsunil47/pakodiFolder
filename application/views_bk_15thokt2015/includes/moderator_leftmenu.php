<style>
    .collapse.in{
        border-color: #d5d5d5;
        border-width: 1px;
        border-style: solid;
    }
</style>

<div class="sidebar">
    <ul class="widget widget-menu unstyled ">
        <li class= "<?php if ($this->router->fetch_method() == 'dashboard') { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>moderator/users/dashboard"><i class="menu-icon icon-dashboard"></i>Dashboard</a></li>
        <li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'records' || $this->router->fetch_method() == 'updatestatus' || $this->router->fetch_method() == 'recordupdate' || $this->router->fetch_method() == 'moverecord')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>moderator/users/records"><i class="menu-icon icon-dashboard"></i>Records</a></li>
		<li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'dubbedusers' || $this->router->fetch_method() == 'updatestatus' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'movedubs')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>moderator/users/dubbedusers"><i class="menu-icon icon-dashboard"></i>User Dubs</a></li>
        <li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'ugc' || $this->router->fetch_method() == 'updatestatus' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>moderator/users/ugc"><i class="menu-icon icon-dashboard"></i>UGC Content</a></li>
		<li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'deleteddubs' || $this->router->fetch_method() == 'dubdelupdate' || $this->router->fetch_method() == 'movedeldub')) { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>moderator/users/deleteddubs"><i class="menu-icon icon-film"></i>Deleted Dubs</a></li>
<li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'deletedrecords' || $this->router->fetch_method() == 'dubdelrecupdate' || $this->router->fetch_method() == 'movedelrecord')) { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>moderator/users/deletedrecords"><i class="menu-icon icon-film"></i>Deleted Records</a></li>	
    </ul>
</div>