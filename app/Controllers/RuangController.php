<?php

namespace App\Controllers;
/*
	Controller untuk master jenis ruangan
*/
use App\Controllers\BaseController;
use App\Models\RuangModel;

class RuangController extends BaseController
{
	private $ruang;
	private $id_area;
	private $ruang_area;
	public function __construct()
	{
		$this->ruang = new RuangModel;
		
	}
	public function index()
	{
		//
		$a = $this->ruang->findAll();
		$data = [
			'judul'	=> 'Master Jenis Ruang',
			'apl'	=> $this->aplikasi,
			'ruang' => $a
		];
		return view('master/ruangan/jenisRuang',$data);
	}
	public function tambah(){
		$data = [
			'judul' => 'Tambah data master ruangan',
		];
		return view('master/ruangan/tambahdata',$data);
	}
	public function list(){

	}
	public function simpan(){
		$rules = array(
			'ruang_area' => array(
				'rules' => 'required',
				'errors' => array(
					'required' => 'Ruang Area tidak boleh kosong',
					'min_length' => 'Panjang minimal karakter password tidak sesuai',
					'max_length' => 'Panjang karakter password melebihi aturan',
				)
			)
		);
		if($this->validate($rules)):
			$data = array(
				'ruang_area' => $this->request->getPost('ruang_area')
			);
			$d = $this->ruang->insert($data);
			if($d){
				$output = array(
					'success'	=> true,
					'pesan'		=> 'tambah data berhasil'
				);
			}else{
				$output = array(
					'success'	=> false,
					'pesan'		=> 'tambah data Gagal'
				);
			}
		else:
			$output = array(
				'success'	=> false,
				'pesan'		=> 'tambah data gagal'
			);
		endif;
		return $this->response->setJSON($output);
	}
	public function edit($id = null){

	}
	public function hapus($id = null){

	}
}
