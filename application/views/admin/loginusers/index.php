<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Login Users</h3></td>
					<td align="right"><a
                            href="http://sprintmediasg.s3.amazonaws.com/reports/<?php if (isset($loginusers)) {
                                echo $loginusers;
                            } ?>?header=content-disposition:attachment;filename:<?php if(isset($loginusers)){echo $loginusers;}?>;" class='btn pakodi' target="_blank" download >Export</a>
					</td>
                </tr>
            </table>
        </div>
		<div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                <tr style="background-color: #f6f6f6">
                    <form name="date" method="post" class="table-form">
                        <td align="left" style="width: 9.5%"><div id="column1" class="col1"><i class="iconred icon-filter"></i></div></td>
                        <td align="left" style="width:30%">
                            <div class='input-group date' id='from_date'><input type='text' class="form-control" name="fromdate" id="fromdate" value="<?php if (!empty($_POST['fromdate'])) {echo $_POST['fromdate'];}else{$start=date('m')."/01/".date('Y'); echo $start;} ?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
                        </td>
                        <td style="width: 10.5%"></td>
                        <td align="right" style="width:30%">
                            <div class='input-group date' id='to_date'><input type='text' class="form-control" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) {echo $_POST['todate'];}else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>                        </td>

                        <td style="text-align: center">
                            <input type="submit" name="loginusersubmit" id="loginusersubmit" value="Search" class="pakodi" style="margin-bottom: 10px;padding: 4px;">
                        </td>
                    </form>
                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </table>

		    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">User Name</th>
						<th align="left">Count</th>
						<th align="left">Device Type</th>
						<th align="left">Device Id</th>
                        <th align="left">Last logged in</th>
					</tr>
                </thead>
                <tbody>
				 <?php foreach ($records as $key => $value) { ?>
                    <tr>
                        <td align="left"><?php echo $value->name; ?></td>
                        <td align="left"><?php echo $value->Countval; ?></td>
						<td align="left"><?php $dtype=$value->device_type; if($dtype=='1'){ echo 'IOS';} else { echo 'Android';}?></td>
						<td align="left"><?php echo $value->device_id; ?></td>
                        <td align="left"><?php echo $value->datecreated; ?></td>
                    </tr>
                <?php } ?>
				</tbody>
            </table>
        </div>
    </div>
</div>


