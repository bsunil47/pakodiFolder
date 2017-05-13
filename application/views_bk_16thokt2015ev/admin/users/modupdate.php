<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit Moderator</h3></div>
        <div class="module-body">
            <form id="updatemoderator" name="updatemoderator" method="post" action="" class="form-horizontal row-fluid">
                <div class="control-group">
                    <label class="control-label" for="name">Name:</label>
                    <div class="controls">
                        <?php echo form_input('name', $users->name, 'id="name", class="span8" placeholder="Enter Name" autocomplete="off"'); ?>
                        <?php echo form_error('name'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email:</label>
                    <div class="controls">
                        <?php echo form_input('email', $users->email, 'id="email", class="span8" placeholder="Enter Email" autocomplete="off" readonly="readonly"'); ?>
                        <?php echo form_error('email'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="msisdn">Phone:</label>
                    <div class="controls">
                        <?php echo form_input('msisdn', $users->msisdn, 'id="msisdn", class="span8" placeholder="Enter Mobile Number" autocomplete="off"'); ?>
                        <?php echo form_error('msisdn'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">Password:</label>
                    <div class="controls">
                        <?php echo form_password('password', $users->password, 'id="password", class="span8" placeholder="Enter Password" autocomplete="off"'); ?>
                        <?php echo form_error('password'); ?>
                    </div>
                </div>
				<div class="controls" ><span>Note: New Password Will be combination of One Numeric and One Special Character</span></div>
              <div class="control-group">

                    <label class="control-label" for="language_id">Language:</label>

                    <div class="controls">

                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="language_id" id="language_id">

                            <option value="">-Select-</option>

                            <?php foreach ($language as $lang){?>

                                <option value="<?php echo $lang->lang_id; ?>" <?php if($lang->lang_id == $users->app_language){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $lang->language; ?></option>

                            <?php } ?>

 

                        </select>

                        <?php echo form_error('language_id'); ?>

                    </div> 

                </div>
                
                <div class="control-group">
                    <div class="controls">
					<input type="submit" id="submit" name="submit" value="Edit" class="btn pakodi">
                        <?php //echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
						<a href="javascript:window.history.go(-1);" class="btn pakodi" style="margin-bottom: -3px;">Back</a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>