@include('bitcoin/inner_header')

<main class="mainBody">



        <div class="body-inner">

          <div class="container">

            <div class="body-box">



              <div class="send-bitcoins">

 <?php 

      $abc = Session::get('cart');
echo "<"
      

  

        ?>

                  <header>

                    <h1>Send Bitcoins</h1>

                  </header>

                  <div class="send-bitcoins-form">

                    <form action="{{url('send_bitcoin')}}" method="post"/>

                    

                     {{ csrf_field() }}

                    <div class="row">

                      <div class="col-md-3 exchange-select-block">

                        <select style="height:50px!important" class="exchange-select" name="select_name">

                          <option value="Select a Receiver">Select a Receiver</option>

                         @foreach($data as $val)

                          <option id="name" value="{{$val->account_id}}">{{$val->name}}</option>

                         @endforeach

                        </select>

                      </div>

                      <div class="col-md-3">

                        <input id ="acc_id" class="exchange-textbox" type="text" name="account_id" placeholder="Enter the Bitcoin Address">

                      </div>

                      <div class="col-md-3">

                        <input class="exchange-textbox" type="text" name="set"  placeholder="Set">

                        <input type="hidden" name="bit" value="<?php $number = $abc[0][0]['USD']['sell']; echo round($number,2); ?>"/>

                        <input type="hidden" name="eths" value="<?php $number =  $abc[0][1]['bid']; echo round($number,2);?>"/>

                      </div>

                      <div class="col-md-3 exchange-select-block">

                        <select style="height:50px!important" class="exchange-select" name="select_type">

                          <option value="BTC">BTC</option>

                          <option value="ETH">ETH</option>

                          <option value="ERC20">ERC20</option>

                        </select>

                      </div>

                    </div>

                    <button class="gradient-button">Send</button>

                  </form>

                  </div>





              </div>



            </div>

          </div>

        </div>



      </main>

 @include('bitcoin/inner_footer')

 <script type="text/javascript">

$(document).ready(function(){

    $('select').change(function(){

    var value_id = $('#name').val();  

      $('#acc_id').val(value_id);   

    })

});

 </script>