<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Move Record</h3></div>
        <div class="module-body">
            <form id="movedubs" name="movedubs" method="post" action="" class="form-horizontal row-fluid" enctype="multipart/form-data">
                <div class="control-group">
                    <label class="control-label" for="dubclip_title">Clip Title:</label>
                    <div class="controls">
                        <?php echo form_input('dubclip_title', $userdubs->dubclip_title, 'id="dubclip_title", class="span8" placeholder="Enter Clip Title" autocomplete="off"'); ?>
                        <?php echo form_error('dubclip_title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="clip_length">Clip Length:</label>
                    <div class="controls">
                        <?php echo form_input('clip_length', $userdubs->clip_length, 'id="clip_length", class="span8" placeholder="Enter clip length" autocomplete="off"'); ?>
                        <?php echo form_error('clip_length'); ?>
                    </div>
                </div>
               <div class="control-group">
                    <label class="control-label" for="category_id">Category:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="category_id" id="category_id">
                            <option value="">-Select-</option>
                            <?php foreach ($category as $cat){  ?>
                                <option value="<?php echo $cat->cat_id; ?>" <?php if(!empty($_POST['category_id']) && $_POST['category_id'] == $cat->cat_id){ echo "selected='selected'"; } ?>><?php echo $cat->category; ?></option>
                            <?php } ?>

                        </select>
                        <?php echo form_error('category_id'); ?>
                    </div>  
                </div>
                <div class="control-group">
                    <label class="control-label" for="parental_advisory">Parental Advisory:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="parental_advisory" id="parental_advisory">
                            <option value="">-Select-</option>
                            <option value="ALL" <?php if($userdubs->parental_advisory == 'ALL'){ echo 'selected="selected"'; } ?>>ALL</option>
                            <option value="PG" <?php if($userdubs->parental_advisory == 'PG'){ echo 'selected="selected"'; } ?>>PG</option>
                            <option value="13+" <?php if($userdubs->parental_advisory == '13+'){ echo 'selected="selected"'; } ?>>13+</option>
                            <option value="16+" <?php if($userdubs->parental_advisory == '16+'){ echo 'selected="selected"'; } ?>>16+</option>
                            <option value="18+" <?php if($userdubs->parental_advisory == '18+'){ echo 'selected="selected"'; } ?>>18+</option>
                        </select>
                        <?php echo form_error('parental_advisory'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="language_id">Language:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="language_id" id="language_id">
                            <option value="">-Select-</option>
                            <?php foreach ($language as $lang){?>
                                <option value="<?php echo $lang->lang_id; ?>" <?php if($lang->lang_id == $userdubs->language_id){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $lang->language; ?></option>
                            <?php } ?>

                        </select>
                        <?php echo form_error('language_id'); ?>
                    </div>  
                </div>
                <div class="control-group">
                    <label class="control-label" for="thumb_filename">Image:</label>
                    <div class="controls">
                        <img src="http://sprintmedia.s3.amazonaws.com/appimages/<?php echo $userdubs->thumb_filename; ?>" border='0' alt='Thumb Image' width='100' height="100" />
                        <?php echo form_error('thumb_filename'); ?>
                    </div>
                </div>
                <div class="control-group" id="multipleupload">
                    <label class="control-label" for="dubclip_filename">Dub Video:</label>
                    <div class="controls">
                       <!--<iframe src="../../../videos/<?php //echo $userdubs->dubclip_filename; ?>" width="450" height="250"></iframe><br>-->
                        <video src="http://sprintmedia.s3.amazonaws.com/dubs/<?php echo $userdubs->dubclip_filename; ?>" width='0' height='150' controls ></video><br>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="movie_name">Movie Name:</label>
                    <div class="controls">
                        <?php echo form_input('movie_name', $this->input->post('movie_name'), 'id="movie_name", class="span8" placeholder="Enter Movie Name" autocomplete="off"'); ?>
                        <?php echo form_error('movie_name'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="main_artist">Main Artist:</label>
                    <div class="controls">
                        <?php echo form_input('main_artist', $this->input->post('main_artist'), 'id="main_artist", class="span8" placeholder="Enter Main Artist" autocomplete="off"'); ?>
                        <?php echo form_error('main_artist'); ?>
                    </div>
                </div>
		<div class="control-group">
                    <label class="control-label" for="content_type">Content Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="content_type" id="content_type">
                            <option value="">-Select-</option>
                            <option value="1" <?php if(!empty($_POST['content_type']) && $_POST['content_type'] == '1'){ echo 'selected="selected"'; } ?>>Video</option>
                            <option value="2" <?php if(!empty($_POST['content_type']) && $_POST['content_type'] == '2'){ echo 'selected="selected"'; } ?>>Audio</option>
                        </select>
                        <?php echo form_error('content_type'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="short_desc">Short Description:</label>
                    <div class="controls">
                        <?php echo form_textarea('short_desc', $this->input->post('short_desc'), 'id="short_desc", class="span8" placeholder="Enter short description" autocomplete="off" '); ?>
                        <?php echo form_error('short_desc'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Move', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                        <a href="javascript:window.history.go(-1);" class="btn-inverse" style="padding:3px;">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>