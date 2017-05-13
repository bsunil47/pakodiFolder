<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit About Us<a href="javascript:window.history.go(-1);" style="float:right; display: inline-block" class="back-close btn pakodi">Back</a></h3></div>
        <div class="module-body">
            <form id="updateaboutus" name="updateaboutus" method="post" action="" class="form-horizontal row-fluid">
                
                <div class="control-group">
<!--                    <label class="control-label" for="page_desc">Page Description:</label>-->
                    <div class="">
                        <textarea name="page_desc"  id="page_desc" class="span8 cms_textarea" rows="10" cols="33" > <?php echo $cms->page_desc; ?></textarea>
                    </div>
                </div>

                <div class="control-group">
                    <div class="">
					<input type="submit" name="submit" id="submit" value="Edit" class="btn pakodi" style="float: right">
                        <?php //echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>