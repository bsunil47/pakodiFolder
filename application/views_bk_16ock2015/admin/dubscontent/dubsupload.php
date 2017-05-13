<div class="content">
    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <div class="span8">
                <div class="row-fluid">
                    <div class="span12">
					<!--a href="<?php //echo base_url(); ?>Admin/dubscontent/dubslist"  class="btn-box small span4"><i class="icon-download"></i><b>&nbsp;</b>Dubs List</a-->

					</div>

                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <form enctype="multipart/form-data" method="POST" action="<?php echo base_url(); ?>Admin/dubscontent/createdub" class="btn-box small span8">
                            <label style="color:blue">Create Dubs Zip Upload</label>
                            <input name="file" type="file" />
                            <input type="submit" value="submit" class="btn pakodi" name="submit" id="create_dub" />
                        </form>
                    </div>
                </div>
            </div>
            <div align='right'> <a href="<?php echo base_url() . 'zipfiles/'?>samplepakodidubsmeta.xlsx">Sample Excel file Download for Dubs</a></div>
        </div>
    </div>
</div>


