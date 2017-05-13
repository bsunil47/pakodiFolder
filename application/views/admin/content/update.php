<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Edit Content</h3></td>
                    <td align="right"><a href="https://translate.google.co.in/" target="_blank" class="btn pakodi">Google Translater link</a><span style="float:right; display: inline-block" class="back-close btn pakodi">Back</span></td>
                </tr>

            </table>
        </div>
        <div class="module-body">
            <form id="updatecontent" name="updatecontent" method="post" action="" class="form-horizontal row-fluid" enctype="multipart/form-data">
                
                <div class="control-group">
                    <label class="control-label" for="category_id">Category:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="category_id" id="category_id">
                            <option value="">-Select-</option>
                            <?php foreach ($category as $cat){  ?>
                                <option value="<?php echo $cat->cat_id; ?>" <?php if($cat->cat_id == $content[0]->category_id){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $cat->category; ?></option>
                            <?php } ?>

                        </select>
                        <?php echo form_error('category_id'); ?>
                    </div>  
                </div>
                <div class="control-group">
                    <label class="control-label" for="language_id">Language:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="language_id" id="language_id">
                            <option value="">-Select-</option>
                            <?php foreach ($language as $lang){?>
                                <option value="<?php echo $lang->lang_id; ?>" <?php if($lang->lang_id == $content[0]->language_id){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $lang->language; ?></option>
                                
                                    <?php } ?>

                        </select>
                        <?php echo form_error('language_id'); ?>
                    </div>  
                </div>
                                                 
                 <div class="control-group">
                    <label class="control-label" for="parental_advisory">Parental Advisory:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="parental_advisory" id="parental_advisory">
                            <option value="">-Select-</option>
                            <option value="ALL" <?php if($content[0]->parental_advisory == 'ALL'){ echo 'selected="selected"'; } ?>>ALL</option>
                            <option value="PG" <?php if($content[0]->parental_advisory == 'PG'){ echo 'selected="selected"'; } ?>>PG</option>
                            <option value="13+" <?php if($content[0]->parental_advisory == '13+'){ echo 'selected="selected"'; } ?>>13+</option>
                            <option value="16+" <?php if($content[0]->parental_advisory == '16+'){ echo 'selected="selected"'; } ?>>16+</option>
                            <option value="18+" <?php if($content[0]->parental_advisory == '18+'){ echo 'selected="selected"'; } ?>>18+</option>
                        </select>
                        <?php echo form_error('parental_advisory'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="unique_code">Unique Code:</label>
                    <div class="controls">
                        <?php echo form_input('unique_code', $content[0]->unique_code, 'id="unique_code", class="span8" placeholder="Enter Unique code" autocomplete="off" readonly'); ?>
                        <?php echo form_error('unique_code'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="contentowner_id">Content Owner Id:</label>
                    <div class="controls">
                        <?php echo form_input('contentowner_id', $content[0]->contentowner_id, 'id="contentowner_id", class="span8" placeholder="Enter Content Owner ID" autocomplete="off" readonly'); ?>
                        <?php echo form_error('contentowner_id'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="clip_length">Clip Length:</label>
                    <div class="controls">
                        <?php echo form_input('clip_length', $content[0]->clip_length, 'id="clip_length", class="span8" placeholder="Enter Clip length" autocomplete="off"'); ?>
                        <?php echo form_error('clip_length'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="copyright">Copyright:</label>
                    <div class="controls">
                        <?php echo form_input('copyright', $content[0]->copyright, 'id="copyright", class="span8" placeholder="Enter Copyright" autocomplete="off"'); ?>
                        <?php echo form_error('copyright'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="search_keywords">Search Keywords:</label>
                    <div class="controls">
                        <?php echo form_input('search_keywords', $content[0]->search_keywords, 'id="search_keywords", class="span8" placeholder="Enter Search keywords" autocomplete="off"'); ?>
                        <?php echo form_error('search_keywords'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_activationdate">Activation Date:</label>
                    <div class="controls">
                        <?php echo form_input('content_activationdate', $content[0]->content_activationdate, 'id="content_activationdate", class="span8" placeholder="Select content activationdate" autocomplete="off" readonly'); ?>&nbsp;mm-dd-yyyy
                        <?php echo form_error('content_activationdate'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_expirydate">Expiry Date:</label>
                    <div class="controls">
                        <?php echo form_input('content_expirydate', $content[0]->content_expirydate, 'id="content_expirydate", class="span8" placeholder="Select content expirydate" autocomplete="off" readonly'); ?>&nbsp;mm-dd-yyyy
                        <?php echo form_error('content_expirydate'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_type">Content Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="content_type" id="content_type" onchange="contenttype(this.value);">
                            <option value="">-Select-</option>
                            <option value="2" <?php if($content[0]->content_type == 2){ echo 'selected="selected"'; } ?>>Audio</option>
                            <option value="1" <?php if($content[0]->content_type == 1){ echo 'selected="selected"'; } ?>>Video</option>
                        </select>
                        <?php echo form_error('content_type'); ?>
                    </div>
                </div>                        
                <?php
                    $path_thumb = $content[0]->thumb_filename;
                    $path_clip = $content[0]->contentclip_filename;
                ?>        
                   
                <div class="control-group" id="imgupload">
                    <label class="control-label" for="filen">Upload Image:</label>
                    <div class="controls">
                       <input type="file" name="filen" id="filen" onchange="filetype(this.value);" />
                       <img src="http://sprintmediasg.s3.amazonaws.com/appimages/<?php echo $path_thumb; ?>" border='0' alt='image2' width='50' height='50' />
                       <strong><sub>&nbsp;Upload only jpg,png,gif files</sub></strong>
                    </div>
                </div>
                <div class="control-group" id="multipleupload"  style="">
                            <label class="control-label" for="filetitle" id="filetitle">File:</label>
                    <div class="controls">
                       <input type="file" name="file1" id="file1" value="<?php echo $path_clip; ?>" onchange="contentfiletype(this.value);" />
                       <strong><sub id="note"></sub></strong><br>
                       <?php if($content[0]->content_type == 1){ ?>
                       <!--<iframe src="../../../videos/<?php //echo $path_clip; ?>" width="450" height="250"></iframe>-->
					   <video src="http://sprintmediasg.s3.amazonaws.com/videos/<?php echo $path_clip; ?>" width='0' height='150' controls ></video><br>
                       <?php }else if($content[0]->content_type == 2){ ?>
                       <!--<iframe src="../../../audios/<?php //echo $path_clip; ?>" width="450" height="100"></iframe>-->
					   <audio src="http://sprintmediasg.s3.amazonaws.com/audios/<?php echo $path_clip; ?>" width='0' height='30' controls ></audio>
					   <br>
                       <?php }echo $path_clip; ?>
                    </div>
                </div>
                        <ul class="widget widget-menu unstyled">  
                     <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i><?php foreach ($language as $lang){if($lang->lang_id == $content[0]->language_id){echo $lang->language; }}?> </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li>
                                             <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title0', $content[0]->title, 'id="title", class="span8" placeholder="Enter Title" autocomplete="off" maxlength="75"'); ?>
                        <?php echo form_error('title0'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="short_desc">Short Description:</label>
                    <div class="controls">
                        <?php echo form_textarea('short_desc0', $content[0]->short_desc, 'id="short_desc", class="span8" placeholder="Enter short description" autocomplete="off" '); ?>
                        <?php echo form_error('short_desc0'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="movie_name">Movie Name:</label>
                    <div class="controls">
                        <?php echo form_input('movie_name0', $content[0]->movie_name, 'id="movie_name", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('movie_name0'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="main_artist">Main Artist:</label>
                    <div class="controls">
                        <?php echo form_input('main_artist0', $content[0]->main_artist, 'id="main_artist", class="span8" placeholder="Enter Main Artist Name" autocomplete="off"'); ?>
                        <?php echo form_error('main_artist0'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sub_artists">Sub Artists:</label>
                    <div class="controls">
                        <?php echo form_input('sub_artists0', $content[0]->sub_artists, 'id="sub_artists", class="span8" placeholder="Enter sub artists" autocomplete="off"'); ?>
                        <?php echo form_error('sub_artists0'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="film_director">Film Director:</label>
                    <div class="controls">
                        <?php echo form_input('film_director0', $content[0]->film_director, 'id="film_director", class="span8" placeholder="Enter Film Director Name" autocomplete="off"'); ?>
                        <?php echo form_error('film_director0'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="music_director">Music Director:</label>
                    <div class="controls">
                        <?php echo form_input('music_director0', $content[0]->music_director, 'id="music_director", class="span8" placeholder="Enter music director Name" autocomplete="off"'); ?>
                        <?php echo form_error('music_director0'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dialog_writer">Dialogue Writer:</label>
                    <div class="controls">
                        <?php echo form_input('dialog_writer0', $content[0]->dialog_writer, 'id="dialog_writer", class="span8" placeholder="Enter Dialogue writer Name" autocomplete="off"'); ?>
                        <?php echo form_error('dialog_writer0'); ?>
                        <input type="hidden" name="cid0" value="<?php echo $content[0]->content_id;?>">
                    </div>
                </div>
                                        </li>
                                     </ul>
                                </li>  
                        </ul>
						<?php if(!empty($content[1])){ ?>
                        <ul class="widget widget-menu unstyled">  
                     <li><a class="collapsed" data-toggle="collapse" href="#togglePages1"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>English </a>
                                    <ul id="togglePages1" class="collapse unstyled">
                                        <li>
                                             <div class="control-group">
                    <label class="control-label" for="title1">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title1', $content[1]->title, 'id="title", class="span8" placeholder="Enter Title" autocomplete="off" maxlength="75"'); ?>
                        <?php echo form_error('title1'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="short_desc">Short Description:</label>
                    <div class="controls">
                        <?php echo form_textarea('short_desc1', $content[1]->short_desc, 'id="short_desc", class="span8" placeholder="Enter short description" autocomplete="off" '); ?>
                        <?php echo form_error('short_desc1'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="movie_name">Movie Name:</label>
                    <div class="controls">
                        <?php echo form_input('movie_name1', $content[1]->movie_name, 'id="movie_name", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('movie_name1'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="main_artist">Main Artist:</label>
                    <div class="controls">
                        <?php echo form_input('main_artist1', $content[1]->main_artist, 'id="main_artist", class="span8" placeholder="Enter Main Artist Name" autocomplete="off"'); ?>
                        <?php echo form_error('main_artist1'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sub_artists">Sub Artists:</label>
                    <div class="controls">
                        <?php echo form_input('sub_artists1', $content[1]->sub_artists, 'id="sub_artists", class="span8" placeholder="Enter sub artists" autocomplete="off"'); ?>
                        <?php echo form_error('sub_artists1'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="film_director">Film Director:</label>
                    <div class="controls">
                        <?php echo form_input('film_director1', $content[1]->film_director, 'id="film_director", class="span8" placeholder="Enter Film Director Name" autocomplete="off"'); ?>
                        <?php echo form_error('film_director1'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="music_director">Music Director:</label>
                    <div class="controls">
                        <?php echo form_input('music_director1', $content[1]->music_director, 'id="music_director", class="span8" placeholder="Enter music director Name" autocomplete="off"'); ?>
                        <?php echo form_error('music_director1'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dialog_writer">Dialogue Writer:</label>
                    <div class="controls">
                        <?php echo form_input('dialog_writer1', $content[1]->dialog_writer, 'id="dialog_writer", class="span8" placeholder="Enter Dialogue writer Name" autocomplete="off"'); ?>
                        <?php echo form_error('dialog_writer1'); ?>
                         <input type="hidden" name="cid1" value="<?php echo $content[1]->content_id;?>">
                    </div>
                </div>
                                        </li>
                                     </ul>
                                </li>  
                        </ul>
					<?php } ?>
                <div class="control-group">
                    <div class="controls">
					<input type="submit" name="submit" id="submit" value="Edit" class="btn pakodi">
                        <?php //echo form_submit('submit', 'Edit', 'id="csubmit"', 'name="csubmit"', 'class="btn-primary"'); ?>
<a href="javascript:window.history.go(-1);" class="btn pakodi" style="margin-bottom: -3px;">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>