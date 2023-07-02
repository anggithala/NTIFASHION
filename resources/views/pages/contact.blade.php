@extends('layouts.app')

@section('title')
    Contact
@endsection

@section('content')
    <!-- Page Content-->
    <div class="page-content page-contact mt-2">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h3>CONTACT US</h3>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="row">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.
                            1052101179935!2d106.83172391406357!3d-6.249865395476091!2m3!1f0!2f0!
                            3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f35d013131ef%3A0x3b18fe8118cedd7d!
                            2sNTI%20Fashion!5e0!3m2!1sen!2sid!4v1677140006964!5m2!1sen!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <form target="_blank" action="https://formsubmit.co/anggithala@gmail.com" method="POST">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" name="name" class="form-control" placeholder="Full Name"
                                        required>
                                </div>
                                <div class="col">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Your Message" class="
                            form-control" name="message" rows="10"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
