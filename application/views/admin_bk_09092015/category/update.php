<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit Category</h3></div>
        <div class="module-body">
            <form id="updatecategory" name="updatecategory" method="post" action="" class="form-horizontal row-fluid">
                <div class="control-group">
                    <label class="control-label" for="category">Category Name:</label>
                    <div class="controls">
                        <?php echo form_input('category', $category->category, 'id="category", class="span8" placeholder="Enter Category Name" autocomplete="off"'); ?>
                        <?php echo form_error('category'); ?>
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