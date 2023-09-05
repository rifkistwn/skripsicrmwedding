<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Abie Production Wedding Organizer</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/client/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/client/bootstrap/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('custom/toastr/toastr.min.css') }}" rel="stylesheet" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('custom/login/fonts/font-awesome-4.7.0/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/client/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/client/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/client/global-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/client/header/header.css') }}">

    @yield('styles')
  </head>

  <body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include('client.components.layout.header')

    <!-- Page Content -->
    @yield('content')

    @yield('modals')

    {{-- Footer --}}
    @include('client.components.layout.footer')

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/js/client/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/client/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/client/vendor/bootstrap/js/bootstrap-select.min.js') }}"></script>


    <!-- Addiional Scripts -->
    <script src="{{ asset('assets/js/client/custom.js') }}"></script>
    <script src="{{ asset('assets/js/client/owl.js') }}"></script>
    <script src="{{ asset('assets/js/client/slick.js') }}"></script>
    <script src="{{ asset('assets/js/client/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/client/accordions.js') }}"></script>
    <script src="{{ asset('custom/toastr/toastr.min.js') }}"></script>

    <script>
      // start::toastr
      @if(Session::has('success'))
          toastr.options =
          {
              "closeButton" : true,
              "progressBar" : true
          }
          toastr.success("{{ session('success') }}");
      @endif

      @if(Session::has('error'))
          toastr.options =
          {
              "closeButton" : true,
              "progressBar" : true
          }
          toastr.error("{{ session('error') }}");
      @endif

      @if(Session::has('info'))
          toastr.options =
          {
              "closeButton" : true,
              "progressBar" : true
          }
          toastr.info("{{ session('info') }}");
      @endif

      @if(Session::has('warning'))
          toastr.options =
          {
              "closeButton" : true,
              "progressBar" : true
          }
          toastr.warning("{{ session('warning') }}");
      @endif
      // end::toastr

      // start::template js
      // cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      // function clearField(t){                   //declaring the array outside of the
      // if(! cleared[t.id]){                      // function makes it static and global
      //     cleared[t.id] = 1;  // you could use true and false, but that's more typing
      //     t.value='';         // with more chance of typos
      //     t.style.color='#fff';
      //     }
      // }
      // end::template js
    </script>

    {{-- Scripts --}}
    @yield('scripts')
  </body>

</html>
