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
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr >
                    <td align="left"><h3>Add Alert</h3></td>
                    <td align="right"></td>
                    <td align="right" class="table-form"><a href="javascript:window.history.go(-1);" ><button class='btn pakodi' title='Add' style="border:1px solid #cccccc;" >Back</button></a>

                    </td>
                </tr>
            </table>
        </div>
        <div class="module-body">
            <form id="addalert" name="addalert" class="form-horizontal row-fluid"
                  action="<?php echo base_url() . 'Admin/alerts/add'; ?>" method="post" enctype="multipart/form-data">

                <div class="control-group">
                    <label class="control-label" for="dtype">Device Type:</label>

                    <div class="controls">
                        <select tabindex="1" class="span8" name="dtype" id="dtype">
                            <option value="0">Both</option>
                            <option value="1">IOS</option>
                            <option value="2">Andriod</option>
                        </select>
                        <?php echo form_error('dtype'); ?>
                        <input type="hidden" name="language_id" value="1" id="language_id"/>
                    </div>
                </div>

                <!--<div class="control-group" id="lang">
                    <label class="control-label" for="language_id">Language:</label>

                    <div class="controls">

                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="language_id"
                                id="language_id">
                            <option value="">-Select-</option>
                <?php //foreach ($language as $lang) { ?>
                                <option
                                    value="<?php //echo $lang->lang_id;  ?>" <?php //if (!empty($_POST['language_id']) && $lang->lang_id == $_POST['language_id']) {
                // echo 'selected="selected"'; 
                ?><?php // } ?>><?php //echo $lang->language; ?></option>
                <?php // }  ?>
                        </select>
<?php //echo form_error('language_id');  ?>
                    </div>
                </div>-->

                <div class="control-group">
                    <label class="control-label" for="msg">Message:</label>

                    <div class="controls">
                        <textarea name="msg" id="msg" class="span8" placeholder="Enter Message Here..." minlength="5"
                                  maxlength="250"></textarea>
<?php echo form_error('msg'); ?>
                    </div>
                </div>

                <div class="control-group ">
                    <label class="control-label" for="link">Schedule Time: </label>

                    <div class="controls">
                        <div class='input-group date' id='push_time'>
                            <input type='text' class="form-control" name="push_time"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <!--                    <div class="controls input-group date" id="push_time" style="margin-left: 20px">
                    
                                            <input type="text" data-format="yyyy-MM-dd hh:mm:ss" name="push_time" class="form-control">
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                    
                                        </div>-->
                </div>

                <div class="control-group">
                    <label class="control-label" for="img">Image:</label>

                    <div class="controls">
                        <input type="file" name="img" id="img" placeholder="Upload Image">
                    </div>
                </div>                  

                <div class="control-group">
                    <label class="control-label" for="link">link media</label>

                    <div class="controls">
                        <button type="button" name="link" id="link" onclick="check()" class="btn pakodi">link</button>
                        <span id='selected_content'></span>
                        <input type="hidden" name="masterid" id="m_id">
                        <input type="hidden" name="contentid" id="c_id">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" name="submit" id="submit" value="Add" class="btn pakodi">
<?php // echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"');  ?>
                      
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="popupp" style="display: none; width: 900px; padding: 5px; max-height: 400px">
    <div style="position:fixed;width:900px; z-index: 102;margin-top: -20px"><span class="close-button"><img class="close-button" src="<?php echo base_url(); ?>appimages/lightbox-close.png" style="float: right;"/></span></div>
    <div class="module-head">
        <h3>Enter Title/Main Artist/Unique Code to Search</h3>
    </div>
    <div class="module-body table">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-34 table table-bordered table-striped display" width="100%">
            <thead>
            <tr>
                <th align="left">S.NO</th>
                <th align="left">Title</th>
                <th align="left">Unique Code</th>
                <th align="left">Thumb file</th>
                <th align="left">Clip file</th>
                <th align="left">Artist</th>
                <th align="left">Select</th>
            </tr>
            </thead>
            <tbody>
             </tbody>
        </table>
    </div>


</div>
<script>
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

    function getdata() {
        var lang = $('#language_id').val();
        var v = $('#title').val();
        if (v.length > 3) {
            $.ajax({
                type: "post",
                url: '<?php echo base_url() . 'Admin/alerts/autocomplete'; ?>',
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
                            $('.divTable').append('<div class="divRow">' + '<div class="divCell" style="width:10%">' + j + '</div>' + '<div class="divCell" style="width:20%" >' + data[i].title + '</div>' + '<div class="divCell" style="width:10%" >' + data[i].unique_code + '</div>' + '<div class="divCell" style="width:10%"><img src="http://sprintmediasg.s3.amazonaws.com/appimages/' + data[i].thumb_filename + '" width="50" height="50"/></div>' + '<div class="divCell" style="width:30% !important;overflow: hidden;"><audio src="http://sprintmediasg.s3.amazonaws.com/audios/' + data[i].contentclip_filename + '" width="50" controls></audio></div> ' + '<div class="divCell" style="width:10%">' + data[i].main_artist + '</div>' + '<div class="divCell" style="width:10%"><input type="hidden" name="master" id="master' + i + '" value="' + data[i].master_content_id + '"><input type="radio" name="content" onchange="getval(' + data[i].master_content_id + ',' + data[i].content_id + ',' + title + ')"></div>' + '</div>');
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
    function getval(e, c,t) {
        $('#m_id').val(e);
        $('#c_id').val(c);
        $('#selected_content').html(t);
        $('.overlay').hide();
        $('.popupp').hide();
    }

</script>