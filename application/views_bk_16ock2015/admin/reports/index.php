<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Reports / Contact Us</h3></td>
                   
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">Report Type</th>
                        <th align="left">User Email</th>
                        <th align="left">Report Subject</th>
						<th align="left">Report Description</th>
						<th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>
                 <?php
				    if (!empty($reports)) {
                    for ($i = 0; $i < count($reports); $i++) {
                 ?>
                            <tr>

                                <td align="left"><?php echo $i+1; ?></td>
                                <td align="left"><?php echo $reports[$i]->report_type; ?></td>
                                <td align="left"><?php echo $reports[$i]->email; ?></td>
                                <td align="left"><?php echo $reports[$i]->report_subject; ?></td>
                                <td align="left"><?php echo $reports[$i]->report_desc; ?></td>
                                <td align="left"> <a href="<?php base_url(); ?>reports/sendmail/<?php echo $reports[$i]->report_id; ?>">Reply</a></td>
                                
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>

                            <td align="left" colspan="5">No Reports</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

