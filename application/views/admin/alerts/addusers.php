<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add User Clip</h3></div>
        <div class="module-body">
            <form id="addcuser" name="addcuser" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/alerts/addusers'; ?>" method="post" enctype="multipart/form-data">

               <div class="control-group">
                    <label class="control-label" for="name">Name:</label>

                    <div class="controls">
                        <input type="text" name="name" id="name" class="span8" placeholder="Enter Name Here..." >
                    <?php echo form_error('name'); ?>
                    </div>
                </div>

               <div class="control-group">
                    <label class="control-label" for="clip">Clip File:</label>

                    <div class="controls">
                        <input type="file" name="clip" id="clip" placeholder="Upload Content Clip">
                         <?php echo form_error('clip'); ?>
                    </div>
                </div>     
                         
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" name="submit" id="submit" value="Add" class="btn pakodi">
<?php // echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"');  ?>
                        <a href="javascript:window.history.go(-1);" class="btn pakodi"
                           style="margin-bottom: -3px;">Back</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!--zipfiles-->
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Add User  Clip Excel</h3></td>
                    <td align="right"><a href="<?php echo base_url() . 'zipfiles/'?>userclipsexcel.xlsx" class="btn pakodi">Sample Excel Download</a>
					</td>
                </tr>
            </table></div>
        <div class="module-body">
            <form id="addecuser" name="addecuser" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/alerts/addusers'; ?>" method="post" enctype="multipart/form-data">
               <div class="control-group">
                    <label class="control-label" for="zip">Upload Zip File:</label>
                    <div class="controls">
                        <input type="file" name="zip" id="zip" placeholder="Upload Content Clip">
                         <?php echo form_error('zip'); ?>
                    </div>
                </div>     
                         
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" name="esubmit" id="esubmit" value="Add" class="btn pakodi">
<?php // echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"');  ?>
                       
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
