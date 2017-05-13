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
                                <td align="left"><h3><?php echo date('Y');?> Year- <?php $month=array('January','February','March','April','May','June','July','August','September','October','November','December');$i=$this->uri->segment(5); $j=$i-1;echo $month[$j];?> Month-<?php echo $this->uri->segment(6);?> Week Report</h3></td>
                                <td align="right"><?php if(isset($day_file)){?><a href="http://sprintmedia.s3.amazonaws.com/reports/<?php echo $day_file;?>" class='btn pakodi' >Export</a><?php }?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div class="module-body table">
                        <table cellpadding="0" cellspacing="0" border="0"
                               class="datatable-31 table table-bordered table-striped display" width="100%">
                            <thead>
                            <tr>
                                <th align="left">day</th>
                                <th align="left">Views</th>
                                <th align="left">Downloads</th>
                                <th align="left">Dubs</th>
                                <th align="left">Share</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($day as $key => $value){
                                   $day=$value['day']; ?>
                                <tr>
                                    <td align="left"><?php echo $value['day']; ?></td>
                                    <td align="left"><?php if(!empty($value['viewCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/dayreportdetails/<?php echo date('Y'); ?>/<?php echo $day; ?>/<?php echo 0;?>"><?php echo $value['viewCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['downloadCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/dayreportdetails/<?php echo date('Y'); ?>/<?php echo $day; ?>/<?php echo 1;?>"><?php echo $value['downloadCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['dubCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/dayreportdetails/<?php echo date('Y'); ?>/<?php echo $day; ?>/<?php echo 2;?>"><?php echo $value['dubCount']; ?></a><?php }else{ echo "0";}?></td>
                                    <td align="left"><?php if(!empty($value['shareCount'])){?><a href="<?php echo base_url(); ?>Admin/creports/dayreportdetails/<?php echo date('Y'); ?>/<?php echo $day; ?>/<?php echo 3;?>"><?php echo $value['shareCount']; ?></a><?php }else{ echo "0";}?></td>
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

    
