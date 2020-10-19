<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\EmailConfirmation;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public $successStatus = 200;

    public function confirmEmail($id)
    {
        $user = User::findOrFail($id);

        if ($user->email_verified_at === null) {
            $user->email_verified_at = date('Y-m-d g:i:s');
            $user->save();
        }
        return view('emails.confirmed');
    }

    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function getOrderHistory()
    {
        $user = User::find(Auth::user()->id);
        $user['order_history'] = Order::where('cart_id', $user->cart->id)->where('status_id', 2)->with('product')->get();

        return response()->json(['success' => $user], $this->successStatus);
    }

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = User::find(Auth::user()->id);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = new User();
        $user->id = Str::uuid();
        $user->email  = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->save();

        $data = ['name' => $request->name, 'id' => $user->id];
        Mail::to($request->email)->send(new EmailConfirmation($data));

        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }
}
