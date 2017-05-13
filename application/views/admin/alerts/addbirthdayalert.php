<style>
    .popupp {
        position: absolute;
        left: 27%;
        margin-left: -32px; /* -1 * image width / 2 */
        margin-top: -32px; /* -1 * image height / 2 */
        display: none;
        z-index: 101;
        background: rgb(246, 246, 246) none repeat scroll 0 0;
        opacity: 1;
        width: auto;
        max-width: 100%;
        //border: 4px solid #f6f6f6;
        border: 4px solid;
        overflow-y: scroll !important;
    }

    .clear {
        padding: 10px;
    }
    audio{
        width: 125px !important;
        height:30px;
    }
</style>
<style type="text/css">
    .divTable {
        display: table;
        width: 98%;
        background-color: #f6f6f6;
        border: 1px solid #666666;
        border-spacing: 5px;
        //min-height: 100px;
        height: auto;
        overflow-y: scroll !important;
        text-align: center;
        margin-left: 15px;

        /*cellspacing:poor IE support for  this*/
        /* border-collapse:separate;*/
    }
    .divTable1 {
        display: table;
        width: 98%;
        background-color: #f6f6f6;
        border: 1px solid #666666;
        border-spacing: 5px;
        //min-height: 100px;
        height: auto;
        overflow-y: scroll !important;
        text-align: center;
        margin-left: 15px;

        /*cellspacing:poor IE support for  this*/
        /* border-collapse:separate;*/
    }
    .divRow {
        display: table-row;
        width: 100%;
        height:50px;
    }

    .divCell {
        float: left; /*fix for  buggy browsers*/
        display: table-column;
        background-color: #f6f6f6;
        border: 2px solid #eee;
        text-align: center;
        padding: 2px;
        height:50px;
    }
    
    #selected_content {
        padding: 5px;
    }
</style>
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Alert</div>
        <div class="module-body">
            <form id="addbalert" name="addbalert" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/alerts/addbirthdayalert'; ?>" method="post" enctype="multipart/form-data">
                <div class="control-group" id="lang">
                    <label class="control-label" for="language_id">Language:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="language_id" id="language_id" onchange="getdata1()">
                            <option value="">-Select-</option>
                            <?php foreach ($language as $lang) { ?>
                                <option value="<?php echo $lang->lang_id; ?>" <?php if (!empty($_POST['language_id']) && $lang->lang_id == $_POST['language_id']) {
                                echo 'selected="selected"'; ?> <?php } ?>><?php echo $lang->language; ?></option>
                        <?php } ?>
                        </select>
<?php echo form_error('language_id'); ?>
                    </div> 
                </div>

                <div class="control-group">
                    <label class="control-label" for="msg">Message:</label>
                    <div class="controls">
                        <textarea name="msg" id="msg" class="span8" placeholder="Enter Message Here..." minlength="5" maxlength="250"></textarea>
<?php echo form_error('msg'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="type">Type:</label>
                    <div class="controls">
                        <select name="type" id="type" onchange="gettype(this.value)">
                            <option value="default">Default</option>
                            <option value="artist">Artist</option>
                        </select>
                            
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="link">link media</label>
                    <div class="controls">
                        <button type="button" name="link" id="link" onclick="check()" class="btn pakodi">link</button><span id='selected_content'></span>
                        <input type="hidden" name="masterid" id="m_id">
                        <input type="hidden" name="contentid" id="c_id">
                        <input type="hidden" name="artist" id="artist">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" name="submit" id="submit" value="Add" class="btn pakodi">   
<?php // echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"');  ?>
                     <a href="javascript:window.history.go(-1);" class="btn pakodi" style="margin-bottom: -3px;">Back</a>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
<div class="popupp" style="display: none; width: 500px; padding: 5px;">
     <div style="position:fixed;width:500px; z-index: 102;margin-top: -20px"><span class="close-button"><img class="close-button" src="<?php echo base_url(); ?>appimages/lightbox-close.png" style="float: right;"/></span></div>
     <div class="default">
         <div class="divTable1" style="display:block;">
                    <div class="headRow">
                        <div class="divCell" style="width:5%">S.No</div>
                       <div class="divCell" style="width:15%">Title</div>
                        <div class="divCell" style="width:10%">Unique Code</div>
                        <div class="divCell" style="width:10%">Thumb file</div>
                         <div class="divCell" style="width:30%">Clip file</div>
                        <div  class="divCell" style="width:10%">Artist</div>
                        <div  class="divCell" style="width:10%">Language</div>
                        <div  class="divCell" style="width:10%">Select</div>
                    </div>

                </div>
     </div>     
     <div class="artist" style="display:none">
     <form name="search" id="search" class="form-horizontal row-fluid" method="post">
        <div class="module-head">
            <h3>Enter Title/Main Artist/Unique Code to Search</div>
        <div class="control-group">
            <label class="control-label" for="title">Title:</label>

            <div class="controls">
                <input type="text" name="title" id="title">
                <input type="button" name="search" id="search" value="Search" class="pakodi" onclick="getdata();">
                <input type="hidden" name="title1" id="title1">
<?php echo form_error('title'); ?>
            </div>
        </div>
    </form>
                <div class="clear"></div>
                <div class="divTable" style="display:none;">
                    <div class="headRow">
                        <div class="divCell" style="width:5%">S.No</div>
                       <div class="divCell" style="width:15%">Title</div>
                        <div class="divCell" style="width:10%">Unique Code</div>
                        <div class="divCell" style="width:10%">Thumb file</div>
                         <div class="divCell" style="width:30%">Clip file</div>
                        <div  class="divCell" style="width:10%">Artist</div>
                        <div  class="divCell" style="width:10%">Language</div>
                        <div  class="divCell" style="width:10%">Select</div>
                    </div>

                </div>
     </div>

            </div>
<script>
  function getdata1(){
   var lang = $('#language_id').val();
            $.ajax({
                type: "post",
                url: '<?php echo base_url() . 'Admin/alerts/bdautocomplete'; ?>',
                data: { lan: lang},
                dataType: "JSON",
                success: function (data) {
                    $('.divRow').remove();
                    $('.popupp').css('height', '0');
                    $('.popupp').css('width', '0');
                    //$('.popupp').css('top', '279px');
                    $('.popupp').css('top', '800px');
                    $('.popupp').animate({
                        height: '70%',
                        width: '70%',
                    }, 1000, function () {
                        $('.close-button').parent().css('width', '70%');
                        for (i in data) {
                            var j = parseInt(i) + 1;
                            var title = "'" + data[i].title + '-' + data[i].unique_code + "'";
                             var artis="'" + data[i].main_artist + "'";
                            $('.divTable1').append('<div class="divRow">' +'<div class="divCell" style="width:5%">'+j+'</div>'+ '<div class="divCell" style="width:15%" >' + data[i].title + '</div>' + '<div class="divCell" style="width:10%" >' + data[i].unique_code + '</div>'+  '<div class="divCell" style="width:10%"><img src="http://sprintmediasg.s3.amazonaws.com/appimages/' + data[i].thumb_filename + '" width="50" height="50"/></div>' + '<div class="divCell" style="width:30% !important;overflow: hidden;"><audio src="http://sprintmediasg.s3.amazonaws.com/audios/' + data[i].contentclip_filename + '" width="50" controls></audio></div> ' + '<div class="divCell" style="width:10%" >' + data[i].main_artist + '</div>' + '<div class="divCell" style="width:10%" >' + data[i].language + '</div>' + '<div class="divCell" style="width:10%"><input type="hidden" name="master" id="master' + i + '" value="' + data[i].master_content_id + '"><input type="radio" name="content" onchange="getval('+ data[i].master_content_id +','+ data[i].content_id +','+ artis +','+ title+')"></div>' + '</div>');
                        }
                        jQuery.fn.center = function () {
                            this.animate({
                                position:"absolute",
                                top: Math.max(0, (($('.overlay').height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px",
                                left: Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +  $(window).scrollLeft() + 40) + "px"
                            },"linear",function(){
                            })
                            //this.css("position", "absolute");
                            //this.css("top", Math.max(0, (($('.overlay').height() - $(this).outerHeight()) / 2) +
                                    //$(window).scrollTop()) + "px");
                            //this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                                   // $(window).scrollLeft()) + "px");
                            return this;
                        }
                        $('.popupp').center();
                        

                    });
                    //$('.popupp').animate({ width: "70%"},800);
                    //$('.popupp').animate({ height: "70%"},800);

                    //$('.popupp').css('width', '50%')

                }
            });
}
    function gettype(v){
        if(v=='artist'){
            $('.artist').show();
            $('.default').hide();
            $('.divTable1').hide();
            }else if(v=='default'){
             $('.artist').hide();
            $('.default').show();
            var lang = $('#language_id').val();
            $.ajax({
                type: "post",
                url: '<?php echo base_url() . 'Admin/alerts/bdautocomplete'; ?>',
                data: { lan: lang},
                dataType: "JSON",
                success: function (data) {
                    $('.divRow').remove();
                    $('.popupp').css('height', '0');
                    $('.popupp').css('width', '0');
                    //$('.popupp').css('top', '279px');
                    $('.popupp').css('top', '800px');
                    $('.popupp').animate({
                        height: '70%',
                        width: '70%',
                    }, 1000, function () {
                        $('.close-button').parent().css('width', '70%');
                        for (i in data) {
                            var j = parseInt(i) + 1;
                            var title = "'" + data[i].title + '-' + data[i].unique_code + "'";
                             var artis="'" + data[i].main_artist + "'";
                            $('.divTable1').append('<div class="divRow">' +'<div class="divCell" style="width:5%">'+j+'</div>'+ '<div class="divCell" style="width:15%" >' + data[i].title + '</div>' + '<div class="divCell" style="width:10%" >' + data[i].unique_code + '</div>'+  '<div class="divCell" style="width:10%"><img src="http://sprintmediasg.s3.amazonaws.com/appimages/' + data[i].thumb_filename + '" width="50" height="50"/></div>' + '<div class="divCell" style="width:30% !important;overflow: hidden;"><audio src="http://sprintmediasg.s3.amazonaws.com/audios/' + data[i].contentclip_filename + '" width="50" controls></audio></div> ' + '<div class="divCell" style="width:10%" >' + data[i].main_artist + '</div>' + '<div class="divCell" style="width:10%" >' + data[i].language + '</div>' + '<div class="divCell" style="width:10%"><input type="hidden" name="master" id="master' + i + '" value="' + data[i].master_content_id + '"><input type="radio" name="content" onchange="getval('+ data[i].master_content_id +','+ data[i].content_id +','+ artis +','+ title+')"></div>' + '</div>');
                        }
                        jQuery.fn.center = function () {
                            this.animate({
                                position:"absolute",
                                top: Math.max(0, (($('.overlay').height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px",
                                left: Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +  $(window).scrollLeft() + 40) + "px"
                            },"linear",function(){
                            })
                            //this.css("position", "absolute");
                            //this.css("top", Math.max(0, (($('.overlay').height() - $(this).outerHeight()) / 2) +
                                    //$(window).scrollTop()) + "px");
                            //this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                                   // $(window).scrollLeft()) + "px");
                            return this;
                        }
                        $('.popupp').center();
                        

                    });
                    //$('.popupp').animate({ width: "70%"},800);
                    //$('.popupp').animate({ height: "70%"},800);

                    //$('.popupp').css('width', '50%')

                }
            });
        
        }
    }
    
    function check() {
        jQuery.fn.center = function () {
                    this.css("position", "absolute");
                    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
                            $(window).scrollTop()) + "px");
                    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                            $(window).scrollLeft()) + "px");
                    return this;
                }
        var $lan = $('#language_id').val();
        if ($lan == '') {
            alert('Please Select Language');
            document.getElementById('link').checked = false;
        } else {
                     
                $('.overlay').show();
                $('.overlay').center();
                $('.popupp').show();
                $('.popupp').center();
                $('body').css('overflow-y', 'hidden');
        $('.popupp').css({
            'display': 'block',
            'overflow-y': 'scroll'
        });
                $('.popupp').css('overflow-y', 'scroll');
                
            
        }
    }
    
                
    
</script>
<script type="text/javascript">
//
//    function getdata(v) {
//        var lang = $('#language_id').val();
//        if (v.length > 3) {
//            $.ajax({
//                type: "post",
//                url: '<?php //echo base_url() . 'Admin/alerts/bautocomplete'; ?>',
//                data: {term: v, lan: lang},
//                dataType: "JSON",
//                success: function (data) {alert(data)
//                    $('.divTable').show();
//                    $('.popupp').css('height','70%')
//                    $('.popupp').css('width','70%')
//                    for (i in data) {
//                        var j=parseInt(i)+1;
//                        var title="'"+data[i].title+'-'+data[i].unique_code+"'";
//                        $('.divTable').append('<div class="divRow">' +'<div class="divCell" style="width:5%">'+j+'</div>'+ '<div class="divCell" style="width:15%" >' + data[i].title + '</div>' + '<div class="divCell" style="width:10%" >' + data[i].unique_code + '</div>'+  '<div class="divCell" style="width:10%"><img src="http://sprintmedia.s3.amazonaws.com/appimages/' + data[i].thumb_filename + '" width="50" height="50"/></div>' + '<div class="divCell" style="width:30% !important;overflow: hidden;"><audio src="http://sprintmedia.s3.amazonaws.com/audios/' + data[i].contentclip_filename + '" width="50" controls></audio></div> ' + '<div class="divCell" style="width:10%" >' + data[i].main_artist + '</div>' + '<div class="divCell" style="width:10%" >' + data[i].language + '</div>' + '<div class="divCell" style="width:10%"><input type="hidden" name="master" id="master' + i + '" value="' + data[i].master_content_id + '"><input type="radio" name="content" onchange="getval('+ data[i].master_content_id +','+ data[i].content_id +','+ title+')"></div>' + '</div>');
//                    }
//                    jQuery.fn.center = function () {
//                    this.css("position", "absolute");
//                    this.css("top", Math.max(0, (($('.overlay').height() - $(this).outerHeight()) / 2) +
//                            $(window).scrollTop()) + "px");
//                    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
//                            $(window).scrollLeft()) + "px");
//                    return this;
//                    }
//                    $('.popupp').center();
//                }
//            });
//        }
//    }

    function getdata() {
        var lang = $('#language_id').val();
        var v = $('#title').val();
        if (v.length > 3) {
            $.ajax({
                type: "post",
                url: '<?php echo base_url() . 'Admin/alerts/bautocomplete'; ?>',
                data: {term: v, lan: lang},
                dataType: "JSON",
                success: function (data) {
                    $('.divRow').remove();
                    $('.popupp').css('height', '0');
                    $('.popupp').css('width', '0');
                    //$('.popupp').css('top', '279px');
                    $('.popupp').css('top', '800px');
                    $('.popupp').animate({
                        height: '70%',
                        width: '70%',
                    }, 1000, function () {
                        $('.close-button').parent().css('width', '70%');
                        for (i in data) {
                            var j = parseInt(i) + 1;
                            var title = "'" + data[i].title + '-' + data[i].unique_code + "'";
                            var artis="'" + data[i].main_artist + "'";
                            $('.divTable').append('<div class="divRow">' +'<div class="divCell" style="width:5%">'+j+'</div>'+ '<div class="divCell" style="width:15%" >' + data[i].title + '</div>' + '<div class="divCell" style="width:10%" >' + data[i].unique_code + '</div>'+  '<div class="divCell" style="width:10%"><img src="http://sprintmediasg.s3.amazonaws.com/appimages/' + data[i].thumb_filename + '" width="50" height="50"/></div>' + '<div class="divCell" style="width:30% !important;overflow: hidden;"><audio src="http://sprintmediasg.s3.amazonaws.com/audios/' + data[i].contentclip_filename + '" width="50" controls></audio></div> ' + '<div class="divCell" style="width:10%" >' + data[i].main_artist + '</div>' + '<div class="divCell" style="width:10%" >' + data[i].language + '</div>' + '<div class="divCell" style="width:10%"><input type="hidden" name="master" id="master' + i + '" value="' + data[i].master_content_id + '"><input type="radio" name="content" onchange="getval('+ data[i].master_content_id +','+ data[i].content_id +','+ artis +','+ title+')"></div>' + '</div>');
                        }
                        jQuery.fn.center = function () {
                            this.animate({
                                position:"absolute",
                                top: Math.max(0, (($('.overlay').height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px",
                                left: Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +  $(window).scrollLeft() + 40) + "px"
                            },"linear",function(){
                                
                                $('.divTable').show();
                            })
                            //this.css("position", "absolute");
                            //this.css("top", Math.max(0, (($('.overlay').height() - $(this).outerHeight()) / 2) +
                                    //$(window).scrollTop()) + "px");
                            //this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                                   // $(window).scrollLeft()) + "px");
                            return this;
                        }
                        $('.popupp').center();
                        

                    });
                    //$('.popupp').animate({ width: "70%"},800);
                    //$('.popupp').animate({ height: "70%"},800);

                    //$('.popupp').css('width', '50%')

                }
            });
        }
    }
    function getval(e,c,a,t) {
       $('#m_id').val(e);
        $('#c_id').val(c);
        $('#artist').val(a);
       $('#selected_content').html(t);
        $('.overlay').hide();
        $('.popupp').hide();
    }

</script>