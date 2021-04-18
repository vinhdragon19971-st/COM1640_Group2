<!DOCTYPE html>
<html lang="en">
   <!-- Basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Site Metas -->
   <title>Induko</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="{{asset('public/frontend/images/fevicon.png')}}" type="image/png" />
   <!-- Bootstrap core CSS -->
   <link href="{{asset('public/frontend/css/bootstrap.css')}}" rel="stylesheet">
   <!-- FontAwesome Icons core CSS -->
   <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
   <!-- Custom animate styles for this template -->
   <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
   <!-- Custom styles for this template -->
   <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet">
   <!-- Responsive styles for this template -->
   <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
   <!-- Colors for this template -->
   <link href="{{asset('public/frontend/css/colors.css')}}" rel="stylesheet">
   <!-- light box gallery -->
   <link href="{{asset('public/frontend/css/ekko-lightbox.css')}}" rel="stylesheet">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   <![endif]-->
   @stack('css')

   </head>
   <body id="home_page" class="home_page">
      <!-- header -->
      <header class="header">
        <div class="header_top_section">
           <div class="container">
              <div class="row">
               <div class="col-lg-3">
                  <div class="full">
                     <div class="logo">
                        <a href="{{URL::to('/')}}"><img src="{{asset('public/Frontend/images/logo.png')}}" alt="#" /></a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-9 site_information">
                  <div class="full">
                     <div class="main_menu">
                        <nav class="navbar navbar-inverse navbar-toggleable-md">
                           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#cloapediamenu" aria-controls="cloapediamenu" aria-expanded="false" aria-label="Toggle navigation">
                           <span class="float-left">Menu</span>
                           <span class="float-right"><i class="fa fa-bars"></i> <i class="fa fa-close"></i></span>
                           </button>
                           <div class="collapse navbar-collapse justify-content-md-center" id="cloapediamenu">
                              <ul class="navbar-nav">
                                 <li class="nav-item active">
                                    <a class="nav-link" href="{{URL::to('/')}}">Home</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link color-aqua-hover" href="#AboutGW">About</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link color-aqua-hover" href="{{URL::to('/course-of-category')}}">Category</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link color-grey-hover" href="contact.html">Contact Us</a>
                                 </li>
                                 <?php
                                    $user_id = Session::get('user_id');
                                    $user_role = Session::get('user_role');
                                    if($user_id != NULL){
                                 ?>
                                 <div class="top-nav clearfix">
                                    <ul class="nav pull-right top-menu">
                                       <!-- user login dropdown start-->
                                       <li class="dropdown">
                                          <a data-toggle="dropdown" class="dropdown-toggle" href="#">                                             
                                             <span class="username">
                                             <?php
                                                $name = Session::get('user_fullname');
                                                if($name){
                                                   echo "hello "."<b>".$name."</b>";
                                                }
                                             ?>
                                          </span>
                                             <b class="caret"></b>
                                          </a>
                                          <ul class="dropdown-menu extended logout">
                                             <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                                             <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
                                             <li><a href="{{URL::to('/logout-user')}}"><i class="fa fa-key"></i>Log Out</a></li>
                                          </ul>
                                       </li>
                                       <!-- user login dropdown end -->                                       
                                    </ul>
                                 </div>
                                 <?php
                                    }else{
                                 ?>
                                 <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">Login <span class="caret"></span></button>
                                 <ul class="dropdown-menu dropdown-menu-right mt-2">
                                    <li class="nav-item" id="LoginUser">
                                       <form action="{{URL::to('/login-user')}}" method="post">
                                       @csrf
                                          <center>
                                          <?php
                                             $message = Session::get('message-login');
                                                if($message){
                                                   echo '<center><span style="color: red;">'.$message.'</span></center>';
                                                   Session::put('Message',null);
                                             }
                                          ?>
                                          <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                                             <div class="col-sm-10">
                                                <input type="email" name="user_email" class="form-control" id="inputEmail3" placeholder="Email...">
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="inputPassword3" class="col-sm-5 col-form-label">Password</label>
                                             <div class="col-sm-10">
                                                <input type="password" name="user_password" class="form-control" id="inputPassword3" placeholder="Password...">
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="col-sm-10">
                                                <input type="submit" value="Log In" name="login">
                                             </div>
                                          </div>
                                          </center>
                                       </form>                                       
                                    </li>
                                 </ul>
                                 <?php
                                    }
                                 ?>
                              </ul>
                           </div>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
           </div>
        </div>
        

      </header>
      <!-- end header -->
      
      <!-- section -->
      <section class="main_full banner_section_top">
        <div class="container-fluid">
          <div class="row">
             <div class="full">
                  <div class="slider_banner">
                    <img class="img-responsive" src="{{asset('public/frontend/images/slider_img.png')}}" alt="#" />
                      <div class="slide_cont">
                        <div class="slider_cont_inner">
                          <h3 class="">Greenwich University</h3>
                        </div>
                      </div>
                  </div>
                </div>
          </div>
        </div>
      </section>
      <!-- end section -->
    
     @yield('index_content')
     
      <!-- footer -->
      <footer class="footer layout_padding">
         <div class="container">
            <div class="row">

               <div class="col-md-4 col-sm-12">
                  <a href="index.html"><img class="img-responsive" src="{{asset('public/frontend/images/logo_footer.png')}}" alt="#" width="60%"/></a>
                  <div class="footer_link_heading">
                     <div class="footer_menu margin_top_30">
                     <ul>
                        <li><a href="tel:9876543210">9876 543 210</a></li>
                        <li><a href="#">demo@gmail.com</a></li>
                        <li><a href="#">40 Baria Sreet 133/2 NewYork City, US</a></li>
                     </ul>
                  </div>
                  </div>
               </div>
               
               <div class="col-md-8">
                 <div class="row">
                    <div class="col-md-4 col-sm-12">
                  <div class="footer_link_heading">
                     <h3>FEATURED COURSES</h3>
                  </div>
                  <div class="footer_menu">
                     <ul>
                        <li><a href="#">Starting Soon</a></li>
                        <li><a href="#">Just Added</a></li>
                        <li><a href="#">Most Viewed</a></li>
                        <li><a href="#">Top Paid</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-4 col-sm-12">
                  <div class="footer_link_heading">
                     <h3>CATEGORIES</h3>
                  </div>
                  <div class="footer_menu">
                    <ul>
                       <li><a href="#">Arts & Design</a></li>
                       <li><a href="#">Business</a></li>
                       <li><a href="#">Computer</a></li>
                       <li><a href="#">Data entery</a></li>
                    </ul>
                  </div>
               </div>
               
               <div class="col-md-4 col-sm-12">
                  <div class="footer_link_heading">
                     <h3>USEFUL LINKS</h3>
                  </div>
                  <div class="footer_menu">
                    <ul>
                       <li><a href="#">FAQs</a></li>
                       <li><a href="#">Success Stories</a></li>
                       <li><a href="#">Shop</a></li>
                       <li><a href="#">Privacy policy</a></li>
                       <li><a href="#">Contact search</a></li>
                       <li><a href="#">Jobs and vacancies</a></li>
                    </ul>
                  </div>
               </div>
                 </div>
               </div>
               
            </div>
         </div>
      </footer>
      <div class="cpy">
        <div class="container">
           <div class="row">
             <div class="col-md-12">
               <p>Copyright 2021. All Rights TCS2010_PPT (COMP1640) - Group 2.<a href="https://html.design/"></a></p>
             </div>
           </div>
        </div>
      </div>
      <!-- end footer -->
      <!-- Core JavaScript
         ================================================== -->
      <script src="{{asset('public/frontend/js/jquery.min.js')}}"></script>
      <script src="{{asset('public/frontend/js/tether.min.js')}}"></script>
      <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('public/frontend/js/parallax.js')}}"></script>
      <script src="{{asset('public/frontend/js/animate.js')}}"></script>
      <script src="{{asset('public/frontend/js/ekko-lightbox.js')}}"></script>
      <script src="{{asset('public/frontend/js/custom.js')}}"></script>
      @stack('js')
   </body>
</html>
