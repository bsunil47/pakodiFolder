<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Edit Birth day Alert</div>
        <div class="module-body">
            <form id="editalert" name="addalert" class="form-horizontal row-fluid" action="" method="post" enctype="multipart/form-data">
                <div class="control-group">
                    <label class="control-label" for="msg">Message:</label>

                    <div class="controls">
                        <textarea name="msg" id="msg" class="span8" placeholder="Enter Message Here..." minlength="5"
                                  maxlength="250"><?php echo $balert->message;?></textarea>
                        <input type="hidden" name="id" id="id" value="<?php echo $balert->id;?>">
                        <?php echo form_error('msg'); ?>
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="msg">Content Thumbnail:</label>

                    <div class="controls">
                        <input type="file" name="img" id="img">
                          </div>
                     <div class='controls'><img
                             src="http://sprintmediasg.s3.amazonaws.com/birthday/<?php echo $balert->image;?>"  class="test" width="120" height="80"></div>

                 </div>
                 <div class="control-group">
                    <label class="control-label" for="msg">Content Clip:</label>

                    <div class="controls">
                        <input type="file" name="clip" id="clip">
                        </div>
                     <div class="controls"><audio
                             src='http://sprintmediasg.s3.amazonaws.com/birthday/<?php echo $balert->contentclip_filename;?>'  width='50' height='50' controls  ></audio></div>

                 </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" name="submit" id="submit" value="Update" class="btn pakodi">
                        <?php // echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
<!--                        <a href="javascript:window.history.go(-1);" class="btn pakodi"
                           style="margin-bottom: -3px;">Back</a>-->
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
