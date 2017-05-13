<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit Admin User<span style="float:right; display: inline-block" class="back-close btn pakodi">Back</span></h3></div>
        <div class="module-body">
            <form id="updateadminuser" name="updateadminuser" method="post" action="<?php echo base_url(); ?>Admin/users/adupdate/<?php echo $users->id; ?>" class="form-horizontal row-fluid">
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
                </div><?php if (preg_match('#\b^[a-z0-9]{32}\b$#', $users->password )){$passcheck=1;}else{$passcheck=2;}?>
                <div class="control-group">
                    <label class="control-label" for="password">Password:</label>
                    <div class="controls">
                        <?php echo form_password('password', '', 'id="password", class="span8" placeholder="Enter Password" autocomplete="off" ' ); ?>
                        <input type="hidden" name="pass" id="pass" value="<?php echo $passcheck;?>">
						<?php echo form_error('password'); ?>
                    </div>
                </div>
			<div class="controls" ><span>Note: New Password Will be combination of One Numeric and One Special Character</span></div>
			<?php 
			//if(preg_match('/^[a-f0-9](?=.*[!@#$%^&*]){32}$/i', $users->password)) {
			/*if(preg_match('/^[a-f0-9]{32}$/i', $users->password)) { //check md5  or not
			echo "It matches.";
			} else {
			echo "It does not match.";
			}*/
					?>
<!--              <div class="control-group">

                    <label class="control-label" for="language_id">Language:</label>

                    <div class="controls">

                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="language_id" id="language_id">

                            <option value="">-Select-</option>

                            <?php //foreach ($language as $lang){?>

                                <option value="<?php //echo $lang->lang_id; ?>" <?php //if($lang->lang_id == $users->app_language){ echo 'selected="selected"'; ?> <?php //} ?>><?php //echo $lang->language; ?></option>

                            <?php //} ?>

 

                        </select>

                        <?php //echo form_error('language_id'); ?>

                    </div> 

                </div>-->
                
                <div class="control-group">
                    <div class="controls">
					<input type="submit" id="submit" name="submit" value="Edit" class="btn pakodi">
                        <?php //echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
						<!--<a href="javascript:window.history.go(-1);" class="btn pakodi" style="margin-bottom: -3px;">Back</a>-->
					</div>
                </div>
                
            </form>
        </div>
    </div>
</div>