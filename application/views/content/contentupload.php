<div class="content">
    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <div class="span8">
                <div class="row-fluid">
                    <div class="span12">
                        <!--<a href="<?php //echo base_url(); ?>content/clist"  class="btn-box small span4"><i class="icon-download"></i><b>&nbsp;</b>Content List</a>-->
                        <!--<a href="<?php //echo base_url(); ?>content/createjob" class="btn-box small span4"><i class="icon-upload"></i><b>&nbsp;</b>Create Job</a>-->
						
                    </div>

                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <form enctype="multipart/form-data" method="POST" action="<?php echo base_url(); ?>content/createjob" class="btn-box small span8">
                            <label style="color:blue">Content zip upload</label>
                            <input name="file" type="file" />
                            <input type="submit" value="submit" name="submit" id="create_job" class="btn pakodi"/>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>


