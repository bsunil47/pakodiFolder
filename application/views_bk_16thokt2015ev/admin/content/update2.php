<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() { 
    // Datepicker Popups calender to Choose date.
    $(function() {
    $("#content_activationdate").datepicker();
    // Pass the user selected date format.
    });
    
    <?php
	  if($content->content_type == '0'){ ?>
            document.getElementById("multipleupload").style.display = 'block';
            document.getElementById("file1").value = '';
            document.getElementById("note").innerHTML = 'Upload only mp3 files';
            document.getElementById("filetitle").innerHTML = 'Upload Audio';
	<?php } 
	  if($content->content_type == '1'){ ?>
            document.getElementById("multipleupload").style.display = 'block';
            document.getElementById("file1").value='';
            document.getElementById("note").innerHTML = 'Upload only mp4 or flv files';
            document.getElementById("filetitle").innerHTML = 'Upload Video';
	<?php } ?>
    
    });//ready
</script>
<script type="text/javascript">
    $(document).ready(function() {
    // Datepicker Popups calender to Choose date.
    $(function() {
    $("#content_expirydate").datepicker();
    // Pass the user selected date format.
    });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#submit").click(function(){
            //alert($("#content_activationdate").val());
            var content_activationdate = new Date($("#content_activationdate").val()).getTime()
            var content_expirydate = new Date($("#content_expirydate").val()).getTime();

            if(content_activationdate > content_expirydate){
                alert("Activation date should be less than Expiry date");
                return false;
            }else if(content_activationdate == content_expirydate){
                alert("Activation date should not be equal to  Expiry date");
                return false;
            }
            
        });
    });
</script>

<script type="text/javascript">
  
  function newselection(v)
  {
	if(v == '0')
	 {  
          document.getElementById("multipleupload").style.display = 'block';
	  document.getElementById("file1").value = '';
          document.getElementById("note").innerHTML = 'Upload only mp3 files';
          document.getElementById("filetitle").innerHTML = 'Upload Audio';
	 }
	else if(v == '1')
	{  
          document.getElementById("multipleupload").style.display = 'block';
	  document.getElementById("file1").value='';
          document.getElementById("note").innerHTML = 'Upload only mp4 or flv files';
          document.getElementById("filetitle").innerHTML = 'Upload Video';
	}
        else{
          document.getElementById("multipleupload").style.display = 'none';
          document.getElementById("file1").value='';
          //document.getElementById("note").innerHTML = '';
         // document.getElementById("filetitle").innerHTML = '';
        }
	
 }
 
 function filetype(val)
 {
    var fup = document.getElementById("filen");
    var fileName = fup.value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	
    if(ext =="GIF" || ext=="gif" || ext =="jpg" || ext=="jpeg" || ext =="png" || ext=="PNG" || ext =="JPG" || ext=="JPEG")
    {
        return true;
    }
    else
    {
        alert("Upload images only");
	document.getElementById("filen").value='';
        return false;
    }
 }
 
 function filetypenew(val)
 { 
    var fup = document.getElementById("file1");
    var content_type = document.getElementById("content_type").value;
    var fileName = fup.value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    
    if(content_type == '0' && ext == "mp3")
    {
        return true;
    }
    else if(content_type == '1' && (ext == "mp4" || ext == "flv"))
    {
        return true;
    }
    else
    {
        alert("Upload correct formats only");
	document.getElementById("file1").value='';
        return false;
    }
 }
</script>

<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Edit Content</h3></div>
        <div class="module-body">
            <form id="updatecontent" name="updatecontent" method="post" action="" class="form-horizontal row-fluid" enctype="multipart/form-data">
                
                <div class="control-group">
                    <label class="control-label" for="category_id">Category:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="category_id" id="category_id">
                            <option value="">-Select-</option>
                            <?php foreach ($category as $cat){  ?>
                                <option value="<?php echo $cat->cat_id; ?>" <?php if($cat->cat_id == $content->category_id){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $cat->category; ?></option>
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
                                <option value="<?php echo $lang->lang_id; ?>" <?php if($lang->lang_id == $content->language_id){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $lang->language; ?></option>
                            <?php } ?>

                        </select>
                        <?php echo form_error('language_id'); ?>
                    </div>  
                </div>
                <!--space for content_type-->
                <div class="control-group">
                    <label class="control-label" for="recommend_type">Recommend Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="recommend_type" id="recommend_type">
                            <option value="">-Select-</option>
                            <option value="1" <?php if($content->recommend_type == 1){ echo 'selected="selected"'; } ?>>Trends</option>
                            <option value="2" <?php if($content->recommend_type == 2){ echo 'selected="selected"'; } ?>>Recommends</option>
                        </select>
                        <?php echo form_error('recommend_type'); ?>
                    </div>
                </div>
                <!--<div class="control-group">
                    <label class="control-label" for="recommend_type">Recommend Type:</label>
                    <div class="controls">
                        <?php //echo form_radio('recommend_type', 1 , 'id="trends", class="span8" '.set_radio('recommend_type', '1', FALSE)); ?>&nbsp;&nbsp;Trends&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php //echo form_radio('recommend_type', 2 , 'id="recommends", class="span8" '.set_radio('recommend_type', '2', FALSE)); ?>&nbsp;&nbsp;Recommends
                        <?php //echo form_error('recommend_type'); ?>
                    </div>
                </div>-->
                <div class="control-group">
                    <label class="control-label" for="parental_advisory">Parental Advisory:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="parental_advisory" id="parental_advisory">
                            <option value="">-Select-</option>
                            <option value="ALL" <?php if($content->parental_advisory == 'ALL'){ echo 'selected="selected"'; } ?>>ALL</option>
                            <option value="PG" <?php if($content->parental_advisory == 'PG'){ echo 'selected="selected"'; } ?>>PG</option>
                            <option value="13+" <?php if($content->parental_advisory == '13+'){ echo 'selected="selected"'; } ?>>13+</option>
                            <option value="16+" <?php if($content->parental_advisory == '16+'){ echo 'selected="selected"'; } ?>>16+</option>
                            <option value="18+" <?php if($content->parental_advisory == '18+'){ echo 'selected="selected"'; } ?>>18+</option>
                        </select>
                        <?php echo form_error('parental_advisory'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="unique_code">Unique Code:</label>
                    <div class="controls">
                        <?php echo form_input('unique_code', $content->unique_code, 'id="unique_code", class="span8" placeholder="Enter Unique code" autocomplete="off" readonly'); ?>
                        <?php echo form_error('unique_code'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="contentowner_id">Content Owner Id:</label>
                    <div class="controls">
                        <?php echo form_input('contentowner_id', $content->contentowner_id, 'id="contentowner_id", class="span8" placeholder="Enter Content Owner ID" autocomplete="off" readonly'); ?>
                        <?php echo form_error('contentowner_id'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $content->title, 'id="title", class="span8" placeholder="Enter Title" autocomplete="off" maxlength="75"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="short_desc">Short Description:</label>
                    <div class="controls">
                        <?php echo form_textarea('short_desc', $content->short_desc, 'id="short_desc", class="span8" placeholder="Enter short description" autocomplete="off" '); ?>
                        <?php echo form_error('short_desc'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="movie_name">Movie Name:</label>
                    <div class="controls">
                        <?php echo form_input('movie_name', $content->movie_name, 'id="movie_name", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('movie_name'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="main_artist">Main Artist:</label>
                    <div class="controls">
                        <?php echo form_input('main_artist', $content->main_artist, 'id="main_artist", class="span8" placeholder="Enter Main Artist Name" autocomplete="off"'); ?>
                        <?php echo form_error('main_artist'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sub_artists">Sub Artists:</label>
                    <div class="controls">
                        <?php echo form_input('sub_artists', $content->sub_artists, 'id="sub_artists", class="span8" placeholder="Enter sub artists" autocomplete="off"'); ?>
                        <?php echo form_error('sub_artists'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="film_director">Film Director:</label>
                    <div class="controls">
                        <?php echo form_input('film_director', $content->film_director, 'id="film_director", class="span8" placeholder="Enter Film Director Name" autocomplete="off"'); ?>
                        <?php echo form_error('film_director'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="music_director">Music Director:</label>
                    <div class="controls">
                        <?php echo form_input('music_director', $content->music_director, 'id="music_director", class="span8" placeholder="Enter music director Name" autocomplete="off"'); ?>
                        <?php echo form_error('music_director'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dialog_writer">Dialog Writer:</label>
                    <div class="controls">
                        <?php echo form_input('dialog_writer', $content->dialog_writer, 'id="dialog_writer", class="span8" placeholder="Enter Dialog writer Name" autocomplete="off"'); ?>
                        <?php echo form_error('dialog_writer'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="clip_length">Clip Length:</label>
                    <div class="controls">
                        <?php echo form_input('clip_length', $content->clip_length, 'id="clip_length", class="span8" placeholder="Enter Clip length" autocomplete="off"'); ?>
                        <?php echo form_error('clip_length'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="copyright">Copyright:</label>
                    <div class="controls">
                        <?php echo form_input('copyright', $content->copyright, 'id="copyright", class="span8" placeholder="Enter Copyright" autocomplete="off"'); ?>
                        <?php echo form_error('copyright'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="search_keywords">Search Keywords:</label>
                    <div class="controls">
                        <?php echo form_input('search_keywords', $content->search_keywords, 'id="search_keywords", class="span8" placeholder="Enter Search keywords" autocomplete="off"'); ?>
                        <?php echo form_error('search_keywords'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_activationdate">Activation Date:</label>
                    <div class="controls">
                        <?php echo form_input('content_activationdate', $content->content_activationdate, 'id="content_activationdate", class="span8" placeholder="Select content activationdate" autocomplete="off" readonly'); ?>&nbsp;mm-dd-yyyy
                        <?php echo form_error('content_activationdate'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_expirydate">Expiry Date:</label>
                    <div class="controls">
                        <?php echo form_input('content_expirydate', $content->content_expirydate, 'id="content_expirydate", class="span8" placeholder="Select content expirydate" autocomplete="off" readonly'); ?>&nbsp;mm-dd-yyyy
                        <?php echo form_error('content_expirydate'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_type">Content Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="content_type" id="content_type" onchange="newselection(this.value);">
                            <option value="">-Select-</option>
                            <option value="0" <?php if($content->content_type == 0){ echo 'selected="selected"'; } ?>>Audio</option>
                            <option value="1" <?php if($content->content_type == 1){ echo 'selected="selected"'; } ?>>Video</option>
                        </select>
                        <?php echo form_error('content_type'); ?>
                    </div>
                </div>                        
                <?php
                    $path_thumb = $content->thumb_filename;
                    $path_clip = $content->contentclip_filename;
                ?>        
                <div class="control-group" id="imgupload">
                    <label class="control-label" for="filen">Upload Image:</label>
                    <div class="controls">
                       <input type="file" name="filen" id="filen" onchange="filetype(this.value);" />
                       <img src="<?php echo base_url(); ?>appimages/<?php echo $path_thumb; ?>" border='0' alt='image2' width='50' height='50' />
                       <strong><sub>&nbsp;Upload only jpg,png,gif files</sub></strong>
                    </div>
                </div>
                <div class="control-group" id="multipleupload"  style="display:none;">
                            <label class="control-label" for="filetitle" id="filetitle">File:</label>
                    <div class="controls">
                       <input type="file" name="file1" id="file1" value="<?php echo $path_clip; ?>" onchange="filetypenew(this.value);" />
                       <strong><sub id="note"></sub></strong><br>
                       <?php if($content->content_type == 1){ ?>
                       <iframe src="../../../videos/<?php echo $path_clip; ?>" width="450" height="250"></iframe><br>
                       <?php }else{ ?>
                       <iframe src="../../../audios/<?php echo $path_clip; ?>"></iframe><br>
                       <?php }echo $path_clip; ?>
                    </div>
                </div>
                        
                        

                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>