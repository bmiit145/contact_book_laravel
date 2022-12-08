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
</head>

<body>
    <x-error_msg></x-error_msg>
    <div class="container">
        <div style="padding:5% 25% ;">
            <h2 style="text-align: center; ">Change Password</h2>
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{route('verify.otp')}}">
                @csrf               
                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Email Address:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="email"  name="email" value="{{$email}}" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit"  class="btn btn-success">Send Otp</button>
                        <a href="view_contact.php" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>