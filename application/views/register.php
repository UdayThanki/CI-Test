<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        <br />
        <div class="card">
            <div class="card-body">
                <h3 class="links" align="">User Registration</h3>
                <br />
                <div class="message"></div>
                <div class="panel-dtaa panel-default">

                    <div class="panel-body">
                        <form method="post" name="register" id="submit">
                            <div class="form-group">
                                <label class="links">Enter Your Name</label>
                                <input type="text" name="user_name" class="form-control"
                                    value="<?php echo set_value('user_name'); ?>" />
                                <span class="text-danger"><?php echo form_error('user_name'); ?></span>
                            </div>
                            <div class="form-group links">
                                <label>Enter Your Valid Email Address</label>
                                <input type="text" name="user_email" class="form-control"
                                    value="<?php echo set_value('user_email'); ?>" />
                                <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                            </div>
                            <div class="form-group">
                                <label class="links">Enter Password</label>
                                <input type="password" name="user_password" class="form-control"
                                    value="<?php echo set_value('user_password'); ?>" />
                                <span class="text-danger"><?php echo form_error('user_password'); ?></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="sub">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <a style="color:orange" href="<?php echo base_url()?>login">Already a member ? Go and log in</a>
            </div>

        </div>

    </div>
    <div class="col-md-3"></div>
</div>

<script>
$('#submit').submit(function(e) {
    e.preventDefault();
    if ($("#submit").valid()) {
        $.ajax({
            url: '<?php echo base_url();?>store',
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                var obj = $.parseJSON(data);

                if (obj['user_name'] != null || obj['user_email'] != null || obj['user_password'] !=
                    null) {
                    $('.message').text("");
                    $('.message').html(obj['user_name']);
                    $('.message').append(obj['user_email']);
                    $('.message').append(obj['user_password']);
                } else {
                    $('#submit').trigger("reset");
                    $('.message').text("");
                    $('.message').html(obj);
                }

            }
        });
    } else {
        return false;
    }
});
</script>