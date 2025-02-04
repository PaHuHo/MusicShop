@extends('layout/layout')

@section('title-content','Category')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item active">Category</li>
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
                        <a class="btn btn-success" id="create" data-toggle="modal" data-target="#createForm"><i class="fa fa-user-plus"></i>Add Category</a>
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
                                <tbody>
                                    @for($i=0;$i<10;$i++)
                                        <tr v-for="category in listCategory">
                                        <td>ID {{$i+1}}</td>
                                        <td>Nhân viên {{$i+1}}</td>
                                        <td>Email {{$i+1}}</td>
                                        <td>
                                            <button class="btn btn-primary"
                                                @click="openModel('#editForm', category)"><i
                                                    class="fas fa-edit"></i>Update</button>

                                            <button class="btn btn-danger"
                                                @click="openModel('#editForm', category)"><i
                                                    class="fas fa-delete"></i>Delete</button>
                                        </td>
                                        </tr>
                                        @endfor
                                </tbody>
                                <tfoot>
                                    <!-- <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Function</th>
                                        </tr> -->
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
                        <h3 class="panel-title">Add Category</h3>
                    </div>
                    <div class="panel-body">
                        <form id="add-event-form">
                            <fieldset>
                                <div class="form-group">
                                    <label>Category name</label>
                                    <input class="form-control" id="title" v-model="nameCategoryAdd" name="title"
                                        maxlength="40" type="text" placeholder="Category name">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

            <div class="model-footer" style="height: 50px;">
                <button class="btn btn-primary" type="button" id="add-category" @click="addCategory()"
                    style="position: absolute;right: 20px;bottom: 10px;">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section("js-content")
<script>
    $(document).ready(function(){
        $(document).on('click', '#create', function(event) {
        });
    })
</script>
@endsection