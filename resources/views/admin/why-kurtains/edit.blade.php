<x-admin-app-layout>
    @section('title') Edit Why Blinds & Curtains Solution Fzc @endsection
    @php
    $list = \App\Models\GetEstimateTitle::where('status',1)->get();
    @endphp
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('admin.why-kurtains.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="why_kurtains">Estimate Title</label>
                                            <select name="why_kurtains" id="why_kurtains" class="form-control @error('description') is-invalid @enderror">
                                                @foreach($list as $item)
                                                    <option value="{{ $item->id }}" {{ $data->why_kurtains == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                               

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="" value="{{ $data->title }}" required>
                                            @error('title')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="image">Image</label>
                                            <div class="custom-file">
                                                <input value="{{ $data->image }}" name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);$('#image').addClass('d-block')">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                @error('image')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                            @if( $data->image !=null)
                                            <img class="mt-3" src="{{ Storage::url($data->image) }}" id="image" alt="your footer_logo" width="150" height="75" style="border:1px dashed black">
                                            @else
                                            <img class="mt-3 d-none" src="" id="image" alt="your footer_logo" width="150" height="75" style="border:1px dashed black">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" required>{!! $data->description !!}
                                            </textarea>
                                            @error('description')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>Deactive
                                                </option>

                                            </select>
                                            @error('status')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" card-footer d-flex justify-content-end bg-white pb-5">

                                <a href="{{ route('admin.why-kurtains.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
                                <button class="btn btn-primary ml-3 custom-btn" type="submit">Update</button>

                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</x-admin-app-layout>