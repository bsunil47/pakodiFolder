<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>User  Shared  Report</h3></td>
                    <td align="right"><?php if(isset($share_file)){?><a href="http://sprintmedia.s3.amazonaws.com/reports/<?php echo $share_file;?>" class='btn pakodi' >Export</a><?php }?></td>
                </tr>
            </table>
        </div><?php //print_r($category);?>
        <div class="module-body table" style="border-bottom: 1px solid #d5d5d5;">
            <form name="date" method="post" class="form-horizontal row-fluid table-form">
                <div class="control-group span11">
                     <div class="span6" style="margin-left: 0px; margin-bottom: 5px">
                        <label class="control-label span4" id="report-start-label" style="">Report Start
                            Date :</label>

                        <div class="controls span4" id="report-start" style="margin-left: 12px;">
                            <input type="text" name="fromdate" id="fromdate"
                                   value="<?php if (!empty($_POST['fromdate'])) {
                                       echo $_POST['fromdate'];
                                   } else {
                                       $date1=$this->uri->segment(5);
                                       $d=explode("-", $date1);
                                       echo $d[1]."/".$d[2]."/".$d[0];
                                      } ?> " readonly="readonly">
                        </div>

                    </div>
                    <div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4" id="report-end-label" style="">Report End Date
                            :</label>

                        <div class="controls span4" id="report-end" style="margin-left: 12px;">
                            <input type="text" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) {
                                echo $_POST['todate'];
                            } else {
                               $date1=$this->uri->segment(6);
                                       $d=explode("-", $date1);
                                       echo $d[1]."/".$d[2]."/".$d[0];
                            } ?>" readonly="readonly">
                        </div>
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

       <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0"
                   class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                <tr>
                    <th align="left">User Name</th>
                    <th align="left">Content ID</th>
                    <th align="left">Title</th>
                    <th align="left">Thumbnail</th>
                    <th align="left">Media file</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($records as $key => $value) { ?>
                    <tr>
                        <td align="left"><?php echo $value->name;?></td>
                        <td align="left"><?php echo $value->unique_code; ?></td>
                        <td align="left"><?php echo $value->title; ?></td>
                        <td align="left"><?php $path = $value->thumb_filename; ?>
                            <img src="http://sprintmedia.s3.amazonaws.com/appimages/<?php echo $path; ?>" border='0'
                                 alt='image' width='100' height='40' class='test'/>
                        </td>
                        <td align="left"><?php $path = $value->contentclip_filename; ?>
                            <audio src="http://sprintmedia.s3.amazonaws.com/audios/<?php echo $path; ?>" width='0'
                                   height='30' controls></audio>
                        </td>
                   
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
    
