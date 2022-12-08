<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .error{
            color: red;
        }
    </style>
</head>

<body>
    <x-error_msg></x-error_msg>
    <div class="container">
        <div style="padding:5% 25% ;">
            <h2 style="text-align: center; ">Change Password</h2>
            <form id="con_pass" class="form-horizontal" method="POST" enctype="multipart/form-data"
                action="{{ route('change.password') }}">
                @csrf
                <div class="form-group">
                    <label class="control-label col-sm-4" for="password">Otp</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="otp" placeholder="Enter Otp Here"
                            name="otp">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="password">New Password:</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="new_password" placeholder="Enter New Password"
                            name="new_pwd">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="password">Confirm New Password:</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="con_password" placeholder="Enter New Password"
                            name="con_pwd">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Change</button>
                        <a href="view_contact.php" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        $.validator.addMethod("EqualValue", function(value, element, param) {
            return param == value;
        }, "Not match !")



        $('#con_pass').validate({
            rules: {
                otp: {
                    required: true,
                    number:true,
                    minlength: 6,
                    maxlength: 6
                },
                new_pwd: {
                    required: true,
                },
                con_pwd: {
                    required: true,
                    // EqualValue: "new_pwd",
                    equalTo:"#new_password"
                }
            },
            messages: {
                otp: {
                    minlength: "Enter 6 digits otp.",
                    maxlength: "Enter 6 digits otp."

                },
                new_pwd: {
                    required: "Please enter a Password."
                },
                con_pwd: {
                    required: "Please enter a Confirm Password.",
                    EqualValue:"Password not match.",
                    equalTo:"Password not match.",
                }
            },
            submitHandler: function() {
                $('#con_pass').submit();
            }
        })
    </script>
</body>

</html>
