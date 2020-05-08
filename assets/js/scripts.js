$.validator.addMethod("valueNotEquals", function(value, element, arg) {
    return arg !== value;
}, "Value must not equal arg.");

$(function() {
    $("form[name='login']").validate({
        // Specify validation rules
        rules: {
            password: "required",
            userName: {
                required: {
                    depends: function() {
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                email: true
            },
        },
        // Specify validation error messages
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            userName: "Please enter a proper email address"
        },
        submitHandler: function(form) {
            form.submit();
        }
    });


    /*$("form[name='register']").validate({
        // Specify validation rules
        rules: {
            user_name: "required",
            user_email: {
                required: true,
                email: true
            },
            user_password: "required"
        },
        // Specify validation error messages
        messages: {
            user_password: {
                required: "Please Enter password",
            },
            user_name: {
                required: "Please provide a name",
            },
            user_email: {
                required: "Please Enter Email",
                email: "Please enter proper email address"
            }

        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    */

    $("form[name='submit_data']").validate({

        rules: {
            product_name: "required",
            product_desc: "required",
            file: "required",
            color: { valueNotEquals: "0" },
            product_type: { valueNotEquals: "0" },
            qty: { valueNotEquals: "0" },

        },
        messages: {
            product_name: "Please Enter Product Name",
            product_desc: "Please Enter Product Description",
            file: "Please Select Image",
            color: { valueNotEquals: "Please Select Color" },
            product_type: { valueNotEquals: "Please Select Product Type" },
            qty: { valueNotEquals: "Please Select Quantity" },
        },
        submitHandler: function(form) {
            //form.submit();
        }
    });





});

function showmodel(id) {
    $.ajax({
        url: 'http://localhost/CI_test/dashboard/getdata',
        data: { id_val: id },
        success: function(data) {
            $(".modal-title").text("Edit Product");
            $(".reimg").remove();
            var obj = $.parseJSON(data);
            $(".setimage").html("<div class='imagedata1'><img src='http://localhost/CI_test/assets/images/" + obj['0']['image'] + "' height='40'><a href='javascript:void(0);' onclick='removeimage()'>remove</a></a>");
            $("#rec_id").val(obj['0']['id']);
            $("#product_name").val(obj['0']['name']);
            $("#product_desc").val(obj['0']['description']);
            $('#color').val(obj['0']['color']);
            $('#product_type').val(obj['0']['p_type']);
            $('#qty').val(obj['0']['qty']);
            $('#myModal').modal('show');

        }
    });
}

function delete_row(id) {
    $.ajax({
        url: 'http://localhost/CI_test/dashboard/delete',
        data: { id_val: id },
        success: function(data) {
            $('#empTable').DataTable().ajax.reload();
        }
    });
}

function removeimage() {
    $(".setimg").html('<input type="file" class="form-control" name="file" id="file" placeholder="select Product image">');
    $(".imagedata1").remove();
}