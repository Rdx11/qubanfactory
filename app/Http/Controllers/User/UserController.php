<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessLayer\UserBusinessLayer;
use App\DTO\UserDTO;

class UserController extends Controller
{
    private $userBusinessLayer;

    public function __construct()
    {
        $this->userBusinessLayer = new UserBusinessLayer();
    }

    public function login(Request $request)
    {
        if ($request->session()->exists('activeUser')) {
            return redirect('/dashboard/user');
        }

        $params = [
            'title' => 'Login'
        ];
        
        return view('shop.login.index', $params);
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $phoneNumber = $request->input('phone_number');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = 'User';

        $params = new UserDTO();
        $params->setName($name);
        $params->setPhoneNumber($phoneNumber);
        $params->setEmail($email);
        $params->setPassword($password);
        $params->setRole($role);

        $result = $this->userBusinessLayer->actionSave($params);

        if($result['code'] == 200){
            $request->session()->put('activeUser', $result['data']);
            return redirect('/')->with('success', 'Registrasi berhasil');   
        }else{
            return redirect()->back()->with('errors', $result['message']);   
        }
      
    }

    public function loginAdmin(Request $request)
    {
        if ($request->session()->exists('activeUser')) {
            return redirect('/admin/dashboard');
        }

        $params = [
            'title' => 'Login'
        ];
        
        return view('admin.login.index', $params);
    }

    public function validateLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $params = new UserDTO();
        $params->setEmail($email);
        $params->setPassword($password);

        $result = $this->userBusinessLayer->actionCheckLogin($params);

        if($result['code'] == 200){
           $request->session()->put('activeUser', $result['data']);
           return redirect('/')->with('success', 'login berhasil');   
        }else{
           return redirect()->back()->with('errors', $result['message']);   
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
