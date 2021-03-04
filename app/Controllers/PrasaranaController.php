<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PrasaranaModel;
use App\Models\RuangModel;

class PrasaranaController extends BaseController
{
	protected $id_ruang;
	protected $jns_ruang;
	protected $prasarana;
	public function __construct()
	{
		$this->jns_ruang = new RuangModel;
		$this->prasarana = new PrasaranaModel;
	}
	public function index()
	{
		//
	}
	public function tambah(){
		$jns = $this->jns_ruang->findAll();
		$data = [
			'judul'	=> 'Tambah data prasarana'
		];
		return view('master/prasarana/tambah',$data);
	}
	public function simpan(){

	}
	public function edit($id = null){

	}
	public function hapus($id=null){

	}
}
