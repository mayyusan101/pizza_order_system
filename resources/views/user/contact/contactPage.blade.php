@extends('user.layouts.master')

@section('title','Contact Us')

@section('content')

    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-6 offset-1">
                @if(session('message'))
                    <div class="alert alert-warning alert-dismissible fade show float-end" role="alert">
                        <strong>  {{ session('message') }} </strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                @endif
            </div>
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="{{ route('User@sendContact') }}" method="post" >
                        @csrf
                        <div class="control-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" name="message" id="message" placeholder="Message"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d174869.69656653138!2d95.93494837774716!3d21.962003525762256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb6d8d07d47b25%3A0x15a2df74e2e9db95!2sThe%20Pizza%20Company!5e0!3m2!1sen!2smm!4v1664446067741!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>34th Street, 77th X 78th Streets, Chanayethazan Tsp, Myanmar</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>mayyusan101@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+95 09406539933</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@section('scriptContent')
    <script>
    $(document).ready(function(){
        $('#titleContact').addClass("active");  
    })  
    </script>
@endsection