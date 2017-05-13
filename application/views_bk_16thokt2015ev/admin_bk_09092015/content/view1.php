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
                        <tr><th align="right">Recommend Type:</th><td align="left"><?php if($content->recommend_type == 1){ echo "Trends"; }else{ echo "Recommends"; } ?></td></tr>
                        <tr><th align="right">Parental Advisory:</th><td align="left"><?php echo $content->parental_advisory; ?></td></tr>
                        <tr><th align="right">Unique Code:</th><td align="left"><?php echo $content->unique_code; ?></td></tr>
                        <tr><th align="right">Content Owner Id:</th><td align="left"><?php echo $content->contentowner_id; ?></td></tr>
                        <tr><th align="right">Title:</th><td align="left"><?php echo $content->title; ?></td></tr>
                        <tr><th align="right">Short Description:</th><td align="left"><?php echo $content->short_desc; ?></td></tr>
                        <tr><th align="right">Movie Name:</th><td align="left"><?php echo $content->movie_name; ?></td></tr>
                        <tr><th align="right">Main Artist:</th><td align="left"><?php echo $content->main_artist; ?></td></tr>
                        <tr><th align="right">Sub Artists:</th><td align="left"><?php echo $content->sub_artists; ?></td></tr>
                        <tr><th align="right">Film Director:</th><td align="left"><?php echo $content->film_director; ?></td></tr>
                        <tr><th align="right">Music Director:</th><td align="left"><?php echo $content->music_director; ?></td></tr>
                        <tr><th align="right">Dialog Writer:</th><td align="left"><?php echo $content->dialog_writer; ?></td></tr>
                        <tr><th align="right">Clip Length:</th><td align="left"><?php echo $content->clip_length; ?></td></tr>
                        <tr><th align="right">Copyright:</th><td align="left"><?php echo $content->copyright; ?></td></tr>
                        <tr><th align="right">Search Keywords:</th><td align="left"><?php echo $content->search_keywords; ?></td></tr>
                        <tr><th align="right">Activation Date:</th><td align="left"><?php echo $content->content_activationdate; ?></td></tr>
                        <tr><th align="right">Expiry Date:</th><td align="left"><?php echo $content->content_expirydate; ?></td></tr>
                        <tr><th align="right">Content Type:</th><td align="left"><?php if($content->content_type == 1){ echo 'Video'; }else{ echo 'Audio'; } ?></td></tr>
                        <tr><th align="right">Image:</th><td align="left"><img src="<?php echo base_url(); ?>appimages/<?php echo $content->thumb_filename; ?>" border='0' alt='image2' /></td></tr>
                        <?php if($content->content_type == 1){ ?>
                        <tr><th align="right">Video:</th><td align="left"><iframe src="../../../videos/<?php echo $content->contentclip_filename; ?>"></iframe></td></tr>
                        <?php }else{ ?>
                        <tr><th align="right">Audio:</th><td align="left"><iframe src="../../../audios/<?php echo $content->contentclip_filename; ?>"></iframe></td></tr>
                        <?php } ?>
                        
                        <tr><th align="right">Content Like Count:</th><td align="left"><?php echo $content->contentlike_count; ?></td></tr>
                        <tr><th align="right">Content Share Count:</th><td align="left"><?php echo $content->contentshare_count; ?></td></tr>
                        <tr><th align="right">Content Downloaded Count:</th><td align="left"><?php echo $content->contentdownload_count; ?></td></tr>
                        <tr><th align="right">Content Rating:</th><td align="left"><?php echo $content->content_rating; ?></td></tr>
                        <tr><th align="right">Content Play Count:</th><td align="left"><?php echo $content->contentplay_count; ?></td></tr>
                        <tr><th align="right">Content Dub Count:</th><td align="left"><?php echo $content->dub_count; ?></td></tr>
                        <tr><th align="right">Created On:</th><td align="left"><?php echo $content->datecreated; ?></td></tr>
                        <tr><th align="right">Status:</th><td align="left"><?php if($content->content_status == 1){ echo 'Active'; }else{ echo 'Inactive'; } ?></td></tr>
                        
                    <?php } else { ?>
                        <tr><td align="left" colspan="29">No Content found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

