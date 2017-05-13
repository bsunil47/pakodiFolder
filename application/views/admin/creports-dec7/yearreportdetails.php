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
                                <td align="left"><h3><?php echo date('Y');?> Year <?php $report=array('Views','Downloads','Dubs','Share'); $i=$this->uri->segment(5); echo $report[$i];?> Report</h3></td>
                                <td align="right"><?php if(isset($year_details_file)){?><a href="http://sprintmedia.s3.amazonaws.com/reports/<?php echo $year_details_file;?>" class='btn pakodi' >Export</a><?php }?></td>
                            </tr>
                        </table>
<!--                        <h3>--><?php //echo date('Y');?><!-- Year-Monthly Report</h3>-->
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
        </div>
    </div>
</div>

    
