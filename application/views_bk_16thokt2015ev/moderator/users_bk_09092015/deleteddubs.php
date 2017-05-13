<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Deleted Dubs</h3></td>
               </tr>
            </table>
        </div>
        <div class="module-body table">
            
            
            <form name="date" method="post">
                <span style="padding-left:10px;"> From :</span><input type="text" name="rec_fromdate" id="rec_fromdate" value="<?php if(!empty($_POST['rec_fromdate'])){ echo $_POST['rec_fromdate']; } ?>" readonly="readonly" >
                <span style="padding-left:20px;"> To  : </span><input type="text" name="rec_todate" id="rec_todate" value="<?php if(!empty($_POST['rec_todate'])){ echo $_POST['rec_todate']; } ?>" readonly="readonly" >
                <input type="button" name="delsubmit" id="delsubmit" value="Go">
                <input type="button" id="delreset" value="Reset">
            </form>
            
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-14 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">User Name</th>
                        <th align="left">Clip Title</th>
                        <th align="left">Moderated By</th>
						<!--<th align="left">Status</th>-->
                        <th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>
                 
                </tbody>
            </table>
        </div>
    </div>
</div>

