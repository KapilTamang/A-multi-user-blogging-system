@extends('layouts.app')

@section('content')
    <div class="row" style="width: 80%; background-color: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.2); margin: 30px auto; padding: 30px;">
        <div class="col-md-12" style="margin-bottom: 10px; color: #3490dc;"> 
            <h3 class="text-center"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; <strong>Contact us</strong>
                <small class="form-text text-muted" style="font-size: 14px;">If you have any query do contact us</small>
            </h3>
            <hr style="background-color: rgba(52, 144, 220, 0.4); height: 1px;">
        </div>
        <div class="col-md-12 contact-form"> 
            <form method="post" action="{{ route('mail.send') }}">
                @include('partials.error_message')

                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" class="form-control" name="name" aria-describedby="emailHelp" value="{{ old('name') }}">
                    <small class="form-text text-muted">Please enter your full name.</small>
                  </div>
                <div class="form-group">
                  <label for="email">Your Email address</label>
                 <input type="email" class="form-control" name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" aria-describedby="emailHelp" value="{{ old('subject') }}">
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea class="form-control" name="mail_message" rows="3">{{ old('mail_message') }}</textarea>
                  </div>
                <button type="submit" class="btn btn-send-mail" onclick="mailSent()" style="background-color: #3490dc; color: #fff; border-radius: 3px;"><i class="fa fa-share-square-o" aria-hidden="true"></i>&nbsp; Send</button>
                
                {{ csrf_field() }}
            </form>
        </div>
       </div>
@endsection
