<a name="about"></a>
<div class="intro-header">
    <div class="container">

        <div class="row">
            <div class="col-lg-8" class="col-md-8" class="col-sm-8" >
                <div class="intro-message">
                    <h1 font face="ETNA">CHOWPOCKET</h1>
                    <h3 class="texta">MEET MANILA'S MOST DELICIOUS APP</h3>
                    <hr class="intro-divider">

                    <div class="textc">
                        Hand crafted filipino recipes made using only the freshest ingredients
                    </div>
                    <div class="textc" >
                        and delivered straight to your door.
                    </div>

                    <div class="textc">
                        <h3 class="textd">Coming this 2017</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4" class="col-md-4" class="col-sm-4" >
                <form class="form-horizontal">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email Address">
                        <p class="errors text-danger pull-left" id="email_error"><span class="glyphicon glyphicon-remove"></span> Valid Email Address is required.</p>
                        <p class="errors text-danger pull-left" id="email_exist_error"><span class="glyphicon glyphicon-remove"></span> Email address is already registered.</p>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="fname" placeholder="First Name">
                        <p class="errors text-danger pull-left" id="first_name_error"><span class="glyphicon glyphicon-remove"></span> First Name is required.</p>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="lname" placeholder="Last Name">
                        <p class="errors text-danger pull-left" id="last_name_error"><span class="glyphicon glyphicon-remove"></span> Last Name is required.</p>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="number" class="form-control" id="mobile" placeholder="Mobile Number">
                        <p class="errors text-danger pull-left" id="mobile_error"><span class="glyphicon glyphicon-remove"></span> Valid Mobile Number is required.</p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Company Name">
                        <p class="errors text-danger pull-left" id="address_error"><span class="glyphicon glyphicon-remove"></span> Address is required.</p>
                    </div>
                    <div class="alert alert-success" role="alert" id="sucess-panel">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Hurrah! please check your email for the confirmation of your registration.
                    </div>
                    <div>
                        <button id="submit" class="btn btn-warning">BE THE FIRST ONE IN</button>
                    </div>
                    <br>
                </form>

                <a class="btn btn-social-icon btn-facebook btn-md" >
                    <span class="fa fa-facebook">    </span>

                </a>
                <a class="btn btn-social-icon btn-twitter btn-md">
                    <span class="fa fa-twitter"></span>
                </a>
                <a class="btn btn-social-icon btn-instagram btn-md">
                    <span class="fa fa-instagram"></span>
                </a>
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.intro-header -->


<!-- /.banner -->

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-9" class="col-md-9" class="col-sm-9">
                <p class="copyright text-muted small">Copyright &copy; CHOWPOCKET2016. All Rights Reserved
                </p>
            </div>
            <div class="col-lg-3" class="col-md-3" class="col-sm-3" >
            </div>
        </div>
    </div>
</footer>

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
