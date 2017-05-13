<div class="content">
    <div class="module">
        <div class="module-head"><h3>Add Random Users<span style="float:right; display: inline-block" class="back-close btn pakodi">Back</span></h3></div>
        <div class="module-body">
            <?php //if (!empty($this->session->flashdata('result'))) { echo $this->session->flashdata('result'); }?>
            
            <?php
            $attributes = array('class' => "form-horizontal row-fluid", 'id' => "randusersexcel_form");
            echo form_open_multipart(base_url() . 'Admin/randomusers/add', $attributes);
            ?>

            <div class="control-group">
                <label class="control-label" for="basicinput">Upload Excel File :</label>
                <div class="controls">
                    <?php echo "<input type='file' name='excel_file'  id='excel_file' />"; ?>
                    <?php echo form_error('excel_file'); ?>
             <div id="error_div" style="color:red;"><?php
            if (!empty($error)) {
                echo $error;
            }
            ?></div>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
				<input type="submit" name="submit" id="submit" value="Upload" class="btn pakodi">
                    <?php //echo form_submit('submit', 'Upload', 'id="submit"', 'name="submit"'); ?>
                </div>
            </div>
            <?php echo form_close(); ?>

        </div>
        <!--<div align='right'> <a href="<?php //echo base_url() . 'uploads/'?>pakodi-randusers.xlsx">Download Sample Excel file for Random Users</a></div>-->
    </div>
</div>