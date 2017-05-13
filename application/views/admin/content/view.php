<div class="content">
    <div class="module">
        <div class="module-head"> <h3>View Content <span style="float:right; display: inline-block" class="back-close btn pakodi">Back</span></h3></div>
        <div class="module-body">
            <form class="form-horizontal">  
			<?php
			if (!empty($content)) { ?>
			
			<div class="span4">
			<?php
			$path_thumb = $content[0]->thumb_filename;
			$path_clip = $content[0]->contentclip_filename;
			?>        
			<img src="http://sprintmediasg.s3.amazonaws.com/appimages/<?php echo $path_thumb; ?>" border='0' alt='image2' width='225' height='190' class='test' />
			</div>
			<div class="span4" >
			<?php if(!empty($content[1]->title)){ ?>
				<div class="control-group">
                    <label class="control-label" for="title" style="text-align:left;">Title :</label>
                    <div class="checkbox inline">
                        <?php echo $content[1]->title; ?>
                    </div>
                </div>
				<?php }else if(!empty($content[0]->title)){ ?>
				<div class="control-group">
                    <label class="control-label" for="title" style="text-align:left;" >Title :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->title; ?>
                    </div>
                </div>
				<?php } ?>
				<div class="control-group">
                    <label class="control-label" for="unique_code" style="text-align:left;">Unique Code :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->unique_code; ?>
                    </div>
                </div>
				 <div class="control-group">
                    <label class="control-label" for="content_expirydate" style="text-align:left;">Status :</label>
                   	<div <?php if($content[0]->content_status == 1){?>class="checkbox inline icongreen" <?php }else{?> class="checkbox inline"<?php } ?>>
                        <?php if($content[0]->content_status == 1){ echo 'Active'; }else{ echo 'Inactive'; } ?>
                    </div>
                </div>  
            
                    <div class="control-group">
                    <label class="control-label" for="category_id" style="text-align:left;">Category :</label>
                    <div class="checkbox inline">
                        <?php echo $category; ?>
                       </div>  
                </div>
                <div class="control-group">
                    <label class="control-label" for="language_id" style="text-align:left;">Language :</label>
                    <div class="checkbox inline">
                        <?php echo $language; ?>
                    </div>  
                </div>
				
				  
			</div>
			<div style="clear: both;" ></div>
					
				
               <div class="span4">
			
				<div class="control-group">
                    <label class="control-label" for="parental_advisory" style="text-align:left;">Recommend Type :</label>
                    <div class="checkbox inline">
                        <?php if($content[0]->recommend_type == 1){ echo "Trends"; }else{ echo "Recommends"; } ?>
                    </div>
                </div>
                  <div class="control-group">
                    <label class="control-label" for="parental_advisory" style="text-align:left;">Parental Advisory :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->parental_advisory; ?>
                </div> 
                  </div>
                    
                <div class="control-group">
                    <label class="control-label" for="contentowner_id" style="text-align:left;">Content Owner Id :</label>
                    <div class="checkbox inline">
                         <?php echo $content[0]->contentowner_id; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="clip_length" style="text-align:left;">Clip Length :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->clip_length; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="copyright" style="text-align:left;">Copyright :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->copyright; ?>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="content_activationdate" style="text-align:left;">Activation Date :</label>
                    <div class="checkbox inline">
                         <?php echo $content[0]->content_activationdate; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_expirydate" style="text-align:left;">Expiry Date :</label>
                    <div class="checkbox inline" >
                        <?php echo $content[0]->content_expirydate; ?>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="search_keywords" style="text-align:left;">Search Keywords :</label>
                    <div class="block span2" style="margin-left:16px;">
                        <?php echo $content[0]->search_keywords; ?>
                    </div>
                </div>
			</div>
			<div class="span4">
				<div class="control-group">
                    <label class="control-label" for="content_expirydate" style="text-align:left;">Content Like Count :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->contentlike_count; ?>
                    </div>
                </div>    
                   <div class="control-group">
                    <label class="control-label" for="content_expirydate" style="text-align:left;">Content Share Count :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->contentshare_count; ?>
                    </div>
                </div>  
                     <div class="control-group">
                    <label class="control-label" for="content_expirydate" style="text-align:left;">Content Downloaded Count :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->contentdownload_count; ?>
                    </div>
                </div>  
                    <div class="control-group">
                    <label class="control-label" for="content_expirydate" style="text-align:left;">Content Rating :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->content_rating; ?>
                    </div>
                </div>  
                    <div class="control-group">
                    <label class="control-label" for="content_expirydate" style="text-align:left;">Content Play Count :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->contentplay_count; ?>
                    </div>
                </div>  
                    <div class="control-group">
                    <label class="control-label" for="content_expirydate" style="text-align:left;">Content Dub Count :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->dub_count; ?>
                    </div>
                </div> 
			</div>
			<div style="clear: both;" ></div>
                <div class="clear"></div>
              <ul class="widget widget-menu unstyled">  
                     <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i><?php echo $language; ?> </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li>
                                             <div class="control-group">
                    <label class="control-label" for="title">Title :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->title; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="short_desc">Short Description :</label>
                    <div class="span6" style="padding:5px; margin-left:13px;">
                          <?php echo $content[0]->short_desc; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="movie_name">Movie Name :</label>
                    <div class="checkbox inline">
                         <?php echo $content[0]->movie_name; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="main_artist">Main Artist :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->main_artist; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sub_artists">Sub Artists :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->sub_artists; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="film_director">Film Director :</label>
                    <div class="checkbox inline">
                       <?php echo $content[0]->film_director; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="music_director">Music Director :</label>
                    <div class="checkbox inline">
                        <?php echo $content[0]->music_director; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dialog_writer">Dialogue Writer :</label>
                    <div class="checkbox inline">
                       <?php echo $content[0]->dialog_writer; ?>
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
                    <label class="control-label" for="title">Title :</label>
                    <div class="checkbox inline">
                        <?php echo $content[1]->title; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="short_desc">Short Description :</label>
                    <div class="span6" style="padding:5px; margin-left:13px;">
                          <?php echo $content[1]->short_desc; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="movie_name">Movie Name :</label>
                    <div class="checkbox inline">
                         <?php echo $content[1]->movie_name; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="main_artist">Main Artist :</label>
                    <div class="checkbox inline">
                        <?php echo $content[1]->main_artist; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sub_artists">Sub Artists :</label>
                    <div class="checkbox inline">
                        <?php echo $content[1]->sub_artists; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="film_director">Film Director :</label>
                    <div class="checkbox inline">
                       <?php echo $content[1]->film_director; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="music_director">Music Director :</label>
                    <div class="checkbox inline">
                        <?php echo $content[1]->music_director; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dialog_writer">Dialogue Writer :</label>
                    <div class="checkbox inline">
                       <?php echo $content[1]->dialog_writer; ?>
                    </div>
                </div>
                                        </li>
                                     </ul>
                                </li>  
                        </ul>
						<?php } ?>
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

