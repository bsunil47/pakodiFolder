<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Most Shared Content Report</h3></td>
                    <td align="right"><a href="http://sprintmedia.s3.amazonaws.com/reports/<?php if(isset($share_file)){echo $share_file;}?>?header=content-disposition:attachment;filename:<?php if(isset($share_file)){echo $share_file;}?>;" class='btn pakodi' target="_blank" download >Export</a></td>
                </tr>
            </table>
        </div><?php //print_r($category);?>
        <div class="module-body table" style="border-bottom: 1px solid #d5d5d5;">
            <form name="date" method="post" class="form-horizontal row-fluid table-form">
                <div class="control-group span11">
                    <!--<div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4">Select Type :</label>

                        <div class="controls span4" style="margin-left: 10px">
                            <select name="type" id="type">
                                <option value="1" selected="selected">Viewed</option>
                                <option value="2">Download</option>
                                <option value="3">Dubs</option>
                                <option value="4">Shared</option>
                            </select>
                        </div>
                    </div>
                    <div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4">Select Duration :</label>

                        <div class="controls span4" style="margin-left: 10px">
                            <select name="dura" id="dura" onchange="getdivs(this.value)">
                                <option value="month" selected="selected">Month</option>
                                <option value="dates">Date Range</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="span6" style="margin-left: 0px; margin-bottom: 5px">
                        <label class="control-label span4" id="report-start-label" style="">Report Start
                            Date :</label>

                        <div class="controls span4" id="report-start" style="margin-left: 12px;">
                            <input type="text" name="fromdate" id="fromdate"
                                   value="<?php if (!empty($_POST['fromdate'])) {
                                       echo $_POST['fromdate'];
                                   }else{$start=date('m')."/01/".date('Y');echo $start;} ?>" readonly="readonly">
                        </div>

                    </div>
                    <div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4" id="report-end-label" style="">Report End Date
                            :</label>

                        <div class="controls span4" id="report-end" style="margin-left: 12px;">
                            <input type="text" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) {
                                echo $_POST['todate'];
                            }else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>" readonly="readonly">
                        </div><!--
                        <label class="control-label span4" id="month-label">Select Month :</label>

                        <div class="controls span4" id="months" style="margin-left: 10px">
                            <select name="month" id="month">
                                <option value="">-Select Month-</option>
                                <option value="1" <?php /*if (date('m') == "1") { */?> selected<?php /*} */?>>January</option>
                                <option value="2" <?php /*if (date('m') == "2") { */?> selected<?php /*} */?>>February</option>
                                <option value="3" <?php /*if (date('m') == "3") { */?> selected<?php /*} */?>>March</option>
                                <option value="4" <?php /*if (date('m') == "4") { */?> selected<?php /*} */?>>April</option>
                                <option value="5" <?php /*if (date('m') == "5") { */?> selected<?php /*} */?>>May</option>
                                <option value="6" <?php /*if (date('m') == "6") { */?> selected<?php /*} */?>>June</option>
                                <option value="7" <?php /*if (date('m') == "7") { */?> selected<?php /*} */?>>July</option>
                                <option value="8" <?php /*if (date('m') == "8") { */?> selected<?php /*} */?>>August</option>
                                <option value="9" <?php /*if (date('m') == "9") { */?> selected<?php /*} */?>>September</option>
                                <option value="10" <?php /*if (date('m') == "10") { */?> selected<?php /*} */?>>October</option>
                                <option value="11" <?php /*if (date('m') == "11") { */?> selected<?php /*} */?>>November
                                </option>
                                <option value="12" <?php /*if (date('m') == "12") { */?> selected<?php /*} */?>>December
                                </option>
                            </select>
                        </div>-->
                    </div>
                    <div class="span9" style="margin-left: 0px;margin-bottom: 5px">
                    </div>
                    <div class="span3" style="margin-left: 0px; margin-bottom: 5px">
                        <input type="submit" name="contentsubmit" id="reportsubmit" value="Search" class="btn pakodi"
                               style="float: right; margin-right: 10px">
                    </div>
                </div>

            </form>
        </div>

        <!-- <div class="module-body table" style="background: url(../images/bg.png) #eee;">
             <div class="btn-controlls">
                 <div class="btn-box-row row-fluid">
                     <a href="#" class="btn-box small span6"><i class=" icon-download"></i><b>65</b>
                         <p class="">
                             Present Year Downloads</p>
                     </a><a href="#" class="btn-box small span6"><i class="icon-download"></i><b>15</b>
                         <p class="">
                             Present Month Downloads</p>
                     </a>
                 </div>
             </div>
         </div>-->

        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0"
                   class="datatable-32 table table-bordered table-striped display" width="100%">
                <thead>
                <tr>
                    <th align="left">Content ID</th>
                    <th align="left">Title</th>
                    <th align="left">Thumbnail</th>
                    <th align="left">Media file</th>
                    <th align="left">Count</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($records as $key=>$value){ ?>
                    <tr>
                        <td align="left"><?php echo $value->unique_code; ?></td>
                        <td align="left"><?php echo $value->title; ?></td>
                        <td align="left"><?php $path=$value->thumb_filename; ?>
                            <img src="http://sprintmedia.s3.amazonaws.com/appimages/<?php echo $path;?>" border='0' alt='image' width='100' height='40' class='test'/>
                        </td>
                        <td align="left"><?php $path= $value->contentclip_filename; ?>
                            <audio src="http://sprintmedia.s3.amazonaws.com/audios/<?php echo $path;?>" width='0' height='30' controls ></audio>
                        </td>
                        <td align="left"><?php echo $value->cnt; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function getdivs(e) {
        if (e == 'dates') {
            document.getElementById('report-start-label').style.display = 'block';
            document.getElementById('report-start').style.display = 'block';
            document.getElementById('report-end-label').style.display = 'block';
            document.getElementById('report-end').style.display = 'block';
            document.getElementById('months').style.display = 'none';
            document.getElementById('month-label').style.display = 'none';
        } else {
            document.getElementById('report-start-label').style.display = 'none';
            document.getElementById('report-start').style.display = 'none';
            document.getElementById('report-end-label').style.display = 'none';
            document.getElementById('report-end').style.display = 'none';
            document.getElementById('months').style.display = 'block';
            document.getElementById('month-label').style.display = 'block';
        }
    }
</script>
    
