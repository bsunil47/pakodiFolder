$(document).ready(function () {
	//start
	//$("#fromdate").datepicker({ firstDay: 1 });
   //$("#todate").datepicker({ firstDay: 1 });
   // $("#rec_fromdate").datepicker({ firstDay: 1 });
    //$("#rec_todate").datepicker({ firstDay: 1 });
    $("#content_activationdate").datepicker({ firstDay: 1 });
    $("#content_expirydate").datepicker({ firstDay: 1 });
   // $("#expdate").datepicker({ firstDay: 1 });
	//end
    $.validator.addMethod("regexpress",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Invalid input"
            );

    $("#addcategory").validate({
        rules: {
            category: {
                required: true,
            }
        },
        messages: {
            category: "Please enter Category",
        }
    });

    $("#ugcformupload").validate({
        rules:{
            file:{
                required:true,
                extension: "zip"
            }
        },
    });

    $("#updatecategory").validate({
        rules: {
            category: {
                required: true,
            }
        },
        messages: {
            category: "Please enter Category",
        }
    });
	 $("#addsettings").validate({
        rules: {
            name: {
                required: true,
                regexpress: /^[a-zA-Z ]+$/
            },
            number_of_records: {
               required: true,
                regexpress: /^[0-9]+$/
            },
            page_limit: {
                required: true,
                regexpress: /^[0-9]+$/
            }
           
        },
        messages: {
            name: "Please enter Name",
           
            number_of_records: { required:"Please enter number of records",
                     regexpress: "please enter digits only"
                   },
            page_limit: { required:"Please enter page limit",
                     regexpress: "please enter digits only"
                   },
        }
    });
	    $("#updatesettings").validate({
		//alert('hi');
        rules: {
            name: {
                required: true,
                regexpress: /^[a-zA-Z]+$/
            },
            number_of_records: {
               required: true,
                regexpress: /^[0-9]+$/
            },
            page_limit: {
                required: true,
                regexpress: /^[0-9]+$/
            }
           
        },
        messages: {
            name: "Please enter Name",
           
            number_of_records: { required:"Please enter number of records",
                     regexpress: "please enter digits only"
                   },
            page_limit: { required:"Please enter page limit",
                     regexpress: "please enter digits only"
                   },
        }
    });
    $('#addalert').validate({
        rules:{
            dtype:{
                required: true
            },
            msg:{
                required:true
            }
        },
        messages: {
            dtype:"Please Select Device Type",
            msg:"Please Enter Message"
             }
    });
    $('#addcuser').validate({
        rules:{
            name:{
                required: true
            },
            clip:{
                required:true
            }
        },
        messages: {
            name:"Please Enter Name",
            clip:"Please Upload Clip"
             }
    });
     $('#addecuser').validate({
        rules:{
            zip:{
                required: true
            }
        },
        messages: {
              zip:"Please Upload Zip File"
             }
    });
    $('#addauser').validate({
        rules:{
            name:{
                required: true
            },
            clip:{
                required:true
            }
        },
        messages: {
            name:"Please Enter Name",
            clip:"Please Upload Clip"
             }
    });
    $('#addeauser').validate({
        rules:{
            zip:{
                required: true
            }
        },
        messages: {
              zip:"Please Upload Zip File"
             }
    });
    $('#addcarousal').validate({
        rules:{
            file_type:{
                required: true
            },
            file:{
                required: true
            },
            filen:{
                required: true
            },
            file1:{
                required: true
            },
            expdate:{
                required:true
            }
        },
        messages:{
            file_type:"Please Choose filetype",
            file:"Please Upload Image",
            filen:"Please Upload Image",
            file1:"Please Upload File",
            expdate:"please Select Expiry Date"
            
        }
        
    });
    $('#editbalert').validate({
        rules:{
            msg:{
                required: true
            },
            
        },
        messages: {
             msg:"Please Enter Message"
             }
    });
    $("#adduser").validate({
        rules: {
            user:{
                required: true
                  },
            name: {
                required: true,
                regexpress: /^[a-zA-Z ]{3,40}$/
            },
            email: {
                required: true,
                email: true
            },
            msisdn: {
                required: true,
                regexpress: /^[0-9]{6,16}$/
            },
            password: {
                required: true,
				regexpress: /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{5,32}$/
				
            },
			language_id: {
                required: true
            }
        },
        messages: {
            user: "Please Select User Type",
            name: { required: "Please enter Name",
                    	regexpress: "Please enter Alphabets (3-40 length) only"
                      }, 

            email: { required: "Please enter Email",
                     email: "Please enter Valid email"
                   },
            msisdn: { required:"Please enter Phone Number",
                     regexpress: "please enter digits (6-16) only"
                   },
            //password: "Please enter Password",
			password: { required: "Please enter Password",
                    	regexpress: "Please enter Password with one Special character and one Number (5-32 length) only"
                      }, 
			language_id: "Please Select Language",
        }
    });

	$("#addmoderator").validate({
        rules: {
            name: {
                required: true,
                regexpress: /^[a-zA-Z ]+$/
            },
            email: {
                required: true,
                email: true
            },
            msisdn: {
                required: true,
                regexpress: /^[0-9]{6,16}$/
            },
            password: {
                required: true
            },
			language_id: {
                required: true
            }
        },
        messages: {
            name: { required: "Please enter Name",
                    	regexpress: "Please enter Alphabets only"
                      }, 

            email: { required: "Please enter Email",
                     email: "Please enter Valid email"
                   },
            msisdn: { required:"Please enter Phone Number",
                     regexpress: "please enter digits (6-16) only"
                   },
            password: "Please enter Password",
			language_id: "Please Select Language",
        }
    });

    $("#addcontentowner").validate({
        rules: {
            name: {
                required: true,
                regexpress: /^[a-zA-Z ]+$/
            },
            email: {
                required: true,
                email: true
            },
            msisdn: {
                required: true,
                regexpress: /^[0-9]{6,16}$/
            },
            password: {
                required: true
            }
        },
        messages: {
            name: { required: "Please enter Name",
                    	regexpress: "Please enter Alphabets only"
                      }, 

            email: { required: "Please enter Email",
                     email: "Please enter Valid email"
                   },
            msisdn: { required:"Please enter Phone Number",
                     regexpress: "please enter digits (6-16) only"
                   },
            password: "Please enter Password",
        }
    });

    $("#addcarousal").validate({
        rules: {
            file_type: {  
                required: true
            } 
        },
        messages: {
            file_type: "Please select file type"
        }
    });
    /*$("#addcontent").validate({
        rules: {
            title: {
                required: true
            },
            category_id: {
                required: true
            }
        },
        messages: {
            title: "Please enter Title",
            category_id: "Please select Category",
        }
    });*/
    
    /*$("#updatecontent").validate({
        rules: {
            title: {
                required: true
            }
        },
        messages: {
            title: "Please enter Title",
        }
    });*/
    
   $("#movedubs").validate({
        rules: {
            dubclip_title: {  
                required: true
            },
            clip_length: {  
                required: true
            },
            category_id: {  
                required: true
            },
            parental_advisory: {  
                required: true
            },
            language_id: {  
                required: true
            },
            movie_name: {  
                required: true
            },
            main_artist: {  
                required: true
            },
            content_type: {  
                required: true
            },
            short_desc: {  
                required: true
            }
        },
        messages: {
            dubclip_title: "Please enter Clip title",
            clip_length: "Please enter Clip Length",
            category_id: "Please select Category",
            parental_advisory: "Please select Parental advisory",
            language_id: "Please select language",
            movie_name: "Please enter Movie Name",
            main_artist: "Please enter Main artist Name",
            content_type: "Please select content type",
            short_desc: "Please enter Short Description",
        }
    }); 
    
    
});//ready
/*****************************************************************************************/
                                //End of Validations//
/****************************************************************************************/
        //script for tinymce-text editor    
        $(document).ready(function() {
            if($('.cms_textarea').length > 0) {
                tinymce.init({
                    selector: "textarea",
                    theme: "modern",
                    width: '100%',
                    plugins: [
                        "textcolor advlist autolink link lists charmap preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                        "save table contextmenu directionality emoticons template paste"
                    ],
                    content_css: "css/content.css",
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview fullpage | forecolor backcolor emoticons",
                });
            }
        });
       //ready
        //Script for Recommends
        $(document).ready(function() {
            $("#recommend_value").change(function(){
                $("#contentdownload_count1").css('display','block');
                $("#contentlike_count1").css('display','block');
                $("#contentshare_count1").css('display','block');
                $("#contentplay_count1").css('display','block');
                $("#dub_count1").css('display','block');
                $("#"+$(this).val()+"1").css('display','none');
                if($("#"+$(this).val()+"1").val() == $("#trending_value").val()){
                    $("#trending_value").val('');
                }
            });


            $("#trending_value").change(function(){
                $("#contentdownload_count").css('display','block');
                $("#contentlike_count").css('display','block');
                $("#contentshare_count").css('display','block');
                $("#contentplay_count").css('display','block');
                $("#dub_count").css('display','block');
                $("#"+$(this).val()).css('display','none');
                if($(this).val() == $("#recommend_value").val()){
                    $("#recommend_value").val('');
                }
            });
            $('#addbalert').validate({
                rules:{
                    language_id:{
                        required:true
                    },
                    msg:{
                        required:true
                    }

                },
                messages: {
                    language_id:"Please Select Language",
                    msg:"Please Enter Message"

                }
            });

        });
        function showrecommend(v){
        if(v=='recommend_sort'){
            document.getElementById('mydiv').style.display='block';
            document.getElementById('recfilter').style.display='none';
        }else if(v=='random'){
            document.getElementById('mydiv').style.display='none';
            document.getElementById('recfilter').style.display='none';
            }else{
            document.getElementById('mydiv').style.display='none';
            document.getElementById('recfilter').style.display='block';
        }
    }
        function changepriority(e,i){
            if(e<16){
               $.ajax({
                type:'POST',
                url: base_url +'Admin/content/setpriority',
                data:{'priority':e,'id':i},
                success:function(data){
                  location.reload();
                }
                });
            }
        }
        $("#csubmit").click(function() { //script for content-add,update submit
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
        function filetype(val) {//used in carousal-add,edit and content-add,update files
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
        function filetypeimage(val) {//used in carousal add,edit files
            var fup = document.getElementById("file");
            var fileName = fup.value;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            if(ext =="GIF" || ext=="gif" || ext =="jpg" || ext=="jpeg" || ext =="png" || ext=="PNG" || ext =="JPG" || ext=="JPEG")
            {
                return true;
            }
            else
            {
                alert("Upload images only");
                document.getElementById("file").value='';
                return false;
            }
        }
        function contenttype(v) {//used in content-add,update files
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
            }
        }
        function contentfiletype(val) { //used for checking audio/video in content-add,update
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
		/*function test(v){
			//alert(v);
			var pass=document.getElementById('pass').value;
			if(pass==v){
				alert('hi');
			}else{
				alert('error');
			}
		}*/


