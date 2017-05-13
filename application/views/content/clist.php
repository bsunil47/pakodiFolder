<div class="content">
    <div class="module">
        <div class="module-head"><h3>Content List</h3></div>
        <div class="module-body table">&nbsp;
            <span>Languages :</span>
            <select name="languages"  id="lanid" style="width:14%">
                <option value="" >-All-</option>
                <?php if (!empty($claungages)) {
                    for ($i = 0; $i < count($claungages); $i++) { ?>
                        <option value="<?php echo $claungages[$i]->language_id; ?>"><?php echo $claungages[$i]->language; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <span> Categories :</span>
            <select name="category"  id="categoryid" style="width:36%">
                <option value="" >-All-</option>
                <?php if (!empty($category)) {
                    for ($i = 0; $i < count($category); $i++) { ?>
                        <option value="<?php echo $category[$i]->cat_id; ?>"><?php echo $category[$i]->category; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <input type="button" name="search" id="clistsearch" value="Search" class="pakodi" ><input type="button" name="reset" id="clistreset" value="Reset" class="pakodi">
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-9 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">Content ID</th>
                        <th align="left">Title</th>
                        <th align="left">Thumbnail</th>
                        <th align="left">Media file</th>
                        <th align="left">Status</th>
                        <th align="left">Date Created</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
