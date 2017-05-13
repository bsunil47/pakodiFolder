<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit Category<span style="float:right; display: inline-block" class="back-close btn pakodi">Back</span></h3></div>
        <div class="module-body">
            <form id="updatecategory" name="updatecategory" method="post" action="<?php echo base_url(); ?>Admin/category/update/<?php echo $category->cat_id; ?>/<?php echo $category->language_id; ?>" class="form-horizontal row-fluid">
                <div class="control-group">
                    <label class="control-label" for="category">Category Name:</label>
                    <div class="controls">
                        <?php echo form_input('category', $category->category, 'id="category", class="span8" placeholder="Enter Category Name" autocomplete="off"'); ?>
                        <?php echo form_error('category'); ?>
                        
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
						<input type="submit" id="submit" name="submit" class="btn pakodi" value="Edit">
                        <?php //echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>