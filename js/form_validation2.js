$(document).ready(function () {

    $.validator.addMethod("regexpress",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Invalid input"
            );

    $("#addcategory").validate({
        rules: {
            category: {
                required: true,
            }
        },
        messages: {
            category: "Please enter Category",
        }
    });
    $("#updatecategory").validate({
        rules: {
            category: {
                required: true,
            }
        },
        messages: {
            category: "Please enter Category",
        }
    });
    $("#addmoderator").validate({
        rules: {
            name: {
                required: true,
                regexpress: /^[a-zA-Z ]+$/
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            password: {
                required: true
            },
            usertype: {
                required: true
            }  
            
        },
        messages: {
            category: "Please enter Category",
        }
    });
    $("#addcarousal").validate({
        rules: {
            file_type: {  
                required: true
            } 
        },
        messages: {
            file_type: "Please select file type"
        }
    });
    $("#addcontent").validate({
        rules: {
            title: {
                required: true
            }
        },
        messages: {
            title: "Please enter Title",
        }
    });
    $("#updatecontent").validate({
        rules: {
            title: {
                required: true
            }
        },
        messages: {
            title: "Please enter Title",
        }
    });
    
    
    
    
});//ready

