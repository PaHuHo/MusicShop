@extends('layout/layout')

@section('title-content','Product | Detail')


@section('main-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1 class="m-0"><a href="{{ route('product-page') }}" style="color:black">
                            <i class="fas fa-arrow-left"></i>
                        </a> Product Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Management</li>
                        <li class="breadcrumb-item"><a href="{{ route('product-page') }}">Product</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="product-detail" id="product_detail">

        <!-- Thông tin sản phẩm -->

    </div>
    <!-- Main content -->

    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>

<!-- update form product -->
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
                            <div class="mb-3">
                                <input type="file" class="custom-file" id="productImage" accept="image/*" name="productImage" onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0])">
                                <!-- <label class="custom-file-label" for="productImage">Choose file</label> -->
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

@endsection

@section("js-content")
<script>
     const sliderUpdate = document.getElementById("discountUpdate");
     const outputUpdate = document.getElementById("discountValueUpdate");

     sliderUpdate.oninput = function() {
        outputUpdate.textContent = this.value;
    }
    $(document).ready(function() {
        window.onload = loadCategory();
        window.onload = getProductDetail();
        $(document).on('click', '#update_product', function(event) {
            document.getElementById("error_messege_update").style.display = "none";
            $('#error_messege_update').html('');
        });

        $(document).on('click', '#delete_product', function(event) {
            let id = $(this).attr('data-id');
            console.log(id)
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
        $('#formUpdateProduct').on('submit', function(event) {
            event.preventDefault();

            let form = document.getElementById('formUpdateProduct');
            //Dùng formData mới lấy dc input là file, dùng serialize không lấy được input file
            let formData = new FormData(form);

            UpdateProduct(formData);
        });
        async function getProductDetail() {
            product_id = window.location.href.split('detail/')[1];
            $.ajax({
                url: "{{route('get-detail-product',':id')}}".replace(':id', product_id),
                type: 'GET',
                success: data => {
                    loadProductDetail(data.product[0])
                    getProductForm(data.product[0])
                }
            });
        }
        async function loadCategory() {
            $.ajax({
                url: '{{route("get-list-category")}}',
                type: 'GET',
                success: function(data) {
                    let selectUpdate = document.getElementById("productCategoryUpdate");

                    data.forEach(dt => {

                        let option = document.createElement("option");
                        option.text = dt.name;
                        option.value = dt.id;

                        selectUpdate.appendChild(option);
                    })
                }
            })
        }
        function getProductForm(data = '') {
            $('#productIDUpdate').val(data.product_id);
            $('#productNameUpdate').val(data.name);
            $('#productPriceUpdate').val(data.price);
            $('#productQuantityUpdate').val(data.quantity);
            $('#productDescriptionUpdate').val(data.description);


            $select = document.getElementById('productCategoryUpdate');
            $select.value = data.category.id;

            document.getElementById("discountUpdate").value=data.discount
            document.getElementById("discountValueUpdate").innerText = data.discount

            let img = document.getElementById("imagePreview");
            img.src = "{{ asset('storage/'.':image') }}".replace(':image', data.image);
            img.style.display = "block";

        }
        function loadProductDetail(data) {
            let image="{{ asset('storage/products/default.jpg') }}"
            if(data.image!=''){
                 image="{{ asset('storage/'.':image') }}".replace(':image',data.image)
            }
           
            
            htmlStr = `<div class="product-header"><h1 class="product-name">${data.name}</h1><div class="product-status">${data.is_sales == 1 ? 'Available' : 'Unavailable'}</div></div><div class="product-main"><div class="product-image"><img id="product_image" src="${image}"alt="Hình ảnh sản phẩm"></div><div class="product-info"><p class="product-price">  <span class="old-price">${data.price+ '.00$'}</span><span class="discounted-price">${(Math.floor(data.price - (data.price * (data.discount / 100)))) + '.00$'}</span></p><div class="product-quantity"><label for="quantity">Quantity: ${data.quantity}</label></div>`

            htmlStr += `<div><a id='edit_product' data-target='#updateForm' data-toggle='modal' class='btn btn-primary'><i class='fas fa-edit'></i>Update</a><a id='delete_product' data-id="${data.product_id}"  class='btn btn-danger'><i class='fas fa-delete'></i>Delete</a></div></div>`

            const parentElement = document.getElementById("product_detail");
            $('#product_detail').html('');
            parentElement.innerHTML = htmlStr;

            var timestamp = new Date().getTime();
            $('#product_image').attr('src', image+'?t=' + timestamp);
        }
        function UpdateProduct(formdata){
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
                                getProductDetail();
                                
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
        function deleteUser(id){
            $.ajax({
                url:"{{route('delete-product',':id')}}".replace(':id',id),
                type:'POST',
                success:data=>{
                    Swal.fire({
                        title: data.message,
                        icon: data.status,
                        showCancelButton: false,
                        showConfirmButton: false,
                        position: 'center',
                        timer: 1500,
                    })
                    setTimeout(function() {
                        window.location.href="{{route('product-page')}}"
                    }, 1500);
                }
            })
        }
    })
</script>
@endsection