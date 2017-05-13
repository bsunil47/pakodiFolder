<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Category</h3></div>
        <div class="module-body">
            <form id="addcategory" name="addcategory" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/category/add'; ?>" method="post">

                <div class="control-group">
                    <label class="control-label" for="category">Category Name:</label>
                    <div class="controls">
                        <?php echo form_input('category', $this->input->post('category'), 'id="category", class="span8" placeholder="Enter Category Name" autocomplete="off"'); ?>
                        <?php echo form_error('category'); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
						<input type="submit" id="submit" name="submit" class="btn pakodi" value="Add">
                        <?php //echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>