<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <x-error_msg></x-error_msg>
    <div class="container">
        <div style="padding:5% 30% ;">
            <h2 style="text-align: center; ">Login</h2>
            <form class="form-horizontal" id="user_create_data" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" placeholder="Enter email"
                            name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" placeholder="Enter password"
                            name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="login" id="login" class="btn btn-primary">login</button>
                        <button type="submit" name="signup" id="signup" class="btn btn-primary">SignUp</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        loginReg = 1;
        $('#signup').click(function() {
            loginReg = 0;
            // console.log(2145);
        })
        $('#login').click(function() {
            loginReg = 1;
        })



        $('#user_create_data').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                }
            },
            submitHandler: function(form) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                formData = $('#user_create_data').serialize();
                if (loginReg == 0) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('store-user') }}',
                        data: formData,
                        success: function(res) {
                            // console.log(res);
                            location.reload();
                        }

                    })
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('login-user') }}',
                        data: formData,
                        success: function(res) {
                            console.log(res['status']);
                            if (res['status'] == true) {
                                window.location.replace('/contact-list');
                            }else{
                                alert('User does not match !');
                            }
                        }
                    })
                }
            }
        })
    </script>
</body>

</html>
