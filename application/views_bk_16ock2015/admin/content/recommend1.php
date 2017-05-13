<div class="content">
    <div class="module">
        <div class="module-head"> <h3>Pakodi Recommends</h3></div>
        <div class="module-body">
            <form id="updaterecommend" name="updaterecommend" method="post" action="" class="form-horizontal row-fluid">
<?php //echo $this->session->userdata('recommend_value'); exit; ?>
                <div class="control-group">
					<div class="controls" style="float:left;width:250px; margin-left:185px; padding:12px 0px; font-weight: bold;">Sort By</div>
					<div class="controls" style="float:left;width:260px; margin-left:20px; padding:12px 0px; font-weight: bold;">Filter By</div>
					<div class="clear"></div>
				
                    <label class="control-label" for="recommend_value">Recommend:</label>
                    <div class="controls" style="float:left;width:260px; margin-left:20px;">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="recommend_value" id="recommend_value" onchange="showrecommend(this.value)">
                            <option value="">-Select-</option>
                            <option id="contentdownload_count" value="contentdownload_count" <?php if($this->session->userdata('recommend_value') == 'contentdownload_count'){ echo 'selected="selected"'; } ?>>Most Downloaded</option>
                            <option id="contentlike_count" value="contentlike_count" <?php if($this->session->userdata('recommend_value') == 'contentlike_count'){ echo 'selected="selected"'; } ?>>Most Liked</option>
                            <option id="contentshare_count" value="contentshare_count" <?php if($this->session->userdata('recommend_value') == 'contentshare_count'){ echo 'selected="selected"'; } ?>>Most Shared</option>
                            <option id="contentplay_count" value="contentplay_count" <?php if($this->session->userdata('recommend_value') == 'contentplay_count'){ echo 'selected="selected"'; } ?>>Most Viewed</option>
                            <!--<option id="dub_count" value="dub_count" <?php //if($this->session->userdata('recommend_value') == 'dub_count'){ echo 'selected="selected"'; } ?>>Most Dubbed</option>-->
                            <option id="content_rating" value="content_rating" <?php if($this->session->userdata('recommend_value') == 'content_rating'){ echo 'selected="selected"'; } ?>>Most Rated</option>
							<option id="customized" value="customized" <?php if($this->session->userdata('recommend_value') == 'customized'){ echo 'selected="selected"'; } ?>>Customized</option>
                        </select>
                        <?php echo form_error('recommend_value'); ?>
                    </div>
					
					<!--<label class="control-label" for="recommend_filter">Recommend Filter:</label>-->
                    <div class="controls" id="recfilter" <?php if($this->session->userdata('recommend_value') != 'customized'){ ?>style="float:left;width:260px; margin-left:10px;display: block;" <?php }else{?>style="float:left;width:260px; margin-left:10px;display: none;"<?php }?>>
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="recommend_filter" id="recommend_filter">
                            <option value="None">None</option>
                            <option  value="2 HOUR" <?php if($this->session->userdata('recommend_filter') == '2 HOUR'){ echo 'selected="selected"'; } ?>>2 HOUR</option>
                            <option  value="4 HOUR" <?php if($this->session->userdata('recommend_filter') == '4 HOUR'){ echo 'selected="selected"'; } ?>>4 HOUR</option>
                            <option  value="8 HOUR" <?php if($this->session->userdata('recommend_filter') == '8 HOUR'){ echo 'selected="selected"'; } ?>>8 HOUR</option>
                            <option  value="12 HOUR" <?php if($this->session->userdata('recommend_filter') == '12 HOUR'){ echo 'selected="selected"'; } ?>>12 HOUR</option>
                            <option  value="16 HOUR" <?php if($this->session->userdata('recommend_filter') == '16 HOUR'){ echo 'selected="selected"'; } ?>>16 HOUR</option>
                            <option  value="1 DAY" <?php if($this->session->userdata('recommend_filter') == '1 DAY'){ echo 'selected="selected"'; } ?>>1 DAY</option>
							<option  value="2 DAY" <?php if($this->session->userdata('recommend_filter') == '2 DAY'){ echo 'selected="selected"'; } ?>>2 DAY</option>
                        </select>
                        <?php echo form_error('recommend_filter'); ?>
                    </div>
					<div class="clear"></div>
					
                </div>
                <div class="control-group">
                    <label class="control-label" for="trending_value">Trending:</label>
                    <div class="controls" style="float:left;width:260px; margin-left:20px;">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="trending_value" id="trending_value">
                            <option value="">-Select-</option>
                            <option id="contentdownload_count1" value="contentdownload_count" <?php if($this->session->userdata('trending_value') == 'contentdownload_count'){ echo 'selected="selected"'; } ?>>Most Downloaded</option>
                            <option id="contentlike_count1" value="contentlike_count" <?php if($this->session->userdata('trending_value') == 'contentlike_count'){ echo 'selected="selected"'; } ?>>Most Liked</option>
                            <option id="contentshare_count1" value="contentshare_count" <?php if($this->session->userdata('trending_value') == 'contentshare_count'){ echo 'selected="selected"'; } ?>>Most Shared</option>
                            <option id="contentplay_count1" value="contentplay_count" <?php if($this->session->userdata('trending_value') == 'contentplay_count'){ echo 'selected="selected"'; } ?>>Most Viewed</option>
                            <!--<option id="dub_count1" value="dub_count" <?php //if($this->session->userdata('trending_value') == 'dub_count'){ echo 'selected="selected"'; } ?>>Most Dubbed</option>-->
							<option id="content_rating1" value="content_rating" <?php if($this->session->userdata('trending_value') == 'content_rating'){ echo 'selected="selected"'; } ?>>Most Rated</option>
                        </select>
                        <?php echo form_error('trending_value'); ?>
                    </div>
				    <div class="controls" style="float:left;width:260px; margin-left:10px;"	>
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="trending_filter" id="trending_filter">
                            <option value="None">None</option>
                            <option  value="2 HOUR" <?php if($this->session->userdata('trending_filter') == '2 HOUR'){ echo 'selected="selected"'; } ?>>2 HOUR</option>
                            <option  value="4 HOUR" <?php if($this->session->userdata('trending_filter') == '4 HOUR'){ echo 'selected="selected"'; } ?>>4 HOUR</option>
                            <option  value="8 HOUR" <?php if($this->session->userdata('trending_filter') == '8 HOUR'){ echo 'selected="selected"'; } ?>>8 HOUR</option>
                            <option  value="12 HOUR" <?php if($this->session->userdata('trending_filter') == '12 HOUR'){ echo 'selected="selected"'; } ?>>12 HOUR</option>
                            <option  value="16 HOUR" <?php if($this->session->userdata('trending_filter') == '16 HOUR'){ echo 'selected="selected"'; } ?>>16 HOUR</option>
                            <option  value="1 DAY" <?php if($this->session->userdata('trending_filter') == '1 DAY'){ echo 'selected="selected"'; } ?>>1 DAY</option>
							<option  value="2 DAY" <?php if($this->session->userdata('trending_filter') == '2 DAY'){ echo 'selected="selected"'; } ?>>2 DAY</option>
                        </select>
                        <?php echo form_error('trending_filter'); ?>
                    </div>
                </div>
				<div class="control-group">
					<label class="control-label" for="content_value">Content List:</label>
                    <div class="controls" style="padding-left: 270px;width: 260px;"	>
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="content_filter" id="content_filter">
                            <option value="None">None</option>
                            <option  value="2 HOUR" <?php if($this->session->userdata('content_filter') == '2 HOUR'){ echo 'selected="selected"'; } ?>>2 HOUR</option>
                            <option  value="4 HOUR" <?php if($this->session->userdata('content_filter') == '4 HOUR'){ echo 'selected="selected"'; } ?>>4 HOUR</option>
                            <option  value="8 HOUR" <?php if($this->session->userdata('content_filter') == '8 HOUR'){ echo 'selected="selected"'; } ?>>8 HOUR</option>
                            <option  value="12 HOUR" <?php if($this->session->userdata('content_filter') == '12 HOUR'){ echo 'selected="selected"'; } ?>>12 HOUR</option>
                            <option  value="16 HOUR" <?php if($this->session->userdata('content_filter') == '16 HOUR'){ echo 'selected="selected"'; } ?>>16 HOUR</option>
                            <option  value="1 DAY" <?php if($this->session->userdata('content_filter') == '1 DAY'){ echo 'selected="selected"'; } ?>>1 DAY</option>
							<option  value="2 DAY" <?php if($this->session->userdata('content_filter') == '2 DAY'){ echo 'selected="selected"'; } ?>>2 DAY</option>
                        </select>
                        <?php echo form_error('content_filter'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Edit', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                        <?php echo form_submit('reset', 'Reset', 'id="reset"', 'name="reset"', 'class="btn-primary"'); ?>
                    </div>
                </div>
                <div id="mydiv" name="mydiv" style="display: none;"><table cellpadding="0" cellspacing="0" border="0" class="datatable-10 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">Title</th>
                        <th align="left">Thumbnail</th>
                        <th align="left">Content Clip</th>
                        <th align="left">Priority</th>
                        </tr>
                </thead>
                <tbody>
                </tbody>
            </table></div>
            </form>
        </div>
    </div>
</div>