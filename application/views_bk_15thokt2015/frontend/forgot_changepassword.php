<?php if($this->session->flashdata('type') == 'success'){ ?>
<div class="module module-login span4 offset4" style="margin:100px 410px;">
    <div align="center" class="success" style="margin:20px 0px"><?php echo $this->session->flashdata('msg'); ?></div> 
    <div align="center"><a href="<?php echo base_url(); ?>" class="btn btn-primary pull-right" style="margin:20px 160px">Login</a></div>
</div>
<?php }else{ ?>
<div class="module module-login span4 offset4">
    <?php echo form_open(base_url().'frontend/forgot_changepassword/'.$hashcode.'/'.$path); ?>
    <div class="module-head"><h3>Change Password </h3></div>
    <div class="module-body">
        <div class="control-group">
            <div class="controls row-fluid">
                <?php echo form_password('password', $this->input->post('password'), 'id="password", class="span12" placeholder="Enter Password" autocomplete="off"'); ?>
                <?php echo form_error('password'); ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls row-fluid">
                <?php echo form_password('c_password', $this->input->post('c_password'), 'id="c_password", class="span12" placeholder="Confirm password" autocomplete="off"'); ?>
                <?php echo form_error('c_password'); ?>
            </div>
        </div>
    </div>
    <div align="center" class="<?php echo $this->session->flashdata('type'); ?>"><?php echo $this->session->flashdata('msg'); ?></div>
    <div class="module-foot">
        <div class="control-group">
            <div class="controls clearfix">
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary pull-right"  />
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?php } ?>