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
                                <td align="left"><h3><?php echo date('Y');?> Year- <?php $months=array('January','February','March','April','May','June','July','August','September','October','November','December');$i=$this->uri->segment(5); $j=$i-1;echo $months[$j];?> Month Report</h3></td>
                                <td align="right"><a href="http://sprintmedia.s3.amazonaws.com/reports/<?php if(isset($week_file)){echo $week_file;}?>?header=content-disposition:attachment;filename:<?php if(isset($week_file)){echo $week_file;}?>;" class='btn pakodi' target="_blank" download >Export</a></td>
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
                            <?php foreach($week as $key => $value){ ?>
                                <tr>
                                    <td align="left"><a href="<?php echo base_url(); ?>Admin/creports/weekreport/<?php echo date('Y'); ?>/<?php echo $month; ?>/<?php echo $value['week']; ?>"><?php echo $value['week']; ?></a></td>
                                    <td align="left"><?php echo !empty($value['viewCount'])? $value['viewCount'] : 0; ?></td>
                                    <td align="left"><?php echo !empty($value['downloadCount'])? $value['downloadCount'] :0; ?></td>
                                    <td align="left"><?php echo !empty($value['dubCount'])? $value['dubCount']: 0; ?></td>
                                    <td align="left"><?php echo !empty($value['shareCount'])?$value['shareCount']:0; ?></td>
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

    
