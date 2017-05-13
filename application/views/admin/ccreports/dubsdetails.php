<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>User  Dubs  Report</h3></td>
                    <td align="right"><?php if(isset($dubs_file)){?><a href="http://sprintmediasg.s3.amazonaws.com/reports/<?php echo $dubs_file;?>" class='btn pakodi' >Export</a><?php }?></td>
                </tr>
            </table>
        </div><?php //print_r($category);?>
        <div class="module-body table" style="border-bottom: 1px solid #d5d5d5;">
             <form name="date" method="post" class="form-horizontal row-fluid table-form">
                <div id="column1" class="col1"><i class="iconred icon-filter"></i></div>
				<div id="column2" class="col2">
				<div class='input-group date' id='from_date'><input type='text' class="form-control" name="fromdate" id="fromdate" value="<?php if (!empty($_POST['fromdate'])) { echo $_POST['fromdate'];}else{$start=date("m-d-Y", strtotime($this->uri->segment(5))); echo $start;} ?>" />
				<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
				</div>
				<div id="column3" class="col2">
				<div class='input-group date' id='to_date'><input type='text' class="form-control" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) { echo $_POST['todate'];}else{$end=date("m-d-Y", strtotime($this->uri->segment(6)));echo $end;} ?>" />
				<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
				</div>
				<div id="column4" class="col2">
				<input type="submit" name="contentsubmit" id="reportsubmit" value="Search" class="pakodi" style="margin-bottom: 10px;padding: 4px;">
                </div>
				<div style="clear: both;" ></div>
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
                        <td align="left" style="text-align:center"><?php $path = $value->thumb_filename; ?>
                            <div class="tric test"><img src="http://sprintmediasg.s3.amazonaws.com/appimages/<?php echo $path; ?>"  width="50" height="auto"><div class="redo"><b><?php echo $value->clip_length;?> S</b></div></div>
                       </td>
                        <td align="left" style="text-align:center"><?php $path = $value->contentclip_filename; ?>
                            <i class="iconred fa fa-play-circle-o fa-2 play-content" title="Play" data-media="<?php echo $path;?>"></i>
                        </td>
                   
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
//    function getdivs(e) {
//        if (e == 'dates') {
//            document.getElementById('report-start-label').style.display = 'block';
//            document.getElementById('report-start').style.display = 'block';
//            document.getElementById('report-end-label').style.display = 'block';
//            document.getElementById('report-end').style.display = 'block';
//            document.getElementById('months').style.display = 'none';
//            document.getElementById('month-label').style.display = 'none';
//        } else {
//            document.getElementById('report-start-label').style.display = 'none';
//            document.getElementById('report-start').style.display = 'none';
//            document.getElementById('report-end-label').style.display = 'none';
//            document.getElementById('report-end').style.display = 'none';
//            document.getElementById('months').style.display = 'block';
//            document.getElementById('month-label').style.display = 'block';
//        }
//    }
</script>
    
