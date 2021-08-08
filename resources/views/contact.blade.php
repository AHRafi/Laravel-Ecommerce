@extends('layouts.frontend_master')
@section('contact')
  active
@endsection

@section('frontend_master')

  <div class="contact-area ptb-100">
      <div class="container">
        @if(session('success_msg'))
          <div class="alert alert-success">
            {{ session("success_msg") }}
          </div>
        @endif
        @error ('email')
          <div class="alert alert-secondary">
            <span class="text-danger"> {{  $message }}  </span>
          </div>
        @enderror
          <div class="row">
              <div class="col-lg-8 col-12">
                  <div class="contact-form form-style">
                      <div class="cf-msg"></div>
                      <form action="{{ url('messagepost') }}" method="post" >
                        @csrf
                          <div class="row">
                              <div class="col-12 col-sm-6">
                                  <input type="text" placeholder="Name"  name="fname">
                              </div>
                              <div class="col-12  col-sm-6">
                                  <input type="text" placeholder="Email"  name="email">
                              </div>

                              <div class="col-12">
                                  <input type="text" placeholder="Subject" name="subject">
                              </div>
                              <div class="col-12">
                                  <textarea class="contact-textarea" placeholder="Message" name="msg"></textarea>
                              </div>
                              <div class="col-12">
                                  <button id="submit" name="submit">SEND MESSAGE</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
              <div class="col-lg-4 col-12">
                  <div class="contact-wrap">
                      <ul>
                          <li>
                              <i class="fa fa-home"></i> Address:
                              <p>Dhanmondi-15(Keary Plaza), House- 79, Dhaka- 1205</p>
                          </li>
                          <li>
                              <i class="fa fa-phone"></i> Email address:
                              <p>
                                  <span>infobismillahgroup@gmail.com </span>

                              </p>
                          </li>
                          <li>
                              <i class="fa fa-envelope"></i> phone number:
                              <p>
                                  <span>0131234567</span>

                              </p>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
