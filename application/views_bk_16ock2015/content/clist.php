<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Content List</h3></td>
                    <td align="right"><!--<a href="<?php //base_url(); ?>content/add" ><button class='btn' title='Edit' style="border:1px solid #cccccc;">Add Content</button></a>--></td>
                    <td align="right">Languages:

                        <select name="languages"  id="lanid">
                            <option value="" >-Select-</option>
                            <?php if (!empty($claungages)) {
                                for ($i = 0; $i < count($claungages); $i++) { ?>
                                    <option value="<?php echo $claungages[$i]->language_id; ?>"><?php echo $claungages[$i]->language; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                    </td>
					<td align="right">Categories:

                        <select name="category"  id="categoryid">
                            <option value="" >-Select-</option>
                            <?php if (!empty($category)) {
                                for ($i = 0; $i < count($category); $i++) { ?>
                                    <option value="<?php echo $category[$i]->cat_id; ?>"><?php echo $category[$i]->category; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                    </td><td>&nbsp;&nbsp;<input type="button" name="search" id="clistsearch" value="Search" class="btn pakodi">&nbsp;&nbsp;<input type="button" name="reset" id="clistreset" value="Reset" class="btn pakodi"></td>
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-9 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">Content ID</th>
                        <th align="left">Title</th>
                        <th align="left">Thumbnail</th>
                        <th align="left">File</th>
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
