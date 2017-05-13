<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Audio Records</h3></td>
               </tr>
            </table>
        </div>
        <div class="module-body table">
            
            
            <form name="date" method="post">
                <span style="padding-left:10px;"> Uploded Between Start Date :</span><input type="text" name="rec_fromdate" id="rec_fromdate" value="<?php if(!empty($_POST['rec_fromdate'])){ echo $_POST['rec_fromdate']; } ?>" readonly="readonly" >
                <span style="padding-left:20px;"> End Date  : </span><input type="text" name="rec_todate" id="rec_todate" value="<?php if(!empty($_POST['rec_todate'])){ echo $_POST['rec_todate']; } ?>" readonly="readonly" >
                <input type="button" name="recsubmit" id="recsubmit" value="Go" class="btn pakodi">
                <input type="button" id="recreset" value="Reset" class="btn pakodi">
            </form>
            
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-17 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">User Name</th>
                        <th align="left">Clip Title</th>
						<th align="left">Thumb</th>
						<th align="left">Media file</th>
                        <th align="left">Moderated By</th>
						<th align="left">Date</th>
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

