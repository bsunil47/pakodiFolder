<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Search By Movie Name/Main Artist Report</h3></td>
                    <td align="right"><?php if(isset($search_file)){ ?><a href="http://sprintmedia.s3.amazonaws.com/reports/<?php if(isset($search_file)){echo $search_file;}?>?header=content-disposition:attachment;filename:<?php if(isset($search_file)){echo $search_file;}?>;" class='btn pakodi' target="_blank" download >Export</a><?php } ?></td>
			  </tr>
            </table>
        </div>
        <div class="module-body table">
            <form name="date" method="post" class="form-horizontal row-fluid table-form">
                
                <div class="control-group span11">
                    <div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4">Select Search Type :</label>
                    <div class="controls span4" style="margin-left: 10px;">
                        <select name="search_by" id="search_by">
                            <option value="main_artist" <?php if(isset($_POST['search_by']) && $_POST['search_by'] == 'main_artist'){ ?>selected<?php } ?>>Main Artist</option>
                            <option value="movie_name" <?php if(isset($_POST['search_by']) && $_POST['search_by'] == 'movie_name'){ ?>selected<?php } ?>>Movie Name</option>
                        </select>
                        </div>
                    </div>
                    <div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4"   >Search  :</label>
                    <div class="controls span4" style="margin-left: 10px;">
                         <input type="text" name="search_word" id="search_word" placeholder="Enter Movie Name/Main Artist..." value ="<?php if(!empty($search_word)){ echo $search_word; }?>">
                    </div>
                    </div>
                    <div class="span6" style="margin-left: 0px; margin-bottom: 5px">
                        <label class="control-label span4" id="report-start-label" >Report Start Date :</label>
                        <div class="controls span4" id="report-start" style="margin-left: 12px;">
                            <input type="text" name="fromdate" id="fromdate" value="<?php if (!empty($_POST['fromdate'])) {
                                       echo $_POST['fromdate'];
                                   }else{$start=date('m')."/01/".date('Y');echo $start;} ?>" readonly="readonly" >
                        </div>

                    </div>
                    <div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4" style="display:none"  >Search  :</label>
                    <div class="controls span4" style="margin-left: 10px;display:none">
                         <input type="text" name="uid2" id="uid2" placeholder="Enter Movie Name/Main Artist...">
                    </div>
                        <label class="control-label span4" id="month-label">Report End Date :</label>
                        <div class="controls span4" id="months" style="margin-left: 10px">
                           <input type="text" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) {
                                echo $_POST['todate'];
                            }else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>"  readonly="readonly" >
                        </div>
                    </div>
                    <div class="span9" style="margin-left: 0px;margin-bottom: 5px">
                    </div>
                    <div class="span3" style="margin-left: 0px; margin-bottom: 5px">
                        <input type="submit" name="contentsubmit" id="reportsubmit" value="Search" class="btn pakodi" style="float: right; margin-right: 10px">
                    </div>
                </div>
                 </form>
            <table cellpadding="0" cellspacing="0" border="0" class=" table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">Unique Code</th>
                        <th align="left">Movie Name</th>
                        <th align="left">Main Artist</th>
                        <th align="left">View Count</th>
                        <th align="left">Download Count</th>
                        <th align="left" >Dubs Count</th>
                        <th align="left">Shared Count</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php if(!empty($search)){
                        foreach($search as $key => $value){?>
                    <tr>
                        <td align="left"><?php echo !empty($value->unique_code)? $value->unique_code : '-'; ?></td>
                        <td align="left"><?php echo !empty($value->movie_name)? $value->movie_name : '-'; ?></td>
                        <td align="left"><?php echo !empty($value->main_artist)? $value->main_artist : '-'; ?></td>
                        <td align="left"><?php echo !empty($value->viewCount)? $value->viewCount : 0; ?></td>
                        <td align="left"><?php echo !empty($value->downloadCount)? $value->downloadCount :0; ?></td>
                        <td align="left"><?php echo !empty($value->dubCount)? $value->dubCount: 0; ?></td>
                        <td align="left"><?php echo !empty($value->shareCount)?$value->shareCount:0; ?></td>
                    </tr><?php }}else{?>
                     <tr>
                         <td colspan="7">No Results Found</td>
                     </tr><?php }?>
                  </tbody>
                
            </table>
        </div>
    </div>
</div>

    
