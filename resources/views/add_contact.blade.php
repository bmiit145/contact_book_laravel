<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("location:index.php");
}

$connect = mysqli_connect('localhost', 'root', '', 'contact_book');

    $first_name = $_POST['first_name'];
    $last_name = $_POST["last_name"];
    $mo_no = $_POST["mo_no"];
    $email = $_POST["email"];
    $user_id = $_SESSION['id'];
    
    
    //  For image
    if ($_FILES['image']["name"] != '') {
        $img_name = time() . rand(1000, 9999) . $_FILES['image']["name"];
        // print_r($_FILES['image']);
        if (!is_dir('uploads')) {
            mkdir('uploads');
        }

        $target_file = "uploads/" . $img_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    $query = "INSERT INTO member(`user_id`,first_name,last_name ,email, mo_no , `image`) VALUES ('$user_id','$first_name' , '$last_name' , '$email', '$mo_no' , '$img_name')";

    $con = mysqli_query($connect, $query);
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>




    <!-- <div class="container">
        <h2 style="text-align: center; ">Contact Information</h2>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-2">First name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter first name" name="first_name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="last_name">Last name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="mo_no">Mobile Number:</label>
                <div class="col-sm-10">
                    <input type="tel" pattern="[0-9]{10}" class="form-control" id="mo_no" placeholder="Enter mobile number" name="mo_no" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="photo">Photo:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="photo" name="image">
                    <img src="" height="100" id="preview_img">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="save" class="btn btn-primary">ADD</button>
                    <a href="view_contact.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div> -->






    <!-- priview image at real time -->
    <!-- <script>
        $(document).on('change','#photo',function(){
            var src =  this.files[0];
            // console.log(this.files);
            let reader = new FileReader();
            reader.onload = function(event){
                console.log(event);
                $('#preview_img').attr('src', event.target.result);
            }
          reader.readAsDataURL(src);
            // $("#preview_img").attr('src',src);
        })
    </script> -->
</body>

</html>