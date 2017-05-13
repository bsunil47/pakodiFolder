<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Content</h3></div>
        <div class="module-body">
            <form id="addcontent" name="addcontent" class="form-horizontal row-fluid" action="<?php echo base_url() . 'Admin/content/add'; ?>" method="post">

                <div class="control-group">
                    <label class="control-label" for="category_id">Category:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="category_id" id="category_id">
                            <option value="">-Select-</option>
                            <?php foreach ($category as $cat){?>
                                <option value="<?php echo $cat->cat_id; ?>"><?php echo $cat->category; ?></option>
                            <?php } ?>

                        </select>
                        <?php echo form_error('category_id'); ?>
                    </div>  
                </div>
                <div class="control-group">
                    <label class="control-label" for="language_id">Language:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="language_id" id="language_id">
                            <option value="">-Select-</option>
                            <?php foreach ($language as $lang){?>
                                <option value="<?php echo $lang->lang_id; ?>"><?php echo $lang->language; ?></option>
                            <?php } ?>

                        </select>
                        <?php echo form_error('category_id'); ?>
                    </div>  
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_type">Content Type:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="content_type" id="content_type">
                            <option value="">-Select-</option>
                            <option value="0">Audio</option>
                            <option value="1">Video</option>
                        </select>
                        <?php echo form_error('content_type'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="parental_advisory">Parental Advisory:</label>
                    <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="parental_advisory" id="parental_advisory">
                            <option value="">-Select-</option>
                            <option value="ALL">ALL</option>
                            <option value="PG">PG</option>
                            <option value="13+">13+</option>
                            <option value="16+">16+</option>
                            <option value="18+">18+</option>
                        </select>
                        <?php echo form_error('parental_advisory'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="movie_name">Title:</label>
                    <div class="controls">
                        <?php echo form_input('movie_name', $this->input->post('movie_name'), 'id="movie_name", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('movie_name'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <?php echo form_input('title', $this->input->post('title'), 'id="title", class="span8" placeholder="Enter Title" autocomplete="off"'); ?>
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="content_type">Content Type:</label>
                    <div class="controls">
                        <?php echo form_input('content_type', $this->input->post('content_type'), 'id="content_type", class="span8" placeholder="Enter Content Type" autocomplete="off"'); ?>
                        <?php echo form_error('content_type'); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <?php echo form_submit('submit', 'Add', 'id="submit"', 'name="submit"', 'class="btn-primary"'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>