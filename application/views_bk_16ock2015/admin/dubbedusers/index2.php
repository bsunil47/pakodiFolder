<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>User Dubs</h3></td>
               </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">User Name</th>
                        <th align="left">Clip Title</th>
						<th align="left">Moderated By</th>
						<th align="left">Status</th>
                        <th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>
                 <?php
                    if (!empty($dubbedusers)) {
                        for ($i = 0; $i < count($dubbedusers); $i++) {
						$sn = $dubbedusers[$i]->dub_status;
						 if($dubbedusers[$i]->dub_status == '1')
						 {
						   $status = 'Active';
						 } else	 {
							$status = 'Inactive'; 
						 }
                   $this->common_model->initialise('users');                         
                   $moderatorname = $this->common_model->get_record_single(array('id' => $dubbedusers[$i]->moderatedby), 'name')->name;
                  ?>
                         <tr>
                           <td align="left"><?php echo $i+1; ?></td>
                                <td align="left"><?php echo $dubbedusers[$i]->name; ?></td>
                                <td align="left"><?php echo $dubbedusers[$i]->dubclip_title; ?></td>
                                <td align="left"><?php echo $moderatorname; ?></td>
                                <td align="left"><?php echo $status; ?></td>
                                <td align="left">
                                <a href="<?php echo base_url(); ?>Admin/dubbedusers/updatestatus/<?php echo $dubbedusers[$i]->dub_id; ?>/<?php echo $sn;?>">Status</a>&nbsp;&nbsp;
                                <a href="<?php echo base_url(); ?>Admin/dubbedusers/update/<?php echo $dubbedusers[$i]->dub_id; ?>">Update</a>
                                </td>
                            </tr>
                     <?php
                        }
                        } else {
						
                     ?>
                        <tr><td align="left" colspan="6">No Dubs Found</td></tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

