<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Moderator</h3></div>
        <div class="module-body">
            <form id="addmoderator" name="addmoderator" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/moderators/add'; ?>" method="post">

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
                    <label class="control-label" for="phone">Phone:</label>
                    <div class="controls">
                        <?php echo form_input('phone', $this->input->post('phone'), 'id="phone", class="span8" placeholder="Enter Mobile Number" autocomplete="off"'); ?>
                        <?php echo form_error('phone'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">Password:</label>
                    <div class="controls">
                        <?php echo form_input('password', $this->input->post('password'), 'id="password", class="span8" placeholder="Enter Password" autocomplete="off"'); ?>
                        <?php echo form_error('password'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="usertype">User Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="usertype" id="usertype">
                            <option value="">-Select-</option>
                            <option value="1">Moderator</option>
                        </select>
                        <?php echo form_error('usertype'); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>