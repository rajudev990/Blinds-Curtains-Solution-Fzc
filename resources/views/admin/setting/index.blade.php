<x-admin-app-layout>
    @section('title') Website Settings @endsection
    @section('css')
    @endsection


    @canany('Setting access')
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <form id="settingForm" method="POST" action="{{ route('admin.setting.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Settings Sections</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="header_logo">Header Logo :</label>
                                            <input type="file" value="{{ $data->header_logo }}" name="header_logo" class="p-1 form-control" id="header_logo" placeholder="Upload header_logo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0]);$('#blah').addClass('d-block')">
                                            @if ($data->header_logo == null)
                                            <img class="mt-3 d-none" id="blah" alt="your header_logo" width="50" height="50" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->header_logo) }}" id="blah" alt="your header_logo" width="50" height="50" style="border:1px dashed black" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="footer_logo">Footer Logo :</label>
                                            <input type="file" value="{{ $data->footer_logo }}" name="footer_logo" class="p-1 form-control" id="footer_logo" placeholder="Upload footer_logo" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0]);$('#blah1').addClass('d-block')">
                                            @if ($data->footer_logo == null)
                                            <img class="mt-3 d-none" id="blah1" alt="your footer_logo" width="50" height="50" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->footer_logo) }}" id="blah1" alt="your footer_logo" width="50" height="50" style="border:1px dashed black" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="favicon">Favicon :</label>
                                            <input type="file" value="{{ $data->favicon }}" name="favicon" class="p-1 form-control" id="favicon" placeholder="Upload favicon" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0]);$('#blah2').addClass('d-block')">
                                            @if ($data->favicon == null)
                                            <img class="mt-3 d-none" id="blah2" alt="your favicon" width="50" height="50" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->favicon) }}" id="blah2" alt="your favicon" width="50" height="50" style="border:1px dashed black" />
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="website_name">Website Name :</label>
                                            <input type="text" class="form-control" value="{{ $data->website_name }}" name="website_name" id="website_name" placeholder="Enter name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="whatsapp_number">Whatsapp Number :</label>
                                            <input type="text" class="form-control" value="{{ $data->whatsapp_number }}" name="whatsapp_number" id="whatsapp_number" placeholder="Enter Whatsapp Number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="address">Address :</label>
                                            <input type="text" class="form-control" value="{{ $data->address }}" name="address" id="address" placeholder="Enter address" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email :</label>
                                            <input type="email" class="form-control" value="{{ $data->email }}" name="email" id="email" placeholder="Enter email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="phone">Phone :</label>
                                            <input type="text" class="form-control" value="{{ $data->phone }}" name="phone" id="phone" placeholder="Enter phone" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="footer_text">Footer Text :</label>
                                            <input type="text" class="form-control" value="{{ $data->footer_text }}" name="footer_text" id="footer_text" placeholder="Enter Text" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="copy_wright">CopyRight :</label>
                                            <input type="text" class="form-control" value="{{ $data->copy_wright }}" name="copy_wright" id="copy_wright" placeholder="Enter copyright" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="follow_us">Follow Us Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->follow_us }}" name="follow_us" id="follow_us" placeholder="Enter Follow us title" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="google_map">Goole Map :</label>
                                            <textarea type="text" cols="30" rows="5" class="form-control" name="google_map" id="google_map" placeholder="Enter Embded Iframe">{{ $data->google_map }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->meta_title }}" name="meta_title" id="meta_title" placeholder="Enter meta title">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description :</label>
                                            <textarea id="meta_description" cols="5" rows="4" class="form-control" name="meta_description">{!! $data->meta_description !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keyword (every word then , use) :</label>
                                            <textarea id="meta_keywords" cols="5" rows="4" class="form-control" name="meta_keywords">{!! $data->meta_keywords !!}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="meta_image">Meta Image :</label>
                                            <input type="file" value="{{ $data->meta_image }}" name="meta_image" class="p-1 form-control" placeholder="Upload meta_image" onchange="document.getElementById('meta_image').src = window.URL.createObjectURL(this.files[0]);$('#meta_image').addClass('d-block')">
                                            @if ($data->meta_image == null)
                                            <img class="mt-3 d-none" id="meta_image" alt="your meta_image" width="50" height="50" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->meta_image) }}" id="meta_image" alt="your meta_image" width="50" height="50" style="border:1px dashed black" />
                                            @endif
                                        </div>
                                    </div>




                                </div>
                                <div class=" d-flex justify-content-end pb-2 pt-3">
                                    <a href="{{ route('admin.setting.index') }}" class="btn btn-outline-dark custom-btn">Back</a>
                                    <button type="submit" class="btn btn-primary ml-3 custom-btn">Update</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endcanany

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