<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisalatModel;

class Jenisalat extends BaseController
{
	protected $id_alat;
	protected $jenisAlatModel;
	public function __construct()
	{
		$this->jenisAlatModel = new JenisalatModel;
	}
	public function index()
	{
		//
		$alat = $this->jenisAlatModel->findAll();
		$data = [
			'jenis_alat'	=> $alat,
			'judul'			=> 'Master jenis alat'
		];
		return view('master/alat/index',$data);
	}
	public function tambah(){

	}
	public function edit($id = null){

	}
	public function hapus($id = null){

	}
	public function simpan(){

	}
}
