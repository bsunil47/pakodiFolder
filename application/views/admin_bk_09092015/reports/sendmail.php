<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Send Reply</h3></div>
        <div class="module-body">
            <form id="sendmail" name="sendmail" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/reports/sendmail/'.$report->report_id; ?>" method="post">

                <div class="control-group">
                    <label class="control-label" for="email">To :</label>
                    <div class="controls">
                        <?php echo form_input('email', $user->email.' ('.$user->name.')', 'id="email", class="span8" placeholder="Enter email" autocomplete="off" readonly="readonly"'); ?>
                        <?php echo form_hidden('username', $user->name); ?>
                        <?php echo form_error('email'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="subject">Subject :</label>
                    <div class="controls">
                        <?php echo form_input('subject', $report->report_subject, 'id="subject", class="span8" placeholder="Enter Subject" autocomplete="off" readonly'); ?>
                        <?php echo form_error('subject'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="message">Message :</label>
                    <div class="controls">
                        <?php echo form_textarea('message', $this->input->post('message'), 'id="message", class="span8" placeholder="Enter message" autocomplete="off"'); ?>
                        <?php echo form_error('message'); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Send', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>