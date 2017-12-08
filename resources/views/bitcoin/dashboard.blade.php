@include('bitcoin/inner_header')

   

      <main class="mainBody">



        <div class="body-inner">

          <div class="container">

            <div class="body-box">

@if(Session::has('message'))

         <p id="msg" style="margin-left: 233px;
  text-align: center;
  width: 50%;
" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

       @endif

              <div class="bodyRow">

                <div class="row">

                  <div class="col-md-5">

                    <div class="currency-col">

                      <img src="{{url('bitcoin/images/bitcoin.png')}}" alt="">

                      <h2>BTC Bitcoin</h2>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="balance-col">

                      <span>BTC Balance</span>

                      <p>BTC : @if(!empty($show)) {{$show}} @else 0 @endif</p>

                    </div>

                  </div>

                  <div class="col-md-5">

                    <div class="currency-cta-col">

                      <button class="get link1">Recieve BTC</button>

                      <button class="send link2">Send BTC</button>

                    </div>

                  </div>

                </div>

              </div>



              <div class="bodyRow">

                <div class="row">

                  <div class="col-md-5">

                    <div class="currency-col">

                      <img src="images/eth.png" alt="">

                      <h2>ETH</h2>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="balance-col">

                      <span>ETH Balance</span>

                      <p>ETH : 0 </p>

                    </div>

                  </div>

                  <div class="col-md-5">

                    <div class="currency-cta-col">

                      <button class="get link3">Recieve ETH</button>

                      <button class="send link2">Send ETH</button>

                    </div>

                  </div>

                </div>

              </div>



              <div class="bodyRow">

                <div class="row">

                  <div class="col-md-5">

                    <div class="currency-col">

                      <img src="images/erc.png" alt="">

                      <h2>ERC20</h2>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="balance-col">

                      <span>ERC20 Balance</span>

                      <p>ERC20 : 0 </p>

                    </div>

                  </div>

                  <div class="col-md-5">

                    <div class="currency-cta-col">

                      <button class="big">Total ERC20</button>

                    </div>

                  </div>

                </div>

              </div>



            </div>

          </div>

        </div>



      </main>

 @include('bitcoin/inner_footer')

 <script type="text/javascript">

 $(document).ready(function(){

     $('.link1').click(function(){

    window.location = "{{URL::to('/buy_btc_eth')}}";

    });

    $('.link2').click(function(){

    window.location = "{{URL::to('/send_bitcoin')}}";

    });

    $('.link3').click(function(){

    window.location = "{{URL::to('/buy_eth')}}";

    });

   });

 </script>