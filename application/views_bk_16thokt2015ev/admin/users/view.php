<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>View App User</h3></td>
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped" width="100%">

                <tbody>

                    <?php
                    if (!empty($user)) {
                        ?>
                        <?php if (!empty($user->name)) { ?><tr><th align="right">Name:</th><td align="left"><?php echo $user->name; ?></td></tr><?php } ?>
                        <?php if (!empty($user->msisdn)) { ?><tr><th align="right">Mobile Number:</th><td align="left"><?php echo $user->msisdn; ?></td></tr><?php } ?>
                        <?php if (!empty($user->email)) { ?><tr><th align="right">Email:</th><td align="left"><?php echo $user->email; ?></td></tr><?php } ?>
                        <?php if (!empty($user->gender)) { ?><tr><th align="right">Gender:</th><td align="left"><?php echo $user->gender; ?></td></tr><?php } ?>
                        <?php if (!empty($user->dob)) { ?><tr><th align="right">DOB:</th><td align="left"><?php echo $user->dob; ?></td></tr><?php } ?>
                        <?php if (!empty($user->udid)) { ?><tr><th align="right">Device Id:</th><td align="left"><?php echo $user->udid; ?></td></tr><?php } ?>
                        <?php if (!empty($user->dtype)) { ?><tr><th align="right">Device Type:</th><td align="left"><?php if($user->dtype == 1){echo 'IOS';}elseif($user->dtype == 2){echo 'Android'; } ?></td></tr><?php } ?>
                        <!--<?php if (!empty($user->avatar)) { ?><tr><th align="right">Avatar:</th><td align="left"><?php //echo $user->avatar; ?></td></tr><?php } ?>-->
                        <?php if (!empty($user->profile_picture)) { ?><tr><th align="right">Profile Picture:</th><td align="left"> <img src="http://sprintmedia.s3.amazonaws.com/userimages/<?php echo $user->profile_picture;?>" alt="photo" style="width:100px; height:100px;"></td></tr><?php } ?>
                        <?php if (!empty($user->activation_key)) { ?><tr><th align="right">Activation Key:</th><td align="left"><?php echo $user->activation_key; ?></td></tr><?php } ?>
                        <?php if (!empty($user->activation_status)) { ?><tr><th align="right">Activation Status:</th><td align="left"><?php echo $user->activation_status; ?></td></tr><?php } ?>
                        <?php if (!empty($user->isfacebook_active)) { ?><tr><th align="right">Facebook Status:</th><td align="left"><?php if($user->isfacebook_active == 1){ echo 'Active';}else{echo 'Inactive';} ?></td></tr><?php } ?>
                        <?php if (!empty($user->istwitter_active)) { ?><tr><th align="right">Twitter Status:</th><td align="left"><?php if($user->istwitter_active == 1){ echo 'Active';}else{echo 'Inactive';} ?></td></tr><?php } ?>
                        <?php if (!empty($user->isgplus_active)) { ?><tr><th align="right">Google Plus Status:</th><td align="left"><?php if($user->isgplus_active == 1){ echo 'Active';}else{echo 'Inactive';} ?></td></tr><?php } ?>
                        <?php if (!empty($user->iswhtatsapp_active)) { ?><tr><th align="right">Whatsapp Status:</th><td align="left"><?php if($user->iswhtatsapp_active == 1){ echo 'Active';}else{echo 'Inactive';} ?></td></tr><?php } ?>
                        <?php if (!empty($user->app_language)) { ?><tr><th align="right">App Language:</th><td align="left"><?php echo $user->app_language; ?></td></tr><?php } ?>
                        <?php if (!empty($user->userprefer_languages)) { ?><tr><th align="right">User Prefer Languages:</th><td align="left"><?php echo $user->userprefer_languages; ?></td></tr><?php } ?>
                        <?php if (!empty($user->storage)) { ?><tr><th align="right">Storage:</th><td align="left"><?php echo $user->storage; ?></td></tr><?php } ?>
                        <?php if (!empty($user->userlike_count)) { ?><tr><th align="right">User Like Count:</th><td align="left"><?php echo $user->userlike_count; ?></td></tr><?php } ?>
                        <?php if (!empty($user->usershare_count)) { ?><tr><th align="right">User Share Count:</th><td align="left"><?php echo $user->usershare_count; ?></td></tr><?php } ?>
                        <?php if (!empty($user->userdownload_count)) { ?><tr><th align="right">User Download Count:</th><td align="left"><?php echo $user->userdownload_count; ?></td></tr><?php } ?>
                        <?php if (!empty($user->userdub_count)) { ?><tr><th align="right">User Dub Count:</th><td align="left"><?php echo $user->userdub_count; ?></td></tr><?php } ?>
                        <?php if (!empty($user->status)) { ?><tr><th align="right">Status:</th><td align="left"><?php if($user->status == 1){ echo 'Active';}else{echo 'Inactive';} ?></td></tr><?php } ?>
                        <?php if (!empty($user->datecreated)) { ?><tr><th align="right">Created On:</th><td align="left"><?php echo $user->datecreated; ?></td></tr><?php } ?>


                        <?php
                    } else {
                        ?>
                        <tr>
                            <td align="left" colspan="29">No Users found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

