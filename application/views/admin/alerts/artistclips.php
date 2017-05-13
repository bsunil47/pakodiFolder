<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Artist Clips</h3></td>
				<td align="right"><a href="<?php base_url(); ?>addartistclip" class="btn pakodi" >Add Artist Clip</a></td>
				</tr>
       
            </table>
        </div>
		<?php //var_dump($this->session->flashdata('error')); ?>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="<?php if(!empty($result)){?>datatable-1 <?php }?> table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
			<th align="left">Name</th>
                        <th align="left">Clip File</th>
                        </tr>
                </thead>
                <tbody>
                 <?php
				    
                    if (!empty($result)) {
                   for ($i = 0; $i < count($result); $i++) {
		        $path = $result[$i]->clip_filename;
			$typenew = "<audio src='http://sprintmediasg.s3.amazonaws.com/birthday/".$path."' class='test' width='0' height='30' controls ></audio>";
						
                      ?>
                      <tr>
                         <td align="left" style="width:20px;"><?php echo $i+1; ?></td>
                         <td align="left" style="width:20px;"><?php echo $result[$i]->name; ?></td>
		         <td align="left" style="width:80px;"><?php echo $typenew; ?></td>
                                                   
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

