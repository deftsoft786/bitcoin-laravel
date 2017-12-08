<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Exchange News</title>

     <link rel="stylesheet" href="{{url('bitcoin/css/bootstrap.min.css')}}">

     <link rel="stylesheet" href="{{url('bitcoin/css/font-awesome.min.css')}}">

     <link rel="stylesheet" href="{{url('bitcoin/css/style.css')}}">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css">

  </head>

  <body>



    <div class="wrapper">



      <header class="home-header">



        <div class="header-menu">

          <div class="container">

            <nav class="navbar">

              <!-- Brand and toggle get grouped for better mobile display -->

              <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-collapse" aria-expanded="false">

                  <span class="sr-only">Toggle navigation</span>

                  <span class="icon-bar"></span>

                  <span class="icon-bar"></span>

                  <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="{{url('/')}}"><img style="height:50px;" src="{{url('bitcoin/images/logo10.png')}}"/></a>

              </div>



              <!-- Collect the nav links, forms, and other content for toggling -->

              <div class="collapse navbar-collapse" id="menu-collapse">

                <ul class="nav navbar-nav navbar-right">

                  <li><a href="{{url('/')}}">Home</a></li>

                  <li><a href="{{url('/coin_market')}}">Coins & Markets</a></li>

                  <li class="active"><a href="{{url('/news')}}">News</a></li>

                <!--    <li><a href="#">Add Coin</a></li> -->

                  <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">English <span class="caret"></span></a>

                    <ul class="dropdown-menu">

                      <li><a href="#">English</a></li>

                      <li><a href="#">Chinese</a></li>

                      

                    </ul>

                  </li>

                </ul>

              </div><!-- /.navbar-collapse -->

            </nav>

          </div>

        </div>

@if(Session::has('message'))

         <p id="msg" style="margin-left:500px;width:450px;color:red; text-align: center;" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

       @endif

@if (count($errors) > 0)

    <div id="msg" style="margin-left:500px;width:450px;color:red; text-align: center;" class="alert alert-danger">

      <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

        <div class="header-content">

          <div class="container">

            <h2>Simple, Easy, Fast</h2>

            <h1>Secure Wallet</h1>

            <h2>Buy / Sell</h2>

            <h1>ETH, ERC20, BitCoin</h1>

            <div class="cta-buttons">

             <button id="login">Login</button>

              <button id="signup">Sign Up</button>

            </div>

          </div>

        </div>



      </header>

    <div class="login light-box">

      <div class="overlay-click"></div>

      <div class="overlay">

        <div class="loginBox lightbox-box">

          <h1>Login</h1>

          @if(Session::has('message'))

         <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

       @endif

        <form id="myForm" action="{{url('/signin')}}" method="post" />

         {{ csrf_field() }}

        @if ($errors->has('email'))

          <div style="color:red;" class="error">{{ $errors->first('email') }}</div>

         @endif

          <input class="validate[required] text-input" type="text" name="account_id" placeholder="Account ID" >

        @if ($errors->has('password'))

          <div style="color:red;" class="error">{{ $errors->first('password') }}</div>

        @endif  

          <input class="validate[required] text-input" type="password" name="password" placeholder="Password" >

          <button class="gradient-button">Login</button>

        </form>

         <div class="social-buttons">

            <button class="facebook-login face"><i class="fa fa-facebook"></i>Facebook</button>

            <button class="twitter-login twitter"><i class="fa fa-twitter"></i>Twitter</button>

          </div>

          <div class="signup-option">

            <p>You don't have an account? <a href="">Signup</a></p>

          </div>

        </div>

      </div>

    </div>

     <div class="signup light-box">

      <div class="overlay-click"></div>

      <div class="overlay">

        <div class="loginBox lightbox-box">

          <h1>Create an Account</h1>

       @if(Session::has('message'))

         <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

       @endif

        <form id="myForm1" method="post" action="{{url('/signup')}}" enctype="multipart/form-data">

            {{ csrf_field() }}

          

        @if ($errors->has('name'))

          <div style="color:red;">{{ $errors->first('name') }}</div>

        @endif

          <input class="validate[required] text-input" type="text" name="name" placeholder="Name">

         @if ($errors->has('email'))

          <div style="color:red;" class="error">{{ $errors->first('email') }}</div>

        @endif

          <input class="validate[required,custom[email]] text-input" type="text" name="email" placeholder="Email">

         @if ($errors->has('password'))

          <div style="color:red;" class="error">{{ $errors->first('password') }}</div>

        @endif  

          <input class="validate[required] text-input" type="password" name="password" placeholder="Password">

          @if ($errors->has('confirm_password'))

          <div style="color:red;" class="error">{{ $errors->first('confirm_password') }}</div>

        @endif 

          <input class="validate[required] text-input" type="password" name="confirm_password" placeholder="Confirm Password">

       

          <button class="gradient-button">Sign up</button>

        </form>

         <div class="social-buttons">

            <button class="facebook-login face"><i class="fa fa-facebook"></i>Facebook</button>

            <button class="twitter-login twitter"><i class="fa fa-twitter"></i>Twitter</button>

          </div>

          <div class="signup-option">

            <p>You have an account? <a href="">Signin</a></p>

          </div>

       

      </div>

    </div>

  </div>

</div>

      <main class="mainBody">



        <div class="news home-body">

          <div class="container">

            <header>

              <h1>Exchange News</h1>

            </header>

            <div class="row">



              <div class="col-md-4 col-1">

                <article class="newsBlock">

                  <div class="news-thumbnail" style="background-image:url(bitcoin/images/blog.jpg)"></div>

                  <div class="content">

                    <span class="metadata">Posted by admin May 27, 2017</span>

                    <h2>Aliquam erat volutpat</h2>

                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that....<a href="" class="readmore">Read More</a></p>

                  </div>

                </article>

              </div>

              <div class="col-md-4 col-1">

                <article class="newsBlock">

                  <div class="news-thumbnail" style="background-image:url(bitcoin/images/blog.jpg)"></div>

                  <div class="content">

                    <span class="metadata">Posted by admin May 27, 2017</span>

                    <h2>Aliquam erat volutpat</h2>

                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that....<a href="" class="readmore">Read More</a></p>

                  </div>

                </article>

              </div>

              <div class="col-md-4 col-1">

                <article class="newsBlock">

                  <div class="news-thumbnail" style="background-image:url(bitcoin/images/blog.jpg)"></div>

                  <div class="content">

                    <span class="metadata">Posted by admin May 27, 2017</span>

                    <h2>Aliquam erat volutpat</h2>

                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that....<a href="" class="readmore">Read More</a></p>

                  </div>

                </article>

              </div>

              <div class="col-md-4">

                <article class="newsBlock">

                  <div class="news-thumbnail" style="background-image:url(bitcoin/images/blog.jpg)"></div>

                  <div class="content">

                    <span class="metadata">Posted by admin May 27, 2017</span>

                    <h2>Aliquam erat volutpat</h2>

                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that....<a href="" class="readmore">Read More</a></p>

                  </div>

                </article>

              </div>

              <div class="col-md-4">

                <article class="newsBlock">

                  <div class="news-thumbnail" style="background-image:url(bitcoin/images/blog.jpg)"></div>

                  <div class="content">

                    <span class="metadata">Posted by admin May 27, 2017</span>

                    <h2>Aliquam erat volutpat</h2>

                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that....<a href="" class="readmore">Read More</a></p>

                  </div>

                </article>

              </div>

              <div class="col-md-4">

                <article class="newsBlock">

                  <div class="news-thumbnail" style="background-image:url(bitcoin/images/blog.jpg)"></div>

                  <div class="content">

                    <span class="metadata">Posted by admin May 27, 2017</span>

                    <h2>Aliquam erat volutpat</h2>

                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that....<a href="" class="readmore">Read More</a></p>

                  </div>

                </article>

              </div>

              



            </div>

          </div>

        </div>



        <div class="body-box2">

          <div class="container">

            <div class="body-inner">

              <h2>Trusted by Bitcoin Business</h2>

              <div class="clients">

                <div class="client"><img src="{{url('bitcoin/images/cloudflare.jpg')}}" alt=""></div>

                <div class="client"><img src="{{url('bitcoin/images/bitgo.jpg')}}" alt=""></div>

                <div class="client"><img src="{{url('bitcoin/images/coinpayments.jpg')}}" alt=""></div>

                <div class="client"><img src="{{url('bitcoin/images/uquid.jpg')}}" alt=""></div>

                <div class="client"><img src="{{url('bitcoin/images/comodo.jpg')}}" alt=""></div>

                <div class="client"><img src="{{url('bitcoin/images/stripe.jpg')}}" alt=""></div>

              </div>

            </div>

          </div>

        </div>





      </main>



      <footer class="home-footer">

        <div class="footer-background">

          <div class="gradient-back"></div>

        </div>

        <div class="home-footer-body">

          <div class="container">

            <img style="height:50px!important;" src="{{url('bitcoin/images/logo10.png')}}" alt="Logo here"/>

            <div class="social">

             <a style="text-decoration:none;color:white; " href="javascript:void(0)">  <i class="fa fa-facebook" aria-hidden="true"></i> </a>

            <a style="text-decoration:none;color:white;" href="javascript:void(0)">   <i class="fa fa-twitter" aria-hidden="true"></i></a>

             <a style="text-decoration:none;color:white;" href="javascript:void(0)">  <i class="fa fa-youtube" aria-hidden="true"></i></a>

             <a style="text-decoration:none;color:white;" href="javascript:void(0)">  <i class="fa fa-google-plus" aria-hidden="true"></i></a>

             <a style="text-decoration:none;color:white;" href="javascript:void(0)">  <i class="fa fa-instagram" aria-hidden="true"></i></a>

             <a style="text-decoration:none;color:white;" href="javascript:void(0)">  <i class="fa fa-linkedin" aria-hidden="true"></i></a>

            </div>

            <div class="copyright">

              <p>Copyright &copy; 2017 All Rights Reserved</p>

            </div>

          </div>

        </div>

      </footer>



    </div>



   <script src="{{url('bitcoin/js/jquery-3.2.1.min.js')}}"></script>

    <script src="{{url('bitcoin/js/bootstrap.min.js')}}"></script>

    <script src="{{url('bitcoin/js/common.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.js"></script>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.js"></script>

   

    <script type="text/javascript">

       jQuery(document).ready(function(){

         $('.face').click(function(){

        window.location = "{{URL::to('/login/facebook')}}";

       });

        $('.twitter').click(function(){

        window.location = "{{URL::to('/login/twitter')}}";

       });

       $('#myForm').validationEngine();

       $('#myForm1').validationEngine();

   });

$(document).ready(function(){

        setTimeout(function() {

          $('#msg').fadeOut('fast');

        }, 3000); // <-- time in milliseconds

    });

    </script>

  </body>

</html>

