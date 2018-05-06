<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite;
use App\User;
use Log;
use Session;
use App\Helpers\Token;

class SocialAuthController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Facebook Auth
	|--------------------------------------------------------------------------
	|*/

	public function facebookAuth() {
		return Socialite::driver('facebook')->redirect();
		
	}
	
	/*
	|--------------------------------------------------------------------------
	| Google Auth
	|--------------------------------------------------------------------------
	|*/

	public function googleAuth() {
		return Socialite::driver('google')->redirect();
	}
	
	/*
	|--------------------------------------------------------------------------
	| Facebook Auth CallBack
	|--------------------------------------------------------------------------
	|*/

	public function facebookCallback(Request $request) {
		try{
			$user = Socialite::driver('facebook')->user();
		} catch (\Exception $e) {
			Log::debug("Error occured whle logging in from facebook");
			Log::debug($e);
			return redirect('/')->with('status', 'Something went wrong or You have rejected the app!');
		}


		$params = array(
			'fullName' => $user->name,
			'password' => '',
			'email' => $user->email,
			'phoneNumber' => '',
			'signupSource' => 'FB',
			'ipAddress' => '127.0.0.1',
			'profilePicture' => $user->avatar_original
			);

		//store data in login session
		session(['user' => $user]);

		//check if user already exists
		$userExists = $userObject->findByEmail($user->email);                
		if(!$userExists){
			$userUpdated = User::create($params);
			$request->session()->put('userId', $userUpdated->id);
		} else{
			$userUpdated = $userObject->updateLastLogin($user->email);
			$request->session()->put('userId', $userUpdated->id);
		}	
		
		//redirect to dashboard
		if($userUpdated){
			return redirect('dashboard');
		} else{
			return redirect('/')->with('status','Login Failed');
		}
	}
	
	/*
	|--------------------------------------------------------------------------
	| Google Auth callback
	|--------------------------------------------------------------------------
	|*/
	
	public function googleCallback(Request $request) {
		try{
			$user = Socialite::driver('google')->stateless()->user();
		} catch (\Exception $e) {
			Log::debug("Error occured whle logging in from google");
			Log::debug($e);
			print_r($e);
			return redirect('/')->with('status', 'Something went wrong or You have rejected the app!');
		}

		//create user model object
		$userObject = new User();
		$params = array(
			'name' => $user->name,
			'email' => $user->email,
			'token' => $user->token,
			'phoneNumber' => '',
			'source' => 'GP',
			'ipAddress' => '127.0.0.1',
			'profilePicture' => $user->avatar_original,
			'remember_token' => Token::generate()
			);

		//store data in login session
		session(['user' => $user]);

		//check if user already exists
		$userExists = $userObject->findByEmail($user->email);                
		if(!$userExists){
			$userUpdated = User::create($params);
			$request->session()->put('userId', $userUpdated->id);
		} else{
			$userUpdated = $userObject->updateLastLogin($user->email);
			$request->session()->put('userId', $userUpdated->id);
		}	
		
		//redirect to dashboard
		if($userUpdated){
			return redirect('dashboard');
		} else{
			return redirect('/')->with('status','Login Failed');
		}
	}

}
