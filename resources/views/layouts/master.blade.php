<!DOCTYPE html>
<html>
<head>

    <style type="text/css">
        .unstyled-button {
  border: none;
  padding: 0;
  background: none;
}
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('title')

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- <script src="https://www.gstatic.com/firebasejs/3.7.2/firebase.js"></script> -->
    <!-- <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script> -->
    <script src="https://www.gstatic.com/firebasejs/4.13.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.13.0/firebase-messaging.js"></script>
    <link rel="manifest" href="manifest.json">



    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>


            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">

                    </a>
                    <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                      <button id="fetchall" class="unstyled-button">
                        <i class="fas fa-bell"></i>
                      </button>
                      <span class="badge badge-danger navbar-badge" id="badgeNotif"></span>
                    </a>
                    {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> --}}

                        {{-- <a href="#" class="dropdown-item"> --}}
                            {{-- <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                                    </h3>
                                    <table id='userTable'>
                                       <thead>
                                        <tr>
                                          <th>invoice</th>
                                        </tr>
                                       </thead>
                                      <tbody>
                                        <tr>
                                          <th>Request Pesanan 'INV-1578031290-7619'</th>
                                        </tr>
                                      </tbody>
                                    </table>
                                </div>
                            </div> --}}
                        {{-- </a> --}}

                        {{-- <div class="dropdown-divider"></div> --}}

                    {{-- </div> --}}
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      {{-- <span class="dropdown-item dropdown-header">15 Notifications</span> --}}
                      <div class="dropdown-divider"></div>
                      {{-- <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> Request Pesanan 'INV-1578031290-7619'
                      </a>
                      <div class="dropdown-divider"></div> --}}
                      <div id="notifAppend">
                      </div>

                      <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
            </ul>
        </nav>

        @include('layouts.module.sidebar')

        @yield('content')

        @include('layouts.module.footer')
    </div>

    <!-- jQuery -->


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js') }}"></script> -->
    <!-- <script src="{{ asset('plugins/morris/morris.min.js') }}"></script> -->
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="https://kit.fontawesome.com/2f3c392d7c.js"></script>
    <script src="{{ asset('js/MessageController.js') }}"></script>
    <script type="text/javascript">
      const admin = '{{Auth::user('admin')}}';
      const userid = `{{Auth::user()->userid}}`;
      window.localStorage.setItem('__uid', userid);
    </script>
    <script src="{{ asset('js/firebase.js') }}"></script>

     <script type='text/javascript'>
      $(document).ready(function(){
        // var logout = $('#logoutData');
        // const url = logout.attr('href');
        // const token = window.localStorage.getItem('___t');
        // const newUrl = `${url}/${token}`;
        // logout.attr('href', newUrl);
        // logout.on('click', function(e){
        //   e.preventDefault();
        //   // console.log('asdasdasd');
        //   window.localStorage.clear();
        //   window.location.href = $(this).attr('href');
        // })
      })
      // $(document).ready(function(){
      //   $('.login').click(function(){
          // $.ajax({
          //   method:'post',
          //   url:'subscribe.php',
          //   data: 'token=' + window.localStorage.getItem('token'),
          //   success: function(data){
          //     console.log(data);
          //     alert('SUBSCRIBED');
          //   }
          // })
      //   })

      //   $('.logout').click(function(){
      //     $.ajax({
      //       method:'post',
      //       url:'unsubscribe.php',
      //       data: 'token=' + window.localStorage.getItem('token'),
      //       success: function(data){
      //         console.log(data);
      //         alert('UNSUBSCRIBED');
      //       }
      //     })
      //   })
      // })


         $(document).ready(function(){
          // console.log(userid);
           // Fetch all records
           // $('#fetchall').click(function(){
             fetchRecords();
           // });
         });
         function fetchRecords(){
           $.ajax({
             url: '/dashboard/notif',
             type: 'get',
             dataType: 'json',
             success: function(response){
              console.log(response);
              response.forEach(d => {
                const data = JSON.parse(d.deskripsi);
                AppendData(data);
                // console.log(data);
                // $('#notifAppend').append(`
                //   <a href="${url}" class="dropdown-item clear-title" id="${data.transaction_id}">
                //       <i class="fas fa-envelope mr-2"></i> ${data.message}
                //    </a>
                //   <div class="dropdown-divider"></div>
                //   `);
              })
              //Working on it
               // var len = 0;
               // $('#userTable tbody').empty(); // Empty <tbody>
               // if(response['data'] != null){
               //   len = response['data'].length;
               // }
               // if(len > 0){
               //   for(var i=0; i<len; i++){
               //     var id = response['data'][i].id;
               //     var invoice = response['data'][i].invoice;
               //     var tr_str = "<tr>" +
               //         "<td align='center'>" + invoice + "</td>" +
               //         "<td align='center'></td>" +
               //         "<td align='center'></td>" +
               //         "<td align='center'></td>" +
               //         "<td align='center'>menunggu</td>" +
               //     "</tr>";

               //     $("#userTable tbody").append(tr_str);
               //   }
               // }else{
               //    var tr_str = "<tr>" +
               //        "<td align='center' colspan='4'>No record found.</td>" +
               //    "</tr>";

               //    $("#userTable tbody").append(tr_str);
               // }

             }
           });
         }
         </script>
      }
    @yield('js')
</body>
</html>
