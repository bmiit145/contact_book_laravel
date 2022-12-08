<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Show Contacts</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>

<body>
    {{-- @dd($contacts); --}}
    <div class="container-fluid">
        <div style="padding:1% 10% ;">
            <br>
            <div style="position: relative;">
                <button class="btn btn-primary add_con" data-toggle="modal" data-target="#add_con_modal">Add New
                    Contact</button>

                <a href="{{route('log.out')}}" class="btn  btn-danger">Log Out</a>
                <a href="{{ route('forget.password.page') }}" class="btn  btn-info"
                    style="position: absolute; right:0;">Change Password</a>
            </div>
            <br>
            <!-- <form method="post"> -->
            <div style="display : flex ; justify-content: end; align-items: center;">
                <div class="form-group" style="margin: 0;">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Search Here" name="search_text"
                            id="search-box" value="">
                    </div>
                    <!-- <button class="btn btn-success" type="submit" name="search"><i class="fa fa-search"></i></button> -->
                </div>
            </div>
            <!-- </form> -->
            <br>
            <table class="table table-striped table-bordered table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Image</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr style="text-align:center;">
                        <td colspan="7">
                            No Data Found
                        </td>
                    </tr> --}}
                    @foreach ($contacts as $key => $contact)
                        @php
                            $id = $contact->id;
                        @endphp
                        <tr>
                            <td> {{ ++$key }} </td>
                            <td>
                                @if ($contact['image'] != '')
                                    <img src="uploads/{{$contact['image'] }}" height="50" width="50">
                                @endif
                            </td>
                            <td> {{ $contact->first_name }} </td>
                            <td> {{ $contact->last_name }} </td>
                            <td> {{ $contact->email }}</td>
                            <td> {{ $contact->mo_no }}</td>

                            <td>
                                <a href="update_con.php?uid= {{ $id }} "
                                    class="btn btn-sm btn-success">Edit</a>
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn btn-sm btn-danger delete_con"
                                    data-del_id={{ $contact->id }}>Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($page != 1 ) { ?>
                    <li class="page-item"><a href="{{ url('/contact-list?page=' . ($page - 1)) }}" class="page-link"
                            data-page="<?php echo $page - 1; ?>">Previous</a></li>
                    <?php } ?>
                    <?php
                    for ($i = 1; $i <= $count; $i++) {
                        if ($page != $i) {
                    ?>
                    <li class="page-item"><a href="{{ url('/contact-list?page=' . $i) }}" class="page-link"
                            data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php }
                    } ?>
                    <?php if ($page != $count) { ?>
                    <li class="page-item"><a href="{{ url('/contact-list?page=' . ($page + 1)) }} " class="page-link"
                            data-page="<?php echo $page + 1; ?>">Next</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>

    </div>


    {{-- model --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="add_con_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Add Contact</h1>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="add-con-form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-sm-3">First name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Enter first name"
                                    name="first_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="last_name">Last name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="last_name" placeholder="Enter last name"
                                    name="last_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="mo_no">Mobile Number:</label>
                            <div class="col-sm-9">
                                <input type="tel" pattern="[0-9]{10}" class="form-control" id="mo_no"
                                    placeholder="Enter mobile number" name="mo_no" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Email:</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="photo">Photo:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="photo" name="image">
                                <img src="" height="100" id="preview_img">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary add_new_con">ADD</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- form add contact -->
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.add_new_con', function() {
            $('#add-con-form').submit();
        })


        $('#add-con-form').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 2,
                },
                last_name: {
                    minlength: 2,
                },
                mo_no: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                },
                email: {
                    email: true,
                    required: true,
                }

            },
            submitHandler: function(form) {
                // e.preventDefault();
                // var formData = $('#add-con-form').serialize();

                $.ajax({
                    type: 'post',
                    url: '{{ route('add.contact')}}',
                    data: new FormData(form),
                    contentType: false,
                    // cache: false,
                    processData: false,
                    success: function(res) {
                        console.log(res);                        
                        $(document).find('tbody').html($(res).find('tbody').find('tr'));
                        $('#add_con_modal').hide();
                        $('.modal-backdrop').hide();
                    }
                })
            }
        })


        $(document).on('click' ,'.delete_con',  function(){
            var id = $(this).data('del_id');
            $this = $(this);
            $.ajax({
                type:'post',
                url:'{{url("del_con")}}',
                data:{
                    del_id:id,
                },
                success:function(res){
                    $this.parents('tr').hide();
                }
            })
        })
    </script>
</body>

</html>
