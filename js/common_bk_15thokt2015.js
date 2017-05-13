$(document).ready(function () {  //alert("I am in common js");
    if ($('.datatable-1').length > 0) {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass('btn-group datatable-pagination');
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    }
 
    $('.datatable-2').dataTable 
            ({
                "bAutoWidth": false,
                'bProcessing': true,
                'bServerSide': true,
                'sAjaxSource': base_url + 'Admin/users/getData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
                'sAjaxSource': base_url + 'Admin/category/getData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    //{"sWidth": "10%", "bVisible": true, "bSearchable": true, "bSortable": false},
                    { "sWidth": "10%","bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
                'sAjaxSource': base_url + 'Admin/users/getMODData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
                'sAjaxSource': base_url + 'Admin/content/getData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "14%", "bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "25%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
        $('#contentsubmit').on('click',function(){
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        if(fromdate != '' && todate != ''){
           var fromdate_ts = new Date(fromdate).getTime()
           var todate_ts = new Date(todate).getTime();
           if(fromdate_ts > todate_ts){
              alert("To-date should be greater than From-date");
              return false;
           }else if(fromdate_ts == todate_ts){
              alert("From-date should not be equal to To-date");
              return false;
           }
         }
        contentTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        contentTable.fnFilter(todate, 1, true);
        });
        $('#contentreset').on('click',function(){
            $("#fromdate").val('');
            $("#todate").val('');
            contentTable.fnFilter('', 0, true);
            contentTable.fnFilter('', 1, true);
        });
		
            $('.datatable-7').dataTable 
            ({
                "bAutoWidth": false,
                'bProcessing': true,
                'bServerSide': true,
                'sAjaxSource': base_url + 'Admin/users/getCOData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
                'sAjaxSource': base_url + 'Admin/languages/getData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
        'sAjaxSource': base_url + 'content/getData',
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
                    {"sWidth": "12%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                     {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}
                   // {"bVisible": true, "bSearchable": true, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback)
        { //alert("I am in commonjs");alert(base_url);
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
    $('#lanid').on('change',function(){
        var selectedValue = $(this).val();
        oTable.fnFilter(selectedValue, 0, true); //Exact value, column, reg
    });
            
             $('.datatable-10').dataTable 
            ({
                "bAutoWidth": false,
                'bProcessing': true,
                'bServerSide': true,
                'sAjaxSource': base_url + 'Admin/content/getRData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false}
                   

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
				'sAjaxSource': base_url + uriseg + '/getData',
                //'sAjaxSource': base_url + uriseg + '/getData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"sWidth": "27%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                {    //alert("I am in commonjs");//alert(base_url);
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
        $('#dubsubmit').on('click',function(){
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        if(fromdate != '' && todate != ''){
           var fromdate_ts = new Date(fromdate).getTime()
           var todate_ts = new Date(todate).getTime();
           if(fromdate_ts > todate_ts){
              alert("To-date should be greater than From-date");
              return false;
           }else if(fromdate_ts == todate_ts){
              alert("From-date should not be equal to To-date");
              return false;
           }
         }
        dubTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        dubTable.fnFilter(todate, 1, true);
        });
        $('#dubreset').on('click',function(){
            $("#fromdate").val('');
            $("#todate").val('');
            dubTable.fnFilter('', 0, true);
            dubTable.fnFilter('', 1, true);
        });
		var recordTable = $('.datatable-12').dataTable 
                ({//Records
                "bAutoWidth": false,
                'bProcessing': true,
                'bServerSide': true,
                'sAjaxSource': base_url + uriseg + '/getRData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "8%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "15%", "bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "15%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"sWidth": "23%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                {    
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
			$('#recsubmit').on('click',function(){
			var fromdate = $('#rec_fromdate').val();
			var todate = $('#rec_todate').val();
			if(fromdate != '' && todate != ''){
			   var fromdate_ts = new Date(fromdate).getTime()
			   var todate_ts = new Date(todate).getTime();
			   if(fromdate_ts > todate_ts){
				  alert("To-date should be greater than From-date");
				  return false;
			   }else if(fromdate_ts == todate_ts){
				  alert("From-date should not be equal to To-date");
				  return false;
			   }
			 }
			recordTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
			recordTable.fnFilter(todate, 1, true);
			});
			$('#recreset').on('click',function(){
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
                'sAjaxSource': base_url + 'Admin/randomusers/getData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    				
					{"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false},
					{"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
                'sAjaxSource': base_url + uriseg + '/getMData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "8%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    //{"sWidth": "15%", "bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"sWidth": "23%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                {    
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
            
            var dubdelrecordTable = $('.datatable-15').dataTable 
                ({//Records
                "bAutoWidth": false,
                'bProcessing': true,
                'bServerSide': true,
                'sAjaxSource': base_url + uriseg + '/getNData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "8%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    //{"sWidth": "15%", "bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"sWidth": "23%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                {    
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
			$('#delsubmit').on('click',function(){
			var fromdate = $('#rec_fromdate').val();
			var todate = $('#rec_todate').val();
			if(fromdate != '' && todate != ''){
			   var fromdate_ts = new Date(fromdate).getTime()
			   var todate_ts = new Date(todate).getTime();
			   if(fromdate_ts > todate_ts){
				  alert("To-date should be greater than From-date");
				  return false;
			   }else if(fromdate_ts == todate_ts){
				  alert("From-date should not be equal to To-date");
				  return false;
			   }
			 }
			recordTable1.fnFilter(fromdate, 0, true); //Exact value, column, reg
			recordTable1.fnFilter(todate, 1, true);
			});
			$('#delreset').on('click',function(){
				$("#rec_fromdate").val('');
				$("#rec_todate").val('');
				recordTable1.fnFilter('', 0, true);
				recordTable1.fnFilter('', 1, true);
			});
                        
                        var contentTable = $('.datatable-16').dataTable 
            ({
                "bAutoWidth": false,
                'bProcessing': true,
                'bServerSide': true,
                'sAjaxSource': base_url + 'Admin/content/getMData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "14%", "bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "25%", "bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
        $('#delcontentsubmit').on('click',function(){
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        if(fromdate != '' && todate != ''){
           var fromdate_ts = new Date(fromdate).getTime()
           var todate_ts = new Date(todate).getTime();
           if(fromdate_ts > todate_ts){
              alert("To-date should be greater than From-date");
              return false;
           }else if(fromdate_ts == todate_ts){
              alert("From-date should not be equal to To-date");
              return false;
           }
         }
        contentTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        contentTable.fnFilter(todate, 1, true);
        });
        $('#delcontentreset').on('click',function(){
            $("#fromdate").val('');
            $("#todate").val('');
            contentTable.fnFilter('', 0, true);
            contentTable.fnFilter('', 1, true);
        });
            
            $('.datatable-22').dataTable 
            ({
                "bAutoWidth": false,
                'bProcessing': true,
                'bServerSide': true,
                'sAjaxSource': base_url + 'Admin/flags/getData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
					{"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false}
                   
                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { 
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
                'sAjaxSource': base_url + 'Admin/users/getAdData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"bVisible": true, "bSearchable": false, "bSortable": false}

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
                'sAjaxSource': base_url + 'Admin/content/getWData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false}
                  

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                { //alert("I am in commonjs");
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
            
            $('.datatable-25').dataTable 
            ({
                "bAutoWidth": false,
                'bProcessing': true,
                'bServerSide': true,
                'sAjaxSource': base_url + 'Admin/content/getWDData',
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [
                    {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false}
                  

                ],
                'fnServerData': function (sSource, aoData, fnCallback)
                {   //alert("I am in commonjs");
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
            
 var aTable = $('.datatable-26').dataTable
    ({
        "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': base_url + 'Admin/alerts/getData',
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
                    {"sWidth": "12%", "bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                     {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": false, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false},
                    {"sWidth": "18%", "bVisible": true, "bSearchable": false, "bSortable": false}
                    

        ],
        'fnServerData': function (sSource, aoData, fnCallback)
        { //alert("I am in commonjs");alert(base_url);
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
        'sAjaxSource': base_url + uriseg + '/getUData',
        //'sAjaxSource': base_url + uriseg + '/getData',
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "27%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback)
        {    //alert("I am in commonjs");//alert(base_url);
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
    $('#ugcsubmit').on('click',function(){
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        if(fromdate != '' && todate != ''){
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if(fromdate_ts > todate_ts){
                alert("To-date should be greater than From-date");
                return false;
            }else if(fromdate_ts == todate_ts){
                alert("From-date should not be equal to To-date");
                return false;
            }
        }
        ugcTable.fnFilter(fromdate, 0, true); //Exact value, column, reg
        ugcTable.fnFilter(todate, 1, true);
    });
    $('#ugcreset').on('click',function(){
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
        'sAjaxSource': base_url + uriseg + '/getUData',
        //'sAjaxSource': base_url + uriseg + '/getData',
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "27%", "bVisible": true, "bSearchable": false, "bSortable": false}

        ],
        'fnServerData': function (sSource, aoData, fnCallback)
        {    //alert("I am in commonjs");//alert(base_url);
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
    $('#mugcsubmit').on('click',function(){
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        if(fromdate != '' && todate != ''){
            var fromdate_ts = new Date(fromdate).getTime()
            var todate_ts = new Date(todate).getTime();
            if(fromdate_ts > todate_ts){
                alert("To-date should be greater than From-date");
                return false;
            }else if(fromdate_ts == todate_ts){
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
        'sAjaxSource': base_url + 'dubscontent/getDublistData',
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
        "aaSorting": [[1, 'asc']],
        "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            //{"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false}


        ],
        'fnServerData': function (sSource, aoData, fnCallback)
        { //alert("I am in commonjs");
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
    $('#langid').on('change',function(){
        var selectedValue = $(this).val();
        odTable.fnFilter(selectedValue, 0, true); //Exact value, column, reg
    });

    $('#mugcreset').on('click',function(){
        $("#fromdate").val('');
        $("#todate").val('');
        mugcTable.fnFilter('', 0, true);
        mugcTable.fnFilter('', 1, true);
    });
    $('#dtype').on('change',function(){
        var selectedValue = $(this).val();
        aTable.fnFilter(selectedValue, 0, true); //Exact value, column, reg
    });
            
		
    $('.dataTables_paginate').addClass('btn-group datatable-pagination');
    $('.dataTables_paginate > a').wrapInner('<span />');
    $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
    $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');

});