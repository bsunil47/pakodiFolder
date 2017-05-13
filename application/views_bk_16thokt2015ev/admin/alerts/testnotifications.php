<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Alert</div>
        <div class="module-body">
            <form id="" name="" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/alerts/testnotifications'; ?>" method="post">

                <div class="control-group">
                    <label class="control-label" for="dtype">Device Type:</label>
                  <div class="controls">
                        <select tabindex="1" class="span8" name="device_type" id="dtype">
                            <option value="">-select-</option>
                            <option value="1">IOS</option>
                            <option value="2">Andriod</option>
                        </select>
                        <?php echo form_error('dtype'); ?>
                      </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="dtype">Device Token:</label>
                  <div class="controls">
                      <input type="text" name="device_token" id="d_token" class="span8">
                        <?php echo form_error('dtype'); ?>
                      </div>
                </div>
                <div class="control-group" id="lang">
                    <label class="control-label" for="language_id">Language:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="language_id" id="language_id">
                            <option value="">-Select-</option>
                            <?php foreach ($language as $lang){?>
                            <option value="<?php echo $lang->lang_id; ?>" <?php if(!empty($_POST['language_id']) && $lang->lang_id == $_POST['language_id']){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $lang->language; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('language_id'); ?>
                    </div> 
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="msg">Message:</label>
                    <div class="controls">
                        <textarea name="message" id="msg" class="span8" placeholder="Enter Message Here..." minlength="5" maxlength="250"></textarea>
                       <?php echo form_error('msg'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="msg">Master Content Id:</label>
                    <div class="controls">
                        <input type="text" name="masterid" id="msg" class="span8" placeholder="Enter mastercontentid Here..." minlength="5" maxlength="250">
                       <?php echo form_error('msg'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="msg">Content Id:</label>
                    <div class="controls">
                        <input type="text" name="contentid" id="msg" class="span8" placeholder="Enter content  id Here..." minlength="5" maxlength="250"><?php echo form_error('msg'); ?>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" name="submit" id="submit" value="Add" class="btn pakodi">   
                     <?php // echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    <a href="javascript:window.history.go(-1);" class="btn pakodi">Back</a>
                    </div>
                </div>
            </form>
           
        </div>
    </div>
</div>
 