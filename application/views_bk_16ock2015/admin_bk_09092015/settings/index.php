<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr><td align="left"><h3>Settings</h3></td>
				 <td align="right" <?php if(count($settings) < 6) { ?>style="display:none;" <?php } ?>><a href="<?php base_url(); ?>settings/add" >Add Settings</a></td>
				</tr>
                
            </table>
        </div>
       <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
						<th align="left">Name</th>
                        <th align="left">Page Limit</th>
                        <th align="left">Maximum Records</th>
						<th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>
                 <?php
				  if (!empty($settings)) {
                     for ($i = 0; $i < count($settings); $i++) {
						$name = $settings[$i]->name;
						$page_limit = $settings[$i]->page_limit;
						$number_of_records = $settings[$i]->number_of_records;
                 ?>
                      <tr>
                         <td align="left" style="width:20px;"><?php echo $i+1; ?></td>
						 <td align="left" style="width:80px;"><?php echo $name; ?></td>
                         <td align="left"><?php echo $settings[$i]->page_limit; ?></td>
                         <td align="left"><?php echo $number_of_records; ?></td>
                        
                         <td align="left">
				                     
                             <a href="<?php echo base_url(); ?>Admin/settings/update/<?php echo $settings[$i]->id; ?>"><button class="btn" title="Edit" style="border:1px solid #cccccc;">Edit</button></a>
						
						 </td>
                              
                      </tr>
                  <?php
                    }
                    }
			      else {
                 ?>
                    <tr><td align="left" colspan="5">No Results Found</td> </tr>
                  <?php
                    }
                  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

