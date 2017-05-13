/**
 * Created by admin on 12/18/2015.
 */
$(document).on('click','.back-close',function(){
    $('.ajax-call-div').remove();
    $('.main-div').show();
});
$(document).on('click','.open-div',function(){
    if($(this).attr('data-url') != "undefined"){
       // alert($(this).attr('data-url'));
        $.ajax()
        $.get( $(this).attr('data-url'), function( data ) {
            $( ".ajax-div" ).html( data );
            $(".ajax-div > .content").addClass('ajax-call-div');

        });
        $('.main-div').hide();

    }

});
 $(document).ready(function(){
     $('.success').fadeIn('slow').delay(5000).hide(0);
     $('img').parent().parent().attr('padding','1px') ;
     $(window).scroll(function () {
         if ($(this).scrollTop() > 100) {
             $('.scroll-top-div').fadeIn();
         } else {
             $('.scroll-top-div').fadeOut();
         }
     });
     $('.scroll-top-div').click(function(){
         $("html, body").animate({
             scrollTop: 0
         }, 600);
         return false;
     });
 });

$('.menu-item').click(function(){
   /* $('.menu-item').addClass('collapsed');
    $('.menu-item').next().removeClass('in');

    $(this).parent().parent().addClass('in');
    $(this).attr('class','menu-item');
    $(this).next().addClass('in');
    $(this).next().css('height','');*/
    //$(this).parent().parent().parent().find('.menu-item').removeClass('collapsed');
    //$('.menu-item').next().removeClass('in');
    //$(this).removeClass('collapsed');

    if($(this).attr('data-toggle') == 'collapse'){
        $('.menu-item').addClass('collapsed');
        $('.menu-item').next().removeClass('in');
        if($(this).attr('class') == 'menu-item collapsed'){


            if($(this).attr('data-item').length > 0){
                $("#"+$(this).attr('data-item')).removeClass('collapsed');
                $("#"+$(this).attr('data-item')).next().addClass('in');
                //alert('sad');
                $(this).preventDefault()
                $(this).removeClass('collapsed');
                $(this).next().addClass('in');
                //alert('sad');
            }

            //$(this).child('.icon-chevron-up').show();
            //$(this).child('.icon-chevron-down').hide();


        }
    }
    console.log($(this).attr('data-toggle'));
});

/*$(document.body).on('submit', '#randusersexcel_form', function(e){
    $options ={
        success:    function(data) {
            $( ".ajax-div" ).html( data );
        }
    }
    // Set your validation settings and initialize the validate plugin on the form.
    $('#randusersexcel_form').validate({
        rules:{
            excel_file:{
                required:true,
                extension: "xls|csv|xlsx"
            }

        },
        submitHandler: function(form) {
            alert('asda');
            $('#randusersexcel_form').ajaxSubmit($options);
        }

    });
    if($('#randusersexcel_form').valid()){
        e.preventDefault();
        alert('kk');
        //$('#randusersexcel_form').ajaxSubmit($options);
        $('#randusersexcel_form').trigger( "submit" );
    }else{
        e.preventDefault();
    }


});*/
$option ={
    success:    function(data) {
        obj = JSON.parse(data);
        if(obj.code == 200){
            window.location.href = obj.url;
        }else{
            $( ".ajax-div" ).html( data );
        }

    }
}
$(document.body).on('submit', '#updateadminuser', function(e){


$("#updateadminuser").validate({
    rules: {
        name: {
            required: true,
            regexpress: /^[a-zA-Z ]{3,40}$/
        },
        email: {
            required: true,
            email: true
        },
        msisdn: {
            required: true,
            regexpress: /^[0-9]{6,16}$/
        },
        password: {
            required: false,
            pwcheck: true,
            minlength: 8
            //if(pass!=password){
            //regexpress: /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{5,32}$/
            //}
        },
        language_id: {
            required: true
        }
    },
    messages: {
        name: { required: "Please enter Name",
            regexpress: "Please enter Alphabets (3-40 length) only"
        },

        email: { required: "Please enter Email",
            email: "Please enter Valid email"
        },
        msisdn: { required:"Please enter Phone Numbers",
            regexpress: "please enter digits (6-16) only"
        },
        //password: "Please enter Password",
        password: {
            required:"Please enter Password",
            pwcheck:"Must have Alphabets, One Numeric and One Special Character"
            //regexpress: "Please enter Password with one Special character and one Number (5-32 length) only"
        },
        language_id: "Please Select Language",
    },
    submitHandler: function(form) {
        $('#updateadminuser').ajaxSubmit($option);
    }
});

    if($('#updateadminuser').valid()){
        e.preventDefault();
        //$('#randusersexcel_form').ajaxSubmit($options);
        $('#updateadminuser').trigger( "submit" );
    }else{
        e.preventDefault();
    }

});
$.validator.addMethod("pwcheck", function(value) {
    if(value.length == 0 || (/^[A-Za-z0-9\d=!\-@._*#$%&]*$/.test(value) // consists of only these
        && /[a-z]/.test(value) // has a lowercase letter
        && /\d/.test(value))){
        return true;
    }else{
        return false;
    }

});

$(document.body).on('submit', '#updatemoderator', function(e){

$("#updatemoderator").validate({
    rules: {
        name: {
            required: true,
            regexpress: /^[a-zA-Z ]{3,40}$/
        },
        email: {
            required: true,
            email: true
        },
        msisdn: {
            required: true,
            regexpress: /^[0-9]{6,16}$/
        },
        password: {
            required: false,
            pwcheck: true,
            minlength: 8
        },
        language_id: {
            required: true
        }
    },
    messages: {
        name: { required: "Please enter Name",
            regexpress: "Please enter Alphabets (3-40 length) only"
        },

        email: { required: "Please enter Email",
            email: "Please enter Valid email"
        },
        msisdn: { required:"Please enter Phone Numbers",
            regexpress: "please enter digits (6-16) only"
        },
        password: {
            required:"Please enter Password",
            pwcheck:"Must have Alphabets, One Numeric and One Special Character"
            //regexpress: "Please enter Password with one Special character and one Number (5-32 length) only"
        },
        language_id: "Please Select Language",
    },
    submitHandler: function(form) {
        $('#updatemoderator').ajaxSubmit($option);
    }
});


    if($('#updatemoderator').valid()){
        e.preventDefault();
        //$('#randusersexcel_form').ajaxSubmit($options);
        $('#updatemoderator').trigger( "submit" );
    }else{
        e.preventDefault();
    }

});

$(document.body).on('submit', '#updatecontentowner', function(e){
$("#updatecontentowner").validate({
    rules: {
        name: {
            required: true,
            regexpress: /^[a-zA-Z ]{3,40}$/
        },
        email: {
            required: true,
            email: true
        },
        msisdn: {
            required: true,
            regexpress: /^[0-9]{6,16}$/
        },
        password: {
            required: false,
            pwcheck: true,
            minlength: 8
        }
    },
    messages: {
        name: { required: "Please enter Name",
            regexpress: "Please enter Alphabets (3-40 length) only"
        },

        email: { required: "Please enter Email",
            email: "Please enter Valid email"
        },
        msisdn: { required:"Please enter Phone Number",
            regexpress: "please enter digits (6-16) only"
        },
        password: {
            required:"Please enter Password",
            pwcheck:"Must have Alphabets, One Numeric and One Special Character"
            //regexpress: "Please enter Password with one Special character and one Number (5-32 length) only"
        },
    },
    submitHandler: function(form) {
        $('#updatecontentowner').ajaxSubmit($option);
    }
});


    if($('#updatecontentowner').valid()){
        e.preventDefault();
        //$('#randusersexcel_form').ajaxSubmit($options);
        $('#updatecontentowner').trigger( "submit" );
    }else{
        e.preventDefault();
    }

});

$(document.body).on('submit', '#randusersexcel_form', function(e){
    $options ={
        success:    function(data) {
            $( ".ajax-div" ).html( data );
        }
    }
    // Set your validation settings and initialize the validate plugin on the form.
    $('#randusersexcel_form').validate({
        rules:{
            excel_file:{
                required:true,
                extension: "xls|csv|xlsx"
            }
        },
        submitHandler: function(form) {
            $('#error_div').show();
            $('#randusersexcel_form').ajaxSubmit($options);
        }
    });
    if($('#randusersexcel_form').valid()){
        $('#randusersexcel_form').trigger( "submit" );
        $('#error_div').show();
    }else{
        $('#error_div').hide();
        e.preventDefault();
    }
});
//category section
$(document.body).on('submit', '#updatecategory', function(e){

    // Set your validation settings and initialize the validate plugin on the form.
    $("#updatecategory").validate({
        rules: {
            category: {
                required: true,
            }
        },
        messages: {
            category: "Please enter Category",
        },
        submitHandler: function(form) {

            $('#updatecategory').ajaxSubmit($option);

        }
    });
    if($('#updatecategory').valid()){
        e.preventDefault();
        $('#updatecategory').trigger( "submit" );
    }else{
        e.preventDefault();
    }
});
//Language Section
$(document.body).on('submit', '#updatelanguage', function(e){

    // Set your validation settings and initialize the validate plugin on the form.
    $("#updatelanguage").validate({
        rules: {
            language: {
                required: true,
            }
        },
        messages: {
            category: "Please enter Language",
        },
        submitHandler: function(form) {

            $('#updatelanguage').ajaxSubmit($option);

        }
    });
    if($('#updatelanguage').valid()){
        e.preventDefault();
        $('#updatelanguage').trigger( "submit" );
    }else{
        e.preventDefault();
    }
});
//Edit Alerts



