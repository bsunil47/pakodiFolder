<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
				<?php
				//echo "<pre>";print_r($catwiselangrecords);
				?>
                    <td align="left"><h3>User Report <span class="itotaldisrecords" style="font-weight: normal"></span></h3></td>
                   
                      	
                </tr>
            </table>
        </div>
        <div class="module-body table">
		
            <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                <tr style="background-color: #f6f6f6">
                    <form name="date" method="post" class="table-form" action="">
                        <td align="left" style="width: 9.5%"></td>
                        <td align="left" style="width:30%">

                        </td>
                        <td style="width: 10.5%">Username : </td>
                        <td align="right" style="width:30%">
                            <div class='input-group date' ><input type="text" name="term" id="term" value="<?php if(!empty($_POST['term'])){ echo $_POST['term'];}?>"  />
                               </div>                        </td>

                        <td style="width:16%;">
                            <input type="submit" name="delcontentsubmit" id="delcontentsubmit" value="Go" class="pakodi" style="">
                        </td>

                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </table>
			<!-- datatable-16 -->
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%" style="margin-top:20px;">
                <thead>
                    <tr>
                        <th align="left">Name</th>
						<th align="left">Views</th>
                        <th align="left">Dubs</th>
						   <th align="left">Likes</th>
						   <th align="left">Downloads</th>
                        <th align="left" >Shares</th>
                      
                        
                    </tr>
					
                </thead>
                <tbody>
					<?php 
					//echo "<pre>";print_r($stored_catlang_records);
					if(!empty($userreportsall)){
						//echo "<pre>";print_r($userreportsall);
						foreach($userreportsall as $userreports){
								//echo "<pre>";print_r($userreports);
															
													
						?>
					<tr>
                        
                        <td><?php echo $userreports->name;?></td>
						<td><?php echo $userreports->ViewCount;?></td>
						   <td><?php echo $userreports->dubcount;?></td>
						   <td><?php echo $userreports->likecount;?></td>
                        
						<td><?php echo $userreports->downloadCount;?></td>
						<td><?php echo $userreports->shareCount;?></td>
                       
                    </tr>
							<?php }}else{?>
					<tr><td colspan="6">No Records Found</td></tr>
					<?php }?>
                </tbody>
            </table>
			
        </div>
		 <div class="module-body table">
             <table cellpadding="0" cellspacing="0" border="0" width="100%">
                 <tr></tr>
                 <tr style="background-color: #f6f6f6">
                     <td style="width: 9.5%">Categories :</td>
                     <td  style="width:30%">
                         <select name="category"  id="catids" style="">
                             <!--<option value="all" >-Select-</option>-->
                             <option value="view"<?php if(!empty($_POST['category'])){if($_POST['category']=='view'){echo 'selected=selected';}}?>>Views</option>
                             <option value="dubs"<?php if(!empty($_POST['category'])){if($_POST['category']=='dubs'){echo 'selected=selected';}}?>>Dubs</option>
                             <option value="like"<?php if(!empty($_POST['category'])){if($_POST['category']=='like'){echo 'selected=selected';}}?>>Likes</option>
                             <option value="share"<?php if(!empty($_POST['category'])){if($_POST['category']=='share'){echo 'selected=selected';}}?>>Shares</option>
                             <option value="downloads"<?php if(!empty($_POST['category'])){if($_POST['category']=='downloads'){echo 'selected=selected';}}?>>Downloads</option>
                         </select>
                     </td>
                     <td style="width: 10.5%">Language :</td>
                     <td align="left" style="width:30%"><select name="language"  id="lang" style="">
                             <option value="">-All-</option>
                             <?php if (!empty($language)) {?>
                                 <?php foreach ($language as $lang){?>
                                     <option value="<?php echo $lang->lang_id; ?>"<?php if(!empty($_POST['language'])){if($lang->lang_id == $_POST['language']){ echo 'selected=selected'; } }?>><?php echo $lang->language; ?></option>
                                 <?php } } ?>

                         </select>

                     </td>
                     <td style="width: 16%">
                         <input type="submit" name="delcontentsubmit_new" id="delcontentsubmit" value="Go" class="pakodi" style="">
                     </td>

                 </tr>
                 <tr><td></td><td></td><td></td><td></td><td></td></tr>
             </table>



        </div>
		<div class="module-body table">
            <!-- datatable-16 -->
			<?php if(!empty($userreportdetails)){ ?>
			<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
					<thead>
                    <tr>
                        
                        <th align="left">Unique_code</th>
						   <th align="left">Thumbnail</th>
						   <th align="left">Media</th>
                        <th align="left" >Recent Used</th>
                      
                        
                    </tr>
					
                </thead>
                <tbody>
					<?php 
					//echo "<pre>";print_r($catwiselangrecords);
					
						
							//echo "<pre>";print_r($catwiselangrecord);echo "first values";
							foreach($userreportdetails as $userreportdetailsnew){
								
							$userreportdetail=(array)$userreportdetailsnew;
								//echo "<pre>";print_r($userreportdetail);
															
													
						?>
					<tr>
                        
                        <td><?php echo $userreportdetail['unique_code'];?></td>
						   <td style="text-align:center;">
						   <img src="http://sprintmediasg.s3.amazonaws.com/appimages/<?php echo $userreportdetail['thumb_filename'];?>" class="test" width="50" height="50"/>
						   
						   </td>
						   <td align="center">
							<audio src="http://sprintmediasg.s3.amazonaws.com/audios/<?php echo $userreportdetail['contentclip_filename'];?>" class='test' width='150' height='100' controls ></audio>
						   </td>
                        <td align="center"><?php if($userreportdetail['viewstatus'] !=0 || !empty($userreportdetail['viewstatus'])){?><i class="iconred fa fa-eye " title="View"></i>&nbsp;&nbsp;<?php }?><?php if($userreportdetail['likestatus'] !=0 ||!empty($userreportdetail['liketatus'])){?><i class="iconred fa fa-heart " title="Like"></i>&nbsp;&nbsp;<?php }?><?php if($userreportdetail['downloadstatus'] !=0 ||!empty($userreportdetail['downloadstatus'])){?><i class="iconred fa fa-download" title="Download"></i>&nbsp;&nbsp;<?php }?><?php if($userreportdetail['dubstatus'] !=0 ||!empty($userreportdetail['dubstatus'])){?><i class="iconred fa fa-video-camera" title="Dubs"></i>&nbsp;&nbsp;<?php }?><?php if($userreportdetail['sharestatus'] !=0 ||!empty($userreportdetail['sharestatus'])){?><i class="iconred fa fa-share-alt" title="Share"></i><?php }?></td>
						   <!--<td><?php //echo $userreportdetail->mastr_cat_count;?></td>-->
                       
                    </tr>
							<?php } ?>
                </tbody>
            </table>
			<?php }else {?>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
					<thead>
                    <tr>
                        
                        <th align="left">Unique_code</th>
						   <th align="left">Thumbnail</th>
						   <th align="left">Media</th>
                        <th align="left" >Action</th>
                      
                        
                    </tr>
					
                </thead>
                <tbody>
					
					<tr>
                        
                        <td colspan="4">No Records Found</td>
						   
						   
                       
                    </tr>
							
                </tbody>
            </table>
			<?php } ?>
        </div> 
		</form>
    </div>
</div>

