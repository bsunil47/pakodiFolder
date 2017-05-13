<?php
//echo '<pre>';
// print_r($month);
//print_r($year);
//print_r($week);
?>
<div class="content">
    <div class="btn-controls">
        <div class="span9" style="margin-left: 5px">
            <div class="btn-box-row row-fluid">
                <div class="module span12">
                    <div class="module-head">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td align="left"><h3><?php echo date('Y');?> Year Report</h3></td>
                                <td align="right"><a href="http://sprintmediasg.s3.amazonaws.com/reports/<?php if(isset($month_file)){echo $month_file;}?>?header=content-disposition:attachment;filename:<?php if(isset($month_file)){echo $month_file;}?>;" class='btn pakodi' target="_blank" download >Export</a><a href="javascript:window.history.go(-1);" style="float:right; display: inline-block" class="back-close btn pakodi">Back</a>
                                </td>
                            </tr>
                        </table>
<!--                        <h3>--><?php //echo date('Y');?><!-- Year-Monthly Report</h3>-->
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

    
