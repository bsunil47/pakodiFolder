<div class="content">
    <div class="module">
        <div class="module-head"> 
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
				<td align="left"><h3>Edit Rejected Dubs</h3></td>
                                <td align="right"><a href="https://translate.google.co.in/" target="_blank" class="btn pakodi">Google Translater link</a><span style="float:right; display: inline-block" class="back-close btn pakodi">Back</span></td>
				</tr>
       
            </table>
        </div>
        <div class="module-body">
            <form id="updatecontent" name="updatecontent" method="post" action="" class="form-horizontal row-fluid" enctype="multipart/form-data">
                
                <div class="control-group">
                    <label class="control-label" for="dubclip_title">Clip Title:</label>
                    <div class="controls">
                        <?php echo form_input('dubclip_title', $userdubs->dubclip_title, 'id="dubclip_title", class="span8" placeholder="Enter Clip Title" autocomplete="off" readonly'); ?>
                        <?php echo form_error('dubclip_title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="artist">Artist:</label>
                    <div class="controls">
                        <?php echo form_input('artist', $userdubs->artist, 'id="artist", class="span8" placeholder="Enter Artist" autocomplete="off" readonly'); ?>
                        <?php echo form_error('artist'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="language_id">Language:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="language_id" id="language_id" readonly="readyonly">
                            <!--<option value="">-Select-</option>-->
                            <?php foreach ($language as $lang){
                                if($lang->lang_id == $userdubs->language_id){?>
                            
                                <option value="<?php echo $lang->lang_id; ?>" <?php if($lang->lang_id == $userdubs->language_id){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $lang->language; ?></option>
                            <?php } } ?>

                        </select>
                        <?php echo form_error('language_id'); ?>
                    </div>  
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_id">Content Privacy:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="content_id" id="content_id" readonly="readonly">
                            <!--<option value="">-Select-</option>-->
                            <?php if($userdubs->content_id != 0){ ?>
                            <option value="<?php echo $userdubs->content_id; ?>" <?php if($userdubs->content_id != 0){ echo 'selected="selected"'; } ?>>Public</option>
                            <?php }else{ ?>
                            <option value="0" <?php if($userdubs->content_id == 0){ echo 'selected="selected"'; } ?>>Private</option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('content_id'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="parental_advisory">Parental Advisory:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="parental_advisory" id="parental_advisory" readonly="readonly">
                            <!--<option value="">-Select-</option>-->
                            <?php if($userdubs->parental_advisory == 'ALL'){ ?>
                            <option value="ALL" <?php if($userdubs->parental_advisory == 'ALL'){ echo 'selected="selected"'; } ?>>ALL</option><?php } ?>
                            <?php if($userdubs->parental_advisory == 'PG'){ ?>
                            <option value="PG" <?php if($userdubs->parental_advisory == 'PG'){ echo 'selected="selected"'; } ?>>PG</option><?php } ?>
                            <?php if($userdubs->parental_advisory == '13+'){ ?>
                            <option value="13+" <?php if($userdubs->parental_advisory == '13+'){ echo 'selected="selected"'; } ?>>13+</option><?php } ?>
                            <?php if($userdubs->parental_advisory == '16+'){ ?>
                            <option value="16+" <?php if($userdubs->parental_advisory == '16+'){ echo 'selected="selected"'; } ?>>16+</option><?php } ?>
                            <?php if($userdubs->parental_advisory == '18+'){ ?>
                            <option value="18+" <?php if($userdubs->parental_advisory == '18+'){ echo 'selected="selected"'; } ?>>18+</option><?php } ?>
                        </select>
                        <?php echo form_error('parental_advisory'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="user_id">Dubbed User:</label>
                    <div class="controls">
                        <?php echo form_input('user_id', $user->name.' ('.$user->msisdn.')', 'id="user_id", class="span8" placeholder="Enter User id" autocomplete="off" readonly'); ?>
                        <?php echo form_error('user_id'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dublike_count">Dub Like Count:</label>
                    <div class="controls">
                        <?php echo form_input('dublike_count', $userdubs->dublike_count, 'id="dublike_count", class="span8" placeholder="Enter Dub Like Count" autocomplete="off" readonly'); ?>
                        <?php echo form_error('dublike_count'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dubshare_count">Dub Share Count:</label>
                    <div class="controls">
                        <?php echo form_input('dubshare_count', $userdubs->dubshare_count, 'id="dubshare_count", class="span8" placeholder="Enter Dub Share Count" autocomplete="off" readonly'); ?>
                        <?php echo form_error('dubshare_count'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dubdownload_count">Dub Download Count:</label>
                    <div class="controls">
                        <?php echo form_input('dubdownload_count', $userdubs->dubdownload_count, 'id="dubdownload_count", class="span8" placeholder="Enter Dub Download Count" autocomplete="off" readonly'); ?>
                        <?php echo form_error('dubdownload_count'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dubplay_count">Dub Viewed Count:</label>
                    <div class="controls">
                        <?php echo form_input('dubplay_count', $userdubs->dubplay_count, 'id="dubplay_count", class="span8" placeholder="Enter Dub Viewed Count" autocomplete="off" readonly'); ?>
                        <?php echo form_error('dubplay_count'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dub_rating">Dub Rating:</label>
                    <div class="controls">
                        <?php echo form_input('dub_rating', $userdubs->dub_rating, 'id="dub_rating", class="span8" placeholder="Enter Rating" autocomplete="off" readonly'); ?>
                        <?php echo form_error('dub_rating'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dub_status">Dub Status:</label>
                    <div class="controls">
                        <?php if($userdubs->dub_status == 1){ $dubstatus = 'Active'; }else{ $dubstatus = 'Inactive'; } ?>
                        <?php echo form_input('dub_status', $dubstatus, 'id="dub_status", class="span8" placeholder="Enter Dub Status" autocomplete="off" readonly'); ?>
                        <?php echo form_error('dub_status'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="datecreated">Dub Created On:</label>
                    <div class="controls">
                        <?php echo form_input('datecreated', $userdubs->datecreated, 'id="datecreated", class="span8" placeholder="Enter Dub Created date" autocomplete="off" readonly'); ?>
                        <?php echo form_error('datecreated'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="thumb_filename">Image:</label>
                    <div class="controls">
                        <img src="http://sprintmediasg.s3.amazonaws.com/appimages/<?php echo $userdubs->thumb_filename; ?>" border='0' alt='Thumb Image' width='100' height="100" />
                        <?php echo form_error('thumb_filename'); ?>
                    </div>
                </div>
                <div class="control-group" id="multipleupload">
                    <label class="control-label" for="dubclip_filename">Dub Video:</label>
                    <div class="controls">
                       <!--<input type="file" name="dubclip_filename" id="dubclip_filename" value="<?php //echo $userdubs->dubclip_filename; ?>" onchange="filetypenew(this.value);" />-->
                       <!--<iframe src="../../../videos/<?php //echo $userdubs->dubclip_filename; ?>" width="450" height="250"></iframe><br>-->
					   <video src="http://sprintmediasg.s3.amazonaws.com/dubs/<?php echo $userdubs->dubclip_filename; ?>" width='0' height='150' controls ></video><br>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="isdub_moderate">Dub Moderate:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="isdub_moderate" id="isdub_moderate">
                            <option value="0" <?php if($userdubs->isdub_moderate == 0){ echo 'selected="selected"'; } ?>>NO</option>
                            <option value="1" <?php if($userdubs->isdub_moderate == 1){ echo 'selected="selected"'; } ?>>YES</option>
                        </select>
                        <?php echo form_error('isdub_moderate'); ?>
                    </div>
                </div>
                      

                <div class="control-group">
                    <div class="controls">
					<input type="submit" name="submit" id="submit" value="Edit" class="btn pakodi">
                        <?php //echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                        <a href="javascript:window.history.go(-1);" class="btn pakodi" style="margin-bottom: -3px;">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>