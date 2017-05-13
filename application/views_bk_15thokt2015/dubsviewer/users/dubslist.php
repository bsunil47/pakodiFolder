<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Dubbed Users</h3></td>
               </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">Clip Title</th>
<!--			<th align="left">Status</th>-->
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
                  $moderatorname = $this->common_model->get_record_single(array('id' => $dubbedusers[$i]->moderatedby), 'name');
                  ?>
                         <tr>
                           <td align="left"><?php echo $i+1; ?></td>
                                <td align="left"><?php echo $dubbedusers[$i]->dubclip_title; ?></td>
<!--                                <td align="left"><?php echo $status; ?></td>-->
                                <td align="left">
                                    <a <?php if(!empty($dubbedusers[$i]->dubclip_filename)){?>href="http://sprintmedia.s3.amazonaws.com/dubs/<?php echo $dubbedusers[$i]->dubclip_filename;?>" <?php }?> download target="_blank">Download</a>&nbsp;&nbsp;
<!--                                <a href="<?php echo base_url(); ?>dubsviewer/users/updatestatus/<?php echo $dubbedusers[$i]->dub_id; ?>/<?php echo $dubbedusers[$i]->dub_status;?>">Status</a>&nbsp;&nbsp;
                                <a href="<?php echo base_url(); ?>dubsviewer/users/update/<?php echo $dubbedusers[$i]->dub_id; ?>">Update</a>-->
                                </td>
                            </tr>
                     <?php
                        }
                        } else {
						
                     ?>
                        <tr><td align="left" colspan="5">No Dubs Found</td></tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


