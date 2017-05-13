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
                            <option value="">-Select-</option>
                            <option value="3">IOS</option>
                            <option value="1">Andriod</option>
                            <option value="2">Both</option>
                        </select>
                        <?php echo form_error('dtype'); ?>
                      </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="msg">Message:</label>
                    <div class="controls">
                     <?php echo form_textarea('msg', $this->input->post('msg'), 'id="msg", class="span8" placeholder="Enter message" autocomplete="off"'); ?>
                             <?php echo form_error('msg'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>