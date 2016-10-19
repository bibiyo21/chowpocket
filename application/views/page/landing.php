    <div class="header">
        <h2><b>CHOWPOCKET</b></h2>
    </div>
    <div class="row" id="contents">
        <div class="ccol-sm-6" id="left">
            <h4>Be the first ones in.</h4>
            <form>
                <input class="has-error" id="fname" type="text" placeholder="FIRST NAME" required>
                <input id="lname" type="text" placeholder="LAST NAME">
                <input id="email" type="email" placeholder="EMAIL ADDRESS" required>
                <input id="mobile" type="text" placeholder="MOBILE NUMBER" required>
                <input id="address" type="text" placeholder="STREET ADDRESS" required>
                <span><input id="submit" type="button" value="Get in Line"></span>
            </form>
            <br>
            <div class="panel panel-danger errors" id="error-panel">
                <div class="panel-body ">
                    <p class="errors text-danger" id="first_name_error"><span class="glyphicon glyphicon-remove"></span> First Name is required.</p>
                    <p class="errors text-danger" id="last_name_error"><span class="glyphicon glyphicon-remove"></span> Last Name is required.</p>
                    <p class="errors text-danger" id="email_error"><span class="glyphicon glyphicon-remove"></span> Valid Email Address is required.</p>
                    <p class="errors text-danger" id="email_exist_error"><span class="glyphicon glyphicon-remove"></span> Email address is already registered.</p>
                    <p class="errors text-danger" id="mobile_error"><span class="glyphicon glyphicon-remove"></span> Valid Mobile Number is required.</p>
                    <p class="errors text-danger" id="address_error"><span class="glyphicon glyphicon-remove"></span> Address is required.</p>
                </div>
            </div>
            <div class="panel panel-success" id="sucess-panel">
                <div class="panel-body ">
                    <p class="text-success"><span class="glyphicon glyphicon-ok"></span> You have successfully registered.</p>
                </div>
            </div>
        </div>
        <!--	<br style="clear:both;"/> -->
        <div class="col-sm-6"id="right">
            <div id="texts">
                <p>MEET CHOWPOCKET.</p>
                <p>THE MOST DELICIOUS APP IN BGC</p>
                <h3>Great tasting food delivered straight to your door.</h3>
                    <br />
                    <br />
                    <strong>COMING 2017</strong>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var last_name;
        var first_name;
        var mobile;
        var address;
        var email;
        var subscribe_form;
        var data;
        var xhr;

        $(document).ready(init);

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
                    console.log(data);
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

                    if(errorCount) {
                        $('#error-panel').slideDown('fast');
                    }
                    else {
                        $('#sucess-panel').slideDown('fast');
                    }
                },
                complete: function(){
                    $(':input').prop('disabled', false);
                }
            });
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