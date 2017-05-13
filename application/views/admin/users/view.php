<div class="content">
    <div class="module">
	<div class="module-head"> <h3>View App User<span style="float:right; display: inline-block" class="back-close btn pakodi">Back</span></h3></div>
        
        <div class="module-body">
		<form class="form-horizontal">
           	<?php if (!empty($user)) {?>
            <div class="span4">
				<img src="http://sprintmediasg.s3.amazonaws.com/userimages/<?php echo $user->profile_picture;?>" alt="photo" style="width:100px; height:100px;">			
			</div>
			
			<div class="span4" >
			<?php if (!empty($user->name)) { ?>
				<div class="control-group">
                    <label class="control-label" for="name" style="text-align:left;">Name :</label>
                    <div class="checkbox inline">
                    <?php echo $user->name; ?>
                    </div>
                </div>
				<?php } ?>
				
				<?php if (!empty($user->email)) { ?>
				<div class="control-group">
                    <label class="control-label" for="email" style="text-align:left;">Email :</label>
                    <div class="block span2" style="margin-left:20px;">
                        <?php echo $user->email; ?>
                    </div>
                </div>
				<?php } ?>
				
				<?php if (!empty($user->status)) { ?>
				 <div class="control-group">
                    <label class="control-label" for="status" style="text-align:left;">Status :</label>
                   	<div <?php if($user->status == 1){?>class="checkbox inline icongreen" <?php }else{?> class="checkbox inline"<?php } ?>>
                        <?php if($user->status == 1){ echo 'Active'; }else{ echo 'Inactive'; } ?>
                    </div>
                </div>  
				<?php } ?>
            </div>
			<div style="clear: both;" ></div>
			<div class="span4">
			<?php if (!empty($user->isfacebook_active)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="facebook" style="text-align:left;">Facebook Status :</label>
                    <div class="checkbox inline">
                    <?php if($user->isfacebook_active == 1){ echo 'Active';}else{echo 'Inactive';} ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->istwitter_active)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="twitter" style="text-align:left;">Twitter Status :</label>
                    <div class="checkbox inline">
                    <?php if($user->istwitter_active == 1){ echo 'Active';}else{echo 'Inactive';} ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->isgplus_active)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="google" style="text-align:left;">Google Plus Status :</label>
                    <div class="checkbox inline">
                    <?php if($user->isgplus_active == 1){ echo 'Active';}else{echo 'Inactive';} ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->iswhatsapp_active)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="whatsapp" style="text-align:left;">Whatsapp Status :</label>
                    <div class="checkbox inline">
                    <?php if($user->iswhatsapp_active == 1){ echo 'Active';}else{echo 'Inactive';} ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->userlike_count)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="likecount" style="text-align:left;">User Like Count :</label>
                    <div class="checkbox inline">
                    <?php echo $user->userlike_count; ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->usershare_count)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="sharecount" style="text-align:left;">User Share Count :</label>
                    <div class="checkbox inline">
                    <?php echo $user->usershare_count; ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->userdownload_count)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="downloadcount" style="text-align:left;">User Download Count :</label>
                    <div class="checkbox inline">
                    <?php echo $user->userdownload_count; ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->userplay_count)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="viewcount" style="text-align:left;">User View Count :</label>
                    <div class="checkbox inline">
                    <?php echo $user->userplay_count; ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->userdub_count)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="dubcount" style="text-align:left;">User Dub Count :</label>
                    <div class="checkbox inline">
                   <?php echo $user->userdub_count; ?>
                       </div>  
                </div>
			<?php } ?>
			
			</div>
			
			<div class="span4">
			
				<?php if (!empty($user->dob && $user->dob!='0000-00-00')) { ?>
				<div class="control-group">
                    <label class="control-label" for="dob" style="text-align:left;">Dob :</label>
                    <div class="checkbox inline">
                    <?php echo $user->dob; ?>
                    </div>
                </div>
				<?php } ?>
				<?php if (!empty($user->msisdn)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="mobile" style="text-align:left;">Mobile Number :</label>
                    <div class="checkbox inline">
                        <?php echo $user->msisdn ?>
                       </div>  
                </div>
			<?php } ?>
			
			<?php if (!empty($user->dtype)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="dtype" style="text-align:left;">Device Type :</label>
                    <div class="checkbox inline">
                    <?php if($user->dtype == 1){echo 'IOS';}elseif($user->dtype == 2){echo 'Android'; } ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->udid)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="dtype" style="text-align:left;">Device Id :</label>
                    <div class="checkbox inline">
                    <?php echo $user->udid; ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->storage)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="storage" style="text-align:left;">Storage :</label>
                    <div class="checkbox inline">
                    <?php echo $user->storage; ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->app_language)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="applanguage" style="text-align:left;">App Language :</label>
                    <div class="checkbox inline">
                   <?php echo $user->app_language; ?>
                       </div>  
                </div>
			<?php } ?>
			<?php if (!empty($user->userprefer_languages)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="preferlanguage" style="text-align:left;">User Prefer Languages :</label>
                   <div class="block span2" style="margin-left:20px;">
                    <?php echo str_replace(',',', ',$user->userprefer_languages); ?>
                       </div>  
                </div>
			<?php } ?>
			
			<?php if (!empty($user->datecreated)) { ?>
                    <div class="control-group">
                    <label class="control-label" for="createdon" style="text-align:left;">Created On :</label>
                    <div class="checkbox inline">
                   <?php echo $user->datecreated; ?>
                       </div>  
                </div>
			<?php } ?>
			</div>
			<div style="clear: both;" ></div>
			
        </div>
		</form>
		<?php } else { ?>
            <div style="text-align:center;">No User found</div>
            <?php }  ?>
    </div>
</div>

