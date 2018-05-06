<?php 
$baseUrl = URL::to('/');
?>
@extends('templates.login')

@section('title', 'Login Page')

@section('content')
<!-- End Page Loading -->
@if(Session::has('status'))
<div id="card-alert" class="card red lighten-5">
  <div class="card-content red-text">
    <p>{{ Session::get('status') }}</p>
  </div>
</div>
@endif
<div id="login-page" class="row">
  <div class="col s12 z-depth-4 card-panel">
    <div class="row">
      <div class="input-field col s12 center">
        <img src="images/playlistImage.jpg" alt="" class="circle responsive-img valign profile-image-login">
        <p class="center login-form-text">Playlist Craft</p>
      </div>
      <div>
        <div class="input-field col s12 center">
          <a class="btn indigo darken-4"  id="facebook-signin" href="auth/facebook"><i class="fa fa-facebook-official"></i> Login with Facebook</a>
        </div>
      </div>
      <div>
        <div class="input-field col s12 center">
          <a href="auth/google" class="btn red"  id="google-signin"><i class="fa fa-google"></i> Login with Google</a>
        </div>
      </div>
    </div>
  </div>
</div>



  <!-- ================================================
    Scripts
    ================================================ -->

    @stop
    @section('scripts')
    @stop

    <script type="text/javascript">
      function facebookLogin(){
        httpGet(null,"auth/facebook","success");
      }
      function googleLogin(){
        httpGet(null,"auth/google","success");
      }

    </script>

