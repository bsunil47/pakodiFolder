<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr><td align="left"><h3>Recommends</h3></td>
				 </tr>
             </table>
        </div>
       <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
						<th align="left">Page Name</th>
                        <th align="left">Sort By</th>
                        <th align="left">Recommends</th>
						<th align="left">Date Updated</th>
						<th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>
                 <?php
				  if (!empty($recommends)) {
                     for ($i = 0; $i < count($recommends); $i++) {
						$name = $recommends[$i]->page_name;
						$sort = $recommends[$i]->column_name;
						$filter = $recommends[$i]->filter_interval;
						$dateupdated = $recommends[$i]->dateupdated;
						//$number_of_records = $recommends[$i]->number_of_records;
                 ?>
                      <tr>
                         <td align="left" style="width:20px;"><?php echo $i+1; ?></td>
						 <td align="left" style="width:80px;"><?php echo $name; ?></td>
                         <td align="left"><?php echo $sort; ?></td>
                         <td align="left"><?php echo $filter; ?></td>
						 <td align="left"><?php echo $dateupdated; ?></td>
                        
                         <td align="left">
				                     
                             <a href="<?php echo base_url(); ?>Admin/content/recupdate/<?php echo $recommends[$i]->rec_id; ?>"><i class="iconred icon-pencil" title="Edit"></i></a>
						
						 </td>
                              
                      </tr>
                  <?php
                    }
                    }
			      else {
                 ?>
                    <tr><td align="left" colspan="6">No Results Found</td> </tr>
                  <?php
                    }
                  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
