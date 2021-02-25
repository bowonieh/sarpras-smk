<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
	public function index()
	{
		//
		$data = [
			'judul'	=> 'Selamat Datang di Aplikasi Sarpras',
			'apl'	=> $this->aplikasi
		];
		return view('dashboard/index',$data);
	}
}
