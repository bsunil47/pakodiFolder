<div class="module module-login span4 offset4">
    <?php echo form_open(base_url() . 'dubsviewer'); ?>
    <div class="module-head"><h3>Sign in to PAKODI Dubsviewer</h3></div>
    <div class="module-body">
        <div class="control-group">
            <div class="controls row-fluid">
                <?php echo form_input('user_id', $this->input->post('user_id'), 'id="user_id", class="span12" placeholder="Enter User Name" autocomplete="off"'); ?>
                <?php echo form_error('user_id'); ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls row-fluid">
                <?php echo form_password('password', '', 'id="password", class="span12" placeholder="Please Enter Mobile No" autocomplete="off"'); ?>
                <?php echo form_error('password'); ?>
            </div>
        </div>
    </div>
    <div class="<?php echo $this->session->flashdata('type'); ?>" style="margin:0 auto; text-align: center"><?php echo $this->session->flashdata('msg'); ?></div>

    <div class="module-foot">
        <div class="control-group">
            <div class="controls clearfix">
                <input type="submit" name="submit" id="submit" value="Login" class="btn btn-primary pull-right"  />
                <label class="checkbox"><input type="checkbox"> Remember me</label>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>

</div>
