<x-admin-app-layout>
    @section('title') About Us @endsection
    @section('css')
    @endsection


    @canany('Setting access')
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <form id="settingForm" method="POST" action="{{ route('admin.aboutus.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update About Us Page</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="bgimage">Background Image :</label>
                                            
                                            <input type="file" value="{{ $data->bgimage }}" name="bgimage" class="p-1 form-control" placeholder="Upload bgimage" onchange="document.getElementById('bgimage').src = window.URL.createObjectURL(this.files[0]);$('#bgimage').addClass('d-block')">
                                            @if ($data->bgimage == null)
                                            <img class="mt-3 d-none" id="bgimage" alt="your bgimage" width="100%" height="250px" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->bgimage) }}" id="bgimage" alt="your bgimage" width="100%" height="250px" style="border:1px dashed black" />
                                            @endif
 
                                           
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="founder_title">Founder Name :</label>
                                            <input type="text" class="form-control" value="{{ $data->founder_title }}" name="founder_title" id="founder_title" placeholder="Enter name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="founder_designation">Founder Designation :</label>
                                            <input type="text" class="form-control" value="{{ $data->founder_designation }}" name="founder_designation" id="founder_designation" placeholder="Enter Designation" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="founder_image">Founder Image :</label>
                                            
                                            <input type="file" value="{{ $data->founder_image }}" name="founder_image" class="p-1 form-control" placeholder="Upload founder_image" onchange="document.getElementById('founder_image').src = window.URL.createObjectURL(this.files[0]);$('#founder_image').addClass('d-block')">
                                            @if ($data->founder_image == null)
                                            <img class="mt-3 d-none" id="founder_image" alt="your founder_image" width="120px" height="75px" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->founder_image) }}" id="founder_image" alt="your founder_image" width="120px" height="75px" style="border:1px dashed black" />
                                            @endif

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="founder_description">Founder Description :</label>
                                            <textarea cols="5" rows="5" class="form-control" name="founder_description" id="founder_description" placeholder="Enter Description">{{ $data->founder_description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="cofounder_title">Cofounder Name :</label>
                                            <input type="text" class="form-control" value="{{ $data->cofounder_title }}" name="cofounder_title" id="cofounder_title" placeholder="Enter name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="cofounder_designation">Cofounder Designation :</label>
                                            <input type="text" class="form-control" value="{{ $data->cofounder_designation }}" name="cofounder_designation" id="cofounder_designation" placeholder="Enter Designation" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="cofounder_image">Cofounder Image :</label>
                                            
                                            <input type="file" value="{{ $data->cofounder_image }}" name="cofounder_image" class="p-1 form-control" placeholder="Upload cofounder_image" onchange="document.getElementById('cofounder_image').src = window.URL.createObjectURL(this.files[0]);$('#cofounder_image').addClass('d-block')">
                                            @if ($data->cofounder_image == null)
                                            <img class="mt-3 d-none" id="cofounder_image" alt="your cofounder_image" width="120px" height="75px" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->cofounder_image) }}" id="cofounder_image" alt="your cofounder_image" width="120px" height="75px" style="border:1px dashed black" />
                                            @endif
                                            
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="cofounder_description">Cofounder Description :</label>
                                            <textarea cols="5" rows="5" class="form-control" name="cofounder_description" id="cofounder_description" placeholder="Enter Description">{{ $data->cofounder_description }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                        <div class="card-header bg-primary">
                                <h1 class="card-title">Vission</h1>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="vision_title">Vission Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->vision_title }}" name="vision_title" id="vision_title" placeholder="Enter Name">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="vision_image">Vission Image :</label>
                                            <input type="file" value="{{ $data->vision_image }}" name="vision_image" class="p-1 form-control" placeholder="Upload vision_image" onchange="document.getElementById('vision_image').src = window.URL.createObjectURL(this.files[0]);$('#vision_image').addClass('d-block')">
                                            @if ($data->vision_image == null)
                                            <img class="mt-3 d-none" id="vision_image" alt="your vision_image" width="50" height="50" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->vision_image) }}" id="vision_image" alt="your vision_image" width="50" height="50" style="border:1px dashed black" />
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="vision_description">Vission Description :</label>
                                            <textarea id="vision_description" cols="30" rows="8" class="form-control summernote" name="vision_description">{!! $data->vision_description !!}</textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="card card-primary">
                        <div class="card-header bg-primary">
                                <h1 class="card-title">Mission</h1>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="mission_title">Mission Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->mission_title }}" name="mission_title" id="mission_title" placeholder="Enter Name">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="mission_image">Mission Image :</label>
                                            <input type="file" value="{{ $data->mission_image }}" name="mission_image" class="p-1 form-control" placeholder="Upload mission_image" onchange="document.getElementById('mission_image').src = window.URL.createObjectURL(this.files[0]);$('#mission_image').addClass('d-block')">
                                            @if ($data->mission_image == null)
                                            <img class="mt-3 d-none" id="mission_image" alt="your mission_image" width="50" height="50" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->mission_image) }}" id="mission_image" alt="your mission_image" width="50" height="50" style="border:1px dashed black" />
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="mission_description">Mission Description :</label>
                                            <textarea id="mission_description" cols="30" rows="8" class="form-control summernote" name="mission_description">{!! $data->mission_description !!}</textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card card-primary">
                            <div class="card-header bg-primary">
                                <h1 class="card-title">Our Commitment</h1>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="partnership_title">Our Commitment Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->partnership_title }}" name="partnership_title" id="partnership_title" placeholder="Enter Name">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="partnership_image">Our Commitment Image :</label>
                                            <input type="file" value="{{ $data->partnership_image }}" name="partnership_image" class="p-1 form-control" placeholder="Upload partnership_image" onchange="document.getElementById('partnership_image').src = window.URL.createObjectURL(this.files[0]);$('#partnership_image').addClass('d-block')">
                                            @if ($data->partnership_image == null)
                                            <img class="mt-3 d-none" id="partnership_image" alt="your partnership_image" width="50" height="50" style="border:1px dashed black" />
                                            @else
                                            <img class="mt-3" src="{{ Storage::url($data->partnership_image) }}" id="partnership_image" alt="your partnership_image" width="50" height="50" style="border:1px dashed black" />
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="partnership_description">Our Commitment Description :</label>
                                            <textarea id="partnership_description" cols="30" rows="8" class="form-control summernote" name="partnership_description">{!! $data->partnership_description !!}</textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class=" d-flex justify-content-end pb-4 pt-2">
                            <a href="{{ route('admin.aboutus.index') }}" class="btn btn-outline-dark custom-btn">Back</a>
                            <button type="submit" class="btn btn-primary ml-3 custom-btn">Update</button>
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