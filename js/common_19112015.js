$(document).ready(function () {  //alert("I am in common js");

    if ($('.datatable-1').length > 0) {
        $('.datatable-1').dataTable({"sPaginationType": "full_numbers","bSort":false,"iDisplayLength": 100,
            "aLengthMenu": [[100, 200, 500], [100, 200, 500]]

        });
        $('.dataTables_paginate').addClass('datatable-pagination');
        //$('td').css('text-overflow', 'ellipsis');
        //$('td').css('height', '100px');
       // $('td').css('overflow-y', 'hidden');
        //$('.dataTables_paginate > a').wrapInner('<span />');
        //$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        //$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    }


    $('.datatable-2').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/users/getData',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });

    $('.datatable-3').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/category/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            //{"sWidth": "10%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    $('.datatable-4').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/users/getMODData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    var contentTable = $('.datatable-6').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/content/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "3%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    //filter by daterange content
    $('#contentsubmit').on('click', function () {
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var catid = $('#catid').val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        contentTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        contentTable.fnFilter(todate, 1, true);
        contentTable.fnFilter(catid, 2, true); //Exact value, column, reg
    });
    $('#contentreset').on('click', function () {
        $("#fromdate").val('');
        $("#todate").val('');
        $("#catid").val('');
        contentTable.fnFilter('', 0, true);
        contentTable.fnFilter('', 1, true);
        contentTable.fnFilter('', 2, true);
    });
    $('#catid').on('change', function () {
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var selectedValue = $(this).val();
        //alert(selectedValue);
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        contentTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        contentTable.fnFilter(todate, 1, true);
        contentTable.fnFilter(selectedValue, 2, true); //Exact value, column, reg
    });


    $('.datatable-7').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/users/getCOData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });

    $('.datatable-8').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/languages/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });


    var oTable = $('.datatable-9').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'content/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "12%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}
            // {"bVisible": true, "bSearchable": true, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");alert(base_url);
            //alert(sSource);
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    $('#clistsearch').on('click', function () {
        var lanid = $('#lanid').val();
        var categoryid = $('#categoryid').val();
        oTable.fnFilter(lanid, 0, true); //Exact value, column, reg
        oTable.fnFilter(categoryid, 1, true);
    });
    $('#clistreset').on('click', function () {
        $("#lanid").val('');
        $("#categoryid").val('');
        oTable.fnFilter('', 0, true);
        oTable.fnFilter('', 1, true);
    });
    /*$('#lanid').on('change',function(){
     var selectedValue = $(this).val();
     oTable.fnFilter(selectedValue, 0, true); //Exact value, column, reg
     });*/

    $('.datatable-10').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/content/getRData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false}


        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });


    var dubTable = $('.datatable-11').dataTable
    ({//userdubs
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + uriseg + '/getData',
        //'sAjaxSource': base_url + uriseg + '/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "2%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "5%","bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": false, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false}
        ],
        'fnServerData': function (sSource, aoData, fnCallback) {    //alert("I am in commonjs");//alert(base_url);
            //alert(sSource);
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    //user dubs by daterange
    $('#dubsubmit').on('click', function () {
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        dubTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        dubTable.fnFilter(todate, 1, true);
    });
    $('#dubreset').on('click', function () {
        $("#fromdate").val('');
        $("#todate").val('');
        dubTable.fnFilter('', 0, true);
        dubTable.fnFilter('', 1, true);
    });
    var recordTable = $('.datatable-17').dataTable
    ({//Records
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + uriseg + '/getRData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "8%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) {
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    //Rec by daterange
    $('#recsubmit').on('click', function () {
        var fromdate = $('#rec_fromdate').val();
        var todate = $('#rec_todate').val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        recordTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        recordTable.fnFilter(todate, 1, true);
    });
    $('#recreset').on('click', function () {
        $("#rec_fromdate").val('');
        $("#rec_todate").val('');
        recordTable.fnFilter('', 0, true);
        recordTable.fnFilter('', 1, true);
    });


    $('.datatable-13').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/randomusers/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [

            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });

    var recordTable1 = $('.datatable-14').dataTable
    ({//Records
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + uriseg + '/getMData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "8%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "5%","bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "15%", "bVisible": false, "bSearchable": true, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "23%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) {
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    //Rec by daterange
    $('#delsubmit').on('click', function () {
        var fromdate = $('#rec_fromdate').val();
        var todate = $('#rec_todate').val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        recordTable1.fnFilter(fromdate, 0, true); //Exact value, column, reg
        recordTable1.fnFilter(todate, 1, true);
    });
    $('#delreset').on('click', function () {
        $("#rec_fromdate").val('');
        $("#rec_todate").val('');
        recordTable1.fnFilter('', 0, true);
        recordTable1.fnFilter('', 1, true);
    });

    var dubdelrecordTable = $('.datatable-15').dataTable
    ({//Records
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + uriseg + '/getNData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "8%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "15%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "23%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) {
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });

    //Rec by daterange
    $('#delrecsubmit').on('click', function () {
        var fromdate = $('#rec_fromdate').val();
        var todate = $('#rec_todate').val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        dubdelrecordTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        dubdelrecordTable.fnFilter(todate, 1, true);
    });
    $('#delrecreset').on('click', function () {
        $("#rec_fromdate").val('');
        $("#rec_todate").val('');
        dubdelrecordTable.fnFilter('', 0, true);
        dubdelrecordTable.fnFilter('', 1, true);
    });

    var contentmTable = $('.datatable-16').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/content/getMData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    //filter by daterange content
    $('#delcontentsubmit').on('click', function () {
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var catids = $('#catids').val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        contentmTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        contentmTable.fnFilter(todate, 1, true);
        contentmTable.fnFilter(catids, 2, true);
    });
    $('#delcontentreset').on('click', function () {
        $("#fromdate").val('');
        $("#todate").val('');
        $("#catids").val('');
        contentmTable.fnFilter('', 0, true);
        contentmTable.fnFilter('', 1, true);
        contentmTable.fnFilter('', 2, true);
    });
    $('#catids').on('change', function () {
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var selectedValue = $(this).val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        contentmTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        contentmTable.fnFilter(todate, 1, true);
        contentmTable.fnFilter(selectedValue, 2, true); //Exact value, column, reg
    });


    $('.datatable-22').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/flags/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) {
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });

    $('.datatable-23').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/users/getAdData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });

    $('.datatable-24').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/content/getWData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false}


        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });

    var wTable = $('.datatable-25').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/content/getWDData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false}


        ],
        'fnServerData': function (sSource, aoData, fnCallback) {   //alert("I am in commonjs");
            aoData.push({
                name: 'id',
                value: user_id_details
            });
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    $('#catidval').on('change', function () {
        var selectedValue = $(this).val();
        //alert(selectedValue);
        wTable.fnFilter(selectedValue, 0, true); //Exact value, column, reg
    });

    var aTable = $('.datatable-26').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/alerts/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "12%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}


        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");alert(base_url);
            //alert(sSource);
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });

    var ugcTable = $('.datatable-27').dataTable
    ({//userdubs
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + uriseg + '/getUData',
        //'sAjaxSource': base_url + uriseg + '/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "2%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": false, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) {    //alert("I am in commonjs");//alert(base_url);
            //alert(sSource);
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    //user dubs by daterange
    $('#ugcsubmit').on('click', function () {
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        ugcTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        ugcTable.fnFilter(todate, 1, true);
    });
    $('#ugcreset').on('click', function () {
        $("#fromdate").val('');
        $("#todate").val('');
        ugcTable.fnFilter('', 0, true);
        ugcTable.fnFilter('', 1, true);
    });

    var mugcTable = $('.datatable-28').dataTable
    ({//userdubs
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + uriseg + '/getUData',
        //'sAjaxSource': base_url + uriseg + '/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "2%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false}


        ],
        'fnServerData': function (sSource, aoData, fnCallback) {    //alert("I am in commonjs");//alert(base_url);
            //alert(sSource);
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    //user dubs by daterange
    $('#mugcsubmit').on('click', function () {
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            } else if (fromdate_ts == todate_ts) {
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        mugcTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        mugcTable.fnFilter(todate, 1, true);
    });

    var odTable = $('.datatable-29').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        //'sAjaxSource': base_url + 'dubscontent/getDublistData',
        'sAjaxSource': base_url + 'Admin/dubscontent/getDublistData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            //{"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false}


        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    $('.datatable-30').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/alerts/getBData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false}
        ],
        'fnServerData': function (sSource, aoData, fnCallback) {   //alert("I am in commonjs");

            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });

    var loginTable = $('.datatable-33').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'Admin/loginusers/getData',
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
            $.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        }
    });
    $('#loginusersubmit').on('click', function () {
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        if (fromdate != '' && todate != '') {
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if (fromdate_ts > todate_ts) {
                alert("To-date should be greater than From-date");
                return false;
            }
        }
        loginTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        loginTable.fnFilter(todate, 1, true);
    });

    $('#langid').on('change', function () {
        var selectedValue = $(this).val();
        odTable.fnFilter(selectedValue, 0, true); //Exact value, column, reg
    });

    $('#mugcreset').on('click', function () {
        $("#fromdate").val('');
        $("#todate").val('');
        mugcTable.fnFilter('', 0, true);
        mugcTable.fnFilter('', 1, true);
    });
    $('#dtype').on('change', function () {
        var selectedValue = $(this).val();
        aTable.fnFilter(selectedValue, 0, true); //Exact value, column, reg
    });


    $('.dataTables_paginate').addClass('datatable-pagination');

    //$('.dataTables_paginate > a').wrapInner('<span />');
    //$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
    //$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    $('.dataTables_paginate > span').addClass('datatable-pagination');
    $('.datatable-pagination').css('float', 'middle');
    $('.datatable-pagination > a').css('color', '#e01e1c');
    $('.dataTables_paginate > a').css('color', '#e01e1c');
    $('.dropdown-menu').css('width',$('.nav-user').width() -2);


});