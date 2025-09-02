@php
$setting = \App\Models\Setting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="{{ asset('storage/'.$setting->favicon) }}" rel="icon">
    <link href="{{ asset('storage/'.$setting->favicon) }}" rel="apple-touch-icon">
    
    
    <title>Installtion</title>
    
    <link rel="stylesheet" href="{{ asset('admin/') }}/css/adminlte.min.css">
    <style>
        @media (max-width:575px) {
            label {
                font-size: 14px;
            }
        }

        label {
            font-weight: 400 !important;
        }
    </style>
</head>

<body>
    <!-- Main content -->
    <section class="content pt-2">
        <div class="container">
            <div class="row">

                <div class="col-lg-9 mx-auto">
                    <div class="card">
                        <form action="{{ route('customer.feedback.store') }}" method="POST">
                            @csrf
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <img src="{{ asset('frontend/logo.png') }}" alt="img-fluid m-auto" width="175px">
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-3">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-4 col-5">
                                                <div class="form-group">
                                                    <label class="d-block mb-3 mt-3" for="customerName">Customer Name :
                                                    </label>
                                                    <label class="d-block mb-3" for="orderNumber">Book Number :
                                                    </label>
                                                    <label class="d-block" for="installationDate">Date of Installation :
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-7">
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-control form-control-border border-width-2"
                                                        id="customerName" value="{{ $data->book->name }}">
                                                    <input type="number"
                                                        class="form-control form-control-border border-width-2"
                                                        id="orderNumber" value="{{ $data->book->book_id }}">
                                                    <input type="text"
                                                        class="form-control form-control-border border-width-2"
                                                        id="installationDate" value="{{ $data->install_date ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="font-weight-bold">Checklist : </p>
                                        </div>

                                        <div class="col-lg-12">
                                            <ol>
                                                <li class="mb-2">Brackets Installation :
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="brackets" value="option1" name="bracketOne" {{ $data->feedback?->bracketOne ? 'checked' : '' }}>
                                                        <label for="brackets" class="custom-control-label">Brackets
                                                            fixed correctly, with no damage to the wall or surrounding
                                                            areas.</label>
                                                    </div>
                                                </li>


                                                <li class="mb-2">Mechanism Check :
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="mechanism_check_one" value="option1"
                                                            name="mechanismOne" {{ $data->feedback?->mechanismOne ? 'checked' : '' }}>
                                                        <label for="mechanism_check_one"
                                                            class="custom-control-label">Curtains are moving smoothly on
                                                            the tracks.</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="mechanism_check_two" value="option2"
                                                            name="mechanismTwo" {{ $data->feedback?->mechanismTwo ? 'checked' : '' }}>
                                                        <label for="mechanism_check_two"
                                                            class="custom-control-label">Roller
                                                            blind pull chain checked
                                                            and operating properly.</label>
                                                    </div>
                                                </li>


                                                <li class="mb-2">Motorized Systems :
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="motorized_one" value="option1" name="motorizedOne" {{ $data->feedback?->motorizedOne ? 'checked' : '' }}>
                                                        <label for="motorized_one"
                                                            class="custom-control-label">Motorized
                                                            curtains/tracks/blinds installed and functional.</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="motorized_two" value="option2" name="motorizedTwo" {{ $data->feedback?->motorizedTwo ? 'checked' : '' }}>
                                                        <label for="motorized_two" class="custom-control-label">Remote
                                                            control handed over after explaining controls.</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="motorized_three" value="option3" name="motorizedThree" {{ $data->feedback?->motorizedThree ? 'checked' : '' }}>
                                                        <label for="motorized_three" class="custom-control-label">WiFi
                                                            box set up and integrated with the smart home system (if
                                                            applicable).</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="motorized_four" value="option4" name="motorizedFour" {{ $data->feedback?->motorizedFour ? 'checked' : '' }}>
                                                        <label for="motorized_four" class="custom-control-label">All
                                                            cables securely hidden behind trunking (if
                                                            applicable)</label>
                                                    </div>
                                                </li>

                                                <li class="mb-2">Accessories :
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="accessories_one" value="option1"
                                                            name="accessoriesOne" {{ $data->feedback?->accessoriesOne ? 'checked' : '' }}>
                                                        <label for="accessories_one"
                                                            class="custom-control-label">Tie-back
                                                            hooks installed as
                                                            per customer’s wish.</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="accessories_two" value="option2"
                                                            name="accessoriesTwo" {{ $data->feedback?->accessoriesTwo ? 'checked' : '' }}>
                                                        <label for="accessories_two" class="custom-control-label">Hand
                                                            Moving sticks Installed (if ordered)</label>
                                                    </div>
                                                </li>

                                                <li class="mb-2">Final Checks :
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="final_check_one" value="option1"
                                                            name="finalCheckOne" {{ $data->feedback?->finalCheckOne ? 'checked' : '' }}>
                                                        <label for="final_check_one"
                                                            class="custom-control-label">Check
                                                            for Rail/Roller blind
                                                            Alignment (straightness)</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="final_check_two" value="option2"
                                                            name="finalCheckTwo" {{ $data->feedback?->finalCheckTwo ? 'checked' : '' }}>
                                                        <label for="final_check_two"
                                                            class="custom-control-label">Check
                                                            for stains/ Holes on
                                                            Curtains /Blinds</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="final_check_three" value="option3"
                                                            name="finalCheckThree" {{ $data->feedback?->finalCheckThree ? 'checked' : '' }}>
                                                        <label for="final_check_three"
                                                            class="custom-control-label">Area
                                                            cleaned up
                                                            post-installation.</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="final_check_four" value="option4"
                                                            name="finalCheckFour" {{ $data->feedback?->finalCheckFour ? 'checked' : '' }}>
                                                        <label for="final_check_four"
                                                            class="custom-control-label">Customer provided with
                                                            operation instructions.</label>
                                                    </div>
                                                </li>

                                            </ol>
                                        </div>

                                        <div class="col-lg-12">
                                            <p class="font-weight-bold">Agreement :
                                                <input class="ccustom-control-label" type="checkbox" name="agreement"
                                                    value="1" {{ $data->feedback?->agreement ? 'checked' : '' }}>

                                                <input type="hidden" name="order_code" value="{{ $data->order_code }}">
                                            </p>
                                        </div>

                                        <div class="col-lg-12">
                                            <p class="font-weight-bold">Customer Confirmation : </p>
                                            <p>I confirm that the above points have been checked and are satisfactory.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-4 col-5">
                                                <div class="form-group">
                                                    <label class="d-block mb-3 mt-3" for="customerName">Customer Name
                                                        & Signature : </label>
                                                    <label class="d-block" for="installationDate">Date : </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-8 col-7">
                                                <div class="form-group">
                                                    <input type="text" name="customerName"
                                                        class="form-control form-control-border border-width-2"
                                                        id="customerName" value="{{ $data->feedback?->customerName ? $data->feedback?->customerName : '' }}">
                                                    <input type="text" name="installationDate"
                                                        class="form-control form-control-border border-width-2"
                                                        id="installationDate" value="{{ $data->feedback?->installationDate ? $data->feedback?->installationDate : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="row">
                                            <p class="col-12 mb-0">Installer Confirmation : </p>
                                            <p class="col-12 mb-0">I confirm that the installation has been completed
                                                as per the checklist.</p>
                                            <div class="col-lg-4 col-sm-4 col-5">
                                                <div class="form-group">
                                                    <label class="d-block mb-3 mt-3" for="customerName">Installer Name
                                                        : </label>
                                                    <label class="d-block" for="installationDate">Installer Signature
                                                        : </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-8 col-7">
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-control form-control-border border-width-2"
                                                        id="customerName" value="{{ $data->feedback?->installer_name ? $data->feedback?->installer_name : '' }}" name="installer_name">
                                                    <input type="text"
                                                        class="form-control form-control-border border-width-2"
                                                        id="installationDate" name="installer_signature"
                                                        value="{{ $data->feedback?->installer_signature ? $data->feedback?->installer_signature : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <a href="{{ route('home') }}" class="btn btn-dark mr-2">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


    <script src="{{ asset('admin/') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('admin/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/') }}/js/adminlte.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>
