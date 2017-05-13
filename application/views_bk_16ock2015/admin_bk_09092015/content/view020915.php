<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>View Content</h3></td>
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped" width="100%">
                <tbody>
                    <?php
                    if (!empty($content)) { ?>
                        <tr><th align="right">Category:</th><td align="left"><?php echo $category; ?></td></tr>
                        <tr><th align="right">App Language:</th><td align="left"><?php echo $language; ?></td></tr>
                        <tr><th align="right">Recommend Type:</th><td align="left"><?php if($content[0]->recommend_type == 1){ echo "Trends"; }else{ echo "Recommends"; } ?></td></tr>
                        <tr><th align="right">Parental Advisory:</th><td align="left"><?php echo $content[0]->parental_advisory; ?></td></tr>
                        <tr><th align="right">Unique Code:</th><td align="left"><?php echo $content[0]->unique_code; ?></td></tr>
                        <tr><th align="right">Content Owner Id:</th><td align="left"><?php echo $content[0]->contentowner_id; ?></td></tr>
                        <tr><th align="right">Clip Length:</th><td align="left"><?php echo $content[0]->clip_length; ?></td></tr>
                        <tr><th align="right">Copyright:</th><td align="left"><?php echo $content[0]->copyright; ?></td></tr>
                        <tr><th align="right">Search Keywords:</th><td align="left"><?php echo $content[0]->search_keywords; ?></td></tr>
                        <tr><th align="right">Activation Date:</th><td align="left"><?php echo $content[0]->content_activationdate; ?></td></tr>
                        <tr><th align="right">Expiry Date:</th><td align="left"><?php echo $content[0]->content_expirydate; ?></td></tr>
                        <tr><th align="right">Content Type:</th><td align="left"><?php if($content[0]->content_type == 1){ echo 'Video'; }else if($content[0]->content_type == 2){ echo 'Audio'; } ?></td></tr>
                        <tr><th align="right">Image:</th><td align="left"><img src="http://sprintmedia.s3.amazonaws.com/appimages/<?php echo $content[0]->thumb_filename; ?>" border='0' alt='image2' width="100" height="200" /></td></tr>
                        <?php if($content[0]->content_type == 1){ ?>
                        <tr><th align="right">Video:</th><td align="left"><video height="100" width="300" controls><source src="http://sprintmedia.s3.amazonaws.com/videos/<?php echo $content[0]->contentclip_filename; ?>" type='video/mp4'></video></td></tr>
                        <?php }else if($content[0]->content_type == 2){ ?>
                        <tr><th align="right">Audio:</th><td align="left"><audio height="100" width="300" controls><source src="http://sprintmedia.s3.amazonaws.com/audios/<?php echo $content[0]->contentclip_filename; ?>" type='audio/mpeg'></audio></td></tr>
                        <?php } ?>
                        
                        <tr><th align="right">Content Like Count:</th><td align="left"><?php echo $content[0]->contentlike_count; ?></td></tr>
                        <tr><th align="right">Content Share Count:</th><td align="left"><?php echo $content[0]->contentshare_count; ?></td></tr>
                        <tr><th align="right">Content Downloaded Count:</th><td align="left"><?php echo $content[0]->contentdownload_count; ?></td></tr>
                        <tr><th align="right">Content Rating:</th><td align="left"><?php echo $content[0]->content_rating; ?></td></tr>
                        <tr><th align="right">Content Play Count:</th><td align="left"><?php echo $content[0]->contentplay_count; ?></td></tr>
                        <tr><th align="right">Content Dub Count:</th><td align="left"><?php echo $content[0]->dub_count; ?></td></tr>
                        <tr><th align="right">Created On:</th><td align="left"><?php echo $content[0]->datecreated; ?></td></tr>
                        <tr><th align="right">Status:</th><td align="left"><?php if($content[0]->content_status == 1){ echo 'Active'; }else{ echo 'Inactive'; } ?></td></tr>
                        <ul class="widget widget-menu unstyled">  
                     <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i><?php echo $language;?> </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li>
                        <tr><th align="right">Title:</th><td align="left"><?php echo $content[0]->title; ?></td></tr>
                        <tr><th align="right">Short Description:</th><td align="left"><?php echo $content[0]->short_desc; ?></td></tr>
                        <tr><th align="right">Movie Name:</th><td align="left"><?php echo $content[0]->movie_name; ?></td></tr>
                        <tr><th align="right">Main Artist:</th><td align="left"><?php echo $content[0]->main_artist; ?></td></tr>
                        <tr><th align="right">Sub Artists:</th><td align="left"><?php echo $content[0]->sub_artists; ?></td></tr>
                        <tr><th align="right">Film Director:</th><td align="left"><?php echo $content[0]->film_director; ?></td></tr>
                        <tr><th align="right">Music Director:</th><td align="left"><?php echo $content[0]->music_director; ?></td></tr>
                        <tr><th align="right">Dialog Writer:</th><td align="left"><?php echo $content[0]->dialog_writer; ?></td></tr>
                                        </li>
                                     </ul>
                                </li>  
                        </ul>
                        <ul class="widget widget-menu unstyled">  
                     <li><a class="collapsed" data-toggle="collapse" href="#togglePages1"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>English </a>
                                    <ul id="togglePages1" class="collapse unstyled">
                                        <li> <tr><th align="right">Title:</th><td align="left"><?php echo $content[1]->title; ?></td></tr>
                        <tr><th align="right">Short Description:</th><td align="left"><?php echo $content[1]->short_desc; ?></td></tr>
                        <tr><th align="right">Movie Name:</th><td align="left"><?php echo $content[1]->movie_name; ?></td></tr>
                        <tr><th align="right">Main Artist:</th><td align="left"><?php echo $content[1]->main_artist; ?></td></tr>
                        <tr><th align="right">Sub Artists:</th><td align="left"><?php echo $content[1]->sub_artists; ?></td></tr>
                        <tr><th align="right">Film Director:</th><td align="left"><?php echo $content[1]->film_director; ?></td></tr>
                        <tr><th align="right">Music Director:</th><td align="left"><?php echo $content[1]->music_director; ?></td></tr>
                        <tr><th align="right">Dialog Writer:</th><td align="left"><?php echo $content[1]->dialog_writer; ?></td></tr>
                                        </li>
                                     </ul>
                                </li>  
                        </ul>
                    <?php } else { ?>
                        <tr><td align="left" colspan="29">No Content found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

