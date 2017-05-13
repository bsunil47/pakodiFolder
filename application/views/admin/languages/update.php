<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit Language<span style="float:right; display: inline-block" class="back-close btn pakodi">Back</span></h3></div>
        <div class="module-body">
            <form id="updatelanguage" name="updatelanguage" method="post" action="<?php echo base_url();?>Admin/languages/update/<?php echo $language->lang_id;?>" class="form-horizontal row-fluid">
                <?php //print_r($data); exit; ?>
                <div class="control-group">
                    <label class="control-label" for="language">Language Name:</label>
                    <div class="controls">
                        <?php echo form_input('language', $language->language, 'id="language", class="span8" placeholder="Enter L Name" autocomplete="off"'); ?>
                        <?php echo form_error('language'); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
						<input type="submit" name="submit" id="submit" value="Edit" class="btn pakodi">
                        <?php //echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>