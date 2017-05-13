<style>
    .collapse.in{
        border-color: #d5d5d5;
        border-width: 1px;
        border-style: solid;
    }
</style>

<div class="sidebar">
    <ul class="widget widget-menu unstyled ">
        <li class= "<?php if ($this->router->fetch_method() == 'dashboard') { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>dubsviewer/users/dashboard"><i class="menu-icon icon-dashboard"></i>Dashboard</a></li>
        <li class= "<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'dublist' || $this->router->fetch_method() == 'updatestatus' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>dubsviewer/users/dubslist"><i class="menu-icon icon-dashboard"></i>Dublist</a></li>
       
    </ul>
</div>