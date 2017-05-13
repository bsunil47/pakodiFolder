<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>CMS / Terms and Conditions</h3></td>
                   <!-- <td align="right"><a href="<?php //base_url(); ?>category/add" ><button class='btn' title='Edit' style="border:1px solid #cccccc;">Add Category</button></a></td>-->
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">Page Name</th>
                        <th align="left">Language</th>
                        <!--<th align="left">content</th>-->
                        <th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>
                 <?php
				    //print_r($cms); exit;
                    if (!empty($cms_terms)) {
                    for ($i = 0; $i < count($cms_terms); $i++) {
                            ?>
                            <tr>
                                <td align="left"><?php echo $i+1; ?></td>
                                <td align="left"><?php echo $cms_terms[$i]->page_name; ?></td>
                                <td align="left"><?php echo $cms_terms[$i]->language; ?></td>
                                <!--<td align="left"><?php //echo $cms_terms[$i]->page_desc; ?></td>-->
                                 <td align="left">
                                    <a href="<?php echo base_url(); ?>Admin/cms/termsedit/<?php echo $cms_terms[$i]->page_id; ?>"><i class="iconred icon-pencil" title="Edit"></i></a>
                                    <!--<img src="<?php //echo base_url(); ?>images/divid.gif" border="0" alt="divid" />-->
                                    
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td align="left" colspan="5">No Content Management</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

