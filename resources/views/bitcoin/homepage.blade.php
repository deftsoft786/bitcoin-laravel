

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Home Page</title>

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

                <a class="navbar-brand" href="{{url('/')}}"><img style="height:50px;"  src="{{url('bitcoin/images/logo10.png')}}"/></a>

              </div>



              <!-- Collect the nav links, forms, and other content for toggling -->

              <div class="collapse navbar-collapse" id="menu-collapse">

                <ul class="nav navbar-nav navbar-right">

                  <li class="active"><a href="{{url('/')}}">Home</a></li>

                  <li><a href="{{url('/coin_market')}}">Coins & Markets</a></li>

                  <li><a href="{{url('/news')}}">News</a></li>

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

         <p id="msg" style="margin-left:520px;width:450px;color:red; text-align: center;" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

       @endif

@if (count($errors) > 0)

    <div id="msg" style="margin-left:520px;width:450px;color:red; text-align: center;" class="alert alert-danger">

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

          <input class="validate[required] text-input" type="text" name="account_id"  placeholder="Account ID" >

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



        <div class="exchangeRate home-body">

          <div class="container">

            <header>

              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

            </header>

            <div class="row">



              <div class="col-md-4">

                <div class="exchange-block col-1">

                  <img src="{{url('bitcoin/images/coins.png')}}" alt="">

                  <div class="exchange-stats">

                    <h3>BTC</h3>

                    <div class="stat-line">

                     

                     <a class="buys" style="text-decoration:none;" href="javascript:void(0)"> <span class="tag buy">Buy</span></a>

                      <span class="rate">$ <span id='bt_buy'><?php $number = $buy['USD']['buy']; echo round($number,2); ?></span></span>

                      <img src="{{url('bitcoin/images/green-arrow.png')}}" alt="">

                    </div>

                    <div class="stat-line">

                      <a  class="buys" style="text-decoration:none;" href="javascript:void(0)"><span class="tag sell">Sell</span></a>

                      <span class="rate">$ <span id='bt_sell'> <?php $number = $buy['USD']['sell']; echo round($number,2); ?> </span></span>

                      <img src="{{url('bitcoin/images/red-arrow.png')}}" alt="">

                    </div>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <div class="exchange-block col-2">

                  <img src="{{url('bitcoin/images/coins.png')}}" alt="">

                  <div class="exchange-stats">

                    <h3>ETH</h3>

                    <div class="stat-line">

                      <a class="buys" style="text-decoration:none;" href="javascript:void(0)"><span class="tag buy">Buy</span></a>

                      <span class="rate">$ <span id='et_buy'><?php $number = $sell['ask']; echo round($number,2); ?></span> </span>

                      <img src="{{url('bitcoin/images/green-arrow.png')}}" alt="">

                    </div>

                    <div class="stat-line">

                      <a class="buys" style="text-decoration:none;" href="javascript:void(0)"><span class="tag sell">Sell</span></a>

                      <span class="rate">$ <span id='et_sell'><?php $number = $sell['bid']; echo round($number,2); ?></span> </span>

                      <img src="{{url('bitcoin/images/red-arrow.png')}}" alt="">

                    </div>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <div class="exchange-block col-3">

                  <img src="{{url('bitcoin/images/coins.png')}}" alt="">

                  <div class="exchange-stats">

                    <h3>ERC20</h3>

                    <div class="stat-line">

                      <a  class="buys" style="text-decoration:none;" href="javascript:void(0)"><span class="tag buy">Buy</span></a>

                      <span class="rate"><i class="fa fa-btc"></i><span id='bt_buy'> <?php   $number = 1/$buy['USD']['buy']; echo round($number,5); ?></span></span>

                      <img src="{{url('bitcoin/images/green-arrow.png')}}" alt="">

                    </div>

                    <div class="stat-line">

                     <a  class="buys" style="text-decoration:none;" href="javascript:void(0)"> <span class="tag sell">Sell</span></a>

                      <span class="rate"><i class="fa fa-btc"></i> <span id='bt_sell'> <?php   $number = 1/$buy['USD']['sell']; echo  round($number,5); ?></span></span>

                      <img src="{{url('bitcoin/images/red-arrow.png')}}" alt="">

                    </div>

                  </div>

                </div>

              </div>



            </div>

          </div>

        </div>



        <div class="body-box2">

          <div class="container">

            <div class="body-inner">

              <h2>Trusted by Bitcoin Business</h2>

              <div class="clients">
                <div class="col-md-2"> 
                 <div class="client"><img src="{{url('bitcoin/images/cloudflare.jpg')}}" alt=""></div>
                </div> 
                <div class="col-md-2"> 
                 <div class="client"><img src="{{url('bitcoin/images/bitgo.jpg')}}" alt=""></div>
                </div> 
                <div class="col-md-2"> 
                 <div class="client"><img src="{{url('bitcoin/images/coinpayments.jpg')}}" alt=""></div>
                </div> 
                <div class="col-md-2">
                 <div class="client"><img src="{{url('bitcoin/images/uquid.jpg')}}" alt=""></div>
                </div> 
                <div class="col-md-2">
                 <div class="client"><img src="{{url('bitcoin/images/comodo.jpg')}}" alt=""></div>
                </div> 
                <div class="col-md-2">
                 <div class="client"><img src="{{url('bitcoin/images/stripe.jpg')}}" alt=""></div>
                </div> 

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

       $('.buys').click(function(){

        alert('Please Signup Or Login');

      

       });



   });



    



    </script>

<script type="text/javascript">

 jQuery(function(){

  setInterval(ajaxCall, 2000);

 });

 //300000 MS == 5 minutes



function ajaxCall() {

   $.get("http://www.99projects.in/bitcoin_new/public/online", function(data, status){

        var on_price = JSON.parse(data);

        jQuery('#bt_buy').text(on_price.btc_buy);

        jQuery('#bt_sell').text(on_price.btc_sell);

        jQuery('#et_buy').text(on_price.eth_buy);

        jQuery('#et_sell').text(on_price.eth_sell);

    });

}

 $(document).ready(function(){

        setTimeout(function() {

          $('#msg').fadeOut('fast');

        }, 3000); // <-- time in milliseconds

    });

</script>

  </body>

</html>

