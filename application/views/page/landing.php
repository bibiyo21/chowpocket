<!-- Call to Action -->
<aside id="call-to-action" class="call-to-action bg-primary">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 text-center">
                <h1>Sign up to our news letter today!</h1>
                <div class="alert alert-success" role="alert" id="sucess-panel">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Hurrah! please check your email for the confirmation of your registration.
                </div>
            </div>
            <div class="col-lg-8 text-center">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="sr-only col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="Email">
                            <p class="errors text-danger pull-left" id="email_error"><span class="glyphicon glyphicon-remove"></span> Valid Email Address is required.</p>
                            <p class="errors text-danger pull-left" id="email_exist_error"><span class="glyphicon glyphicon-remove"></span> Email address is already registered.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only col-sm-2" for="fname">First Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fname" placeholder="First Name">
                            <p class="errors text-danger pull-left" id="first_name_error"><span class="glyphicon glyphicon-remove"></span> First Name is required.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only col-sm-2" for="lname">Last Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lname" placeholder="Last Name">
                            <p class="errors text-danger pull-left" id="last_name_error"><span class="glyphicon glyphicon-remove"></span> Last Name is required.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only col-sm-2" for="mobile">Contact:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mobile" placeholder="Mobile Number">
                            <p class="errors text-danger pull-left" id="mobile_error"><span class="glyphicon glyphicon-remove"></span> Valid Mobile Number is required.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only col-sm-2" for="address">Address:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" placeholder="Office Address">
                            <p class="errors text-danger pull-left" id="address_error"><span class="glyphicon glyphicon-remove"></span> Address is required.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button id="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</aside>

<script>
    var last_name;
    var first_name;
    var mobile;
    var address;
    var email;
    var subscribe_form;
    var data;
    var xhr;

    $(document).ready(init)

    function onSubmitSubscription()
    {
        var errorCount = 0;
        $('.errors').hide();
        $('#sucess-panel').hide();

        if(xhr && xhr.readyState != 4) {
            xhr.abort();
        }

        xhr = $.ajax({
            url: '<?php echo base_url('index.php/home/register')?>',
            type: 'GET',
            data: data,
            beforeSend: function() {
                $(':input').prop('disabled', true);
            },
            success: function(data){
                $.each(data, function (key, value){
//                        console.log(key);
                    if (value) {
                        errorCount++;
                        switch(key) {
                            case 'first_name_error':
                                $("#first_name_error").show();
                                break;
                            case 'last_name_error':
                                $("#last_name_error").show();
                                break;
                            case 'email_error':
                                $("#email_error").show();
                                break;
                            case 'mobile_error':
                                $("#mobile_error").show();
                                break;
                            case 'address_error':
                                $("#address_error").show();
                                break;
                            case 'email_exist_error':
                                $("#email_exist_error").show();
                                break;
                        }
                    }
                });



                if(!errorCount) {
                    console.log(errorCount);
                    $('input').val('');
                    $('#sucess-panel').slideDown('fast');
                }
//                    else {
//                        $('#sucess-panel').slideDown('fast');
//                    }
            },
            complete: function(){
                $(':input').prop('disabled', false);
            }
        });
    }

    function hideErrors()
    {
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#email_error").hide();
        $("#mobile_error").hide();
        $("#address_error").hide();
        $("#email_exist_error").hide();

    }

    function onSendSubcription(e)
    {
        e.preventDefault();

        data = {};
        data = {
            first_name : first_name.val(),
            last_name : last_name.val(),
            email : email.val(),
            address : address.val(),
            mobile_number : mobile.val(),
        };
        onSubmitSubscription()
    }

    function init()
    {
        $('.errors').hide();
        $('#sucess-panel').hide();

        last_name = $('#lname');
        first_name = $('#fname');
        mobile = $('#mobile');
        email = $('#email');
        address = $('#address');
        subscribe_form = $('#submit');
        subscribe_form.on('click', onSendSubcription);
    }
</script>
