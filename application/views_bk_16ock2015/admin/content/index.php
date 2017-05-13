<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Approved Content List</h3></td>
                    <td align="right"><!--<a href="<?php //base_url(); ?>content/add" ><button class='btn' title='Edit' style="border:1px solid #cccccc;">Add Content</button></a>--></td>
					 <td align="right">Categories:

                        <select name="category"  id="catid">
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
        </div><?php //print_r($category);?>
        <div class="module-body table">
            <form name="date" method="post">
                <span style="padding-left:10px;"> Uploded Between Start Date  : </span><input type="text" name="fromdate" id="fromdate" value="<?php if(!empty($_POST['fromdate'])){ echo $_POST['fromdate']; } ?>" readonly="readonly" >
                <span style="padding-left:20px;"> End Date  : </span><input type="text" name="todate" id="todate" value="<?php if(!empty($_POST['todate'])){ echo $_POST['todate']; } ?>" readonly="readonly" >
                <input type="button" name="contentsubmit" id="contentsubmit" value="Go" class="btn pakodi">
                <input type="button" id="contentreset" value="Reset" class="btn pakodi">
            </form>
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-6 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">Content ID</th>
                        <th align="left">Title</th>
						<th align="left">Thumbnail</th>
                        <th align="left" >Media file</th>
                        <th align="left">Activation Date</th>
                        <th align="left">Expiry Date</th>
						<th align="left">Sample Window</th>
                        <th align="left">Status</th>
                        <th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

