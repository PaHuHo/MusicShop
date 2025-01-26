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

    <form style="margin:30px;" id="formSearchUser" method="get" action="">
        @csrf
        <div class="row">
            <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="nameSearch" placeholder="Enter name" name="name">
            </div>

            <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="emailSearch" name="email" placeholder="Enter email">
            </div>
            <div class="col">
                <label for="is_activeSearch" class="form-label">Status</label>
                <select id="is_activeSearch" class="form-control" name="is_activeSearch">
                    <option value="" selected>Choose status</option>
                    <option value="1">Active</option>
                    <option value="0">No Active</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <a class="btn btn-success" id="create_User" data-toggle="modal" data-target="#createForm"><i class="fa fa-user-plus"></i>Add User</a>
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-labeled btn-primary">
                            <i class="fa fa-search"></i>Search</button>
                    </div>
                    <div class="col-4 delete-search">
                        <a class="btn btn-warning text-light" id="btnRefresh">
                            <i class="fa fa-sync-alt"></i>Refresh</a>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Function</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data">

                                </tbody>
                                <tfoot id="paginate">



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

                <div class="modal-title">

                </div>
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
                        <div class="alert alert-danger" id="error_messege_create" style="display:none"></div>
                        <form id="formAddUser" method="POST">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" id="title" name="fullname"
                                        maxlength="40" type="text" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" id="title" name="email"
                                        maxlength="40" type="email" placeholder="Enter email">
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
                        <div class="alert alert-danger" id="error_messege_edit" style="display:none"></div>
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
                                    <input class="form-control" readonly id="editEmail" name="email"
                                        maxlength="40" type="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="edit_is_active" name="is_active">
                                        <option value="1" selected>Active</option>
                                        <option value="0">No active</option>
                                    </select>
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
    searchForm = document.getElementById('formSearchUser');

    let currentSearchParams = '';
    $(document).ready(function() {
        window.onload = loadUsers();

        $(document).on('click', '#create_User', function(event) {
            document.getElementById("error_messege_create").style.display = "none";
            $('#error_messege_create').html('');
        });

        $(document).on('click', '#edit_user', function(event) {
            document.getElementById("error_messege_edit").style.display = "none";
            $('#error_messege_edit').html('');

            $('#editID').val($(this).closest('tr').find('#user_id').text());
            $('#editName').val($(this).closest('tr').find('#user_name').text());
            $('#editEmail').val($(this).closest('tr').find('#user_email').text());

            var active = $(this).closest('tr').find('#user_status').text();

            $select = document.getElementById('edit_is_active');
            $select.value = active == 'Active' ? 1 : 0;
        });


        $(document).on('click', '#delete_user', function(event) {
            id = $(this).closest('tr').find('#user_id').text()
            Swal.fire({
                title: "Are you sure delete this user !!",
                icon: 'warning',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                showCancelButton: true,
            }).then((result) => {
                if (result['isConfirmed']) {
                    deleteUser(id)
                }
            });
        });

        $(document).on('click', '#btnRefresh', function(event) {
            event.preventDefault;
            $('#nameSearch').val('');
            $('#emailSearch').val('');
            $select = document.querySelector('#is_activeSearch');
            $select.text = 'Choose status';
            $select.value = '';
            loadUsers()
        })

        function createTableData(data, index) {
            var htmlStr = '<tr>';
            if (data.length != 0) {
                data.forEach(function(dt) {
                    html = '<td id="user_id" hidden readonly>' + dt.id + "</td>",
                        html += '<td >' + (index++) + "</td>",
                        html += '<td id="user_name">' + dt.name + "</td>",
                        html += '<td id="user_email">' + dt.email + "</td>",
                        html += '<td id="user_status" class="' + (dt.is_active == 1 ? 'text-success' : 'text-danger') + '">' + (dt.is_active == 1 ? 'Active' : 'No active') + "</td>",
                        html += "<td><a id='edit_user' data-target='#editForm' data-toggle='modal' class='btn btn-primary'><i class='fas fa-edit'></i>Update</a><a id='delete_user' data='" + dt.id + "' class='btn btn-danger'><i class='fas fa-delete'></i>Delete</a></td></tr>"
                    htmlStr += html;
                });
            } else {
                htmlStr += "<th colspan='4' style='text-align:center'>NO DATA</th></tr>"
            }

            const parentElement = document.getElementById("table_data");
            $('#table_data').html('');
            parentElement.innerHTML = htmlStr;
        }

        function createPaginate(data, index) {
            var paginateHtml = '';
            if (index != null) {
                paginateHtml += '<tr><th class="pagination" >';
                data.forEach(function(link, index) {

                    htmlStr = "<div class='page-item'><a  class='page-link btn' data-url='" + link.url + "'>" + link.label + "</a></div>";
                    paginateHtml += htmlStr

                })
                paginateHtml += '</th></tr>'
            }

            const paginateElement = document.getElementById('paginate');
            $('#paginate').html('');
            paginateElement.innerHTML = paginateHtml
        }

        async function loadUsers() {
            fetchData()
        }

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            page = $(this).attr('data-url').split('page=')[1]
            fetchData(page, currentSearchParams);
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

        $('#formSearchUser').on('submit', function(event) {
            event.preventDefault();
            formData = new FormData(searchForm);
            currentSearchParams = new URLSearchParams(formData).toString()
            fetchData(1, currentSearchParams)
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
                },
                error: function(errors) {
                    $('.alert-danger').html('');

                    Object.entries(errors.responseJSON.errors).forEach(([key, value]) => {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                }
            });
        }

        async function addUser(formData) {
            try {
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
                    },
                    error: function(errors) {
                        $('.alert-danger').html('');

                        Object.entries(errors.responseJSON.errors).forEach(([key, value]) => {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    }
                });
            } catch (errors) {

            }
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


        function fetchData(page = 1, searchParams) {
            try {
                $.ajax({
                    url: '{{route("search-user")}}?page=' + page + '&' + searchParams,
                    type: 'GET',
                    success: function(data) {
                        createTableData(data.lstUser.data, data.lstUser.from);
                        createPaginate(data.lstUser.links, data.lstUser.from);
                    }
                })
            } catch (error) {
                console.error('Có lỗi xảy ra:', error.message);
            }
        }
    });
</script>
@endsection