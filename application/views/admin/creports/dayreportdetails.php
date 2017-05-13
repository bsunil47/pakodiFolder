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
                                <td align="left"><h3><?php echo date('Y');?> Year- <?php echo $this->uri->segment(5);?> Day <?php $report=array('Views','Downloads','Dubs','Share'); $k=$this->uri->segment(6); echo $report[$k];?> Report</h3></td>
                                <td align="right"><?php if(isset($day_details_file)){?><a href="http://sprintmediasg.s3.amazonaws.com/reports/<?php echo $day_details_file;?>" class='btn pakodi' >Export</a><?php }?><a href="javascript:window.history.go(-1);" style="float:right; display: inline-block" class="back-close btn pakodi">Back</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div class="module-body table">
                        <table cellpadding="0" cellspacing="0" border="0"
                               class="datatable-1 table table-bordered table-striped display" width="100%">
                            <thead>
                            <tr>
                                <th align="left">UserName</th>
                                <th align="left">Content Id</th>
                                <th align="left">Title</th>
                                <th align="left">Thumbnail</th>
                                <th align="left">File</th>
                            </tr>
                            </thead>
                            <tbody>
                           <?php foreach($records as $key => $value){ ?>
                                <tr>
                                    <td align="left"><?php echo $value->name; ?></td>
                                    <td align="left"><?php echo $value->unique_code; ?></td>
                        <td align="left"><?php echo $value->title; ?></td>
                        <td align="left"><?php $path = $value->thumb_filename; ?>
						<div class="tric test"><img src="http://sprintmediasg.s3.amazonaws.com/appimages/<?php echo $path; ?>"  width="50" height="auto"><div class="redo"><b><?php echo $value->clip_length;?> S</b></div></div>
                        </td>
                        <td align="left"><?php $path1 = $value->contentclip_filename; ?>
                            <i class="iconred fa fa-play-circle-o fa-2 play-content" title="Play"  data-media="<?php echo $path1;?>"></i>
                        </td>
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

    
