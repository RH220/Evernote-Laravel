<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * ユーザー登録後、投稿画面に遷移する
     * @param UserCreateRequest $request
     * @return RedirectResponse
     */
    public function register(UserCreateRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|max:255|regex:/^[a-zA-Z0-9]+$/',
        //     // unique:[テーブル名]	指定したテーブルに、対象の値が既にある場合はエラーになります。
        //     'email' => 'required|max:255|email|unique:users',
        //     'password' => 'required|max:255|min:8|regex:/^[a-zA-Z0-9]+$/',
        // ]);

        $user = User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        logger()->debug($user);
        $this->guard()->login($user);
        return redirect()->route('memo.index');
    }
    
}
