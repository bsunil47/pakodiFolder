<?php
//echo '<pre>';
// print_r($month);
//print_r($year);
//print_r($week);
?>
<div class="content">
    <div class="btn-controls">
        <div class="span4" style="margin-left: 5px">
            <div class="btn-box-row row-fluid">
                <div class="module span12" >
                    <div class="module-head">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td align="left"><h3><?php echo date('F');?> Month-Weekly Report</h3></td>
                                <td align="right"><a href="http://sprintmediasg.s3.amazonaws.com/reports/<?php if(isset($week_file)){echo $week_file;}?>?header=content-disposition:attachment;filename:<?php if(isset($week_file)){echo $week_file;}?>;" download="download" target="_blank" class='btn pakodi' >Export</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div class="module-body table">
                        <table cellpadding="0" cellspacing="0" border="0"
                               class="datatable-31 table table-bordered table-striped display" width="100%">
                            <thead>
                            <tr>
                                <th align="left">Week</th>
                                <th align="left">Views</th>
                                <th align="left">Downloads</th>
                                <th align="left">Dubs</th>
                                <th align="left">Share</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i= 1; foreach($week as $key => $value){ ?>
                                <tr>
                                    <td align="left"><a href="<?php echo base_url(); ?>Admin/creports/weekreport/<?php echo date('Y'); ?>/<?php echo date('m'); ?>/<?php echo date('W'); ?>"><?php echo $value['week']."($i)"; $i++; ?></a></td>
                                    <td align="left"><?php if(!empty($value['viewCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/weekreport/<?php echo date('Y'); ?>/<?php echo date('m'); ?>/<?php echo date('W'); ?>/<?php echo 0;?>"><?php echo $value['viewCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['downloadCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/weekreport/<?php echo date('Y'); ?>/<?php echo date('m'); ?>/<?php echo date('W'); ?>/<?php echo 1;?>"><?php echo $value['downloadCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['dubCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/weekreport/<?php echo date('Y'); ?>/<?php echo date('m'); ?>/<?php echo date('W'); ?><?php echo 2;?>"><?php echo $value['dubCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['shareCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/weekreport/<?php echo date('Y'); ?>/<?php echo date('m'); ?>/<?php echo date('W'); ?><?php echo 3;?>"><?php echo $value['shareCount']; ?></a><?php }else{ echo "0";}?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="btn-box-row row-fluid">
                <div class="module span12">
                    <div class="module-head">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td align="left"><h3>Year wise Report</h3></td>
                                <td align="right"><a href="http://sprintmediasg.s3.amazonaws.com/reports/<?php if(isset($year_file)){echo $year_file;}?>?header=content-disposition:attachment;filename:<?php if(isset($year_file)){echo $year_file;}?>;" class='btn pakodi' target="_blank" download >Export</a></td>
                            </tr>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div class="module-body table">
                        <table cellpadding="0" cellspacing="0" border="0"
                               class="datatable-31 table table-bordered table-striped display" width="100%">
                            <thead>
                            <tr>
                                <th align="left">Year</th>
                                <th align="left">Views</th>
                                <th align="left">Downloads</th>
                                <th align="left">Dubs</th>
                                <th align="left">Share</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($year as $key => $value){ ?>
                                <tr>
                                    <td align="left"><a href="<?php echo base_url(); ?>Admin/creports/yearreport/<?php echo date('Y'); ?>"><?php echo $value['year']; ?></a></td>
                                    <td align="left"><?php if(!empty($value['viewCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/yearreportdetails/<?php echo date('Y'); ?>/<?php echo 0;?>"><?php echo $value['viewCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['downloadCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/yearreportdetails/<?php echo date('Y'); ?>/<?php echo 1;?>"><?php echo $value['downloadCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['dubCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/yearreportdetails/<?php echo date('Y'); ?>/<?php echo 2;?>"><?php echo $value['dubCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['shareCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/yearreportdetails/<?php echo date('Y'); ?>/<?php echo 3;?>"><?php echo $value['shareCount']; ?></a><?php }else{ echo "0";}?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="span5" style="margin-left: 5px">
            <div class="btn-box-row row-fluid">
                <div class="module span12">
                    <div class="module-head">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td align="left"><h3><?php echo date('Y');?> Year-Monthly Report</h3></td>
                                <td align="right"><a href="http://sprintmediasg.s3.amazonaws.com/reports/<?php if(isset($month_file)){echo $month_file;}?>?header=content-disposition:attachment;filename:<?php if(isset($month_file)){echo $month_file;}?>;" class='btn pakodi' target="_blank" download >Export</a></td>
                            </tr>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div class="module-body table">
                        <table cellpadding="0" cellspacing="0" border="0"
                               class="datatable-31 table table-bordered table-striped display" width="100%">
                            <thead>
                            <tr>
                                <th align="left">Month</th>
                                <th align="left">Views</th>
                                <th align="left">Downloads</th>
                                <th align="left">Dubs</th>
                                <th align="left">Share</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($month as $key => $value){ ?>
                                <tr>
                                    <td align="left"><a href="<?php echo base_url(); ?>Admin/creports/monthreport/<?php echo date('Y'); ?>/<?php echo $value['month_num']; ?>"><?php echo $value['month']; ?></a></td>
                                    <td align="left"><?php if(!empty($value['viewCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/monthreportdetails/<?php echo date('Y'); ?>/<?php echo $value['month_num']; ?>/<?php echo 0;?>"><?php echo $value['viewCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['downloadCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/monthreportdetails/<?php echo date('Y'); ?>/<?php echo $value['month_num']; ?>/<?php echo 1;?>"><?php echo $value['downloadCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['dubCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/monthreportdetails/<?php echo date('Y'); ?>/<?php echo $value['month_num']; ?>/<?php echo 2;?>"><?php echo $value['dubCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['shareCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/monthreportdetails/<?php echo date('Y'); ?>/<?php echo $value['month_num']; ?>/<?php echo 3;?>"><?php echo $value['shareCount']; ?></a><?php }else{ echo "0";}?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
    
