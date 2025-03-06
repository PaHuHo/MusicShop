<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center">Login</h3>
                        <form method="Post" action="{{route('store-login')}}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" required name="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" required name="password" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" class="form-check-input" name="rememberCheck" value="1">
                                <label class="form-check-label">Remember me</label>
                            </div>
                            @if($fail)
                            <p class="text-danger">Email or password isn't correct</p>
                            @endif
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>