<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit App Version</h3></div>
        <div class="module-body">
            <form id="updateappversion" name="updateappversion" method="post" action="" class="form-horizontal row-fluid">
		    <div class="control-group">
                    <label class="control-label" for="ostype">OS Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="os_type" id="ostype">
                            <option value="">-Select Type-</option>
                            <option value="1" <?php if($appversion->os_type == 1){ echo 'selected="selected"'; }?> >IOS</option>
                            <option value="2" <?php if($appversion->os_type == 2){ echo 'selected="selected"'; }?>>Android</option>
                        </select>
                        <?php echo form_error('os_type'); ?>
                        </select>
                    </div>
                </div>
               
               <div class="control-group">
                    <label class="control-label" for="appversion">App Version:</label>
                    <div class="controls">
                        <?php echo form_input('app_version', $appversion->app_version, 'id="appversion", class="span8" autocomplete="off"'); ?>
                        <?php echo form_error('app_version'); ?>
                    </div>
                </div>
				
		<div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                        <a href="javascript:window.history.go(-1);" class="btn pakodi" style="margin-bottom: -3px;">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>