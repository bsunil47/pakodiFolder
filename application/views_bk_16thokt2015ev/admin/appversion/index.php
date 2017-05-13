<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>App Version</h3></td>
                   <td align="right"><a href="<?php base_url(); ?>appversion/add" ><button class='btn pakodi' title='Edit' style="border:1px solid #cccccc;">Add App Version</button></a></td>
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">OS Type</th>
                        <th align="left">Version</th>
                        <th align="left">Status</th>
                        <!--th align="left">Action</th-->
                    </tr>
                </thead>
                <tbody>
                 <?php
				    if (!empty($appversion)) {
                    for ($i = 0; $i < count($appversion); $i++) {
                            ?>
                            <tr>

                                <td align="left" width="40"><?php echo $i+1; ?></td>
                                <td align="left"><?php if($appversion[$i]->os_type==1){echo "IOS";}else{echo "Android";} ?></td>
                                <td align="left"><?php echo $appversion[$i]->app_version; ?></td>
                                <td align="left" width="100"><?php  
                                if($appversion[$i]->status=='1')
                                    {
                                    echo "<button class='btn-success' title='Active' style='border:0px solid #cccccc;'>Active</button>";
                                    }
                                else{
                                    echo "<button class='btn-danger' title='Inactive' style='border:0px solid #cccccc;'>Inactive</button>";
                                    
                                }
                                    ?>
                                </td>
                               
                                
                                <!--td align="left">
                                    <!--<a href="<?php //echo base_url(); ?>Admin/appversion/update/<?php //echo $appversion[$i]->id; ?>">Edit</a>-->
                                    <!--<img src="<?php //echo base_url(); ?>images/divid.gif" border="0" alt="divid" />->
                                    
                                </td-->
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>

                            <td align="left" colspan="5">No App Versions</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

