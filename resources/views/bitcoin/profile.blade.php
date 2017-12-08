 @include('bitcoin/inner_header')
 <main class="mainBody">

        <div class="body-inner">
          <div class="container">
            <div class="body-box">

              <div class="profile">
                <header>
                  <h1>Profile</h1>
                   @if(Session::has('message'))
         <p id="msg" style="margin-left:300px;width:450px;color:red; text-align: center;" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
       @endif
@if (count($errors) > 0)
    <div id="msg" style="margin-left:300px;width:450px;color:red; text-align: center;" class="alert alert-danger">
      <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                </header>
                <div class="row">
                  <div class="col-md-3">
                    <div class="edit-propic">
                      <?php

                       $image_get    = $data['user']->image;
                       $fb_img       = $data['user']->fb_img;
                       
                       if(!empty($image_get)){
                       echo '<img  src="'.url('bitcoin/images/user/'.$image_get).'"/>';
                      }elseif(empty($image_get)){
                        echo '<img  src="'.$fb_img.'"/>';
                        
                      }else{
                        echo '<img alt="profile" src="'.url('bitcoin/images/propic.jpg').'"/>';
                      }

                     ?>
                    </div>
                  </div>
                  <div class="col-md-9">

                    <div class="tabs">
                      <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="pill" href="#basic">Basic Info</a></li>
                        <li><a data-toggle="pill" href="#password">Change Password</a></li>
                        <li><a data-toggle="pill" href="#payment" id='cust_pay'>Payment</a></li>
                        <div class="line"></div>
                      </ul>

                      <div class="tab-content">
                        

                        <div id="basic" class="tab-pane fade in active">

                          <div class="basic-info">
                            <form action="{{url('/info_update')}}" method="post" enctype="multipart/form-data">
                             {{ csrf_field() }}
                            <div class="container-fluid">
                                <div class="row">
                                <div class="col-md-5">
                                  <input type="file" name="image" value="" class="exchange-textbox">
                                </div>
                              
                              </div>
                              <div class="row">
                                <div class="col-md-5">
                                  <input type="text" placeholder=" Enter Name" name="name" value="@if(!empty($data['user']->name)) {{$data['user']->name}}  @endif" class="exchange-textbox">
                                </div>
                                <div class="col-md-5">
                                  <input type="text" placeholder=" last Name" name="last_name" value="@if(!empty($data['user']->last_name)) {{$data['user']->last_name}}  @endif" class="exchange-textbox">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-5">
                                  <input type="email" placeholder=" Enter Email" name="email" value="@if(!empty($data['user']->email)) {{$data['user']->email}}  @endif" class="exchange-textbox">
                                </div>
                                <div class="col-md-5">
                                  <input type="text" placeholder=" Enter Contact" name="contact" value="@if(!empty($data['user']->contact)) {{$data['user']->contact}}   @endif" class="exchange-textbox">
                                </div>
                              </div>
                              <button class="gradient-button">Save</button>
                            </div>
                              </form>
                          </div>
                      
                        </div>


                        <div id="password" class="tab-pane fade">
                            <form action="{{url('/change_password')}}" method="post">
                             {{ csrf_field() }}
                          <div class="change-password">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-md-5">
                                  <input type="password" name="password" placeholder="Old Password" class="exchange-textbox" required>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-5">
                                  <input type="password" name="new_password" placeholder="New Password" class="exchange-textbox" required>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-5">
                                  <input type="password" name="confirm_password" placeholder="Confirm Password" class="exchange-textbox" required>
                                </div>
                              </div>
                              <button class="gradient-button">Save</button>
                            </div>
                          </div>
                        </form>
                        </div>
                        

                        <div id="payment" class="tab-pane fade">
                          <form action="{{url('/account_detail')}}" method="post">
                             {{ csrf_field() }}
                          <div class="payment">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-md-6">
                                  <p>Add Account Information</p>
                                </div>
                                <div class="col-md-6">

                                  <p>Added Account :@if(!empty($data['user_acc']->account_no)) {{$data['user_acc']->account_no}} @else Please enter Account detail @endif <span class="tag">Default</span></p>
                                </div>
                              </div>
                              <br>
                              <br>
                              <p>Add New Account</p>
                              <div class="row">
                                <div class="col-md-5">
                                  <input type="text" placeholder="Account Holder" value="@if(!empty($data['user_acc']->account_holder)) {{$data['user_acc']->account_holder}}   @endif" name="account_name" class="exchange-textbox" required>
                                </div>
                                <div class="col-md-5">
                                  <input type="text" placeholder="Account No." value="@if(!empty($data['user_acc']->account_no)) {{$data['user_acc']->account_no}}  @endif" name="account_no" maxlength="16" class="exchange-textbox" required>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-5">
                                  <input type="text" placeholder="IFSC" value="@if(!empty($data['user_acc']->IFSC)) {{$data['user_acc']->IFSC}}  @endif" name="ifsc" maxlength="11" class="exchange-textbox" required>
                                </div>
                                <div class="col-md-5">
                                  <input type="text" placeholder="Swift Code" value="@if(!empty($data['user_acc']->swift_code)) {{$data['user_acc']->swift_code}}  @endif" maxlength="11" name="swift_code" class="exchange-textbox" required>
                                </div>
                              </div>
                              <button class="gradient-button">Add Account</button>
                            </div>
                          </div>
                          </form>
                        </div>





                      </div>
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
      var getUrlParameter = function getUrlParameter(sParam) {
      var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$(document).ready(function(){

var tech = getUrlParameter('pay');
if (tech == 'yes') {
jQuery('#cust_pay').trigger('click');
};

});
$(document).ready(function(){
        setTimeout(function() {
          $('#msg').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
      </script>