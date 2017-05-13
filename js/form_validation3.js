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
            msisdn: {
                required: true,
                regexpress: /^[0-9]{6,16}$/
            },
            password: {
                required: true
            }
        },
        messages: {
            name: "Please enter Name",
            email: { required: "Please enter Email",
                     email: "Please enter Valid email"
                   },
            msisdn: { required:"Please enter Phone Number",
                     regexpress: "please enter digits only"
                   },
            password: "Please enter Password",
        }
    });
    $("#updatemoderator").validate({
        rules: {
            name: {
                required: true,
                regexpress: /^[a-zA-Z ]+$/
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
                required: true
            }
        },
        messages: {
            name: "Please enter Name",
            email: { required: "Please enter Email",
                     email: "Please enter Valid email"
                   },
            msisdn: { required:"Please enter Phone Numbers",
                     regexpress: "please enter digits (6-16) only"
                   },
            password: "Please enter Password",
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

