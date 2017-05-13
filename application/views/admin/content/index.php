<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Approved Content List <span class="itotaldisrecords" style="font-weight: normal"></span></h3></td>

                </tr>
            </table>
        </div><?php //print_r($category);?>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                <tr style="background-color: #f6f6f6">
                    <td>Language :</td>
                    <td align="left" > <select name="language"  id="language" >
                            <option value="">-All-</option>
                            <?php if (!empty($language)) {?>
                                <?php foreach ($language as $lang){?>
                                    <option value="<?php echo $lang->lang_id; ?>" <?php if(!empty($_POST['language_id']) && $lang->lang_id == $_POST['language_id']){ echo 'selected="selected"'; ?> <?php } ?>><?php echo $lang->language; ?></option>
                                <?php } } ?>
                        </select></td>
                    <td>Categories :</td>
                    <td  >
                        <select name="category"  id="catid" style="">
                            <option value="" >-All-</option>
                            <?php if (!empty($category)) {
                                for ($i = 0; $i < count($category); $i++) { ?>
                                    <option value="<?php echo $category[$i]->cat_id; ?>"><?php echo $category[$i]->category; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td></td>


                </tr>

                <tr style="background-color: #f6f6f6">
                    <form name="date" method="post" class="table-form">
                        <td align="left" style="width: 9.5%"><div id="column1" class="col1"><i class="iconred icon-filter"></i></div></td>
                        <td align="left" style="width:30%"><div class='input-group date' id='from_date' ><input type='text' class="form-control" name="fromdate" id="fromdate" value="<?php if (!empty($_POST['fromdate'])) { echo $_POST['fromdate']; }else{$start=date('m')."/01/".date('Y'); echo $start;} ?>" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div></td>
                        <td style="width: 10.5%"></td>
                        <td align="right" style="width:30%"><div class='input-group date' id='to_date' ><input type='text' class="form-control" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) { echo $_POST['todate']; }else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>"/><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
                        </td>

                        <td style="text-align: center">
                            <input type="button" name="contentsubmit" id="contentsubmit" value="Go" class="pakodi" style="margin-bottom: 10px;padding: 4px;">
                            <input type="button" id="contentreset" value="Reset" class="pakodi" style="margin-bottom: 10px;padding: 4px;">
                        </td>
                    </form>
                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </table>


                <!--span style="padding-left:10px;"> Uploaded Between Start Date  : </span><input type="text" name="fromdate" id="fromdate" value="<?php //if(!empty($_POST['fromdate'])){ echo $_POST['fromdate']; } ?>" readonly="readonly" >
                <span style="padding-left:20px;"> End Date  : </span><input type="text" name="todate" id="todate" value="<?php //if(!empty($_POST['todate'])){ echo $_POST['todate']; } ?>" readonly="readonly" >
                <input type="button" name="contentsubmit" id="contentsubmit" value="Go" class="pakodi" style="margin-bottom: 10px;padding: 4px;">
                <input type="button" id="contentreset" value="Reset" class="pakodi" style="margin-bottom: 10px;padding: 4px;"-->

			<div id="column2" class="col2">

			</div>
			<div id="column3" class="col2">

			</div>
			<div id="column4" class="col2">

			</div>
			<div style="clear: both;" ></div>
			
            </form>
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-6 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">Content ID</th>
                        <th align="left">Title</th>
						<th align="left">Thumb</th>
                        <!--th align="left" >Media file</th-->
                        <th align="left">Active Date</th>
                        <th align="left">Exp. Date</th>
						<th align="left">Recommanded</th>
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

