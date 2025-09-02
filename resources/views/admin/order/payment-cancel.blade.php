<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Canceled !</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .payment-success {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .card {
            /* max-width: 450px; */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            text-align: center;
        }
        .success-icon {
            font-size: 60px;
            color: red;
        }
    </style>
</head>
<body>

<div class="container payment-success">
    <div class="row">
        <div class="card col-lg-12 col-12 m-auto">
            <div class="card-body">
                <i class="success-icon bi bi-check-circle-fill"></i>
                <h2 class="my-4 text-danger">Payment Canceled !</h2>
                <p class="text-muted">Your payment was canceled.</p>
                <div class="mt-5">
                    <a href="/" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('frontend/assets/css/bootstrap.bundle.min.js') }}"></script>

</body>
</html>

