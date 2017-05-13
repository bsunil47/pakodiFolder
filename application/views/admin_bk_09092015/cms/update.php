<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit About Us</h3></div>
        <div class="module-body">
            <form id="updateaboutus" name="updateaboutus" method="post" action="" class="form-horizontal row-fluid">
                
                <div class="control-group">
                    <label class="control-label" for="page_desc">Page Description:</label>
                    <div class="controls">
                        <?php echo form_input('page_desc', $cms->page_desc, 'id="page_desc", class="span8" placeholder="Enter About Us" autocomplete="off"'); ?>
                        <?php echo form_error('page_desc'); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>