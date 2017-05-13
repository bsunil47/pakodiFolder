<style>
    .collapse.in{
        border-color: #d5d5d5;
        border-width: 1px;
        border-style: solid;
    }
</style>
<div class="sidebar">
    <ul class="widget widget-menu unstyled ">
        <li class= "<?php if ($this->router->fetch_class() == 'content' && $this->router->fetch_method() == 'index') { ?>active<?php } ?>" ><a href="<?php echo base_url(); ?>content/index"><i class="menu-icon icon-dashboard"></i>Dashboard</a></li>
        <li class= "<?php if ($this->router->fetch_class() == 'content' && $this->router->fetch_method() == 'clist') { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>content/clist"><i class="menu-icon icon-arrow-right"></i>Content List</a></li>
         <!--<li class= "<?php if ($this->router->fetch_class() == 'content' && $this->router->fetch_method() == 'createjob') { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>content/createjob"><i class="menu-icon icon-arrow-up"></i>Create Job</a></li>-->
          <li class= "<?php if ($this->router->fetch_class() == 'content' ) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>zipfiles/sample.xls"><i class="menu-icon icon-arrow-up"></i>Sample excel file for download</a></li>
         

    </ul>
</div>