<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() { 
    // Datepicker Popups calender to Choose date.
    $(function() {
    $("#content_activationdate").datepicker();
    // Pass the user selected date format.
    });
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
	if(v == '2')
	 {  
          document.getElementById("multipleupload").style.display = 'block';
	  document.getElementById("file1").value = '';
          document.getElementById("note").innerHTML = 'Upload only mp3 or aac files';
          document.getElementById("filetitle").innerHTML = 'Upload Audio';
	 }
	else if(v == '1')
	{  
          document.getElementById("multipleupload").style.display = 'block';
	  document.getElementById("file1").value='';
          document.getElementById("note").innerHTML = 'Upload only mp4 or aac files';
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
    
    if(content_type == '2' && (ext == "mp3" || ext == "aac"))
    {
        return true;
    }
    else if(content_type == '1' && (ext == "mp4" || ext == "aac"))
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
        <div class="module-head"> <h3>Add Content</h3></div>
        <div class="module-body">
            <form id="addcontent" name="addcontent" method="post" action="" class="form-horizontal row-fluid" enctype="multipart/form-data">
                
                <div class="control-group">
                    <label class="control-label" for="category_id">Category:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="category_id" id="category_id">
                            <option value="">-Select-</option>
                            <?php foreach ($category as $cat){  ?>
                                <option value="<?php echo $cat->cat_id; ?>"><?php echo $cat->category; ?></option>
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
                                <option value="<?php echo $lang->lang_id; ?>"><?php echo $lang->language; ?></option>
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
                            <option value="ALL">ALL</option>
                            <option value="PG">PG</option>
                            <option value="13+">13+</option>
                            <option value="16+">16+</option>
                            <option value="18+">18+</option>
                        </select>
                        <?php echo form_error('parental_advisory'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="unique_code">Unique Code:</label>
                    <div class="controls">
                        <?php echo form_input('unique_code', $this->input->post('unique_code'), 'id="unique_code", class="span8" placeholder="Enter Unique code" autocomplete="off" readonly'); ?>
                        <?php echo form_error('unique_code'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="contentowner_id">Content Owner Id:</label>
                    <div class="controls">
                        <?php echo form_input('contentowner_id', $this->input->post('contentowner_id'), 'id="contentowner_id", class="span8" placeholder="Enter Content Owner ID" autocomplete="off" readonly'); ?>
                        <?php echo form_error('contentowner_id'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off" maxlength="75"'); ?>
                        <?php echo form_error('title'); ?>
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
                    <label class="control-label" for="movie_name">Movie Name:</label>
                    <div class="controls">
                        <?php echo form_input('movie_name', $this->input->post('movie_name'), 'id="movie_name", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('movie_name'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="main_artist">Main Artist:</label>
                    <div class="controls">
                        <?php echo form_input('main_artist', $this->input->post('main_artist'), 'id="main_artist", class="span8" placeholder="Enter Main Artist Name" autocomplete="off"'); ?>
                        <?php echo form_error('main_artist'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sub_artists">Sub Artists:</label>
                    <div class="controls">
                        <?php echo form_input('sub_artists', $this->input->post('sub_artists'), 'id="sub_artists", class="span8" placeholder="Enter sub artists" autocomplete="off"'); ?>
                        <?php echo form_error('sub_artists'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="film_director">Film Director:</label>
                    <div class="controls">
                        <?php echo form_input('film_director', $this->input->post('film_director'), 'id="film_director", class="span8" placeholder="Enter Film Director Name" autocomplete="off"'); ?>
                        <?php echo form_error('film_director'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="music_director">Music Director:</label>
                    <div class="controls">
                        <?php echo form_input('music_director', $this->input->post('music_director'), 'id="music_director", class="span8" placeholder="Enter music director Name" autocomplete="off"'); ?>
                        <?php echo form_error('music_director'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dialog_writer">Dialog Writer:</label>
                    <div class="controls">
                        <?php echo form_input('dialog_writer', $this->input->post('dialog_writer'), 'id="dialog_writer", class="span8" placeholder="Enter Dialog writer Name" autocomplete="off"'); ?>
                        <?php echo form_error('dialog_writer'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="clip_length">Clip Length:</label>
                    <div class="controls">
                        <?php echo form_input('clip_length', $this->input->post('clip_length'), 'id="clip_length", class="span8" placeholder="Enter Clip length" autocomplete="off"'); ?>
                        <?php echo form_error('clip_length'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="copyright">Copyright:</label>
                    <div class="controls">
                        <?php echo form_input('copyright', $this->input->post('copyright'), 'id="copyright", class="span8" placeholder="Enter Copyright" autocomplete="off"'); ?>
                        <?php echo form_error('copyright'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="search_keywords">Search Keywords:</label>
                    <div class="controls">
                        <?php echo form_input('search_keywords', $this->input->post('search_keywords'), 'id="search_keywords", class="span8" placeholder="Enter Search keywords" autocomplete="off"'); ?>
                        <?php echo form_error('search_keywords'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_activationdate">Activation Date:</label>
                    <div class="controls">
                        <?php echo form_input('content_activationdate', $this->input->post('content_activationdate'), 'id="content_activationdate", class="span8" placeholder="Select content activationdate" autocomplete="off" readonly'); ?>&nbsp;mm-dd-yyyy
                        <?php echo form_error('content_activationdate'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_expirydate">Expiry Date:</label>
                    <div class="controls">
                        <?php echo form_input('content_expirydate', $this->input->post('content_expirydate'), 'id="content_expirydate", class="span8" placeholder="Select content expirydate" autocomplete="off" readonly'); ?>&nbsp;mm-dd-yyyy
                        <?php echo form_error('content_expirydate'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_type">Content Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="content_type" id="content_type" onchange="newselection(this.value);">
                            <option value="">-Select-</option>
                            <option value="2">Audio</option>
                            <option value="1">Video</option>
                        </select>
                        <?php echo form_error('content_type'); ?>
                    </div>
                </div>                        
                <div class="control-group" id="imgupload">
                    <label class="control-label" for="filen">Upload Image:</label>
                    <div class="controls">
                       <input type="file" name="filen" id="filen" onchange="filetype(this.value);" />
                       <strong><sub>&nbsp;Upload only jpg,png,gif files</sub></strong>
                    </div>
                </div>
                <div class="control-group" id="multipleupload"  style="display:none;">
                    <label class="control-label" for="filetitle" id="filetitle">File:</label>
                    <div class="controls">
                       <input type="file" name="file1" id="file1" value="" onchange="filetypenew(this.value);" />
                       <strong><sub id="note"></sub></strong><br>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>