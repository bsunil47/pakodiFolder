<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Alert</div>
        <div class="module-body">
            <form id="addalert" name="addalert" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/alerts/add'; ?>" method="post">

                <div class="control-group">
                    <label class="control-label" for="dtype">Device Type:</label>
                  <div class="controls">
                        <select tabindex="1" class="span8" name="dtype" id="dtype">
                            <option value="0">Both</option>
                            <option value="1">IOS</option>
                            <option value="2">Andriod</option>
                        </select>
                        <?php echo form_error('dtype'); ?>
                      </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="msg">Message:</label>
                    <div class="controls">
                        <textarea name="msg" id="msg" class="span8" placeholder="Enter Message Here..." minlength="5" maxlength="250"></textarea>
                       <?php echo form_error('msg'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
					<input type="submit" name="submit" id="submit" value="Add" class="btn pakodi">   
                        <?php //echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
						<a href="javascript:window.history.go(-1);" class="btn pakodi">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>