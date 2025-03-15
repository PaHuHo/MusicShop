@extends('layout/layout')

@section('title-content','Product')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <form style="margin:30px;" id="formSearchProduct" method="get" action="">
        @csrf
        <div class="row">
            <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="nameSearch" placeholder="Enter name" name="name">
            </div>
            <div class="col">
                <label for="category_search" class="form-label">Category</label>
                <select id="category_search" class="form-control" name="category">
                    <option value="">Choose category</option>

                </select>
            </div>
            <div class="col">
                <label for="is_sales" class="form-label">Status</label>
                <select id="is_sales" class="form-control" name="is_sales">
                    <option value="">Choose status</option>
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
            </div>
            <div class="col">
                <label for="price_min" class="form-label">Price min</label>
                <input type="number" class="form-control" id="price_min" name="price_min">
            </div>
            <div class="col">
                <label for="price_max" class="form-label">Price max</label>
                <input type="number" class="form-control" id="price_max" name="price_max">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <a class="btn btn-success" id="create_product" data-toggle="modal" data-target="#createForm"><i class="fa fa-plus-circle" style="padding-right:5px"></i>Add Product</a>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-labeled btn-primary">
                            <i class="fa fa-search"></i>Search</button>
                    </div>
                    <div class="col delete-search">
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
                            <table id="example2" class="table table-bordered table-hover" style="width: 100%; table-layout: fixed;">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="width: 5%;">#</th>
                                        <th>ID Product</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th style="width: 25%;">Function</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data">

                                </tbody>

                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- Paginate -->
                    <div id="paginate">
                    </div>
                    <!-- /.paginate -->
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


<!-- Model form add product -->
<div class="modal fade " id="createForm" tabindex="-1" role="dialog" data-backdrop="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
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
                        <h3 class="panel-title">Add Product</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger" id="error_messege_create" style="display:none"></div>
                        <form id="formAddProduct" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" placeholder="Enter product name" name="productName">
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="productPrice" placeholder="Enter product price" name="productPrice">
                            </div>
                            <div class="mb-3">
                                <label for="productQuantity" class="form-label">Product Quantity</label>
                                <input type="number" class="form-control" id="productQuantity" placeholder="Enter product quantity" name="productQuantity">
                            </div>
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Product Category</label>
                                <select class="form-control" id="productCategory" name="productCategory">

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Product Description</label>
                                <textarea class="ckeditor form-control" name="productDescription" id="productDescription" placeholder="Enter product description" rows="5"></textarea>
                                <!-- <input type="text" class="form-control" id="productName" placeholder="Enter product name" name="productName"> -->
                            </div>
                            <div class="mb-3">
                                <label for="discount">Discount:</label>
                                <input type="range" id="discount" name="productDiscount" min="0" max="100" value="0" step="1">
                                <span id="discountValue">0</span>%
                            </div>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file" id="productImage" accept="image/*" name="productImage">
                                <label class="custom-file-label" for="productImage">Choose file</label>
                            </div>
                            <div class="mb-3">
                                <img id="imagePreview" src="" alt="Xem trước ảnh" style="display: none; width: 100px; height: auto;">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Model form update product -->
<div class="modal fade " id="updateForm" tabindex="-1" role="dialog" data-backdrop="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
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
                        <h3 class="panel-title">Update Product</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger" id="error_messege_update" style="display:none"></div>
                        <form id="formUpdateProduct" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input hidden type="text" class="form-control" id="productIDUpdate" name="productId" readonly>

                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productNameUpdate" placeholder="Enter product name" name="productName">
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="productPriceUpdate" placeholder="Enter product price" name="productPrice">
                            </div>
                            <div class="mb-3">
                                <label for="productQuantity" class="form-label">Product Quantity</label>
                                <input type="number" class="form-control" id="productQuantityUpdate" placeholder="Enter product quantity" name="productQuantity">
                            </div>
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Product Category</label>
                                <select class="form-control" id="productCategoryUpdate" name="productCategory">

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Product Description</label>
                                <textarea class="ckeditor form-control" name="productDescription" id="productDescriptionUpdate" placeholder="Enter product description" rows="5"></textarea>
                                <!-- <input type="text" class="form-control" id="productName" placeholder="Enter product name" name="productName"> -->
                            </div>
                            <div class="mb-3">
                                <label for="discount">Discount:</label>
                                <input type="range" id="discountUpdate" name="productDiscount" min="0" max="100" step="1">
                                <span id="discountValueUpdate">0</span>%
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="edit_status" name="productStatus" value="1">
                                <label class="form-check-label" for="edit_status" >Available</label>
                            </div>
                            <div class="mb-3">
                                <input type="file" class="custom-file" id="productImageUpdate" accept="image/*" name="productImage" onchange="document.getElementById('imagePreviewUpdate').src = window.URL.createObjectURL(this.files[0])">
                                <!-- <label class="custom-file-label" for="productImage">Choose file</label> -->
                            </div>
                            <div class="mb-3">
                                <img id="imagePreviewUpdate" src="" alt="Xem trước ảnh" style="display: none; width: 100px; height: auto;">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
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
    let currentSearchParams = ''
    let listCategory = []
    const slider = document.getElementById("discount");
    const output = document.getElementById("discountValue");

    const sliderUpdate = document.getElementById("discountUpdate");
    const outputUpdate = document.getElementById("discountValueUpdate");
    //Hiển thị tên file
    document.getElementById("productImage").addEventListener("change", function(event) {
        let fileName = event.target.files[0] ? event.target.files[0].name : "Choose file";
        event.target.nextElementSibling.innerText = fileName;
    });

    // Hiển thị giá trị của slider
    slider.oninput = function() {
        output.textContent = this.value;
    }
    sliderUpdate.oninput = function() {
        outputUpdate.textContent = this.value;
    }
    $(document).ready(function() {
        window.onload = loadProduct();
        window.onload = loadCategory();

        $("#productImage").change(function(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        });
        $("#productImageUpdate").change(function(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreviewUpdate").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        });

        $(document).on('click', '#create_product', function(event) {
            document.getElementById("error_messege_create").style.display = "none";
            $('#error_messege_create').html('');
        });

        $(document).on('click', '#update_product', function(event) {
            document.getElementById("error_messege_update").style.display = "none";
            $('#error_messege_update').html('');

            $.ajax({
                url: "{{route('get-detail-product',':id')}}".replace(':id', $(this).closest('tr').find('#product_id').text()),
                type: 'GET',
                success: data => {
                    getProductForm(data.product[0])
                }
            })

        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            page = $(this).attr('data-url').split('page=')[1]
            fetchData(page, currentSearchParams);
        });

        $(document).on('click', '#delete_product', function(event) {
            let id = $(this).attr('data-id');
            Swal.fire({
                title: `Are you sure delete product ${id} !!`,
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
            $('#price_min').val('');
            $('#price_max').val('');
            $select = document.querySelector('#is_sales');
            $select.text = 'Choose status';
            $select.value = '';

            $select = document.querySelector('#category_search');
            $select.text = 'Choose category';
            $select.value = '';
            loadProduct()
        })
        $('#formAddProduct').on('submit', function(event) {
            event.preventDefault();

            let form = document.getElementById('formAddProduct');
            //Dùng formData mới lấy dc input là file, dùng serialize không lấy được input file
            let formData = new FormData(form);

            addProduct(formData);
        });

        $('#formUpdateProduct').on('submit', function(event) {
            event.preventDefault();

            let form = document.getElementById('formUpdateProduct');
            //Dùng formData mới lấy dc input là file, dùng serialize không lấy được input file
            let formData = new FormData(form);

            UpdateProduct(formData);
        });

        $('#formSearchProduct').on('submit', function(event) {
            event.preventDefault();

            let form = document.getElementById('formSearchProduct');
            //Dùng formData mới lấy dc input là file, dùng serialize không lấy được input file
            let formData = new FormData(form);
            currentSearchParams = new URLSearchParams(formData).toString()
            fetchData(1, currentSearchParams);
        });

        function loadProduct() {
            fetchData();
        }

        function getProductForm(data = '') {
            $('#productIDUpdate').val(data.product_id);
            $('#productNameUpdate').val(data.name);
            $('#productPriceUpdate').val(data.price);
            $('#productQuantityUpdate').val(data.quantity);
            $('#productDescriptionUpdate').val(data.description);


            $select = document.getElementById('productCategoryUpdate');
            $select.value = data.category.id;

            document.getElementById("discountUpdate").value = data.discount
            document.getElementById("discountValueUpdate").innerText = data.discount

            document.getElementById("edit_status").checked = data.is_sales==1?true:false;
            let img = document.getElementById("imagePreviewUpdate");
            if (data.image.length > 0) {
                img.src = "{{ asset('storage/'.':image') }}".replace(':image', data.image);
                img.style.display = "block";

            } else {
                img.src = "";
                img.style.display = "none";
            }


        }

        async function loadCategory() {
            $.ajax({
                url: '{{route("get-list-category")}}',
                type: 'GET',
                success: function(data) {
                    listCategory = data
                    let selectSearch = document.getElementById("category_search");

                    listCategory.forEach(dt => {

                        let option = document.createElement("option");
                        option.text = dt.name;
                        option.value = dt.id;

                        selectSearch.appendChild(option);
                    })

                    //load category vào select ở model create
                    let select = document.getElementById("productCategory");

                    listCategory.forEach(dt => {

                        let option = document.createElement("option");
                        option.text = dt.name;
                        option.value = dt.id;

                        select.appendChild(option);
                    })

                    let selectUpdate = document.getElementById("productCategoryUpdate");

                    listCategory.forEach(dt => {

                        let option = document.createElement("option");
                        option.text = dt.name;
                        option.value = dt.id;

                        selectUpdate.appendChild(option);
                    })
                }
            })
        }

        async function fetchData(page = 1, searchParams) {
            try {
                $.ajax({
                    url: '{{route("search-product")}}?page=' + page + '&' + searchParams,
                    type: 'GET',
                    success: function(data) {
                        createTableData(data.lstProduct.data, data.lstProduct.from);
                        createPaginate(data.lstProduct.links, data.lstProduct.from);
                    }
                })
            } catch (error) {
                console.error('Có lỗi xảy ra:', error.message);
            }
        }

        function createTableData(data, index) {
            var htmlStr = '<tr>';


            if (data.length != 0) {
                data.forEach(function(dt) {
                    var image = "{{ asset('storage/products/default.jpg') }}"
                    var timestamp = new Date().getTime();
                    if (dt.image.length > 0) {
                        console.log(dt.image)
                        image = "{{ asset('storage/'.':image') }}".replace(':image', dt.image)
                    }
                    html = '<td >' + (index++) + "</td>",
                        html += '<td id="product_id">' + dt.product_id + "</td>",
                        html += `<td id="product_name">` + dt.name + ` <img class='preview-image' src='${image+'?t=' + timestamp}' alt='Product Image'></td>`,
                        html += '<td id="product_price"><span ' + (dt.discount > 0 ? "style='text-decoration: line-through;margin-right:5px'" : "") + '>' + (dt.price + '.00$  ') + "</span> <span style='color:red'>" + (Math.floor(dt.price - (dt.price * (dt.discount / 100)))) + '.00$' + "</span></td>",
                        html += '<td id="product_quantity">' + dt.quantity + "</td>",
                        html += '<td id="product_category">' + dt.category.name + "</td>",
                        html += '<td id="product_quantity">' + (dt.discount + '%') + "</td>",
                        html += '<td id="product_status" class="' + (dt.is_sales == 1 ? 'text-success' : 'text-danger') + '">' + (dt.is_sales == 1 ? 'Available' : 'Unavailable') + "</td>",
                        html += "<td><a id='detail_product' class='btn btn-info' href=" + "{{route('detail-product-page',':id')}}".replace(':id', dt.product_id) + "><i class='fas fa-info'></i>Detail</a><a id='update_product' data-target='#updateForm' data-toggle='modal' class='btn btn-primary'><i class='fas fa-edit'></i>Update</a><a id='delete_product' data-id='" + dt.product_id + "' class='btn btn-danger'><i class='fas fa-delete'></i>Delete</a></td></tr>"
                    htmlStr += html;
                });
            } else {
                htmlStr += "<th colspan='9' style='text-align:center'>NO DATA</th></tr>"
            }

            const parentElement = document.getElementById("table_data");
            $('#table_data').html('');
            parentElement.innerHTML = htmlStr;


        }

        function createPaginate(data, index) {
            var paginateHtml = '';
            if (index != null) {
                paginateHtml += '<ul class="pagination" >';
                data.forEach(function(link, index) {

                    htmlStr = "<li class='page-item'><a  class='page-link btn' data-url='" + link.url + "'>" + link.label + "</a></li>";
                    paginateHtml += htmlStr

                })
                paginateHtml += '</ul></>'
            }

            const paginateElement = document.getElementById('paginate');
            $('#paginate').html('');
            paginateElement.innerHTML = paginateHtml
        }

        function addProduct(FormData) {
            try {
                $.ajax({
                    url: '{{route("create-product")}}',
                    type: 'POST',
                    data: FormData,
                    processData: false, // Đảm bảo không tự động chuyển đổi data thành query string
                    contentType: false,
                    success: data => {
                        Swal.fire({
                                title: data.message,
                                icon: data.status,
                                showCancelButton: false,
                                showConfirmButton: false,
                                position: 'center',
                                timer: 1500,
                            }),
                            setTimeout(function() {
                                loadProduct();
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
                })
            } catch (errors) {
                console.log('loi')
            }
        }

        function UpdateProduct(formdata) {
            try {
                $.ajax({
                    url: '{{route("edit-product")}}',
                    type: 'POST',
                    data: formdata,
                    processData: false, // Đảm bảo không tự động chuyển đổi data thành query string
                    contentType: false,
                    success: data => {
                        Swal.fire({
                                title: data.message,
                                icon: data.status,
                                showCancelButton: false,
                                showConfirmButton: false,
                                position: 'center',
                                timer: 1500,
                            }),
                            setTimeout(function() {
                                loadProduct();
                                $('#updateForm').modal('hide');
                            }, 1500);
                    },
                    error: function(errors) {
                        $('.alert-danger').html('');

                        Object.entries(errors.responseJSON.errors).forEach(([key, value]) => {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    }
                })
            } catch (errors) {
                console.log('loi')
            }
        }

        function deleteUser(id) {
            $.ajax({
                url: "{{route('delete-product',':id')}}".replace(':id', id),
                type: 'POST',
                success: data => {
                    Swal.fire({
                        title: data.message,
                        icon: data.status,
                        showCancelButton: false,
                        showConfirmButton: false,
                        position: 'center',
                        timer: 1500,
                    })
                    setTimeout(function() {
                        loadProduct();
                    }, 1500);
                }
            })
        }
    })
</script>
@endsection