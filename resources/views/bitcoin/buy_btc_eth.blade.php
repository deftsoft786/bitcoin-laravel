
@include('bitcoin/inner_header')
     <?php $last =  Request::segment(1);?>
     <?php 
      $abc = Session::get('cart');
      
        ?>
      <main class="mainBody">

        <div class="body-inner">
          <div class="container">
            <div class="body-box">

              
            <form action="{{url('/p')}}" method="post" />
            {{ csrf_field() }}
              <div class="buy-form">

                <h1>Buy BTC/ETH</h1>
        @if (count($errors) > 0)
    <div style="color:red; text-align: center;" class="alert alert-danger">
      <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        @if(Session::has('message'))
         <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
       @endif

                <div class="tab-pills">
                  <ul class="nav nav-pills">
                    <li class="<?php if($last =='buy_btc_eth'){echo 'active';} ?>"><a href="{{url('/buy_btc_eth')}}">BTC</a></li>
                    <li class="<?php if($last =='buy_eth'){echo 'active';} ?>"><a href="{{url('/buy_eth')}}">ETH</a></li>
                  </ul>
                </div>

                <div class="buy-form-fields">
                  <div class="field">
                    <span>Bit Coin</span>
                    <?php $number =  $btcd['USD']['buy']; $A = round($number,2); ?>
                    <input type="text" id="fname" name="bitcoin" value="">
                    <input type="hidden"  id="bitname"  value="<?php echo $A; ?>">
                    <input type="hidden" name="action" value="Buy"/>
                  </div>
                  <span class="equals">=</span>
                  <div class="field">
                    <span>Payment (USD)</span>
                    <input id="price" readonly type="text" name="amount" value="">
                  </div>
                </div>

                <button class="buy-btc-button">Buy</button>

              </div>
            </form>

            </div>
          </div>
        </div>

      </main>
@include('bitcoin/inner_footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function(){
  jQuery('#fname').on('keyup',function(){
  var a = jQuery(this).val();
  var b = jQuery('#bitname').val();
  var c = a*b;
  var d = c.toFixed(2)
  if(!isNaN(c)){
    jQuery('#price').val(d);
  }else{
    alert('please enter valid number');
  }
});
});
</script>

    