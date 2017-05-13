<style>
    .collapse.in {
        border-color: #d5d5d5;
        border-width: 1px;
        border-style: solid;
    }
</style>
<div class="sidebar">
    <ul class="widget widget-menu unstyled ">
        <li class="<?php if ($this->router->fetch_method() == 'dashboard') { ?>active<?php } ?>"><a
                href="<?php echo base_url(); ?>Admin/users/dashboard"><i class="menu-icon icon-dashboard"></i>Dashboard</a>
        </li>
        <li>
            <?php $users_menu_items =['users', 'reandomusers'];  ?>
            <a class="menu-item <?php if (in_array($this->router->fetch_class(),$users_menu_items) && $this->router->fetch_method() != 'dashboard') { }else{ ?>collapsed<?php } ?>"
               data-toggle="collapse" href="#togglePages2"><i class="menu-icon icon-user"></i>
                <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>Users</a>
            <ul id="togglePages2"
                class="unstyled <?php if (($this->router->fetch_class() == 'users' && $this->router->fetch_method() != 'dashboard') || $this->router->fetch_class() == 'randomusers') { ?>in<?php } ?> collapse">
                <?php if ($this->session->userdata('user_type') == 0) { ?>
                <li
                    class="<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'adminuserlist' || $this->router->fetch_method() == 'adupdate')) { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/users/adminuserlist"><i class="menu-icon icon-user"></i>Admin
                        Users</a></li><?php } ?>
                <li class="<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'moderatoruserlist' || $this->router->fetch_method() == 'modupdate')) { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/users/moderatoruserlist"><i class="menu-icon icon-user"></i>Moderators</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'contentownerlist' || $this->router->fetch_method() == 'coupdate')) { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/users/contentownerlist"><i class="menu-icon icon-user"></i>Contentowners</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'userlist' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view')) { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/users/userlist"><i class="menu-icon icon-user"></i>App Users</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'randomusers' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add')) { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/randomusers"><i class="menu-icon icon-random"></i>Random
                        Users</a></li>
                <li class="<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'add')) { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/users/add"><i class="menu-icon icon-user-md"></i>Add
                        Users</a></li>
            </ul>
        </li>

        <li>
            <a id="item-level2-menu1"   class="menu-item <?php if ($this->router->fetch_class() != 'cms' && ($this->router->fetch_class() != 'content' && ($this->router->fetch_method() != 'index' && $this->router->fetch_method() != 'add' && $this->router->fetch_method() != 'update')) && ($this->router->fetch_class() != 'dubscontent') && ($this->router->fetch_class() != 'dubbedusers')) { ?>collapsed<?php } ?>"
               data-toggle="collapse" href="#togglePages5" >
                <i class="menu-icon icon-desktop"></i>
                <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>CMS</a>
            <ul id="togglePages5"
                class="second-widget-menu unstyled <?php if (($this->router->fetch_class() == 'cms') || ($this->router->fetch_class() == 'content') || ($this->router->fetch_class() == 'dubbedusers') || ($this->router->fetch_class() == 'dubscontent') || ($this->router->fetch_class() == 'carousal') || ($this->router->fetch_class() == 'appversion') || ($this->router->fetch_class() == 'category') || ($this->router->fetch_class() == 'languages') || ($this->router->fetch_class() == 'flags')) { ?>in<?php } ?> collapse">
                <li class="<?php if ($this->router->fetch_class() == 'cms' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'edit')) { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/cms"><i class="menu-icon icon-book"></i>About Us</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'cms' && ($this->router->fetch_method() == 'terms' || $this->router->fetch_method() == 'termsedit')) { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/cms/terms"><i class="menu-icon icon-info-sign"></i>Terms &
                        Conditions</a></li>
                <!--contentlist start-->
                <li>
                    <a data-autohide="false" class="menu-item <?php if (!($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'getwdetails' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'deletedcontentlist' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'waiting'))) { ?>collapsed<?php } ?>" data-toggle="collapse" href="#togglePages8" data-item="item-level2-menu1">
                        <i class="menu-icon fa fa-file-text-o"></i>
                        <i class="icon-chevron-down pull-right"></i>
                        <i class="icon-chevron-up pull-right"></i>Content
                        List
                    </a>
                    <ul id="togglePages8"
                        class="second-widget-menu unstyled <?php if (($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'getwdetails' || $this->router->fetch_method() == 'add') || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view' || $this->router->fetch_method() == 'waiting' || $this->router->fetch_method() == 'deletedcontentlist')) { ?>in<?php } ?> collapse">
                        <li class="<?php if ($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/content"><i class="menu-icon fa fa-file-o"></i>Approved
                                Content</a></li>
                        <li class="<?php if ($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'deletedcontentlist' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/content/deletedcontentlist"><i
                                    class="menu-icon fa fa-thumbs-o-down"></i>Rejected Content</a></li>
                        <li class="<?php if ($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'waiting' || $this->router->fetch_method() == 'getwdetails' || $this->router->fetch_method() == 'update' || $this->router->fetch_method() == 'view')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/content/waiting"><i class="menu-icon fa fa-pencil-square-o"></i>Waiting
                                for Approval</a></li>
                    </ul>
                </li>
                <!-- contentlist End-->
                <!-- UGC list start-->
                <li>
                    <a class="menu-item <?php if ($this->router->fetch_class() != 'dubbedusers' && $this->router->fetch_class() != 'dubscontent') { ?>collapsed<?php } ?>" data-toggle="collapse" href="#togglePages6" data-item="item-level2-menu1">
                        <i class="menu-icon icon-film"></i>
                        <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
                        UGC Content</a>
                    <ul id="togglePages6"
                        class="second-widget-menu unstyled <?php if ($this->router->fetch_class() == 'dubbedusers' || $this->router->fetch_class() == 'dubscontent') { ?>in<?php } ?> collapse">
                        <li class="<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/dubbedusers"><i class="fa fa-pause"></i> Waiting
                                for Moderation</a></li>
                        <li class="<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'records' || $this->router->fetch_method() == 'recordupdate' || $this->router->fetch_method() == 'moverecord')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/dubbedusers/records"><i
                                    class="menu-icon fa fa-volume-up"></i>Audio Records</a></li>
                        <li class="<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'deleteddubs' || $this->router->fetch_method() == 'dubdelupdate')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/dubbedusers/deleteddubs"><i
                                    class="menu-icon fa fa-thumbs-o-down"></i>Rejected Dubs</a></li>
                        <li class="<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'deletedrecords' || $this->router->fetch_method() == 'dubdelrecupdate')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/dubbedusers/deletedrecords"><i
                                    class="menu-icon fa fa-thumbs-o-down"></i>Rejected Records</a></li>
                        <li class="<?php if ($this->router->fetch_class() == 'dubbedusers' && ($this->router->fetch_method() == 'ugc' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/dubbedusers/ugc"><i class="menu-icon icon-film"></i>UGC
                                Category</a></li>
                        <li class="<?php if ($this->router->fetch_class() == 'dubscontent' && $this->router->fetch_method() == 'dubsupload') { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/dubscontent/dubsupload"><i
                                    class="menu-icon icon-arrow-up"></i>Upload UGC Dubs</a></li>
                    </ul>
                </li>
                <!--UGC list End-->
                <li class="<?php if ($this->router->fetch_class() == 'carousal') { ?>active<?php } ?>"><a
                        href="<?php echo base_url(); ?>Admin/carousal"><i class="menu-icon fa fa-adn"></i>Ad
                        Management</a></li>
                <!-- Settings start-->
                <li>
                    <a class="menu-item <?php if (!($this->router->fetch_class() == 'content' && $this->router->fetch_method() == 'recommend') && ($this->router->fetch_class() != 'appversion') && ($this->router->fetch_class() != 'category') && ($this->router->fetch_class() != 'languages')) { ?>collapsed<?php } ?>"
                       data-toggle="collapse" href="#togglePages7" data-item="item-level2-menu1"><i class="menu-icon fa fa-cogs"></i>
                        <i class="icon-chevron-down pull-right"></i><i
                            class="icon-chevron-up pull-right"></i>Settings</a>
                    <ul id="togglePages7"
                        class="second-widget-menu unstyled <?php if (($this->router->fetch_class() == 'settings') || (($this->router->fetch_class() == 'content' && $this->router->fetch_method() == 'recommend') && ($this->router->fetch_method() == 'recommend' || $this->router->fetch_method() == 'recupdate')) || ($this->router->fetch_class() == 'appversion') || ($this->router->fetch_class() == 'category') || ($this->router->fetch_class() == 'languages')) { ?>in<?php } ?> collapse">

                        <li class="<?php if ($this->router->fetch_class() == 'content' && ($this->router->fetch_method() == 'recommend' || $this->router->fetch_method() == 'recupdate')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/content/recommend"><i
                                    class="menu-icon fa fa-check-square-o"></i>Recommends</a></li>
                        <li class="<?php if ($this->router->fetch_class() == 'appversion' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/appversion"><i class="menu-icon fa fa-code-fork"></i>App
                                Version</a></li>
                        <li class="<?php if ($this->router->fetch_class() == 'category' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/category"><i class="menu-icon fa fa-sitemap"></i>Categories</a>
                        </li>
                        <li class="<?php if ($this->router->fetch_class() == 'languages' && ($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add' || $this->router->fetch_method() == 'update')) { ?>active<?php } ?>">
                            <a href="<?php echo base_url(); ?>Admin/languages"><i
                                    class="menu-icon fa fa-language"></i>Languages</a></li>
                    </ul>
                </li>
                <!-- Settings End -->
                <li class="<?php if ($this->router->fetch_class() == 'flags' && $this->router->fetch_method() == 'index') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/flags"><i class="menu-icon icon-flag"></i>Flags</a>
                </li>
            </ul>
        </li>
        <li>

            <a class="menu-item <?php if ($this->router->fetch_class() != 'alerts') { ?>collapsed<?php } ?>" href="#togglePages9" data-toggle="collapse">
                <i class="menu-icon fa fa-bell"></i>
                <i class="icon-chevron-down pull-right"></i>
                <i class="icon-chevron-up pull-right"></i>Alerts
            </a>
            <ul id="togglePages9"
                class="unstyled <?php if ($this->router->fetch_class() == 'alerts') { ?>in<?php } ?> collapse">
                <li class="<?php if ($this->router->fetch_class() == 'alerts' && $this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'add') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/alerts"><i class="menu-icon icon-time"></i>General
                        Alerts</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'alerts' && $this->router->fetch_method() == 'birthdayalerts' || $this->router->fetch_method() == 'addbirthdayalert') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/alerts/editbalert"><i class="menu-icon fa fa-birthday-cake"></i>Birthday
                        Alerts</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'alerts' && $this->router->fetch_method() == 'commonusers' || $this->router->fetch_method() == 'addusers') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/alerts/commonusers"><i class="menu-icon fa fa-users"></i>User Clips</a></li>
                <li class="<?php if ($this->router->fetch_class() == 'alerts' && $this->router->fetch_method() == 'artistclips' || $this->router->fetch_method() == 'addartistclip') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/alerts/artistclips"><i class="menu-icon fa fa-users"></i>Artist Clips</a></li>
            </ul>
        </li>
        <li class="<?php if ($this->router->fetch_class() == 'reports') { ?>active<?php } ?>"><a
                href="<?php echo base_url(); ?>Admin/reports"><i class="menu-icon icon-envelope"></i>Feedback</a>
        </li>
        <li>

            <a class="menu-item <?php if ($this->router->fetch_class() != 'creports') { ?>collapsed<?php } ?>" href="#togglePages14" data-toggle="collapse">
                <i class="menu-icon icon-table"></i>
                <i class="icon-chevron-down pull-right"></i>
                <i class="icon-chevron-up pull-right"></i>Reports
            </a>
            <ul id="togglePages14"
                class="unstyled <?php if ($this->router->fetch_class() == 'creports') { ?>in<?php } ?> collapse">
                <li class="<?php if ($this->router->fetch_class() == 'creports' && $this->router->fetch_method() == 'index') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/creports"><i class="menu-icon icon-dashboard"></i>Reports Dashboard</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'creports' && $this->router->fetch_method() == 'viewsreport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/creports/viewsreport"><i class="menu-icon fa fa-eye"></i>Most Viewed Report</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'creports' && $this->router->fetch_method() == 'downloadsreport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/creports/downloadsreport"><i class="menu-icon fa fa-download"></i>Most Downloaded Report</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'creports' && $this->router->fetch_method() == 'dubsreport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/creports/dubsreport"><i class="menu-icon fa fa-video-camera"></i>Most Dubed Report</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'creports' && $this->router->fetch_method() == 'sharereport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/creports/sharereport"><i class="menu-icon fa fa-share-alt"></i>Most Shared Report</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'creports' && $this->router->fetch_method() == 'contentreport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/creports/contentreport"><i class="menu-icon fa fa-file-text-o"></i>Content Search Report</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'creports' && $this->router->fetch_method() == 'search') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/creports/search"><i class="menu-icon icon-user"></i>Artist/Movie name Report</a>
                </li>
				<li class="<?php if ($this->router->fetch_class() == 'creports' && $this->router->fetch_method() == 'langwisereport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/creports/langwisereport"><i class="menu-icon fa fa-language"></i>Language/Category Content Report</a>
                </li>
            </ul>
        </li>
        <li>

            <a class="menu-item <?php if ($this->router->fetch_class() != 'ccreports' || $this->router->fetch_class() != 'loginusers') { ?>collapsed<?php } ?>" href="#togglePages15" data-toggle="collapse">
                <i class="menu-icon icon-table"></i>
                <i class="icon-chevron-down pull-right"></i>
                <i class="icon-chevron-up pull-right"></i>User Reports
            </a>
            <ul id="togglePages15"
                class="unstyled <?php if ($this->router->fetch_class() == 'ccreports'  || $this->router->fetch_class() == 'loginusers') { ?>in<?php } ?> collapse">
                <li class="<?php if ($this->router->fetch_class() == 'loginusers' && $this->router->fetch_method() == 'index') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/loginusers/index"><i class="menu-icon fa fa-sign-in"></i>Login User Report</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'ccreports' && $this->router->fetch_method() == 'viewsreport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/ccreports/viewsreport"><i class="menu-icon fa fa-eye"></i>Most Viewed Report</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'ccreports' && $this->router->fetch_method() == 'downloadsreport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/ccreports/downloadsreport"><i class="menu-icon fa fa-download"></i>Most Downloaded Report</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'ccreports' && $this->router->fetch_method() == 'dubsreport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/ccreports/dubsreport"><i class="menu-icon fa fa-video-camera"></i>Most Dubed Report</a>
                </li>
                <li class="<?php if ($this->router->fetch_class() == 'ccreports' && $this->router->fetch_method() == 'sharereport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/ccreports/sharereport"><i class="menu-icon fa fa-share-alt"></i>Most Shared Report</a>
                </li>
				<li class="<?php if ($this->router->fetch_class() == 'ccreports' && $this->router->fetch_method() == 'userreport') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>Admin/ccreports/userreport"><i class="menu-icon icon-user"></i>User Report</a>
                </li>
			</ul>
        </li>
        <!-- <li class="<?php /*if ($this->router->fetch_class() == 'alerts' && $this->router->fetch_method() == 'index') { */ ?>active<?php /*} */ ?>">
            <a href="<?php /*echo base_url(); */ ?>Admin/alerts"><i class="menu-icon icon-flag"></i>Alerts</a>
        </li>-->


    </ul>
</div>