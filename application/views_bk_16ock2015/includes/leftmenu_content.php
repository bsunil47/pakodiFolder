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
       <li class= "<?php if ($this->router->fetch_class() == 'content' && $this->router->fetch_method() == 'contentupload') { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>content/contentupload"><i class="menu-icon icon-arrow-up"></i>Create Job</a></li>
          <li class= "<?php if ($this->router->fetch_class() == 'content' ) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>zipfiles/sample.xls"><i class="menu-icon icon-arrow-up"></i>Sample excel file for download</a></li>
        <?php /*<li ><a class="<?php if ($this->router->fetch_class() != 'dubscontent') { ?>collapsed<?php } ?>" data-toggle="collapse" href="#togglePages6"><i class="menu-icon icon-film"></i>
                <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>Dubs</a>
            <ul id="togglePages6" class="unstyled <?php if ($this->router->fetch_class() == 'dubscontent') { ?>in<?php } ?> collapse">
                <li class= "<?php if ($this->router->fetch_class() == 'dubscontent' && $this->router->fetch_method() == 'dubsupload') { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>dubscontent/dubsupload"><i class="menu-icon icon-arrow-up"></i>Create Dubs</a></li>
                <li class= "<?php if ($this->router->fetch_class() == 'dubscontent' && $this->router->fetch_method() == 'dubslist') { ?>active<?php } ?>"><a  href="<?php echo base_url(); ?>dubscontent/dubslist"><i class="menu-icon icon-arrow-right"></i>Dubs List</a></li>
                <li class= "<?php if ($this->router->fetch_class() == 'dubscontent' ) { ?><?php } ?>"><a href="<?php echo base_url();?>zipfiles/samplepakodidubsmeta.xlsx"><i class="menu-icon icon-arrow-down"></i>Sample excel file Download for Dubs</a></li>
            </ul>
        </li>*/?>
         

    </ul>
</div>