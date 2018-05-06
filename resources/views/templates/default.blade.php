<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
  <!-- Start Page Loading -->
<!--   <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div> -->
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      @include('sidebar')
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content" class="section-margin">
         @yield('content')
     </section>
     <!-- END CONTENT -->

     <!-- //////////////////////////////////////////////////////////////////////////// -->
     <!-- START RIGHT SIDEBAR NAV-->
     @include('right')
     <!-- LEFT RIGHT SIDEBAR NAV-->

 </div>
 <!-- END WRAPPER -->

</div>
<!-- END MAIN -->

  @yield('scripts')

<!-- //////////////////////////////////////////////////////////////////////////// -->
@include('footer')