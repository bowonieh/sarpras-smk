<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class AuthController extends BaseController
{	
	private $authmodel;
	public function __construct()
	{
		$this->authmodel = new AuthModel;
	}
	public function index()
	{
		//
		if(session()->get('isLoggedIn')){
			return redirect()->to('dashboard');
		}
		$data = array(
			'judul' => 'Aplikasi Sarpras'
		);
		return view('login/loginForm',$data);
	}
	public function checkLogin(){
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$chk = $this->authmodel
				->select('username,password,id_akun,id_jenis_user')
				->where(array('username'=>$username))->first();
		if($chk > 0){
			$psw = $chk['password'];
			if(password_verify($password,$psw)){
				$sess_data = array(
                    'id_akun' 		=> $chk['id_akun'],
                    'id_jenis_user' => $chk['id_jenis_user'],
                    'isLoggedIn' 	=> TRUE
                );
				session()->set($sess_data);
				$output = array(
					'success'	=> true,
					'url'		=> base_url().'/dashboard',
					'pesan'		=> 'anda berhasil login'
				);
			}else{
				$output = array(
					'success'	=> false,
					'pesan'		=> 'Password anda salah'
				);
			}
		}else{
			$output = array(
				'success'	=> false,
				'pesan'		=> 'User tidak tersedia'
			);
		}
		return $this->response->setJSON($output);
	}
	public function logout(){
		session()->destroy();
		return redirect()->to(base_url());
	}
}
