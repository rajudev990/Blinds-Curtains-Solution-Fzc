<x-admin-app-layout>
    @section('title') Smart Curtains Pages @endsection
    @section('css')
    @endsection
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <form id="settingForm" method="POST" action="{{ route('admin.smart-curtains-pages.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Smart Curtains Pages</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="banner_image">Banner Image :</label>
                                            <input type="file" value="{{ $data->banner_image }}" name="banner_image" class="p-1 form-control" id="banner_image" placeholder="Upload banner_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0]);$('#blah').addClass('d-block')">
                                            @if ($data->banner_image == null)
                                            <img class="mt-3 d-none" id="blah" alt="your banner_image" width="50" height="50" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->banner_image) }}" id="blah" alt="your banner_image" width="50" height="50" style="border:1px dashed black" />
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="banner_title">Banner Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->banner_title }}" name="banner_title" id="banner_title" placeholder="Enter Banner Title">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="banner_description">Banner Description :</label>
                                            <textarea cols="30" rows="3" class="form-control" name="banner_description" id="banner_description" placeholder="Description">{{ $data->banner_description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="title">Title :</label>
                                        <input type="text" class="form-control" value="{{ $data->title }}" name="title" id="title" placeholder="Enter title">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="title_description">Description :</label>
                                        <input type="text" class="form-control" value="{{ $data->title_description }}" name="title_description" id="title_description" placeholder="Enter title_description">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="title_text">Text :</label>
                                        <textarea cols="30" rows="7" class="form-control summernote" name="title_text" id="title_text" placeholder="Text">{{ $data->title_text }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="step_one_title">Step-1 Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->step_one_title }}" name="step_one_title" id="step_one_title" placeholder="Enter title">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="step_one_description">Step-1 Description :</label>
                                            <input type="text" class="form-control" value="{{ $data->step_one_description }}" name="step_one_description" id="step_one_description" placeholder="Enter step_one_description">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-12">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="step_one_title_one">Step-1 Title :</label>
                                                    <input type="text" class="form-control" value="{{ $data->step_one_title_one }}" name="step_one_title_one" id="step_one_title_one" placeholder="Enter title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="step_one_title_one_description">Text :</label>
                                                    <textarea cols="30" rows="7" class="form-control" name="step_one_title_one_description" id="step_one_title_one_description" placeholder="Text">{{ $data->step_one_title_one_description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="step_one_title_two">Step-1 Title :</label>
                                                    <input type="text" class="form-control" value="{{ $data->step_one_title_two }}" name="step_one_title_two" id="step_one_title_two" placeholder="Enter title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="step_one_title_two_description">Text :</label>
                                                    <textarea cols="30" rows="7" class="form-control" name="step_one_title_two_description" id="step_one_title_two_description" placeholder="Text">{{ $data->step_one_title_two_description }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="step_two_title">Step-2 Title :</label>
                                        <input type="text" class="form-control" value="{{ $data->step_two_title }}" name="step_two_title" id="step_two_title" placeholder="Enter step_two_title">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="step_two_description">Step-2 Description :</label>
                                        <input type="text" class="form-control" value="{{ $data->step_two_description }}" name="step_two_description" id="step_two_description" placeholder="Enter Text">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="step_two_image">Step-2 Banner Image :</label>
                                        <input type="file" value="{{ $data->step_two_image }}" name="step_two_image" class="p-1 form-control" id="step_two_image" placeholder="Upload step_two_image" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0]);$('#blah1').addClass('d-block')">
                                        @if ($data->step_two_image == null)
                                        <img class="mt-3 d-none" id="blah1" alt="your step_two_image" width="50" height="50" style="border:1px dashed black" />
                                        @else
                                        <img class="mt-3" src="{{ Storage::url($data->step_two_image) }}" id="blah1" alt="your step_two_image" width="50" height="50" style="border:1px dashed black" />
                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row">

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="step_three_title">Step-3 Title :</label>
                                        <input type="text" class="form-control" value="{{ $data->step_three_title }}" name="step_three_title" id="step_three_title" placeholder="Enter copyright">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="step_three_description">Step-3 Description :</label>
                                        <input type="text" class="form-control" value="{{ $data->step_three_description }}" name="step_three_description" id="step_three_description" placeholder="Enter copyright">
                                    </div>
                                </div>
                                </div>
                                </div>
                        </div>
                        <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="step_four_title">Step-4 Title :</label>
                                        <input type="text" class="form-control" value="{{ $data->step_four_title }}" name="step_four_title" id="step_four_title" placeholder="Enter copyright">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="step_five_title">Step-5 Title :</label>
                                        <input type="text" class="form-control" value="{{ $data->step_five_title }}" name="step_five_title" id="step_five_title" placeholder="Enter copyright">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="step_five_description">Step-5 Description :</label>
                                        <input type="text" class="form-control" value="{{ $data->step_five_description }}" name="step_five_description" id="step_five_description" placeholder="Enter copyright">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="step_six_title">Step-6 Title :</label>
                                        <input type="text" class="form-control" value="{{ $data->step_six_title }}" name="step_six_title" id="step_six_title" placeholder="Enter copyright">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class=" d-flex justify-content-end pb-2 pt-3">
                                        <a href="{{ route('admin.setting.index') }}" class="btn btn-outline-dark custom-btn">Back</a>
                                        <button type="submit" class="btn btn-primary ml-3 custom-btn">Update</button>
                                    </div>
                                </div>
                                </div>


                            </div>
                        </div>
                </div>

                </form>
            </div>
        </div>
        </div>
    </section>


    @section('script')
    <script>
        $(function() {
            $('#settingForm').validate({
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    @endsection
</x-admin-app-layout>