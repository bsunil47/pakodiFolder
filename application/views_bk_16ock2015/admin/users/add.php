<script type="text/javascript">
    function showlang(v)
        {
            if(v==3){
                document.getElementById('lang').style.display='block';
            }
            else{
                document.getElementById('lang').style.display='none';
            }
        }
        </script>
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Users</div>
        <div class="module-body">
            <form id="adduser" name="adduser" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/users/add'; ?>" method="post">

                <div class="control-group">
                    <label class="control-label" for="user">User:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="user" id="user" onchange="showlang(this.value);">
                            <option value="" >-Select-</option>
                           <?php if($this->session->userdata('user_type')==0){?> <option value="1">Admin User</option><?php }?>
                            <option value="3">Moderator</option>
                            <option value="4">Content Owner</option>
                        </select>
                        <?php echo form_error('user'); ?>
                      </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="name">Name:</label>
                    <div class="controls">
                        <?php echo form_input('name', $this->input->post('name'), 'id="name", class="span8" placeholder="Enter Name" autocomplete="off"'); ?>
                        <?php echo form_error('name'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email:</label>
                    <div class="controls">
                        <?php echo form_input('email', $this->input->post('email'), 'id="email", class="span8" placeholder="Enter Email" autocomplete="off"'); ?>
                        <?php echo form_error('email'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="msisdn">Phone:</label>
                    <div class="controls">
                        <?php echo form_input('msisdn', $this->input->post('msisdn'), 'id="msisdn", class="span8" placeholder="Enter Mobile Number" autocomplete="off"'); ?>
                        <?php echo form_error('msisdn'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">Password:</label>
                    <div class="controls">
                        <?php echo form_password('password', $this->input->post('password'), 'id="password", class="span8" placeholder="Enter Password" autocomplete="off"'); ?>
                        <?php echo form_error('password'); ?>
                    </div>
                </div>
                
                <div class="control-group" id="lang" style="display: none;">

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
                    <div class="controls">
					<input type="submit" id="submit" name="submit" value="Add" class="btn pakodi">
                        <?php //echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>