<?php

namespace App\Http\Controllers;


use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    private $request;

    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin()
    {
        $rules = [
            'email'    => 'required',
            'password' => 'required'
        ];

        $message = [
            'email.required'    => 'Bạn chưa nhập emai',
            'password.required' => 'Bạn chưa nhập mật khẩu'
        ];

        $this->validate($this->request, $rules, $message);

        $email    = $this->request->input('email');
        $password = $this->request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => Staff::IS_ACTIVE])) {
            return redirect('admin/dashboard/report-total');
        } else {
            return redirect('admin/login')->with('message', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('admin/login');
    }

}
