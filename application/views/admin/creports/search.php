<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Search By Movie Name/Main Artist Report</h3></td>
                    <td align="right"><?php if(isset($search_file)){ ?><a href="http://sprintmediasg.s3.amazonaws.com/reports/<?php if(isset($search_file)){echo $search_file;}?>?header=content-disposition:attachment;filename:<?php if(isset($search_file)){echo $search_file;}?>;" class='btn pakodi' target="_blank" download >Export</a><?php } ?>
                    </td>
			  </tr>
            </table>
        </div>
        <div class="module-body table">
		<form name="date" method="post" class="table-form">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                <tr  style="background-color: #f6f6f6">
                    <td>Select type:</td>
                    <td>
                        <select name="search_by" id="search_by">
                            <option value="main_artist" <?php if(isset($_POST['search_by']) && $_POST['search_by'] == 'main_artist'){ ?>selected<?php } ?>>Main Artist</option>
                            <option value="movie_name" <?php if(isset($_POST['search_by']) && $_POST['search_by'] == 'movie_name'){ ?>selected<?php } ?>>Movie Name</option>
                        </select>
                    </td>
                    <td>Search :</td>
                    <td><input type="text" name="search_word" id="search_word" placeholder="Enter Movie Name/Main Artist..." value ="<?php if(!empty($search_word)){ echo $search_word; }?>"></td>
                    <td></td>
                </tr>
                <tr style="background-color: #f6f6f6">
                        <td align="left" style="width: 9.5%"><div id="column1" class="col1"><i class="iconred icon-filter"></i></div></td>
                        <td align="left" style="width:30%">
                            <div class='input-group date' id='from_date'><input type='text' class="form-control" name="fromdate" id="fromdate" value="<?php if (!empty($_POST['fromdate'])) {echo $_POST['fromdate'];} else{$start=date('m')."/01/".date('Y'); echo $start;}?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
                        </td>
                        <td style="width: 10.5%"></td>
                        <td align="right" style="width:30%">
                            <div class='input-group date' id='to_date'><input type='text' class="form-control" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) {echo $_POST['todate'];}else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>                        </td>

                        <td style="text-align: center">
                            <input type="submit" name="contentsubmit" id="reportsubmit" value="Search" class="btn pakodi" style="">
                        </td>
                    </form>
                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </table>
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

    
