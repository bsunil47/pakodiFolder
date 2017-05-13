<div class="content">
    <div class="module">
        <div class="module-head"><h3>Edit Moderator Profile</h3></div>
        <div class="module-body">
            <form name="updateadmin" id="updateadmin" method="post" action="" class="form-horizontal row-fluid" enctype="multipart/form-data">
                <div class="control-group">
                    <label class="control-label" for="basicinput">Name:</label>
                    <div class="controls">
                        <input type="text" name="name" value="<?php echo $users->name; ?>" class="span8" />
                        <?php echo form_error('name'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="basicinput">Email:</label>
                    <div class="controls"><input type="text" name="email" value="<?php echo $users->email; ?>" class="span8" readonly="readonly" />
                    <?php echo form_error('email'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="basicinput">Phone:</label>
                    <div class="controls"><input type="text" name="msisdn" value="<?php echo $users->msisdn; ?>" class="span8" readonly="readonly" />
                    <?php echo form_error('msisdn'); ?>
                    </div>
                </div>
                <div class="control-group" id="imgupload">
                    <label class="control-label" for="filen">Upload Photo:</label>
                    <div class="controls">
                       <input type="file" name="filen" id="filen" onchange="filetype(this.value);" />
                       <strong><sub>&nbsp;Upload only jpg,png,gif files</sub></strong>
                       <img src="http://sprintmedia.s3.amazonaws.com/userimages/<?php echo $users->profile_picture;?>" alt="photo" style="width: 100px; height:100px;">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls"><input type="submit" name="submit" value="Edit" class="btn" /></div>
                </div>
            </form>
        </div>
    </div>
</div>
