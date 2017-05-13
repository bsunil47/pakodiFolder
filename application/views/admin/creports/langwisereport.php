<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
				<?php
				//echo "<pre>";print_r($catwiselangrecords);
				?>
					<td align="left"><h3>Language/Category Content Report <span class="itotaldisrecords" style="font-weight: normal"></span></h3></td>
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                <tr style="background-color: #f6f6f6">
                    <form name="date" method="post" class="table-form" action="<?php echo base_url()?>Admin/creports/langwisereport">
                        <td align="left" style="width: 9.5%"><div id="column1" class="col1"><i class="iconred icon-filter"></i></div></td>
                        <td align="left" style="width:30%">
                            <div class='input-group date' id='from_date'><input type='text' class="form-control" name="fromdate" id="fromdate" value="<?php if (!empty($_POST['fromdate'])) {echo $_POST['fromdate'];}else{$start=date('m')."/01/".date('Y'); echo $start;} ?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
                        </td>
                        <td style="width: 10.5%"></td>
                        <td align="right" style="width:30%">
                            <div class='input-group date' id='to_date'><input type='text' class="form-control" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) {echo $_POST['todate'];}else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>                        </td>

                        <td style="text-align: center">
                            <input type="submit" name="contentsubmit" id="contentsubmit" value="Search" class="pakodi" style="">

                            <!--input type="reset" id="contentreset" value="Reset" class="pakodi" style=""-->
                        </td>

                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </table>


              <div style="clear: both;"></div> 
			
			<!-- datatable-16 -->
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        
                        <th align="left">Language</th>
						   <th align="left">Total Clips</th>
                        <th align="left" >Active</th>
                      <th align="left">Inactive</th>
                        
                    </tr>
					
                </thead>
                <tbody>
					<?php 
					//echo "<pre>";print_r($stored_catlang_records);
					if(!empty($langwisereports)){
						foreach($langwisereports as $key=>$langwisereport){
								//echo "<pre>";print_r($stored_catlang_records);
															
													
						?>
					<tr>
                        
                        <td><?php echo $key;?></th>
						   <td><?php echo $langwisereport['languagecount'];?></th>
                        <td><?php echo empty($langwisereport['active'])? 0 : $langwisereport['active']?></th>
						<td><?php echo empty($langwisereport['inactive'])? 0 : $langwisereport['inactive'];?></th>
                       
                    </tr>
							<?php }}else{?>
					<tr><td colspan="4">No Records Found</td></tr>
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
                            <option value="" >-All-</option>
                            <?php if (!empty($category)) {
                                for ($i = 0; $i < count($category); $i++) { ?>
                                    <option value="<?php echo $category[$i]->cat_id; ?>"<?php if(!empty($_POST['category']) && $category[$i]->cat_id== $_POST['category']){echo 'selected=selected';} ?>><?php echo $category[$i]->category; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
					</td>
                    <td style="width: 10.5%">Language :</td>
                     <td align="left" style="width:30%"><select name="language"  id="lang" style="">
                            <option value="">-All-</option>
                            <?php if (!empty($language)) {?>
                            <?php foreach ($language as $lang){?>
                            <option value="<?php echo $lang->lang_id; ?>" <?php if(!empty($_POST['language']) && $lang->lang_id == $_POST['language']){ echo 'selected=selected'; ?> <?php } ?>><?php echo $lang->language; ?></option>
                            <?php } } ?>
                            </select>

							</td>
                    <td style="width: 16%">
                        <input type="submit" name="delcontentsubmit" id="delcontentsubmit" value="Search" class="pakodi" style="">
                    </td>
                      	                     	
                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </table>
			</form>

        </div>
		<div class="module-body table">
            <!-- datatable-16 -->
			<?php if(!empty($catwiselangrecords)){ ?>
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        
                        <th align="left">Category</th>
						   <th align="left">Language</th>
						   <th align="left">Total</th>
                        <th align="left" >Active</th>
                      <th align="left">Inactive</th>
                        
                    </tr>
					
                </thead>
                <tbody>
					<?php 
					//echo "<pre>";print_r($catwiselangrecords);
					
						foreach($catwiselangrecords as $key=>$catwiselangrecord){
							//echo "<pre>";print_r($catwiselangrecord);echo "first values";
							foreach($catwiselangrecord as $catlangrecord){
								
							
								//echo "<pre>";print_r($catlangrecord);
															
													
						?>
					<tr>
                        
                        <td><?php echo $catlangrecord['category'];?></th>
						   <td><?php echo $catlangrecord['language'];?></th>
						   <td><?php echo $catlangrecord['mastr_cat_count'];?></th>
                        <td><?php echo empty($catlangrecord['active_cat'])? 0 : $catlangrecord['active_cat']?></th>
						<td><?php echo empty($catlangrecord['inactive_cat'])? 0 : $catlangrecord['inactive_cat'];?></th>
                       
                    </tr>
							<?php }}?>
                </tbody>
            </table>
			<?php } else { ?>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        
                        <th align="left">Category</th>
						   <th align="left">Language</th>
						   <th align="left">Total</th>
                        <th align="left" >Active</th>
                      <th align="left">Inactive</th>
                        
                    </tr>
					
                </thead>
                <tbody>
					
					<tr>
                        
                        <td colspan="5">No Records Found</td>
						   
                       
                    </tr>
							
                </tbody>
            </table>
			<?php }?>
        </div>
    </div>
</div>

