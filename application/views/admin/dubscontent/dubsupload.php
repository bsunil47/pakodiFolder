<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>UGC upload</h3></td>
                    <td align="right"><a href="<?php echo base_url() . 'zipfiles/'?>samplepakodidubsmeta.xlsx" class="btn pakodi">Sample Excel file Download for Dubs</a><a style="float:right; display: inline-block" class="back-close btn pakodi" href="">Back</a></td>
                </tr>

            </table>
        </div>
        <div class="module-body">
            <form enctype="multipart/form-data" method="POST" action="<?php echo base_url(); ?>Admin/dubscontent/createdub" class="form-horizontal row-fluid">
            <div class="control-group">
                <label class="control-label" for="basicinput">Create Dubs Zip Upload :</label>
                <div class="controls">
                    <input name="file" type="file" />
                    <?php echo form_error('excel_file'); ?>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input type="submit" value="submit" class="btn pakodi" name="submit" id="create_dub" />
                    <?php //echo form_submit('submit', 'Upload', 'id="submit"', 'name="submit"'); ?>
                </div>
            </div>
            </form>
        </div>

        </div>
</div>


