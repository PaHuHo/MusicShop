@extends('layout/layout')

@section('title-content','User')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-success" id="create" data-toggle="modal" data-target="#createForm"><i class="fa fa-user-plus"></i>Add User</a>
                            <!-- <button class="btn btn-success">Add Category</button> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Function</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="pagination" id="paginate">

                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Model form add user -->
<div class="modal fade " id="createForm" tabindex="-1" role="dialog" data-backdrop="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header"
                style="background-color:#e9e9e9; height: 30px; margin: 5px; border: 1px solid #ddd;">
                <div class="modal-title"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="position: absolute;right: 10px;top:10px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top:5px">
                <div class="panel panel-primary" style="border: none;margin-bottom: 0;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add User</h3>
                    </div>
                    <div class="panel-body">
                        <form id="formAddUser" method="POST">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" id="title" name="fullname"
                                        maxlength="40" type="text" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" id="title" name="email"
                                        maxlength="40" type="email" placeholder="Email">
                                </div>
                            </fieldset>
                            <div class="model-footer" style="height: 50px;">

                                <button class="btn btn-primary" type="submit">
                                    Save Changes
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Model form edit user -->
<div class="modal fade " id="editForm" tabindex="-1" role="dialog" data-backdrop="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header"
                style="background-color:#e9e9e9; height: 30px; margin: 5px; border: 1px solid #ddd;">
                <div class="modal-title"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="position: absolute;right: 10px;top:10px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top:5px">
                <div class="panel panel-primary" style="border: none;margin-bottom: 0;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit User</h3>
                    </div>
                    <div class="panel-body">
                        <form id="formEditUser" method="POST">
                            @csrf
                            <fieldset>
                                <input hidden type="text" class="form-control" id="editID" name="id" readonly>
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" id="editName" name="fullname"
                                        maxlength="40" type="text" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" id="editEmail" name="email"
                                        maxlength="40" type="email" placeholder="Email">
                                </div>
                            </fieldset>
                            <div class="model-footer" style="height: 50px;">
                                <button class="btn btn-primary" type="submit">
                                    Save Changes
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@section("js-content")
<script>
    $(document).ready(function() {
        window.onload = loadUsers();
        $(document).on('click', '#edit_user', function(event) {
            $('#editID').val($(this).closest('tr').find('#user_id').text());
            $('#editName').val($(this).closest('tr').find('#user_name').text());
            $('#editEmail').val($(this).closest('tr').find('#user_email').text());
        });

        $(document).on('click', '#delete_user', function(event) {
            id = $(this).closest('tr').find('#user_id').text()
            Swal.fire({
                title: "Are you sure delete this user !!",
                icon: 'warning',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                showCancelButton: true,              
            }).then(() => {
                deleteUser(id)
            });
        });

        function createTableData(data, index) {
            var htmlStr = '<tr>';
            data.forEach(function(dt) {
                html = '<td id="user_id" hidden readonly>' + dt.id + "</td>",
                    html += '<td>' + (index++) + "</td>",
                    html += '<td id="user_name">' + dt.name + "</td>",
                    html += '<td id="user_email">' + dt.email + "</td><td><a id='edit_user' data-target='#editForm' data-toggle='modal' class='btn btn-primary'><i class='fas fa-edit'></i>Update</a><a id='delete_user' data='" + dt.id + "' class='btn btn-danger'><i class='fas fa-delete'></i>Delete</a></td></tr>",
                    htmlStr += html;
            });
            const parentElement = document.getElementById("table_data");
            $('#table_data').html('');
            parentElement.innerHTML = htmlStr;
        }

        function createPaginate(data) {
            var paginateHtml = '';
            data.forEach(function(link, index) {
                htmlStr = "<div class='page-item'><a  class='page-link btn' data-url='" + link.url + "'>" + link.label + "</a></div>";
                paginateHtml += htmlStr
            })
            const paginateElement = document.getElementById('paginate');
            $('#paginate').html('');
            paginateElement.innerHTML = paginateHtml
        }

        async function loadUsers() {
            url = '{{route("list-user")}}',
                fetchData(url)
        }

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            url = $(this).attr('data-url')
            fetchData(url);
        });
        $('#formAddUser').on('submit', function(event) {
            event.preventDefault();
            var formData = $('#formAddUser').serialize();
            addUser(formData);
        });

        $('#formEditUser').on('submit', function(event) {
            event.preventDefault();
            var formData = $('#formEditUser').serialize();
            editUser(formData);
        });

        function editUser(formData) {
            $.ajax({
                url: '{{route("edit-user")}}',
                type: 'POST',
                data: formData,
                success: function(data) {
                    Swal.fire({
                            title: data.message,
                            icon: data.status,
                            showCancelButton: false,
                            showConfirmButton: false,
                            position: 'center',
                            timer: 1500,
                        }),
                        setTimeout(function() {
                            loadUsers();
                            $('#editForm').modal('hide');
                        }, 1500);
                }
            });
        }

        function addUser(formData) {
            $.ajax({
                url: '{{route("create-user")}}',
                type: 'POST',
                data: formData,
                success: function(data) {
                    Swal.fire({
                            title: data.message,
                            icon: data.status,
                            showCancelButton: false,
                            showConfirmButton: false,
                            position: 'center',
                            timer: 1500,
                        }),
                        setTimeout(function() {
                            loadUsers();
                            $('#createForm').modal('hide');
                        }, 1500);
                }
            });
        }

        function deleteUser(id) {
            $.ajax({
                url: "{{route('delete-user')}}/" + id,
                type: 'POST',
                success: function(data) {
                    Swal.fire({
                        title: data.message,
                        icon: data.status,
                        showCancelButton: false,
                        showConfirmButton: false,
                        position: 'center',
                        timer: 1500,
                    })
                    setTimeout(function() {
                        loadUsers();
                        $('#createForm').modal('hide');
                    }, 1500);
                }
            })
        }

        function fetchData(url) {
            try {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {

                        createTableData(data.lstUser.data, data.lstUser.from);
                        createPaginate(data.lstUser.links);

                    }
                })
            } catch (error) {
                console.error('Có lỗi xảy ra:', error.message);
            }
        }
    });
</script>
@endsection