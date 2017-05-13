<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
				<td align="left"><h3>Ad Management</h3></td>
				<td align="right"><a href="<?php base_url(); ?>carousal/add" class="pakodi" >Add Carousal</a></td>
				</tr>
       
            </table>
        </div>
		<?php //var_dump($this->session->flashdata('error')); ?>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
						<th align="left">Image</th>
                        <th align="left">Type</th>
                        <th align="left">Clickable</th>
						<th align="left">Status</th>
                        <th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>
                 <?php
				    
                    if (!empty($carousel)) {
                    for ($i = 0; $i < count($carousel); $i++) {
						$type = $carousel[$i]->type;
						$path = $carousel[$i]->car_image;
						if($type == "image" )
						{
						  $typenew = "<img src='http://sprintmedia.s3.amazonaws.com/appimages/".$path."' border='0' alt='image' width='100' height='40' class='test'/>";	
						}
						else if($type == 'audio')
						{
						  $path = $carousel[$i]->car_audio;
						  //$typenew = "<img src='http://sprintmedia.s3.amazonaws.com/audios/".$path."' border='0' alt='Audio' width='100' height='40' />";	
						  $typenew = "<audio src='http://sprintmedia.s3.amazonaws.com/audios/".$path."' width='0' height='30' controls ></audio>";
						}
						else if($type == 'video')
						{
							$path = $carousel[$i]->car_video;
                          //$typenew = "<img src='http://sprintmedia.s3.amazonaws.com/videos/".$path."' border='0' alt='Video' width='100' height='40' />";	
						  $typenew = "<video src='http://sprintmedia.s3.amazonaws.com/videos/".$path."' width='300' height='150' class='test' controls ></video>";
						}	
						
						if($carousel[$i]->is_clickable == '1' || $carousel[$i]->is_clickable == '2')
						{
							$clickable = 'Yes';
						}
						else{
							$clickable = 'No';
						}
						if($carousel[$i]->status == '1')
						{
							//$statusn = "Active";
                                $statusn = "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
												
								$link = '<a href="' . base_url() .'Admin/carousal/carouselstatus/'. $carousel[$i]->car_id .'/'.$carousel[$i]->status.'"><button class="btn pakodi" title="status" style="border:1px solid #cccccc;">Inactive</button></a>';
						}
						else{
							//$statusn = "Inactive";
								$statusn = "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
								$link = '<a href="'. base_url().'Admin/carousal/carouselstatus/'.$carousel[$i]->car_id.'/'. $carousel[$i]->status.'"><button class="btn pakodi" title="status" style="border:1px solid #cccccc;">Active</button></a>';
						}
                      ?>
                      <tr>
                         <td align="left" style="width:20px;"><?php echo $i+1; ?></td>
						 <td align="left" style="width:80px;"><?php echo $typenew; ?></td>
                         <td align="left"><?php echo $carousel[$i]->type; ?></td>
                         <td align="left"><?php echo $clickable; ?></td>
                         <td align="left"><?php echo $statusn; ?></td>
                         <td align="left">
						 <?php echo $link;?>
                             
                             <a href="<?php echo base_url(); ?>Admin/carousal/edit/<?php echo $carousel[$i]->car_id; ?>"><button class="btn pakodi" title="Edit" style="border:1px solid #cccccc;">Edit</button></a>
						
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

