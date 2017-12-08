 @include('bitcoin/inner_header')
  <?php 
      $abc = Session::get('cart');
      
        ?>
  <main class="mainBody">

        <div class="body-inner">
          <div class="container">
            <div class="body-box">

              <div class="buy-form withdraw">

                <h1>Withdraw</h1>

                <div class="row">
                  <div class="col-md-6">
                    <div class="tab-pills">
                      <ul class="nav nav-pills">
                        <li><a href="{{url('/withdraw')}}">BTC</a></li>
                        <li class="active"><a href="{{url('/withdraw_eth')}}">ETH</a></li>
                      </ul>
                    </div>

                    <div class="buy-form-fields">
                      <p class="wallet-text">Your BTC Wallet:@if(!empty($data['balance']->eth_balance)) {{$data['balance']->eth_balance}} @else 0 @endif</p>
                      <div class="field">
                        <span>Bit Coin</span>
                        <?php $number = $abc[0][0]->eth; ?>
                        <input type="text" id="fname" name="eth" value="">
                        <input type="hidden"  id="bitname"  value="<?php echo $number; ?>">
                      </div>
                      <span class="equals">=</span>
                      <div class="field">
                        <span>Payment</span>
                        <input id="price" type="text" name="" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="withdraw-form">
                      <h3>Add Account Information</h3>
                      <div class="withdraw-options">
                        <input id="account" type="radio" name="account-info" value="@if(!empty($data['account']->account_no)) {{$data['account']->account_no}} @else Bank detail @endif"><label for="account-info">Your Account: @if(!empty($data['account']->account_no)) {{$data['account']->account_no}} @else Add Bank detail @endif</label><span class="tag">Default</span><br/>
                        <input type="radio" name="account-info" value="Withdraw to another account"><label for="account-info">Withdraw to another account</label>
                      </div>
                      <div class="withdraw-fields">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-6">
                              <input type="text" name="" value="@if(!empty($data['account']->account_holder)) {{$data['account']->account_holder}} @else Account Holder @endif"  placeholder="Account Holder" class="exchange-textbox">
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="" value="@if(!empty($data['account']->account_no)) {{$data['account']->account_no}} @else Account no @endif" placeholder="Account No." class="exchange-textbox">
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="" value="@if(!empty($data['account']->IFSC)) {{$data['account']->IFSC}} @else IFSC @endif" placeholder="IFSC" class="exchange-textbox">
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="" value="@if(!empty($data['account']->swift_code)) {{$data['account']->swift_code}} @else swift_code @endif" placeholder="Swift Code" class="exchange-textbox">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="withdraw-options" style="margin-top:0;">
                        <input type="checkbox" name="save-for-later"><label for="save-for-later">Save for Later</label>
                      </div>
                    </div>
                  </div>
                </div>


                <button class="buy-btc-button">Withdraw</button>

              </div>

            </div>
          </div>
        </div>

      </main>
@include('bitcoin/inner_footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function(){
  $('#account').click(function(){
    window.location = "{{URL::to('/profile')}}";
    });
  jQuery('#fname').on('keyup',function(){
  var a = jQuery(this).val();
  var b = jQuery('#bitname').val();
  var c = a*b;
  if(!isNaN(c)){
    jQuery('#price').val(c);
  }else{
    alert('please enter valid number');
  }
});
});
</script>