@include('bitcoin/inner_header')
      <main class="mainBody">
 @if(Session::has('message'))
         <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
       @endif
        <div class="body-inner">
          <div class="container">
            <div class="body-box">

              <div class="table-container">
                <table class="body-table table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Time</th>
                      <th>Amount</th>
                      <th>BTC</th>
                      <th>Transaction ID</th>
                      <th>Buy/Sell</th>
                    </tr>
                  </thead>
              @if(!empty($data))
               <?php $x=1; ?>
                 @foreach($data as $value)
                 <tbody>
                 
                    <tr>
                      <td><?php echo $x++; ?></td>
                      <td>@if(!empty($value->created_at)) {{$value->created_at}} @else  N/A @endif</td>
                      <td>@if(!empty($value->amount)) {{$value->amount}} @else  N/A @endif</td> 
                      <td>@if(!empty($value->quantity)) {{$value->quantity}} @else  N/A @endif</td>
                      <td>@if(!empty($value->bitcoin_request_id)) {{$value->bitcoin_request_id}} @else  N/A @endif</td>
                      <td>@if(!empty($value->action)) {{$value->action}}@else N/A @endif</td>
                    </tr>
                </tbody>

               @endforeach  
             @else
             <td> No Data Found <td>
              @endif
                </table>
              </div>

            </div>
          </div>
        </div>

      </main>

   @include('bitcoin/inner_footer')