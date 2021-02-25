<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KompetensiModel;

class KompetensikeahlianController extends BaseController
{
	protected $kk;
	public function __construct()
	{
		$this->kk = new KompetensiModel;
	}
	public function index()
	{
		//
		$list = $this->kk->findAll();

		$data = [
			'judul'	=> 'Master Kompetensi Keahlian',
			'apl'	=> $this->aplikasi,
			'kompetensi' => $list
		];
		return view('master/kompetensi/index',$data);
	}
	public function tambah(){
		$data = [
			'judul' => 'Tambah data master kompetensi keahlian',
		];
		return view('master/kompetensi/tambah',$data);
	}
	public function simpan(){
		$rules = array(
			'kompetensi_keahlian' => array(
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
				'kompetensi_keahlian' => $this->request->getPost('kompetensi_keahlian')
			);
			$d = $this->kk->insert($data);
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
}
