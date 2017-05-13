<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit Settings</h3></div>
        <div class="module-body">
            <form id="updatesettings" name="updatesettings" method="post" action="" class="form-horizontal row-fluid">
			
			   <div class="control-group">
                    <label class="control-label" for="category">Name:</label>
                    <div class="controls">
                        <?php echo form_input('name', $settings->name, 'id="name", class="span8"  autocomplete="off" disabled'); ?>
                        <?php echo form_error('name'); ?>
                    </div>
                </div>
               
               <div class="control-group">
                    <label class="control-label" for="category">Page Limit:</label>
                    <div class="controls">
                        <?php echo form_input('page_limit', $settings->page_limit, 'id="page_limit", class="span8" autocomplete="off"'); ?>
                        <?php echo form_error('page_limit'); ?>
                    </div>
                </div>
				
				<div class="control-group">
                    <label class="control-label" for="category">Maximum Records:</label>
                    <div class="controls">
                        <?php echo form_input('number_of_records', $settings->number_of_records, 'id="number_of_records", class="span8" autocomplete="off"'); ?>
                        <?php echo form_error('number_of_records'); ?>
                    </div>
                </div>


                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                        <a href="javascript:window.history.go(-1);" class="btn-inverse" style="padding:3px;">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>