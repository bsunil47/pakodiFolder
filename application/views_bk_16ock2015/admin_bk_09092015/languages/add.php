<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Language</h3></div>
        <div class="module-body">
            <form id="addlanguage" name="addlanguage" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/languages/add'; ?>" method="post">

                <div class="control-group">
                    <label class="control-label" for="langauge">Language Name:</label>
                    <div class="controls">
                        <?php echo form_input('language', $this->input->post('language'), 'id="language", class="span8" placeholder="Enter Langauge Name" autocomplete="off"'); ?>
                        <?php echo form_error('language'); ?>
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