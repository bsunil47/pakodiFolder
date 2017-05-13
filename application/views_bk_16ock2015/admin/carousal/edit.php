<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
  
  function newselection(v)
  {
	  //alert(v);
	 if(v == 0)
	 {		 
	  document.getElementById("singleupload").style.visibility = 'visible';
	  document.getElementById("multipleupload").style.visibility = 'hidden';
	 }
	if(v == 1 || v == 2)
	{
	  document.getElementById("multipleupload").style.visibility = 'visible';
      document.getElementById("singleupload").style.visibility = 'hidden';
		 
	}
	
 }
 
 
 function filetypenew(val)
 {
	var file_type=document.getElementById('file_type').value;
	var fup = document.getElementById("file1");
    var fileName = fup.value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    if(file_type == 'audio'){
        $var=" Upload MP3 files only";
    }else if(file_type == 'video'){
        $var =" Upload MP4 files only";
    }
	if(file_type=='audio' && (ext =="mp3" || ext == "MP3" )){
            return true
        }else if(file_type == 'video' && ( ext == "mp4" || ext == "MP4" || ext == "aac")){
            return true;
        }
        else
    {
        alert($var);
		document.getElementById("file1").value='';
        return false;
    }
 }
 
</script>
<script type="text/javascript">
  $(document).ready(function(){
      	 <?php
	  if($carouseledit->type == 'image')
	  {
	 ?>
	  document.getElementById("singleupload").style.visibility = 'visible';
	  document.getElementById("multipleupload").style.visibility = 'hidden';
	 <?php
	 } else {
	?>
	document.getElementById("multipleupload").style.visibility = 'visible';
    document.getElementById("singleupload").style.visibility = 'hidden';
	<?php } ?>
	
  });
</script>
<div class="content" onload="testfunction()">
    <div class="module">
        <div class="module-head">
            <h3>Edit Carousal</h3></div>
        <div class="module-body">
            <form id="editcarousal" name="editcarousal" class="form-horizontal row-fluid" action="" method="post" enctype="multipart/form-data">

                <div class="control-group">
                    <label class="control-label" for="file_type">File Type:</label>
                    <div class="controls">
<!--                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="file_type" id="file_type"  readonly>
                             <option value="<?php echo $carouseledit->is_clickable; ?>"><?php echo $carouseledit->type; ?></option> 
                          
							<option value="0"   <?php if($carouseledit->type == 'image') { ?> selected<?php }?> >Image</option>
							
							<option value="1" <?php  if($carouseledit->type == 'audio') { ?> selected <?php }?>>Audio</option>
							
							<option value="2" <?php if($carouseledit->type == 'video') { ?> selected <?php }?>>Video</option> 
                        </select>-->
                        <input type="text" name="file_type" id="file_type" value="<?php echo $carouseledit->type; ?>" readonly="readonly">
                        <?php echo form_error('file_type'); ?>
                    </div>
                </div>
				<?php
				   $path = $carouseledit->car_image;
				   $path_audio = $carouseledit->car_audio;
				   $path_video = $carouseledit->car_video;
				   
					
                ?>						
				
                <!--div class="control-group" id="singleupload">
                    <label class="control-label" for="filenew">File:</label>
                    <div class="controls">
                       <input type="file" name="file" id="file" onchange="filetypeimage(this.value);" />
					   <?php
					    /*if($carouseledit->type == "image" && $carouseledit->is_clickable == 0)
					    {
					      echo $image_path = "<img src='../../../appimages/".$path."' border='0' alt='image' width='100' height='40' />";	
					    }*/
						?>
					   
                    </div>
                </div-->
				<div class="control-group" id="singleupload">
                     <label class="control-label" for="filenew">File:</label>
                     <div class="controls">
                        <input type="file" name="file" id="file" onchange="filetypeimage(this.value);" />
					   <?php
					    if($carouseledit->type == "image" && $carouseledit->is_clickable == 0)
					    {
							//http://sprintmedia.s3.amazonaws.com/audios/PKDKAR7501.mp3
					      echo $image_path = "<img src='http://sprintmedia.s3.amazonaws.com/appimages/".$path."' border='0' alt='image' width='60' height='40' />";
						 // echo $image_path = "<img src='../../../appimages/".$path."' border='0' alt='image' width='60' height='40' />";
					    }
						?>

                     </div>
                     <label class="control-label" for="filenew">URL:</label>
                     <div class="controls">
						<input type="text" name="url" id="url" maxlength="256" value="<?php echo $carouseledit->action;?>"/>&nbsp;(Max 256 characters)
                     </div>
                 </div>

				
				 <div class="control-group" id="multipleupload"  style="visibility:hidden;">
                    <label class="control-label" for="filenew">File:</label>
					
                    <div class="controls">
					
                       <input type="file" name="filen" id="filen" onchange="filetype(this.value);" /><strong><sub>Upload only jpg,png,gif files</sub></strong><br>
                       <input type="file" name="file1" id="file1" onchange="filetypenew(this.value);" /><strong><sub>Upload only mp3/mp4 files</sub></strong><br>
					<?php	
					  if($carouseledit->type == 'audio' && $carouseledit->is_clickable == 1)
					 {
					  echo $image_path = "<img src='http://sprintmedia.s3.amazonaws.com/appimages/".$path."' border='0' alt='image' width='100' height='50' style='float:left; padding:10px 10px 0 0;' />"; 
					  //echo $audio_path = "<iframe src='http://sprintmedia.s3.amazonaws.com/audios/".$path_audio."'></iframe>";
					  //echo $audio_path = "<audio src='../../../audios/".$path_audio."' width='0' height='30' controls ></audio>";
					  echo $audio_path = "<audio src='http://sprintmedia.s3.amazonaws.com/audios/".$path_audio."' width='0' height='30' controls ></audio>";
                      					  
					 }
					 else if($carouseledit->type == 'video' && $carouseledit->is_clickable == 1)
					 {
					  echo $image_path = "<img src='http://sprintmedia.s3.amazonaws.com/appimages/".$path."' border='0' alt='image' width='100' height='50' style='float:left; padding:10px 10px 0 0;' />";
					  //echo $video_path = "<iframe src='http://sprintmedia.s3.amazonaws.com/videos/".$path_video."'></iframe>";
					  echo $video_path  = "<video  width='0' height='150' controls ><source src='http://sprintmedia.s3.amazonaws.com/videos/'".$path_video."' type='video/mp4'></video>";
					}
					?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="expdate">Expiry Date:</label>
                    <div class="controls">
                        <?php echo form_input('expdate', date('m/d/Y', strtotime($carouseledit->expdate)), 'id="expdate", class="span8" placeholder="Select expirydate" autocomplete="off" readonly'); ?>&nbsp;mm-dd-yyyy
                        <?php echo form_error('expdate'); ?>
                        
                    </div>
                </div>
				
                
                <div class="control-group">
                    <div class="controls">
						<input type="submit" name="submit" id="submit" value="Edit" class="btn pakodi">
                        <?php //echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                        <a href="javascript:window.history.go(-1);" class="btn pakodi">Back</a>
                    </div>
                </div>
				
            </form>
        </div>
    </div>
</div>
