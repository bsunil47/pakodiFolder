<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Others View</h3></td>

                    <td>
                        <span style="float:right; display: inline-block" class="back-close btn pakodi">Back</span>
                    </td>
					
                </tr>
            </table>
            <div align="left" style="text-align: left"><span style="font-weight:bold;">Title:</span>
                <?php if (!empty($content)) {
                    echo $content -> title;
                } if (!empty($othersview)) {
                    ?>

                    <div style=""><a href="<?php echo base_url(); ?>Admin/flags/othersviewstatus/<?php echo $content -> master_content_id; ?>/<?php echo $content -> content_status; ?>"><button class="btn" title="disable" style="border:1px solid #cccccc;">Disable</button></a></div>
                <?php } ?>

            </div>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-0 table table-bordered table-striped display" width="100%">
                 <thead>
				  <tr>
				     <th align="left">S.NO</th>
					 <th align="left">Flag Text</th>
				   </tr>
				 </thead>
				 
                <tbody>
                  
                  <?php
					 if (!empty($othersview)) {
				 	 for ($i = 0; $i < count($othersview); $i++) {
                  ?>
				   
                     <tr>
                         <td align="left" style="width:20px;"><?php echo $i+1; ?></td>
						 <td align="left" ><?php echo $othersview[$i]->flag_text; ?></td>
						 
					 </tr>

                  <?php
                    }
					} else {
                  ?>
                   <tr><td align="left" colspan="3">No results found</td></tr>
                  <?php
                    }
                  ?>
					
                </tbody>
				
            </table>
			

        </div>
    </div>
</div>

