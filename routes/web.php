<?php

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
Route::get('/', function () {

    return view('welcome');

});

Route::match(['get', 'post'],'/','WebController@index');

Route::match(['get', 'post'],'/coin_market','WebController@Coin_Market');

Route::match(['get', 'post'],'/news','WebController@News');

Route::match(['get', 'post'],'/signup','WebController@SignUp');

Route::match(['get', 'post'],'/verify/{confirmation_code}','WebController@confirm');

Route::match(['get', 'post'],'/signin','WebController@SignIn');

Route::match(['get', 'post'],'/dashboard','WebController@Dashboard');

Route::match(['get', 'post'],'/trading','WebController@Trading');

Route::match(['get', 'post'],'/btc_history','WebController@BTC_History');

Route::match(['get', 'post'],'/eth_history','WebController@ETH_History');

Route::match(['get', 'post'],'/transaction','WebController@Transaction');

Route::match(['get', 'post'],'/buy_btc_eth','WebController@Buy_Btc_Eth');

Route::match(['get', 'post'],'/buy_eth','WebController@Buy_Eth');

Route::match(['get', 'post'],'/withdraw','WebController@Withdraw');

Route::match(['get', 'post'],'/withdraw_eth','WebController@Withdraw_eth');

Route::match(['get', 'post'],'/profile','WebController@Profile');

Route::match(['get', 'post'],'/logout','WebController@Logout');

Route::match(['get', 'post'],'/bit','WebController@bitcoin');

Route::match(['get', 'post'],'/instruction','WebController@Instruction');

Route::match(['get', 'post'],'/account_detail','WebController@Account_detail');

Route::match(['get', 'post'],'/send_bitcoin','WebController@Send_Bitcoin');

Route::match(['get', 'post'],'/info_update','WebController@Info_Update');

Route::match(['get', 'post'],'/change_password','WebController@changePassword');

Route::get('/login/facebook', 'WebController@redirectToProvider');

Route::get('/login/facebook/callback', 'WebController@handleProviderCallback');

Route::get('/login/twitter', 'WebController@redirectsToProvider');

Route::get('/login/twitter/callback', 'WebController@handlerProviderCallback');

Route::match(['get', 'post'],'/online','WebController@online_price');

Route::match(['get', 'post'],'/p','WebController@p');

Route::match(['get', 'post'],'/i','WebController@i');



Route::post ( '/pay', function (Request $request) {

    $id = $request->input('requesteds');

	\Stripe\Stripe::setApiKey ( 'sk_test_lbqdg9FcPwDpMkVomBWFhZHu' );

	try {

		\Stripe\Charge::create ( array (

				"amount" => $request->input ( 'amount' ),

				"currency" => "usd",

				"source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js

				"description" => "Test payment." 

		) );

        $value           = $request->session()->get('name');

        if(empty($value)){

        	return redirect('/logout');

        }

        $session_data    = json_decode($value);

         $account_id      = $session_data[0]->account_id;

         $email           = $session_data[0]->email;

        if(empty($email)){

        Session::flash('message', 'Please Complete  Profile detail');

        return redirect('/profile');

        } 



    $get_info   = DB::table('request_buy_bitcoin')->where('bitcoin_request_id',$id)->first();

    

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

	} catch ( \Exception $e ) {

		Session::flash ( 'message', "Error! Please Try again." );

		return Redirect('/buy_btc_eth');

	}

} );







