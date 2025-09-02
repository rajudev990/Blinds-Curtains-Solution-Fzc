<x-admin-app-layout>
    @section('title') Section Title @endsection
    @section('css')
    @endsection
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <form id="settingForm" method="POST" action="{{ route('admin.section-title.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Section Sections</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="home_section_title">Home Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->home_section_title }}" name="home_section_title" id="home_section_title" placeholder="Enter name">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="service_section_title">Service Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->service_section_title }}" name="service_section_title" id="service_section_title" placeholder="Enter name">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="service_section_description">Service Section Description :</label>
                                            <textarea type="text" class="form-control" cols="30" rows="3" name="service_section_description" id="service_section_description" placeholder="Enter name">{{ $data->service_section_description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="best_seller_section_title">Best Seller Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->best_seller_section_title }}" name="best_seller_section_title" id="best_seller_section_title" placeholder="Enter name">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="best_seller_section_description">Best Seller Section Description :</label>
                                            <textarea type="text" class="form-control" cols="30" rows="3" name="best_seller_section_description" id="best_seller_section_description" placeholder="Enter name">{{ $data->best_seller_section_description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="portfolio_section_title">Portfolio Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->portfolio_section_title }}" name="portfolio_section_title" id="portfolio_section_title" placeholder="Enter name">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="portfolio_section_description">Portfolio Section Description :</label>
                                            <textarea type="text" class="form-control" cols="30" rows="3" name="portfolio_section_description" id="portfolio_section_description" placeholder="Enter name">{{ $data->portfolio_section_description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="client_section_title">Our Clients Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->client_section_title }}" name="client_section_title" id="client_section_title" placeholder="Enter name">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="client_section_description">Our Clients Section Description :</label>
                                            <textarea type="text" class="form-control" cols="30" rows="3" name="client_section_description" id="client_section_description" placeholder="Enter name">{{ $data->client_section_description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="about_us_section_title">About Us Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->about_us_section_title }}" name="about_us_section_title" id="about_us_section_title" placeholder="Enter name">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="about_us_section_description">About Us Section Description :</label>
                                            <textarea type="text" class="form-control" cols="30" rows="3" name="about_us_section_description" id="about_us_section_description" placeholder="Enter name">{{ $data->about_us_section_description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="team_section_title">Team Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->team_section_title }}" name="team_section_title" id="team_section_title" placeholder="Enter name">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="team_section_description">Team Section Description :</label>
                                            <textarea type="text" class="form-control" cols="30" rows="3" name="team_section_description" id="team_section_description" placeholder="Enter name">{{ $data->team_section_description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="contact_section_title">Contact Us Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->contact_section_title }}" name="contact_section_title" id="contact_section_title" placeholder="Enter name">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="contact_section_description">Contact Us Section Description :</label>
                                            <textarea type="text" class="form-control" cols="30" rows="3" name="contact_section_description" id="contact_section_description" placeholder="Enter name">{{ $data->contact_section_description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="book_section_title">Booking Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->book_section_title }}" name="book_section_title" id="book_section_title" placeholder="Enter name">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="book_section_description">Booking Section Description :</label>
                                            <textarea type="text" class="form-control" cols="30" rows="3" name="book_section_description" id="book_section_description" placeholder="Enter name">{{ $data->book_section_description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="next_section_title">Get Estimate Nex Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->next_section_title }}" name="next_section_title" id="next_section_title" placeholder="Enter name">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="next_section_description">Get Estimate Next Section Description :</label>
                                            <textarea type="text" class="form-control" cols="30" rows="3" name="next_section_description" id="next_section_description" placeholder="Enter name">{{ $data->next_section_description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="product_section_title">Our Product Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->product_section_title }}" name="product_section_title" id="product_section_title" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="help_section_title">Help Section Title :</label>
                                            <input type="text" class="form-control" value="{{ $data->help_section_title }}" name="help_section_title" id="help_section_title" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="getestimate_section_title_one">Get Estimate Section Title One :</label>
                                            <input type="text" class="form-control" value="{{ $data->getestimate_section_title_one }}" name="getestimate_section_title_one" id="getestimate_section_title_one" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="getestimate_section_title_two">Get Estimate Section Title Two :</label>
                                            <input type="text" class="form-control" value="{{ $data->getestimate_section_title_two }}" name="getestimate_section_title_two" id="getestimate_section_title_two" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="getestimate_section_title_three">Get Estimate Section Title Three :</label>
                                            <input type="text" class="form-control" value="{{ $data->getestimate_section_title_three }}" name="getestimate_section_title_three" id="getestimate_section_title_three" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="getestimate_section_title_four">Get Estimate Section Title Four :</label>
                                            <input type="text" class="form-control" value="{{ $data->getestimate_section_title_four }}" name="getestimate_section_title_four" id="getestimate_section_title_four" placeholder="Enter name">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="getestimate_section_title_four">Time Shedule Description :</label>
                                            <textarea rows="5" cols="3" name="time_shedule" id="time_shedule" class="form-control">{!! $data->time_shedule !!}</textarea>
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