<script type="text/javascript">
  function newselection(v)
  {
	 if(v == 0)
	 {		 
	  document.getElementById("singleupload").style.visibility = 'visible';
	  document.getElementById("multipleupload").style.visibility = 'hidden';
	 }
	if(v == 1 || v == 2)
	{
          if(v == 1){
           $("#note").html("Upload only mp3 or aac files");
          }
          if(v == 2){
           $("#note").html("Upload only mp4 files");
          }
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
    if(file_type == '1'){
        $var=" Upload MP3 files only";
    }else if(file_type == '2'){
        $var =" Upload MP4 files only";
    }
	if(file_type=='1' && (ext =="mp3" || ext == "MP3" )){
            return true
        }else if(file_type == '2' && ( ext == "mp4" || ext == "MP4" || ext == "aac")){
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
//$(document).ready(function () {
//    
//   $("#submit").click(function(){
//          
//    if($("#file_type").val() != ''){
//       
//       if($("#file_type").val() == 0){
//           if($("#file").val() != ''){
//                filetypeimage($("#file").val());
//            }else{
//               alert("Please upload image");
//               return false;  
//            }
//        }
//        
//        if($("#file_type").val() == 1 || $("#file_type").val() == 2){
//            
//            if($("#file_type").val() == 1){
//               var ftype = "mp3 or aac";
//            }else{
//               var ftype = "mp4";
//            }
//            
//           if($("#filen").val() != ''){
//                //filetypeimage($("#filen").val());
//            }else{
//               alert("Please upload image");
//               return false;  
//            }
//            if($("#file1").val() != ''){
//                filetypenew($("#file1").val());
//            }else{
//               alert("Please upload file of type "+ftype);
//               return false;  
//            }
//        }
//
//    }else{
//       alert("Please select File Type");
//       return false; 
//    }
//        if($("#expdate").val() == ''){
//        alert('Please Select Expiry Date');
//        return false;
//    }
//      
//   });//submit
//});//ready
</script>

<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Carousal<a style="float:right; display: inline-block" class="back-close btn pakodi" href="javascript:window.history.go(-1);">Back</a></h3></div>
        <div class="module-body">
            <form id="addcarousal" name="addcarousal" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/carousal/add'; ?>" method="post" enctype="multipart/form-data">

                <div class="control-group">
                    <label class="control-label" for="file_type">File Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="file_type" id="file_type" onchange="newselection(this.value);">
                            <option value="">-Select-</option>
                            <option value="0">Image</option>
                            <option value="1">Audio</option>
                            <option value="2">Video</option>
                        </select>
                        <?php echo form_error('file_type'); ?>
                    </div>
                </div>

                <!--div class="control-group" id="singleupload">
                    <label class="control-label" for="filenew">File:</label>
                    <div class="controls">
                       <input type="file" name="file" id="file" onchange="filetypeimage(this.value);" />
                    </div>
                </div-->
				<div class="control-group" id="singleupload">
					<label class="control-label" for="filenew">File:</label>
					<div class="controls">
					<input type="file" name="file" id="file" onchange="filetypeimage(this.value);" />
					</div>
					<label class="control-label" for="filenew">URL:</label>
					<div class="controls">
					<input type="text" name="url" id="url" maxlength="256" />&nbsp;(Max 256 characters)
					</div>
				</div>

				
				 <div class="control-group" id="multipleupload" style="visibility:hidden;" >
                    <label class="control-label" for="filenew">File:</label>
					
                    <div class="controls">
					
                       <input type="file" name="filen" id="filen" onchange="filetype(this.value);" /><strong><sub>Upload only jpg,png,gif files</sub></strong><br>
					     
                       <input type="file" name="file1" id="file1" onchange="filetypenew(this.value);" /><strong><sub id="note"></sub></strong>
                    </div>
                </div>

                 <div class="control-group">
                    <label class="control-label" for="expdate">Expiry Date:</label>
                    <div class="controls">
                   <div class='input-group date' id='from_date'>
                 <input type='text' class="form-control" name="expdate" id="expdate"/>
		<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
                   </div>
                        <?php //echo form_input('expdate', $this->input->post('expdate'), 'id="expdate", class="span8" placeholder="Select expirydate" autocomplete="off" readonly'); ?>
                        <?php echo form_error('expdate'); ?>
                    </div>
                </div>
                
                       
                <div class="control-group">
                    <div class="controls">
			<input type="submit" name="submit" id="submit" value="Add" class="btn pakodi">
                        <?php //echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                       
                    </div>
                </div>
				
            </form>
        </div>
    </div>
</div>