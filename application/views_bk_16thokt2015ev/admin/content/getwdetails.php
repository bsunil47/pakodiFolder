<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Waiting for Approval Content List</h3></td>
                    <td align="right"><button class="btn pakodi" id="approve_button">Approve</button><!--<a href="<?php //base_url(); ?>content/add" ><button class='btn' title='Edit' style="border:1px solid #cccccc;">Add Content</button></a>--></td>
                </tr>
				<tr>
				<td align="right">Categories:
					<select name="category"  id="catidval">
                            <option value="" >-Select-</option>
                            <?php if (!empty($category)) {
                                for ($i = 0; $i < count($category); $i++) { ?>
                                    <option value="<?php echo $category[$i]->cat_id; ?>"><?php echo $category[$i]->category; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
					</td>
				</tr>
            </table>
        </div>
        <div class="module-body table">
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

