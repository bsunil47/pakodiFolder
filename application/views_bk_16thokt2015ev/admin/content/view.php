<div class="content">
    <div class="module">
        <div class="module-head"> <h3>View Content</h3></div>
        <div class="module-body">
            <form class="form-horizontal">  
                    <?php
                    if (!empty($content)) { ?>
            
                        <div class="control-group">
                    <label class="control-label" for="category_id">Category:</label>
                    <div class="controls">
                        <?php echo $category; ?>
                       </div>  
                </div>
                       <div class="control-group">
                    <label class="control-label" for="language_id">Language:</label>
                    <div class="controls">
                        <?php echo $language; ?>
                    </div>  
                </div>
            <div class="control-group">
                    <label class="control-label" for="parental_advisory">Recommend Type:</label>
                    <div class="controls">
                        <?php if($content[0]->recommend_type == 1){ echo "Trends"; }else{ echo "Recommends"; } ?>
                    </div>
                </div>
                  <div class="control-group">
                    <label class="control-label" for="parental_advisory">Parental Advisory:</label>
                    <div class="controls">
                        <?php echo $content[0]->parental_advisory; ?>
                </div> 
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="unique_code">Unique Code:</label>
                    <div class="controls">
                        <?php echo $content[0]->unique_code; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="contentowner_id">Content Owner Id:</label>
                    <div class="controls">
                         <?php echo $content[0]->contentowner_id; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="clip_length">Clip Length:</label>
                    <div class="controls">
                        <?php echo $content[0]->clip_length; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="copyright">Copyright:</label>
                    <div class="controls">
                        <?php echo $content[0]->copyright; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="search_keywords">Search Keywords:</label>
                    <div class="controls">
                        <?php echo $content[0]->search_keywords; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_activationdate">Activation Date:</label>
                    <div class="controls">
                         <?php echo $content[0]->content_activationdate; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_expirydate">Expiry Date:</label>
                    <div class="controls">
                        <?php echo $content[0]->content_expirydate; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_type">Content Type:</label>
                    <div class="controls">
                       <?php if($content[0]->content_type==2){echo "Audio";}else if($content[0]->content_type==1){echo "Video";} ?>
                    </div>
                </div>                        
                <?php
                    $path_thumb = $content[0]->thumb_filename;
                    $path_clip = $content[0]->contentclip_filename;
                ?>        
                 
                <div class="control-group" id="imgupload">
                    <label class="control-label" for="filen">Image:</label>
                    <div class="controls">
                        <img src="http://sprintmedia.s3.amazonaws.com/appimages/<?php echo $path_thumb; ?>" border='0' alt='image2' width='50' height='50' />
                       </div>
                </div>
                <div class="control-group" id="multipleupload">
                            <label class="control-label" for="filetitle" id="filetitle">File:</label>
                    <div class="controls">
                       <?php if($content[0]->content_type == 1){ ?>
                       <!--<iframe src="../../../videos/<?php //echo $path_clip; ?>" width="450" height="250"></iframe>-->
					   <video src="http://sprintmedia.s3.amazonaws.com/videos/<?php echo $path_clip; ?>" width='0' height='150' controls ></video><br>
                       <?php }else if($content[0]->content_type == 2){ ?>
                       <!--<iframe src="../../../audios/<?php //echo $path_clip; ?>" width="450" height="100"></iframe>-->
					   <audio src="http://sprintmedia.s3.amazonaws.com/audios/<?php echo $path_clip; ?>" width='0' height='30' controls ></audio>
					  
                       <?php } ?>
                    </div>
                </div>
                    <div class="control-group">
                    <label class="control-label" for="content_expirydate">Content Like Count:</label>
                    <div class="controls">
                        <?php echo $content[0]->contentlike_count; ?>
                    </div>
                </div>    
                   <div class="control-group">
                    <label class="control-label" for="content_expirydate">Content Share Count:</label>
                    <div class="controls">
                        <?php echo $content[0]->contentshare_count; ?>
                    </div>
                </div>  
                     <div class="control-group">
                    <label class="control-label" for="content_expirydate">Content Downloaded Count:</label>
                    <div class="controls">
                        <?php echo $content[0]->contentdownload_count; ?>
                    </div>
                </div>  
                    <div class="control-group">
                    <label class="control-label" for="content_expirydate">Content Rating:</label>
                    <div class="controls">
                        <?php echo $content[0]->content_rating; ?>
                    </div>
                </div>  
                    <div class="control-group">
                    <label class="control-label" for="content_expirydate">Content Play Count:</label>
                    <div class="controls">
                        <?php echo $content[0]->contentplay_count; ?>
                    </div>
                </div>  
                    <div class="control-group">
                    <label class="control-label" for="content_expirydate">Content Dub Count:</label>
                    <div class="controls">
                        <?php echo $content[0]->dub_count; ?>
                    </div>
                </div>  
                   <div class="control-group">
                    <label class="control-label" for="content_expirydate">Created On:</label>
                    <div class="controls">
                        <?php echo $content[0]->datecreated; ?>
                    </div>
                </div>  
                    <div class="control-group">
                    <label class="control-label" for="content_expirydate">Status:</label>
                    <div class="controls">
                        <?php if($content[0]->content_status == 1){ echo 'Active'; }else{ echo 'Inactive'; } ?>
                    </div>
                </div>  
                <div class="clear"></div>
              <ul class="widget widget-menu unstyled">  
                     <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i><?php echo $language; ?> </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li>
                                             <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo $content[0]->title; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="short_desc">Short Description:</label>
                    <div class="controls">
                          <?php echo $content[0]->short_desc; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="movie_name">Movie Name:</label>
                    <div class="controls">
                         <?php echo $content[0]->movie_name; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="main_artist">Main Artist:</label>
                    <div class="controls">
                        <?php echo $content[0]->main_artist; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sub_artists">Sub Artists:</label>
                    <div class="controls">
                        <?php echo $content[0]->sub_artists; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="film_director">Film Director:</label>
                    <div class="controls">
                       <?php echo $content[0]->film_director; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="music_director">Music Director:</label>
                    <div class="controls">
                        <?php echo $content[0]->music_director; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dialog_writer">Dialog Writer:</label>
                    <div class="controls">
                       <?php echo $content[0]->dialog_writer; ?>
                    </div>
                </div>
                                        </li>
                                     </ul>
                                </li>  
                        </ul>
                        <ul class="widget widget-menu unstyled">  
                     <li><a class="collapsed" data-toggle="collapse" href="#togglePages1"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>English </a>
                                    <ul id="togglePages1" class="collapse unstyled">
                                        <li>
                                             <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo $content[1]->title; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="short_desc">Short Description:</label>
                    <div class="controls">
                          <?php echo $content[1]->short_desc; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="movie_name">Movie Name:</label>
                    <div class="controls">
                         <?php echo $content[1]->movie_name; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="main_artist">Main Artist:</label>
                    <div class="controls">
                        <?php echo $content[1]->main_artist; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sub_artists">Sub Artists:</label>
                    <div class="controls">
                        <?php echo $content[1]->sub_artists; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="film_director">Film Director:</label>
                    <div class="controls">
                       <?php echo $content[1]->film_director; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="music_director">Music Director:</label>
                    <div class="controls">
                        <?php echo $content[1]->music_director; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dialog_writer">Dialog Writer:</label>
                    <div class="controls">
                       <?php echo $content[1]->dialog_writer; ?>
                    </div>
                </div>
                                        </li>
                                     </ul>
                                </li>  
                        </ul>
                    <?php } else { ?>
                        <tr><td align="left" colspan="29">No Content found</td></tr>
                        <div class="control-group">
                      No Content found
                    </div>
                </div>
                    <?php } ?>
            </form>
                </div>
    </div>
</div>

