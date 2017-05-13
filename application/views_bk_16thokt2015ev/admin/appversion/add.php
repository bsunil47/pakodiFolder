<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add App Version</h3></div>
        <div class="module-body">
            <form id="addappversion" name="addappversion" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/appversion/add'; ?>" method="post">

                <div class="control-group">
                    <label class="control-label" for="ostype">OS Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="ostype" id="ostype">
                            <option value="">-Select Type-</option>
                            <option value="1" <?php if(!empty($_POST['ostype']) && $_POST['ostype'] == 1){echo 'selected="selected"';} ?> >IOS</option>
                            <option value="2" <?php if(!empty($_POST['ostype']) && $_POST['ostype'] == 2){echo 'selected="selected"';} ?> >Android</option>
                        </select>
                        <?php echo form_error('ostype'); ?>
                        </select>
                    </div>
                </div>

				
		<div class="control-group">
                    <label class="control-label" for="appversion">App Version:</label>
                    <div class="controls">
                        <?php echo form_input('appversion', $this->input->post('appversion'), 'id="appversion", class="span8"  autocomplete="off"'); ?>
                        <?php echo form_error('appversion'); ?>
                    </div>
                </div>
				
		

                <div class="control-group">
                    <div class="controls">
						<input type="submit" id="submit" name="submit" class="btn pakodi" value="Add">
                        <?php //echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                        <a href="javascript:window.history.go(-1);" class="btn pakodi" style="margin-bottom: -3px;">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>