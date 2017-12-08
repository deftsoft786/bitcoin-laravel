<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php
                 $segment1 =  Request::segment(1);  
                 if($segment1 == 'dashboard'){echo 'Dashboard';}elseif($segment1 == 'trading'){echo 'Trading';}elseif($segment1 =='btc_history') {echo "BTC History"; }elseif($segment1 == 'eth_history') {echo 'ETH History'; }elseif($segment1 == 'transaction') {echo 'Transaction';}elseif ($segment1 == 'buy_btc_eth') {echo 'Buy BTC ETH';}elseif($segment1 == 'withdraw') {echo "Withdraw";}elseif ($segment1 == 'profile') {
                   echo 'Profile'; }elseif ($segment1 == 'send_bitcoin') {
                   echo 'Send Bitcoin'; };?></title>
    <link rel="stylesheet" href="{{url('bitcoin/test/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('bitcoin/test/css/style.css')}}">
    <link rel="stylesheet" href="{{url('bitcoin/css/font-awesome.min.css')}}">
  </head>
  <body>
    <div class="wrapper">

      <header class="header">
        <div class="header-background">
          <div class="gradient-back"></div>
        </div>


        <div class="header-top">
          <div class="container">
            <div class="header-logo">
              <h1><img style="height:50px;"  src="{{url('bitcoin/images/logo10.png')}}"/ </h1>
            </div>
          </div>
        </div>

        <div class="header-middle">
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

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="menu-collapse">
                  <ul class="nav navbar-nav">
                    <li class="@if(Request::is('dashboard')) active @endif"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="@if(Request::is('trading'))   active @endif"><a href="{{url('/trading')}}">Trading</a></li>
                    <li class="@if(Request::is('btc_history')) active @endif"><a href="{{url('/btc_history')}}">BTC History</a></li>
                    <li class="@if(Request::is('eth_history')) active @endif"><a href="{{url('/eth_history')}}">ETH History</a></li>
                    <li class="@if(Request::is('transaction')) active @endif"><a href="{{url('/transaction')}}">Transaction</a></li>
                    <li class="@if(Request::is('buy_btc_eth')) active @endif"><a href="{{url('/buy_btc_eth')}}">Buy BTC/ETH</a></li>
                  </ul>

                  <div class="navbar-right">
                    <div class="profile">
                  <a style="text-decoration:none;" href="{{url('/profile')}}">
                    <?php
                 if(!empty($session_name = Session::has('name'))){
                               $username = Session::get('name');

                              $name = json_decode($username,true);
                  
                   $name_get     = $name[0]['name'];
                   $image_get    = $name[0]['image'];
                   $fb_img       = $name[0]['fb_img'];
                   
                  
                   echo "<h2 class='propic-user'>". $name_get."</h2>";
                    if($image_get != 0){
                   echo '<img  src="'.url('bitcoin/images/user/'.$image_get).'"/>';
                      }elseif(!empty($fb_img)){
                        echo '<img  src="'.$fb_img.'"/>';
                        
                      }else{
                        echo '<img alt="profile" src="'.url('bitcoin/images/propic.jpg').'"/>';
                      }
               }else{ ?>
               <script> window.location = "{{URL::to('/')}}";</script>
        <?php }
    ?> 
</a>
                    <a href="{{url('/logout')}}"><h2 style="margin-left:30px;" class='propic-user'> Logout </h2> </a>
                    

                    </div>
                     <div>
                      
                     </div>
                  </div>
                </div><!-- /.navbar-collapse -->
            </nav>
          </div>
        </div>

         <div class="header-bottom">
          <div class="container">
            <div class="row">
              <div class="col-md-2">
                <h2><?php
                 $segment1 =  Request::segment(1);  
                 if($segment1 == 'dashboard'){echo 'Wallet';}elseif($segment1 == 'trading'){echo 'Trading';}elseif($segment1 =='btc_history') {echo "BTC History"; }elseif($segment1 == 'eth_history') {echo 'ETH History'; }elseif($segment1 == 'transaction') {echo 'Transaction';}elseif ($segment1 == 'buy_btc_eth') {echo 'Buy BTC ETH';}elseif($segment1 == 'withdraw') {echo "Withdraw";};?></h2>
              </div>
              <div class="col-md-2">
<?php
             $abc = Session::get('cart');

?>
              </div>
              <div class="col-md-8">
                <div class="header-wallet-balances">
                  <button class="balance-withdraw with">Withdraw</button>
                  <h2 class="btc">Your BTC Wallet : <?php if($abc[0][2]==''){echo 0 ;}else{ echo $abc[0][2]->btc_balance;} ; ?></h2>
                  <h2 class="eth">Your ETH Balance :<?php if($abc[0][2]==''){echo 0;}else{ echo $abc[0][2]->eth_balance;}; ?></h2>
                </div>
              </div>
            </div>
          </div>
        </div>


      </header>

<script type="text/javascript">

</script>
