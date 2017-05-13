<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAKODI</title>
    <link type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>css/theme.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='<?php echo base_url(); ?>css/fonts.css' rel='stylesheet'>
   <link rel="stylesheet" href="<?php echo base_url(); ?>css/lightbox.css" type="text/css" media="screen" />
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
     <style>
        .pakodi{
            background: #E01E1C;
            text-align: center;
            color: white;
        }
        a{
            padding-left: 2px;
            padding-right: 2px;
            margin-top: -3px;
        }
        a:active {
  color:#E01E1C;
    }
    #html5-watermark{
        display: none !important;
    }
    </style>
    <style>
.overlay {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:105%;
    z-index:1000;
    background-color:#313131;
    filter:alpha(opacity=70);
    -moz-opacity:0.5;
    -khtml-opacity: 0.5;
    opacity: 0.5;
    z-index: 100;
    display: none;
}
.popup{
    position: absolute;
    left: 27%;
    top: 20%;
    margin-left: -32px; /* -1 * image width / 2 */
    margin-top: -32px;  /* -1 * image height / 2 */
    display: none;
    z-index: 101;
    background: rgb(246, 246, 246) none repeat scroll 0 0;
    opacity: 1;
    width: auto;
    max-width: 45%;
    height: auto;
}
.popup-content{
    border: 4px solid #f6f6f6;
}
.popup img{
    width: auto;
    height: auto;
}
.popup video{
    width: 500px;
    height: auto;
}
</style>
    </head>
<body>
<script>
    var base_url = "<?php echo base_url(); ?>";
    var uriseg = "<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>";
</script>
<div class="navbar navbar-fixed-top">
    <?php $this->load->view('includes/header'); ?>
</div>
<!-- /navbar -->
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="span3"><?php $this->load->view('includes/leftmenu'); ?></div>
            <div align="center" class="<?php echo $this->session->flashdata('type'); ?>"><?php echo $this->session->flashdata('msg'); ?></div>
            <div class="span9"><?php echo $content_for_layout; ?></div>
        </div>
    </div>
    <!--/.container-->
</div>
<!--/.wrapper-->
<div class="overlay"></div>
<div class="popup" id="popup">
    <div style="position:absolute;width:100%; z-index: 102"><span class="close-button"><img class="close-button" src="<?php echo base_url(); ?>appimages/lightbox-close.png" style="float: right;"/></span></div>
    <div class="popup-content"></div>
</div>
<?php $this->load->view('includes/footer'); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/common.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/form_validation.js" type="text/javascript"></script>
 <script>
$(document).on('click', '.test', function () {
     jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
    }
      //var idd=  '#'+ $(this).attr('id');
       $(this).clone().removeClass('test').appendTo(".popup-content"); 
       
       $('.overlay').show();
       $('.overlay').center();
        $('.popup').show();
        $('.popup').center();
        //$('.popup-content').next('.test').removeClass('test');
        $('body').css('overflow-y','hidden');

        });
$(document).ready(function(){
    $(".close-button").click(function(){
         $(".popup-content").html("");
         $('.overlay').hide();
         $('.popup').hide();
         $('body').css('overflow-y','visible');
    });
    $('.overlay').click(function(){
        $(".popup-content").html("");
         $('.overlay').hide();
         $('.popup').hide();
         $('body').css('overflow-y','visible');
    });
});
               </script>
    <?php if($this->router->fetch_class() == 'cms'){ ?>
<script src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js" type="text/javascript"></script>
<?php } ?>
<?php  if ($this->router->fetch_method() == 'dashboard') { ?>
    <script type="text/javascript">
        function show(v){//user-show
            for(var i=1; i<5; i++){
                $("#show"+i).hide();
            }
            $("#show"+v).show();
            switch(v){
                case 1: getusersbyyearly();
                    break;
                case 2: getusersbymonthly();
                    break;
                case 3: getusersbyweekly();
                    break;
                case 4: getusersbydaily();
                    break;
            }
        }
        function dshow(v){//dub-show
            for(var i=1; i<5; i++){
                $("#dshow"+i).hide();
            }
            $("#dshow"+v).show();
            switch(v){
                case 1: getdubsbyyearly();
                    break;
                case 2: getdubsbymonthly();
                    break;
                case 3: getdubsbyweekly();
                    break;
                case 4: getdubsbydaily();
                    break;
            }
        }
    </script>
    <!--USERS statistics-->
    <script type="text/javascript">
        function getusersbyyearly(){//Users by Yearly
            var year = $("#year").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getusers",
                data: {'rangetype': 'yearly', 'year': year},
                type: "post",
                success: function(data){
                    $("#graph_users").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getusersbymonthly(){//Users by Monthly
            var monthyear = $("#usermonth").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getusers",
                data: {'rangetype': 'monthly', 'monthyear': monthyear},
                type: "post",
                success: function(data){
                    $("#graph_users").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getusersbyweekly(){//Users by Weekly
            var userweek = $("#userweek").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getusers",
                data: {'rangetype': 'weekly', 'userweek': userweek},
                type: "post",
                success: function(data){
                    $("#graph_users").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getusersbydaily(){//Users by Daily
            var userday = $("#userday").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getusers",
                data: {'rangetype': 'daily', 'userday': userday},
                type: "post",
                success: function(data){
                    $("#graph_users").html(data);
                    drawChart();
                }
            });//ajax
        }
    </script>
    <!--DUBS Stattistics-->
    <script type="text/javascript">
        function getdubsbyyearly(){ //Dubs by Yearly
            var year = $("#dyear").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getdubstats",
                data: {'rangetype': 'yearly', 'year': year},
                type: "post",
                success: function(data){
                    $("#graph_dubs").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getdubsbymonthly(){//Dubs by Monthly
            var monthyear = $("#dubmonth").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getdubstats",
                data: {'rangetype': 'monthly', 'monthyear': monthyear},
                type: "post",
                success: function(data){
                    $("#graph_dubs").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getdubsbyweekly(){//Dubs by Weekly
            var dubweek = $("#dubweek").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getdubstats",
                data: {'rangetype': 'weekly', 'dubweek': dubweek},
                type: "post",
                success: function(data){
                    $("#graph_dubs").html(data);
                    drawChart();
                }
            });//ajax
        }
        function getdubsbydaily(){//Dubs by Daily
            var dubday = $("#dubday").val();
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/users/getdubstats",
                data: {'rangetype': 'daily', 'dubday': dubday},
                type: "post",
                success: function(data){
                    $("#graph_dubs").html(data);
                    drawChart();
                }
            });//ajax
        }
    </script>
    <script>
        $(document).ready(function() {
            $(function() {
                $("#userday").datepicker({ firstDay: 1 });
                $("#dubday").datepicker({ firstDay: 1 });
                $('#usermonth').datepicker({//Users Month Picker;
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy'
                }).focus(function() {
                    var thisCalendar = $(this);
                    $('.ui-datepicker-calendar').detach();
                    $('.ui-datepicker-close').click(function() {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        thisCalendar.datepicker('setDate', new Date(year, month, 1));
                    });
                });
                $('#dubmonth').datepicker({//Dubs Month Picker;
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy'
                }).focus(function() {
                    var thisCalendar = $(this);
                    $('.ui-datepicker-calendar').detach();
                    $('.ui-datepicker-close').click(function() {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        thisCalendar.datepicker('setDate', new Date(year, month, 1));
                    });
                });
            });//function
        });//ready
    </script>
    <!--Users Week-datepicker-->
    <script type="text/javascript">
        $(function() {
            var startDate;
            var endDate;
            var selectCurrentWeek = function() {
                window.setTimeout(function () {
                    $('.userweek-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
                }, 1);
            }
            $('.userweek-picker').datepicker( {
                showOtherMonths: true,
                selectOtherMonths: true,
                firstDay: 1,
                onSelect: function(dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1));
                    endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1) + 6);
                    var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                    var sdate = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                    var edate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                    $('#userweek').val(sdate+'-'+edate);
                    selectCurrentWeek();
                },
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day != 0), ''];
                }
            });
            $('.userweek-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
            $('.userweek-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
        });
    </script>
    <!--Dubs Week-datepicker-->
    <script type="text/javascript">
        $(function() {
//            var curr = new Date; // get current date
//            var first = curr.getDate() - (curr.getDay()-1); // First day is the day of the month - the day of the week
//            var last = first + 6; // last day is the first day + 6
//            var firstday = new Date(curr.setDate(first)).toUTCString();
//            var lastday = new Date(curr.setDate(last)).toUTCString();
//            var sdate = $.datepicker.formatDate('mm/dd/yy', new Date(firstday));
//            var edate = $.datepicker.formatDate('mm/dd/yy', new Date(lastday));
            var date = new Date;
            var startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1));
            var endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1) + 6);
            var sdate = $.datepicker.formatDate( 'mm/dd/yy', startDate );
            var edate = $.datepicker.formatDate( 'mm/dd/yy', endDate);
            $('#dubweek').val(sdate+'-'+edate);
            $('#userweek').val(sdate+'-'+edate);
            var startDate;
            var endDate;
            var selectCurrentWeek = function() {//current week 
                window.setTimeout(function () {
                    $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
                }, 1);
            }
            $('.week-picker').datepicker( {
                showOtherMonths: true,
                selectOtherMonths: true,
                firstDay: 1,
                onSelect: function(dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1));
                    endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - (date.getDay()-1) + 6);
                    var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                    var sdate = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                    var edate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                    $('#dubweek').val(sdate+'-'+edate);
                    selectCurrentWeek();
                },
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day != 0), ''];
                }
            });
            $('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
            $('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#bar').click(function() {
                $('#donutchart').hide();
                $('#number_format_chart').show();
            });
            $('#pie').click(function() {
                $('#number_format_chart').hide();
                $('#donutchart').show();
            });
        });
    </script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Categories', 'Categories in Pakodi'],
                ['Emotions', <?php echo $emotions->count; ?>],
                ['Comedy', <?php echo $comedy->count; ?>],
                ['Satire', <?php echo $satire->count; ?>],
                ['Cinema', <?php echo $cinema->count; ?>],
                ['Romance', <?php echo $romance->count; ?>],
                ['Songs', <?php echo $songs->count; ?>],
                ['Classics', <?php echo $classic->count; ?>],
                ['Quotes', <?php echo $motivational->count; ?>],
                ['ENG', <?php echo $eng->count; ?>],
                ['UGC', <?php echo $ugc->count; ?>],
            ]);
            var options = {
                pieSliceText:'value',
                tooltip:{text:'value'},
                pieHole: 0.1,
            };
            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript"
            src="https://www.google.com/jsapi?autoload={
                    'modules':[{
                    'name':'visualization',
                    'version':'1',
                    'packages':['corechart']
                    }]
            }"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawStuff);
        function drawStuff() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Category');
            data.addColumn('number', 'count');
            var data = google.visualization.arrayToDataTable([
                ['Element', 'Density', { role: 'style' }],
                ['Emotions', <?php echo $emotions->count; ?>, '#e5e4e'],
                ['Comedy', <?php echo $comedy->count; ?>, '#8B1D3B'],
                ['Satire', <?php echo $satire->count; ?>, '#ff6a00'],
                ['Cinema', <?php echo $cinema->count; ?>, '#1DA13A'],
                ['Romance', <?php echo $romance->count; ?>, '#B822B1'],
                ['Songs', <?php echo $songs->count; ?>, '#228EB8'],
                ['Classics', <?php echo $classic->count; ?>, '#21115A'],
                ['Quotes', <?php echo $motivational->count; ?>, '#A1CBAB'],
                ['ENG', <?php echo $eng->count; ?>, '#59B79F'],
                ['UGC', <?php echo $ugc->count; ?>, '#777BB0'],
            ]);
            var options = {
                width: 800,
                height: 300,
                legend: 'none',
                bar: {groupWidth: '45%'},
                hAxis: {title: 'Category', titleTextStyle: {color: '#0000'}},
                vAxis: {title: 'Count', titleTextStyle: {color: '#0000'}, gridlines: { count: 4 } }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart'));
            chart.draw(data, options);
            document.getElementById('format-select').onchange = function() {
                options['vAxis']['format'] = this.value;
                chart.draw(data, options);
            };
        };
    </script>
    <div id="graph_users">
        <script type="text/javascript">
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Year', 'Activeusers', 'Registerusers'],
                    <?php foreach ($datesn as $key=>$value){ ?>
                    ['<?php echo date('D j M-Y', strtotime($value)) ?>',  <?php echo $activecount[$key]; ?>, <?php echo $registercount[$key]; ?>],
                    <?php } ?>
                ]);
                var options = {
                    title: 'Active and Register Users',
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    height: 350,
                    hAxis: { title: 'Weeks' },
                    vAxis: { title: 'Count' }
                };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                chart.draw(data, options);
            }
        </script>
    </div>
    <div id="graph_dubs">
        <script type="text/javascript">
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Year', 'Private', 'Public'],
                    <?php foreach ($dates as $key=>$value){ ?>
                    ['<?php echo date('D j M-Y', strtotime($value)) ?>',  <?php echo $private_dubs[$key]; ?>, <?php echo $public_dubs[$key]; ?>],
                    <?php } ?>

                ]);
                var options = {
                    title: 'Dubs Statistics',
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    height: 350,
                    hAxis: { title: 'Weeks' },
                    vAxis: { title: 'Count' }
                };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));
                chart.draw(data, options);
            }
        </script>
    </div>

<?php }//end of dashboard ?>

<script type="text/javascript">
    $(document).ready(function() {
        <?php
          if(!empty($content) && $content->content_type == 2){ ?>
        document.getElementById("multipleupload").style.display = 'block';
        document.getElementById("file1").value = '';
        document.getElementById("note").innerHTML = 'Upload only mp3 or aac files';
        document.getElementById("filetitle").innerHTML = 'Upload Audio';
        <?php }
          if(!empty($content) && $content->content_type == 1){ ?>
        document.getElementById("multipleupload").style.display = 'block';
        document.getElementById("file1").value='';
        document.getElementById("note").innerHTML = 'Upload only mp4 or aac files';
        document.getElementById("filetitle").innerHTML = 'Upload Video';
        <?php } ?>

    });//ready
</script>
<script>
    var checked = [] ;
    $('#select_all1').click(function(event) {

        if($('input[name="select_all"]').prop('checked') ==  true){
            $('input:checkbox').attr('checked', true);
            $("input[name='approve[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
        }else{
            $('input:checkbox').attr('checked', false);
            checked=[];
        }

    });
    function chk(e){
        if($('#'+$(e).attr('id')).attr('checked')== 'checked'){
            checked =[];
            $("input[name='approve[]']:checked").each(function ()
            {

                checked.push(parseInt($(this).val()));
            });
        }else{
            checked.remove($(this).val());
        }
    }
    $('#approve_button').click(function(){
        var jsonString = JSON.stringify(checked);
        // alert(jsonString);
        $.ajax({
            type:'POST',
            url: base_url +'Admin/content/waitapprove',
            data:{'content':jsonString},
            success:function(data){
                location.reload();
            }
        });
    });

</script>
</body>
</html>