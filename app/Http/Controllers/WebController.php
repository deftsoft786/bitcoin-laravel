<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Hash;
use Session;
use Teamspeak3;
use Socialite;
use Redirect;
class WebController extends Controller{
      public function p(Request $request){
        if($request->isMethod('post')){
           $validator = Validator::make($request->all(), [ 
            'bitcoin'     => 'required',
            'amount'      => 'required',                 ]); 
        if($validator->fails()) {
            return redirect('/buy_btc_eth')
                        ->withErrors($validator)
                        ->withInput();
                                }

        $value           = $request->session()->get('name');

        $session_data    = json_decode($value);

        $account_id      = $session_data[0]->account_id;

        $email           = $session_data[0]->email;

    

        $length          = 10;

        $pool            = '0000000000ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789000000000';

        $bitcoin_request_id= substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

        if(empty($account_id)){

        return redirect('/');

          }

        $bitcoin         = trim($request->input('bitcoin')); 

        $amount          = trim($request->input('amount')); 

        $action          = trim($request->input('action'));   



        $array           = array(  'user_account_id'    => $account_id,

                                   'bitcoin_request_id' => $bitcoin_request_id,

                                   'quantity'           => $bitcoin,

                                   'amount'             => $amount,

                                   'type'               => 'BTC',

                                   'status'             => 2,

                                   'action'             =>$action

                           );

         $insert        = DB::table('request_buy_bitcoin')->insertGetId($array);

         $condition           =  array('id' =>$insert ,'user_account_id'=>$account_id); 

         $get_amount          = DB::table('request_buy_bitcoin')->where($condition)->first();

  

         return view('payment',array('amount' =>$get_amount ));     

      }

      }     

      public function i(Request $request){

        if($request->isMethod('post')){

           $validator = Validator::make($request->all(), [ 

            'eth'     => 'required',

            'amount'  => 'required',

                                     ]); 

         if($validator->fails()) {

            return redirect('/buy_eth')

                        ->withErrors($validator)

                        ->withInput();

                                }

          $value           = $request->session()->get('name');

          if(empty($value)){

          return redirect('/');

            } 



          $session_data    = json_decode($value);

          $account_id      = $session_data[0]->account_id;

          $email           = $session_data[0]->email;

          $length          = 10;

          $pool            = 'ASDFGHJKLQWRERTTY0000000000000123456789';

          $bitcoin_request_id= substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

          if(empty($account_id)){

          return redirect('/');

            }

          $bitcoin         = trim($request->input('eth')); 

          $amount          = trim($request->input('amount'));   

          $action          = trim($request->input('action'));   



          $array           = array(  'user_account_id'    => $account_id,

                                     'bitcoin_request_id' => $bitcoin_request_id,

                                     'quantity'           => $bitcoin,

                                     'amount'             => $amount,

                                     'type'               => 'ETH',

                                     'status'             => 2,

                                     'action'             => $action

                             );

           $insert       = DB::table('request_buy_bitcoin')->insertGetId($array);

         $condition      =  array('id' =>$insert ,'user_account_id'=>$account_id); 

         $get_amount     = DB::table('request_buy_bitcoin')->where($condition)->first();

  

         return view('payment',array('amount' =>$get_amount ));

     

      }

      }

          //facebook login

      public function redirectToProvider(){

         return Socialite::driver('facebook')->redirect();

      } 

      public function handleProviderCallback(Request $request){
        $user         = Socialite::driver('facebook')->stateless()->user();
        if(!empty($user)){
        $name         = $user['name'];
        $image        = $user->avatar_original;
        $id           = $user['id'];
        $length       = 16;
        $pool         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $account_id   = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $checkUser    =  DB::table('user')->where('facebook_id', $id)->first();
        if(count($checkUser) > 0){ 
             $get_in =  DB::table('user')->where('facebook_id', $id)->get();
             Session::put('name',$get_in);
             $api  = "https://blockchain.info/ticker";
             $json = file_get_contents($api);
             $buy_price = json_decode($json, TRUE);
             $apis = "https://www.bitstamp.net/api/v2/ticker/ethusd";
             $jsons = file_get_contents($apis);
             $sell_price = json_decode($jsons, TRUE);           
             $get_balance = 0; 
             
             $value   = $request->session()->get('name');
             if(empty($value)){
             return redirect('/');
              } 
            $session_data    = json_decode($value);
            $account_id      = $session_data[0]->account_id;
            $name            = $session_data[0]->name;
            $image           = $session_data[0]->fb_img;
            $time            = time();
            $time_check      = $time-300;
            $get_session     = DB::table('session')->where('session',$account_id)->count();
            if($get_session == 0){
            $inserts         = array( 'session'=>$account_id,
                                      'name'    =>$name,
                                      'fb_img'   =>$image,
                                      'created_at' =>$time);
            $online          = DB::table('session')->insert($inserts); 
            }else{
            $updates = array('session'=>$account_id,
                             'name'=>$name,
                             'fb_img'=>$image,
                             'created_at' =>$time);
              $online        = DB::table('session')->where('session',$account_id)->update($updates);
            }
             
             $all = DB::table('session')->get();
             $product = collect([$buy_price,$sell_price,$get_balance,$all]);
             Session::push('cart', $product);
             
             
             $del  = DB::table('session')->where('created_at','<',$time_check)->delete();
            
             

             return redirect('/dashboard');
        }else{
          $insert      = array('name' =>$name,

                               'account_id'=> $account_id,

                                'fb_img'   => $image,

                               'facebook_id'=>$id);

           $get_ins = DB::table('user')->insertGetId($insert);
           $InsertArray2  = array( 'user_account_id'    => $account_id ,

                                   'account_holder'     => $name,

                                   'account_no'         => 0,

                                   'IFSC'               => 0,

                                   'swift_code'         => 0,

                                  );

            $Register  = DB::table('user_account_info')->where('user_account_id',$account_id)->insertGetId($InsertArray2);

           $get_in =  DB::table('user')->where('id', $get_ins)->get();

           Session::put('name',$get_in);

            $api  = "https://blockchain.info/ticker";

             $json = file_get_contents($api);

             $buy_price = json_decode($json, TRUE);

             $apis = "https://www.bitstamp.net/api/v2/ticker/ethusd";

             $jsons = file_get_contents($apis);

             $sell_price = json_decode($jsons, TRUE);

            
             $get_balance = 0; 

             $value   = $request->session()->get('name');

            if(empty($value)){

            return redirect('/');
              } 
            $session_data    = json_decode($value);
            $account_id      = $session_data[0]->account_id;
            $name            = $session_data[0]->name;
            $image            = $session_data[0]->fb_img;
            $time       = time();
            $time_check = $time-300;
            $get_session = DB::table('session')->where('session',$account_id)->count();
            if($get_session == 0){
            $inserts = array('session'=>$account_id,
                             'name'    =>$name,
                             'fb_img'   =>$image,
                             'created_at' =>$time);
            $online          = DB::table('session')->insert($inserts); 
            }else{
               $updates = array('session'=>$account_id,
                                'name'=>$name,
                                'fb_img'=>$image,
                                'created_at' =>$time);
              $online          = DB::table('session')->where('session',$account_id)->update($updates);
            }
             $all     = DB::table('session')->get();
             $product = collect([$buy_price,$sell_price,$get_balance,$all]);
             Session::push('cart', $product);
             
             
             $del  = DB::table('session')->where('created_at','<',$time_check)->delete();
             Session::flash('message', 'Please Complete  Profile detail');

             return redirect('/profile');
        }

          }else{

             Session::flash('message', 'Internal server error! Please Try Again');

      

             return Redirect('/');

        }

      }

          // Twitter login

      public function redirectsToProvider(){

        return Socialite::driver('twitter')->redirect();

      }

      public function handlerProviderCallback(Request $request){

        $user         = Socialite::driver('twitter')->user();

         if(!empty($user)){

        $image        = $user->avatar_original;

        $name         = $user->name;

        $id           = $user->id;

        $length       = 16;

        $pool         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $account_id   = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

        $checkUser    =  DB::table('user')->where('twitter_id', $id)->first();

        if(count($checkUser) > 0){ 



             $get_in =  DB::table('user')->where('twitter_id', $id)->get();

             Session::put('name',$get_in);

            $api  = "https://blockchain.info/ticker";

             $json = file_get_contents($api);

             $buy_price = json_decode($json, TRUE);

             $apis = "https://www.bitstamp.net/api/v2/ticker/ethusd";

             $jsons = file_get_contents($apis);

             $sell_price = json_decode($jsons, TRUE);

             $get_balance = 0; 

            

             

             $value   = $request->session()->get('name');

            if(empty($value)){

            return redirect('/');
              } 
            $session_data    = json_decode($value);
            $account_id      = $session_data[0]->account_id;
            $name            = $session_data[0]->name;
            $image            = $session_data[0]->fb_img;
            $time       = time();
            $time_check = $time-300;
            $get_session = DB::table('session')->where('session',$account_id)->count();
            if($get_session == 0){
            $inserts = array('session'=>$account_id,
                             'name'    =>$name,
                             'fb_img'   =>$image,
                             'created_at' =>$time);
            $online          = DB::table('session')->insert($inserts); 
            }else{
               $updates = array('session'=>$account_id,
                'name'=>$name,
                'fb_img'=>$image,
                                'created_at' =>$time);
              $online          = DB::table('session')->where('session',$account_id)->update($updates);
            }
             $all = DB::table('session')->get();
             $product = collect([$buy_price,$sell_price,$get_balance,$all]);
             Session::push('cart', $product);
             
             
             $del  = DB::table('session')->where('created_at','<',$time_check)->delete();
            
             

             return redirect('/dashboard');

       

        }else{

          

          $insert      = array('name' =>$name,

                               'account_id'=> $account_id,

                               'fb_img'   => $image,

                               'twitter_id'=>$id);

          $get_ins = DB::table('user')->insertGetId($insert);

            $InsertArray2  = array( 'user_account_id'    => $account_id ,

                                   'account_holder'     => $name,

                                   'account_no'         => 0,

                                   'IFSC'               => 0,

                                   'swift_code'         => 0,

                                  );

            $Register  = DB::table('user_account_info')->where('user_account_id',$account_id)->insertGetId($InsertArray2);

           $get_in =  DB::table('user')->where('id', $get_ins)->get();

           Session::put('name',$get_in);

            $api  = "https://blockchain.info/ticker";

             $json = file_get_contents($api);

             $buy_price = json_decode($json, TRUE);

             $apis = "https://www.bitstamp.net/api/v2/ticker/ethusd";

             $jsons = file_get_contents($apis);

             $sell_price = json_decode($jsons, TRUE);

             $get_balance = 0; 

            

             

             $value   = $request->session()->get('name');

            if(empty($value)){

            return redirect('/');
              } 
            $session_data    = json_decode($value);
            $account_id      = $session_data[0]->account_id;
            $name            = $session_data[0]->name;
            $image            = $session_data[0]->image;
            $time       = time();
            $time_check = $time-300;
            $get_session = DB::table('session')->where('session',$account_id)->count();
            if($get_session == 0){
            $inserts = array('session'=>$account_id,
                             'name'    =>$name,
                             'image'   =>$image,
                             'created_at' =>$time);
            $online          = DB::table('session')->insert($inserts); 
            }else{
               $updates = array('session'=>$account_id,
                'name'=>$name,
                'image'=>$image,
                                'created_at' =>$time);
              $online          = DB::table('session')->where('session',$account_id)->update($updates);
            }
             $all = DB::table('session')->get();
             $product = collect([$buy_price,$sell_price,$get_balance,$all]);
             Session::push('cart', $product);
             
             
             $del  = DB::table('session')->where('created_at','<',$time_check)->delete();
             return redirect('/dashboard');

         }

       }else{

             Session::flash('message', 'Internal server error! Please Try Again');

             Session::flash('alert-class', 'alert-danger'); 

             return Redirect('/');

       }

      }

             // script code change price online

       public function online_price() {

              //$buy_price   = DB::table('buy_price')->first();

              //$sell_price  = DB::table('sell_price')->first();

               $api  = "https://blockchain.info/ticker";

               $json = file_get_contents($api);

               $data = json_decode($json, TRUE);

               $apis = "https://www.bitstamp.net/api/v2/ticker/ethusd";

               $jsons = file_get_contents($apis);

               $datas = json_decode($jsons, TRUE);

              

               $date['btc_buy'] = $data['USD']['buy'] ;

               $date['btc_sell'] = $data['USD']['sell'] ;

               $date['eth_buy'] = $datas['ask'] ;

               $date['eth_sell'] = $datas['bid'] ;

               $final = json_encode($date);

             

               print_r($final);

      }

               //Home

      public function index() {

        //$buy_price   = DB::table('buy_price')->first();

        //$sell_price  = DB::table('sell_price')->first();

         $api  = "https://blockchain.info/ticker";

         $json = file_get_contents($api);

         $data = json_decode($json, TRUE);

         $apis = "https://www.bitstamp.net/api/v2/ticker/ethusd";

         $jsons = file_get_contents($apis);

         $datas = json_decode($jsons, TRUE);

        

        return view('bitcoin/homepage',array('buy'=>$data,'sell'=>$datas)); 

      }

            // Signup

      public function SignUp(Request $request){

             if($request->isMethod('post')){

                $validator = Validator::make($request->all(), [ 

                'name'     => 'required|max:255',

                'email'    => 'required|unique:user',

                'password' => 'required|min:10',

                'confirm_password' => 'required|same:password',

                                                         ]); 

              if($validator->fails()) {

               return redirect('/')

                        ->withErrors($validator)

                        ->withInput();

                }

                $name         = trim($request->input('name')); 

                $email        = trim($request->input('email'));

                $visible_pwd  = trim($request->input('password'));

                $password     = Hash::make(trim($request->input('password')));

                $confirmation_code = str_random(30);

                $length       = 16;

                $pool         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                $account_id   = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

                $InsertArray  = array( 'name'                => $name,

                                       'email'               => $email,

                                       'password'            => $password,

                                       'visible_password'    =>$visible_pwd,

                                       'email_active'        => 2,

                                       'confirmation_code'   => $confirmation_code,

                                       'block_status'         => 2,

                                       'account_id'           => $account_id,

                                      );

                $RegisterInfo  = DB::table('user')->insertGetId($InsertArray);

                $InsertArray2  = array( 'user_account_id'    => $account_id ,

                                   'account_holder'     => $name,

                                   'account_no'         => 0,

                                   'IFSC'               => 0,

                                   'swift_code'         => 0,

                                  );

                $Register  = DB::table('user_account_info')->where('user_account_id',$account_id)->insertGetId($InsertArray2);

                if($RegisterInfo){

                 $get_info           = DB::table('user')->where('id',$RegisterInfo)->first();

                 $email              = $get_info->email;

                 $confirmation_code  = $get_info->confirmation_code;

                 $account_ids        = $get_info->account_id;

                 $passwords          = $get_info->visible_password;

                 $confirmation_code1 = array('confirmation_code' => $confirmation_code,

                                             'email'             => $email,

                                             'address'           => $account_ids,

                                             'visible_password'  => $passwords);

                 Mail::send('bitcoin/verify',$confirmation_code1, function ($m) use ($email) {

                 $m->from('expinatortesting@gmail.com', 'ecex.io');

                 $m->to($email,' User')

                 ->subject('Thanks for SignIn With ecex.io');

                 });

                  $message = "Thanks for signing up! Please check your email.";

                  Session::flash('message',$message);

                  return redirect('/');

                  }else{

                  $message = "Sorry! Please Register Again";

                  Session::flash('message',$message);

                  return redirect('/');

                  }

                  }

      }

            // confirm Email

      public function confirm($confirmation_code){

          if(!$confirmation_code){

            throw new InvalidConfirmationCodeException;

            }

            $user = DB::table('user')->where('confirmation_code',$confirmation_code)->first();

            $id =  $user->id;

          if(!$user){

            throw new InvalidConfirmationCodeException;

            }

            $updatedArray = array('email_active'  => 1,

                                  'confirmation_code' => '',

                                 );

            $update = DB::table('user')->where('id',$id)->update($updatedArray);

            $message = "You have successfully verified your account. Please Go to Login";

            Session::flash('message',$message);

            return redirect('/');

      } 

            // Signin

      public function SignIn(Request $request){
         if($request->isMethod('post')){

           $validator = Validator::make($request->all(), [

                            'account_id'    => 'required',

                            'password'      => 'required',]); 

         if($validator->fails()) {

            return redirect('/')

                        ->withErrors($validator)

                        ->withInput(); }

            $email      = trim($request->input('account_id'));

            $password   = trim($request->input('password'));

            $query      = DB::table('user')->where('account_id',$email)->get();

           

            $checkUser  = count($query);

         if($checkUser >0){

             $password1 = $query[0]->password;   

         if(Hash::check($password,$password1)){

         if($query[0]->email_active == 1){

             $account_id  = $query[0]->account_id;

             Session::put('name',$query);

             $api  = "https://blockchain.info/ticker";

             $json = file_get_contents($api);

             $buy_price = json_decode($json, TRUE);

             $apis = "https://www.bitstamp.net/api/v2/ticker/ethusd";

             $jsons = file_get_contents($apis);

             $sell_price = json_decode($jsons, TRUE);

             

             $get_balance = 0; 

            

             

             $value   = $request->session()->get('name');

            if(empty($value)){

            return redirect('/');
              } 
            $session_data    = json_decode($value);
            $account_id      = $session_data[0]->account_id;
            $name            = $session_data[0]->name;
            $image            = $session_data[0]->image;
            $time       = time();
            $time_check = $time-300;
            $get_session = DB::table('session')->where('session',$account_id)->count();
            if($get_session == 0){
            $inserts = array('session'=>$account_id,
                             'name'    =>$name,
                             'image'   =>$image,
                             'created_at' =>$time);
            $online          = DB::table('session')->insert($inserts); 
            }else{
               $updates = array('session'=>$account_id,
                'name'=>$name,
                'image'=>$image,
                                'created_at' =>$time);
              $online          = DB::table('session')->where('session',$account_id)->update($updates);
            }
             $all = DB::table('session')->get();
             $product = collect([$buy_price,$sell_price,$get_balance,$all]);
             Session::push('cart', $product);
             
             
             $del  = DB::table('session')->where('created_at','<',$time_check)->delete();
             return redirect('/dashboard');
           
         }else{

             Session::flash('message', 'Please verify your Email first then try Login!');

             Session::flash('alert-class', 'alert-danger'); 

             return Redirect('/');

            }

         }else{

             Session::flash('message', 'The Account ID and Password you have entered did not match.');

             Session::flash('alert-class', 'alert-danger'); 

             return Redirect('/');   

             }

         }else{

             Session::flash('message', 'The Account ID you have entered does not Exist.');

             Session::flash('alert-class', 'alert-danger'); 

             return Redirect('/');

             }

         }

      }

            // Coin & market

      public function Coin_Market(Request $request){

         $api  = "https://blockchain.info/ticker";

         $json = file_get_contents($api);

         $data = json_decode($json, TRUE);

         $apis = "https://www.bitstamp.net/api/v2/ticker/ethusd";

         $jsons = file_get_contents($apis);

         $datas = json_decode($jsons, TRUE);

       return view('bitcoin/coin_market',array('buy'=>$data,'sell'=>$datas));   

      }

            // Exchange News

      public function News(Request $request){ 

           return view('bitcoin/exchange_news');   

      }

            // dashboard

      public function Dashboard(Request $request){  

        $value           = $request->session()->get('name');

         if(empty($value)){

        return redirect('/');

          }

          $session_data    = json_decode($value,true);

          $account_id      = $value[0]->account_id;

          $get_balance = DB::table('user_balance')->where('user_account_id',$account_id)->sum('btc_balance');

        

         return view('bitcoin/dashboard',array('show' => $get_balance)); 

      }

            // trading

      public function Trading(Request $request){

           return view('bitcoin/trading'); 

      }

           // btc history

      public function BTC_History(Request $request){

            $value           = $request->session()->get('name');

            if(empty($value)){

            return redirect('/');

              } 

            $session_data    = json_decode($value);

            $account_id      = $session_data[0]->account_id;

        

            $condition = array('user_account_id'=>$account_id,'type'=>'BTC');

            $get_buy  = DB::table('request_buy_bitcoin')->where($condition);

            $get_sell = DB::table('request_sell_bitcoin')->where($condition);

            $results = $get_buy->union($get_sell)->orderby('created_at','DESC')->get();

            return view('bitcoin/btc_history',array('data'=>$results)); 

      }

          // eth history

      public function ETH_History(Request $request){

        $value           = $request->session()->get('name');

        if(empty($value)){

        return redirect('/');

          } 

        $session_data    = json_decode($value);

        $account_id      = $session_data[0]->account_id;

    

        $condition = array('user_account_id'=>$account_id,'type'=>'ETH');

        $get_buy   = DB::table('request_buy_bitcoin')->where($condition);

        $get_sell  = DB::table('request_sell_bitcoin')->where($condition);

        $results   = $get_buy->union($get_sell)->orderby('created_at','DESC')->get();

        return view('bitcoin/eth_history',array('data'=>$results));         

      }

           // transaction

      public function Transaction(Request $request){

        $value           = $request->session()->get('name');

        if(empty($value)){

        return redirect('/');

          } 

        $session_data    = json_decode($value);

        $account_id      = $session_data[0]->account_id;

        $condition = array('user_account_id'=>$account_id);

        $get_buy  = DB::table('request_buy_bitcoin')->where($condition);

        $get_sell = DB::table('request_sell_bitcoin')->where($condition);

        $results = $get_buy->union($get_sell)->orderby('created_at','DESC')->get();



        return view('bitcoin/transaction',array('data' => $results)); 

      }

           // buy btc only

      public function Buy_Btc_Eth(Request $request){

        if($request->isMethod('post')){

           $validator = Validator::make($request->all(), [ 

            'bitcoin'     => 'required',

            'amount'      => 'required',

                                                         ]); 

        if($validator->fails()) {

            return redirect('/buy_btc_eth')

                        ->withErrors($validator)

                        ->withInput();

                                }

        $value           = $request->session()->get('name');

        $session_data    = json_decode($value);

        $account_id      = $session_data[0]->account_id;

        $email           = $session_data[0]->email;

        $length          = 10;

        $pool            = '0000000000ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789000000000';

        $bitcoin_request_id= substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

        if(empty($account_id)){

        return redirect('/');

          }

        $bitcoin         = trim($request->input('bitcoin')); 

        $amount          = trim($request->input('amount')); 

        $action          = trim($request->input('action'));   



        $array           = array(  'user_account_id'    => $account_id,

                                   'bitcoin_request_id' => $bitcoin_request_id,

                                   'quantity'           => $bitcoin,

                                   'amount'             => $amount,

                                   'type'               => 'BTC',

                                   'status'             => 2,

                                   'action'             =>$action

                           );

         $insert        = DB::table('request_buy_bitcoin')->insertGetId($array);

         $insertarray  = array('btc_balance'     =>$bitcoin,

                                 'user_account_id' =>$account_id

                           );

            $put_coin = DB::table('user_balance')->insert($insertarray);

        if($insert){

        $get_info           = DB::table('request_buy_bitcoin')->where('user_account_id',$account_id)->first();

                

                 $user_account_id    = $get_info->user_account_id;

                 $bitcoin_request_id = $get_info->bitcoin_request_id;

                 $bitcoin            = $get_info->quantity;

                 $amount             = $get_info->amount;

                 $type               = $get_info->type;

                 $confirmation_code1  = array( 'account_id'        => $user_account_id,

                                               'bitcoin_id'        => $bitcoin_request_id,

                                               'bitcoin'           => $bitcoin,

                                               'type'              => $type,

                                               'amount'            => $amount);

                 Mail::send('bitcoin/bitcoin_verify',$confirmation_code1, function ($m) use ($email) {

                       $m->from('expinatortesting@gmail.com', 'ecex.io');

                       $m->to($email,' User')

                       ->subject('Thanks for Buy coin From ecex.io');

                       });

                $message = "Thanks for buy coin ! Please check your email.";

                Session::flash('message',$message);

                return redirect('/p');

          



        }else{

          $message = "Internal server error! Please try again";

          Session::flash('message',$message);

          return redirect('/buy_btc_eth');

        }

        }else{

        $api  = "https://blockchain.info/ticker";

         $json = file_get_contents($api);

         $data = json_decode($json, TRUE);

         



       return view('bitcoin/buy_btc_eth',array('btcd'=>$data)); 

        }

      }

           // buy eth

      public function Buy_Eth(Request $request){

         if($request->isMethod('post')){

           $validator = Validator::make($request->all(), [ 

            'eth'     => 'required',

            'amount'  => 'required',

                                     ]); 

         if($validator->fails()) {

            return redirect('/buy_eth')

                        ->withErrors($validator)

                        ->withInput();

                                }

          $value           = $request->session()->get('name');

          if(empty($value)){

          return redirect('/');

            } 



          $session_data    = json_decode($value);

          $account_id      = $session_data[0]->account_id;

          $email           = $session_data[0]->email;

          $length          = 10;

          $pool            = 'ASDFGHJKLQWRERTTY0000000000000123456789';

          $bitcoin_request_id= substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

          if(empty($account_id)){

          return redirect('/');

            }

          $bitcoin         = trim($request->input('eth')); 

          $amount          = trim($request->input('amount'));   

          $action          = trim($request->input('action'));   



          $array           = array(  'user_account_id'    => $account_id,

                                     'bitcoin_request_id' => $bitcoin_request_id,

                                     'quantity'           => $bitcoin,

                                     'amount'             => $amount,

                                     'type'               => 'ETH',

                                     'status'             => 2,

                                     'action'             => $action

                             );

           $insert       = DB::table('request_buy_bitcoin')->insertGetId($array);

          

          if($insert){

          

            $get_info           = DB::table('request_buy_bitcoin')->where('user_account_id',$account_id)->first();

                

                 $user_account_id    = $get_info->user_account_id;

                 $bitcoin_request_id = $get_info->bitcoin_request_id;

                 $bitcoin            = $get_info->quantity;

                 $amount             = $get_info->amount;

                 $type               = $get_info->type;

                 $confirmation_code1  = array( 'account_id'        => $user_account_id,

                                               'bitcoin_id'        => $bitcoin_request_id,

                                               'bitcoin'           => $bitcoin,

                                               'type'              => $type,

                                               'amount'            => $amount);

                 Mail::send('bitcoin/bitcoin_verify',$confirmation_code1, function ($m) use ($email) {

                       $m->from('expinatortesting@gmail.com', 'ecex.io');

                       $m->to($email,' User')

                       ->subject('Thanks for Buy coin From ecex.io');

                       });

                $message = "Thanks for buy coin ! Please check your email.";

                Session::flash('message',$message);

                return redirect('/dashboard');



          }else{

            $message = "Internal server error! Please try again";

            Session::flash('message',$message);

            return redirect('/buy_eth');

          }

          }else{

          $apis = "https://www.bitstamp.net/api/v2/ticker/ethusd";

          $jsons = file_get_contents($apis);

          $datas = json_decode($jsons, TRUE);

          return view('bitcoin/buy_eth',array('ethi'=> $datas)); 

          }

      }

            // withdraw btc

      public function Withdraw(Request $request){

        if($request->isMethod('post')){

           $this->validate($request, [

                                      'bitcoin'         => 'required',

                                      'price'           => 'required',

                                      'account_name'    => 'required',

                                      'account_no'      => 'required',

                                      'IFSC'            => 'required',

                                      'swift_code'      => 'required',

                                     ]);   

        }else{



        $value           = $request->session()->get('name');

        if(empty($value)){

        return redirect('/');

          } 

        $session_data    = json_decode($value);

        $account_id      = $session_data[0]->account_id;

         $condition = array('user_account_id'=>$account_id);

        $get_balance  = DB::table('user_balance')->where($condition)->first();

        $get_account  = DB::table('user_account_info')->where($condition)->first();

        $results['balance'] = $get_balance;

        $results['accont']  =  $get_account;

        return view('bitcoin/withdraw',array('data'=>$results)); 

        }

      }

             // withdraw eth

      public function Withdraw_eth(Request $request){

        $value           = $request->session()->get('name');

        if(empty($value)){

        return redirect('/');

          } 

        $session_data    = json_decode($value);

        $account_id      = $session_data[0]->account_id;

         $condition = array('user_account_id'=>$account_id);

        $get_balance  = DB::table('user_balance')->where($condition)->first();

        $get_account  = DB::table('user_account_info')->where($condition)->first();

        $results['balance'] = $get_balance;

        $results['accont']  =  $get_account;



        return view('bitcoin/withdraw_eth',array('data'=>$results)); 

      }

              // profile data

      public function Profile(Request $request){

          $value           = $request->session()->get('name');

         

          if(empty($value)){

            

          return redirect('/');

            } 

          

          $session_data    = json_decode($value);

          $account_id      = $session_data[0]->account_id;     

          $get_buy         = DB::table('user')->where('account_id',$account_id)->first();

          $get_sell        = DB::table('user_account_info')->where('user_account_id',$account_id)->first();

          $results['user'] = $get_buy;

          $results['user_acc'] =  $get_sell;

          



        return view('bitcoin/profile',array('data'=>$results)); 

      }

              // Logout

      public function Logout(Request $request){

           $request->session()->flush();

           return redirect('/');

      }

              // term and condition page

      public function Instruction(Request $request){

        return view('/bitcoin/instruction');

      }

             // Account detail while on buy 

      public function Account_detail(Request $request){  

             $validator = Validator::make($request->all(), [ 

                  'account_name'     => 'required',

                  'account_no'       => 'required',

                  'ifsc'             => 'required',

                  'swift_code'       => 'required',

                                                      ]); 

              if($validator->fails()) {

                  return redirect('/')

                              ->withErrors($validator)

                              ->withInput();

                                      }

              $value           = $request->session()->get('name');

              if(empty($value)){

              return redirect('/');

                                    }

              $session_data    = json_decode($value);

              $account_id      = $session_data[0]->account_id;

              $email           = $session_data[0]->email;  

             

              $account_name       = trim($request->input('account_name')); 

              $account_no         = trim($request->input('account_no')); 

              $ifsc               = trim($request->input('ifsc'));  

              $swift_code         = trim($request->input('swift_code'));              

              $arrayinfo =array(             'user_account_id'   =>  $account_id,

                                             'account_holder'    =>  $account_name,

                                             'account_no'        =>  $account_no,

                                             'ifsc'              =>  $ifsc,

                                             'swift_code'        =>  $swift_code

                                             ); 

              $insert = DB::table('user_account_info')->where('user_account_id', $account_id )->update($arrayinfo);

             

                    

                    



                $message = "Your Information Updated Successfully";

                   Session::flash('message',$message);

                  return redirect('/dashboard');

               

      }

             // send btc eth

      public function Send_Bitcoin(Request $request){

         if($request->isMethod('post')){

            $this->validate($request, [

                      'select_name'      => 'required',

                      'account_id'       => 'required',

                      'set'              => 'required',

                      'select_type'      => 'required',

                                      ]); 

           $name       =    $request->input('select_name');

           $account_id =    $request->input('account_id');

           $set_value  =    $request->input('set');

           $select_type=    $request->input('select_type');

           $amount_btc =    $request->input('bit')*$set_value;

           $amount_eth =    $request->input('eths')*$set_value;

           $length          = 10;

           $pool            = '000000000abcdefghijklmnopqrstuvwxyz0000000123456789';

           $sell_id         = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

           if($select_type == 'BTC'){

           $InsertArray = array('user_account_id'  => $account_id,

                                'bitcoin_sell_id'  => $sell_id,

                                'quantity'         => $set_value,

                                'type'             => $select_type,

                                'status'           => 2,

                                'amount'           => $amount_btc,

                                'action'           => 'Sell'

                                ); 

          $insertinto  = DB::table('request_sell_bitcoin')->insertGetId($InsertArray);

         }else{

            $InsertArray = array('user_account_id'  => $account_id,

                                'bitcoin_sell_id'  => $sell_id,

                                'quantity'         => $set_value,

                                'type'             => $select_type,

                                'status'           => 2,

                                'amount'           => $amount_eth,

                                'action'           => 'Sell'

                                ); 

          $insertinto  = DB::table('request_sell_bitcoin')->insertGetId($InsertArray);



         }

           

         

         if($insertinto){

           $get_info           = DB::table('request_sell_bitcoin')->where('id',$insertinto)->first();

           $user_account_id    = $get_info->user_account_id;

           $bitcoin_request_id = $get_info->bitcoin_sell_id;

           $quantity           = $get_info->quantity;

           $type               = $get_info->type;

           $value              = $request->session()->get('name');

           $session_data       = json_decode($value); 

           $email              = $session_data[0]->email;

         if(empty($account_id)){

         return redirect('/');

                              }

          $confirmation_code1  = array('account_id'        => $user_account_id,

                                       'bitcoin_id'        => $bitcoin_request_id,

                                       'type'              => $type,

                                       'amount'            => $quantity);

           Mail::send('bitcoin/bitcoin_sell_verify',$confirmation_code1, function ($m) use ($email) {

                 $m->from('expinatortesting@gmail.com', 'ecex.io');

                 $m->to($email,' User')

                 ->subject('Thanks for Sell coin From ecex.io');

                 });

          $message = "Thanks for sell coin ! Please check your email.";

          Session::flash('message',$message);

          return redirect('/dashboard');

         }

         }

          $get_user  = DB::table('user')->get();  

          return view('bitcoin/send_bitcoin',array('data'=>$get_user));

      }

              // Update profile data

      public function Info_Update(Request $request){

              if($request->isMethod('post')){

              $value           = $request->session()->get('name');

              if(empty($value)){

              return redirect('/');

                } 

              $session_data    = json_decode($value);

              $account_id      = $session_data[0]->account_id;

              $name            = trim($request->input('name')); 

              $email           = trim($request->input('email'));

              $last_name       = trim($request->input('last_name'));

              $contact         = trim($request->input('contact'));

             

              if( $request->hasFile('image')){ 

                  $image    = $request->file('image');

                  $destinationPath = 'bitcoin/images/user';   

                  $extension = $image->getClientOriginalExtension();

                  $fileName = rand(11111,99999).'.'.$extension;

                  Input::file('image')->move($destinationPath, $fileName);

                   $UpdateArray   = array('name'                => $name,

                                     'email'               => $email,

                                     'last_name'           => $last_name,

                                     'contact'             => $contact,

                                     'image'               => $fileName

                                    );

                  $updating = DB::table('user')->where('account_id',$account_id)->update($UpdateArray);

                }else{

                      $UpdateArray1   = array('name'                => $name,

                                              'email'               => $email,

                                              'last_name'           => $last_name,

                                              'contact'             => $contact

                      );

                     $updating = DB::table('user')->where('account_id',$account_id)->update($UpdateArray1);

                   }

                     $get_datas = DB::table('user')->where('account_id',$account_id)->get();



                   $items = Session::get('name', []);

                    Session::put('name', $get_datas);



                if($updating){ $message = "Your Information Updated Successfully";

                   Session::flash('message',$message);

                  return redirect('/profile');}else{

                    $message = "Internal server Error Please Try Again";

                Session::flash('message',$message);

                return redirect('/profile');               

               }

             }

      }

             // change password

      public function changePassword(Request $request){

          $value           = $request->session()->get('name');

             if(empty($value)){

             return redirect('/');

                              } 

             $session_data    = json_decode($value);

             $account_id      = $session_data[0]->account_id;

            if($request->isMethod('post')){

              $this->validate($request, [

                                        'password'         => 'required',

                                        'new_password'     => 'required|Min:10',

                                        'confirm_password' =>'required|Min:10|same:new_password'

                                        ]);

             $password             = trim($request->input('password'));

             $new_password_visible = trim($request->input('new_password'));

             $new_password         = hash::make(trim($request->input('new_password')));

             $get_data = DB::table('user')->where('account_id',$account_id)->first();

           if(Hash::check($password,$get_data->password)){

             $updateArray = array(       'password'        => $new_password,

                                         'visible_password'=> $new_password_visible  

                    );

             $update =DB::table('user')->where('account_id',$account_id)->update($updateArray);

           if($update){

                $message  = "Password changed Successfully";

                Session::flash('message',$message);

                return redirect('/');

           }else{

                $message  = "Please Try Again";

                Session::flash('message',$message);

                return redirect('/profile');

             }     

           }else{

                $message  = "Old Password Not Correct";

                Session::flash('message',$message);

                return redirect('/profile');

            }

          }

      }

}

