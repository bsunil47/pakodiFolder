<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Content List</h3></td>
                    <td align="right"><!--<a href="<?php //base_url(); ?>content/add" ><button class='btn' title='Edit' style="border:1px solid #cccccc;">Add Content</button></a>--></td>
                    <td align="right">Languages:

                        <select name="languages" onchange="showlanguage(this.value)" id="lanid">
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
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-9 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
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
