 <footer class="footer">

        <div class="footer-background">

          <div class="gradient-back"></div>

        </div>

        <div class="container">

          <div class="row">

            <div class="col-md-6">

              <div class="buy-sell-footer">

                <h3>Buy/Sell</h3>

                <img src="{{url('bitcoin/images/bitcoin-white.png')}}" alt="">

                <img src="{{url('bitcoin/images/eth-white.png')}}" alt="">

                <img src="{{url('bitcoin/images/erc-white.png')}}" alt="">

              </div>

            </div>

            <div class="col-md-2">

              <div class="footer-stats">

                <h3>BTC</h3>





      <?php 

      $abc  = Session::get('cart');


      $abcd = Session::get('name');



        ?>



                <div style="width:195px!important;" class="stat-line">

                 <a style="text-decoration:none;" href="@if(!empty($abcd[0]->email)){{url('/buy_btc_eth')}}@else {{url('/profile?p=0')}} @endif"><span class="tag buys">Buy</span> </a>

                  <span class="rate">$ <span id='bt_buy'><?php $number = $abc[0][0]['USD']['buy']; echo round($number,2); ?></span></span>

                  <img src="{{url('bitcoin/images/green-arrow.png')}}" alt="">

                </div>

                <div style="width:195px!important;" class="stat-line">

                  <a style="text-decoration:none;" href="{{url('/send_bitcoin')}}"><span class="tag buys">Sell</span></a>

                  <span class="rate">$ <span id='bt_sell'><?php $number = $abc[0][0]['USD']['sell']; echo round($number,2); ?></span> </span>

                  <img src="{{url('bitcoin/images/red-arrow.png')}}" alt="">

                </div>

              </div>

            </div>

            <div  class="col-md-2">

              <div class="footer-stats">

                <h3>ETH</h3>

                <div style="width:195px!important;" class="stat-line">

                 <a style="text-decoration:none;" href="@if(!empty($abcd[0]->email)){{url('/buy_eth')}}@else {{url('/profile?p=0')}} @endif"><span class="tag buys">Buy</span> </a>

                  <span class="rate"> $ <span id='et_buy'><?php $number = $abc[0][1]['ask']; echo round($number,2); ?></span> </span>

                  <img src="{{url('bitcoin/images/green-arrow.png')}}" alt="">

                </div>

                <div style="width:195px!important;" class="stat-line">

                  <a style="text-decoration:none;" href="{{url('/send_bitcoin')}}"><span class="tag buys">Sell</span></a>

                  <span class="rate"> $ <span id='et_sell'> <?php $number = $abc[0][1]['bid']; echo round($number,2); ?></span> </span>

                  <img src="{{url('bitcoin/images/red-arrow.png')}}" alt="">

                </div>

              </div>

            </div>

            <div  class="col-md-2">

              <div class="footer-stats">

                <h3>ERC20</h3>

                <div style="width:195px!important;" class="stat-line">

                  <a style="text-decoration:none;" title="<?php echo  $number = 1/$abc[0][0]['USD']['buy'];?>" href=""><span class="tag buys">Buy</span></a>

                  <span class="rate"><i class="fa fa-btc"></i><span id='bt_buy'> <?php  $number = 1/$abc[0][0]['USD']['buy']; echo   round($number,5); ?></span></span>

                  <img src="{{url('bitcoin/images/green-arrow.png')}}" alt="">

                </div>

                <div style="width:195px!important;" class="stat-line">

                  <a style="text-decoration:none;" title="<?php echo  $number = 1/$abc[0][0]['USD']['sell'];?>" href=""><span class="tag buys">Sell</span></a>

                  <span class="rate"><i class="fa fa-btc"></i><span  id='bt_sell'> <?php  $number = 1/$abc[0][0]['USD']['sell']; echo round($number,5); ?> </span></span>

                  <img src="{{url('bitcoin/images/red-arrow.png')}}" alt="">

                </div>

              </div>

            </div>

          </div>

        </div>

      </footer>



    </div>

     <div class="chat-person">
          <header>
            <h3> Chat window </h3>
            <a href="javascript:void(0)" class="close-chat">
              <div  style="left: -22px; padding: 15px; position: relative;"> 
                  </div>
            </a>
            <a href="javascript:void(0)" class="minimize-chat"><div  style="left: -22px; padding: 15px;"> 
                  </div></a>
          </header>
          <div class="messages">
            <div class="friend-message">
              <p></p>
              <span></span>
            </div>
            <div class="my-message">
              <p><br/> </p>
             <span></span>
            </div>
          </div>
          <footer>
            <input type="text" placeholder="Type Something" class="message-box">
            <button class="send"></button>
          </footer>
        </div>
        <div style="height:44%!important;" class="chat-online chat-person">
          <header>
            <h3>Active Users</h3>
                <a href="javascript:void(0)" class="close-chat"><div  style="left: -22px; padding: 15px; position: relative;"> 
                  </div></a>
              <a href="javascript:void(0)" class="minimize-chat"><div  style="left: -22px; padding: 15px; "> 
                  </div></a>
          </header>
          <div class="users">
<?php  foreach ($abc[0][3] as $key => $value) { ?>
            <div class="user">
                 <?php 

                   $image_get    = $value->image;
                   $fb_img       = $value->fb_img;

                    if(!empty($image_get)){

                   echo '<img  src="'.url('bitcoin/images/user/'.$image_get).'"/>';

                      }elseif(!empty($fb_img)){

                        echo '<img  src="'.$fb_img.'"/>';

                        

                      }else{

                        echo '<img alt="profile" src="'.url('bitcoin/images/propic.jpg').'"/>';

                      } ?>
              <div class="data">

                <h4><?php  echo $value->name; ?></h4>

                <p><span></span> Online</p>

              </div>

            </div>

         <?php }   ?>
          

           

           

         

          </div>

          <footer>

            <input type="text" placeholder="Search" class="message-box">

          </footer>

        </div>





    <script src="{{url('bitcoin/test/js/jquery-3.2.1.min.js')}}"></script>

    <script src="{{url('bitcoin/test/js/bootstrap.min.js')}}"></script>

    <script type="text/javascript">

     window.onload = function() {

      $(".chat-person").css('margin-bottom','-300px');

    };

  $(document).ready(function(){

   

      $('.with').click(function(){

      window.location = "{{url('/withdraw')}}";

   

   });

  $('.minimize-chat').click(function(){

      $(this).closest('.chat-person').css('margin-bottom','-300px');



  });



    $('.close-chat').click(function(){

    $(this).closest('.chat-person').css('margin-bottom','0px');



 }); 

    $('.send_btc').click(function(){

    window.location = "{{URL::to('/send_bitcoin')}}";

    });



    $('.buys').click(function(){

    window.location = "{{URL::to('/buy_btc_eth')}}";

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

          $('#msg').fadeOut('slow');

        }, 3000); // <-- time in milliseconds

    });
  var idx=window.location.toString().indexOf("#_=_"); if (idx>0) { 
  window.location = window.location.toString().substring(0, idx); }



</script>

  </body>

</html>



   