<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Waiting for Approval Content List <span class="itotaldisrecords" style="font-weight: normal"></span></h3></td>
                    <td align="left" style="width:22%">Language : <select name="language"  id="langs" style="width:58%">
                            <option value="">-All-</option>
                            <?php if (!empty($language)) {?>
                            <?php foreach ($language as $lang){?>
                            <option value="<?php echo $lang->lang_id; ?>" <?php if(!empty($_POST['language_id']) && $lang->lang_id == $_POST['language_id']){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $lang->language; ?></option>
                            <?php } } ?>
                            </select></td>
                    <td align="right" style="width:44%">Categories :
                        <select name="category"  id="catidval" style="width:70%">
                            <option value="" >-All-</option>
                            <?php if (!empty($category)) {
                                for ($i = 0; $i < count($category); $i++) { ?>
                                    <option value="<?php echo $category[$i]->cat_id; ?>"><?php echo $category[$i]->category; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select><!--<a href="<?php //base_url(); ?>content/add" ><button class='btn' title='Edit' style="border:1px solid #cccccc;">Add Content</button></a>--></td>
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <div class="table-form" style="width: auto">
                <span style="margin-left: 80%">
                <button class="btn pakodi" id="reject_button" >Reject</button> &nbsp;&nbsp;<button class="btn pakodi" id="approve_button" >Approve</button>
                </span>
            </div>

             <form name="select" id="select_all" method="post" action="" >
                <span style="padding-left:10px;"> </span>
                
                <br>
                <table cellpadding="0" cellspacing="0" border="0" class="datatable-25 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">Content ID</th>
                        <th align="left">Title</th>
                        <th align="left">Thumbnail</th>
                        <th align="left" >Media file</th>
                        <th align="left">Activation Date</th>
                        <th align="left">Expiry Date</th>
                        <th align="left"><input name="select_all" id="select_all1" value="1" type="checkbox"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
           </form>
        </div>
    </div>
</div>
<script>
var user_id_details="<?php echo $user_id; ?>";
</script>

