<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Most Dubed Content Report</h3></td>
                    <td align="right"><a href="http://sprintmediasg.s3.amazonaws.com/reports/<?php if(isset($dubs_file)){echo $dubs_file;}?>?header=content-disposition:attachment;filename:<?php if(isset($dubs_file)){echo $dubs_file;}?>;" class='btn pakodi' target="_blank" download >Export</a><a href="javascript:window.history.go(-1);" style="float:right; display: inline-block" class="back-close btn pakodi">Back</a>
                    </td>
                </tr>
            </table>
        </div><?php //print_r($category);?>
        <div class="module-body table" style="border-bottom: 1px solid #d5d5d5;">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" >

                <tr style="background-color: #f6f6f6">
                    <form name="date" method="post" class="table-form">
                        <td align="left" style="width: 9.5%"><div id="column1" class="col1"><i class="iconred icon-filter"></i></div></td>
                        <td align="left" style="width:30%">
                            <div class='input-group date' id='from_date'><input type='text' class="form-control" name="fromdate" id="fromdate" value="<?php if (!empty($_POST['fromdate'])) {echo $_POST['fromdate'];} else{$start=date('m')."/01/".date('Y'); echo $start;} ?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
                        </td>
                        <td style="width: 10.5%"></td>
                        <td align="right" style="width:30%">
                            <div class='input-group date' id='to_date'><input type='text' class="form-control" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) {echo $_POST['todate'];} else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>                        </td>

                        <td style="text-align: center">
                            <input type="submit" name="contentsubmit" id="reportsubmit" value="Search" class="btn pakodi" style="">
                        </td>
                    </form>
                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </table>

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
                        <td align="left" style="text-align:center"><?php $path = $value->thumb_filename; ?>
                            <div class="tric test"><img src="http://sprintmediasg.s3.amazonaws.com/appimages/<?php echo $path; ?>"  width="50" height="auto"><div class="redo"><b><?php echo $value->clip_length;?> S</b></div></div>
                        </td>
                        <td align="left" style="text-align:center"><?php $path = $value->contentclip_filename; ?>
                            <i class="iconred fa fa-play-circle-o fa-2 play-content" title="Play" data-media="<?php echo $path;?>"></i>
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
    
