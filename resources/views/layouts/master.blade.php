<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        @yield('title')
    </title>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <!--datatable-->
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="{{asset('assets/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
<!-- <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" /> -->
    <link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">


    @yield('customScripts')
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="red">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
      -->
        <div class="logo text-center bg-dark">
            <a href="/dashboard" class="simple-text logo-normal font-weight-bolder">
                <img src="{{asset('ajk_logo.png')}}" style="text-align:left; height: 40px; width:40px">
                G<span class="text-lowercase">o</span>AJ&K EMIS
            </a>

        </div>
        <div class="sidebar-wrapper bg-dark" id="sidebar-wrapper" style="background-color:black">

            @include('layouts.leftmenu')
        </div>
    </div>
    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  bg-success  navbar-absolute ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo"><h5 style="text-transform: capitalize"> GoAJ&K Employee Management Information System </h5></a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    {{-- <form>
                         <div class="input-group no-border">
                             <input type="text" value="" class="form-control" placeholder="Search...">
                             <div class="input-group-append">
                                 <div class="input-group-text">
                                     <i class="now-ui-icons ui-1_zoom-bold"></i>
                                 </div>
                             </div>
                         </div>
                     </form>--}}
                    <ul class="navbar-nav">
                        {{--<li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="now-ui-icons media-2_sound-wave"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Stats</span>
                                </p>
                            </a>
                        </li>--}}

                        {{--dropdown for Logout--}}
                            <li class="nav-item dropdown">
                            <a class="nav-link {{(Auth::user()->unreadNotifications->count())?'dropdown-toggle':''}}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                @if(Auth::user()->unreadNotifications->count())
                                    <span class="badge badge-pill badge-light">{{Auth::user()->unreadNotifications->count()}}</span>

                                    <p>
                                        <span class="d-lg-none d-md-block"></span>
                                    </p>
                                @endif
                            </a>
                            @if(Auth::user()->unreadNotifications->count())
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <ul style="list-style-type: none; padding: 0px; margin: 0px;">
                                        @foreach(Auth::user()->unreadNotifications as $notification)
                                            <li>
                                               <a class="dropdown-item" style="color: blue;" href="{{url('employees?verified[]=0')}}">New User Register: {{ucwords($notification->data['user_name']) . " - Department: " . ucwords($notification->data['dep_name'])}} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a href="{{route('markRead')}}" style="color: mediumblue" class="float-right mr-2">Mark all read</a>
                                </div>
                            @endif
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }} <span class=""></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        {{--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="now-ui-icons location_world"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>--}}
                        @if(Auth::user()->employee_id !=NULL)
                            <li class="nav-item">
                                <a class="nav-link" href="/employee-profile/{{Auth::user()->employee_id}}">
                                    <i class="now-ui-icons users_single-02"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->


        <div class="panel-header panel-header-sm">
        </div>

        <div class="content">
            @yield('content')

        </div>

        <footer class="footer">
            <div class=" container-fluid ">
                <nav>
                    <ul>
                        {{-- <li>
                             <a href="">
                                 EMIS
                             </a>
                         </li>
                         <li>
                             <a href="">
                                 About Us
                             </a>
                         </li>
                         <li>
                             <a href="">
                                 Contact Us
                             </a>
                         </li>--}}
                    </ul>
                </nav>
                <div class="copyright" id="copyright">
                    &copy;
                    AJK-ITB

                </div>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files
<script src="../assets/js/core/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

{{--Datatable files--}}
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<!--  Google Maps Plugin    -->
{{--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}
<!-- Chart JS -->
<script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/now-ui-dashboard.min.js')}}" type="text/javascript"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="{{asset('assets/demo/demo.js')}}"></script> -->

<script src="https://cdn.tiny.cloud/1/s9irbeg6vis2xqiiuqy3nc3qee28gzvggzadpaf7v57gwmx4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@if(!(request()->routeIs('designation.*') || request()->routeIs('sub-departments.*')))
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
@endif
<script src="{{asset('assets/js/jquery.mask.js')}}" defer></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        menubar: false,
        plugins: [
            'autoresize',
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
    $(document).ready(function () {
        var traing_count = 1;

        $("form .select2").select2();
        $('.cnic_mask').mask('00000-0000000-0');
        $('.dataTable').DataTable();
        $("body").delegate("#add_more", "click", function () {
            $('.myrow').append($('.newqual').html());
            $("form .select2").select2();
        });

        $("body").delegate("#add_more_integrent", "click", function () {

            var training_html = $('.newqual').html();

            training_html = training_html.replaceAll('xcount_replaceable',traing_count);
            traing_count++;


            $('.myrow').append(training_html);
        });
        $("body").delegate(".cross a", "click", function () {
            $(this).closest(".row").remove();
            return false;
        });
    });

</script>
@yield('scripts')

</body>

</html>
