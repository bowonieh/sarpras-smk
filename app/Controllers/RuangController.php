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
		helper('App');
		
		
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
				'id_area' => '',
				'ruang_area' => $this->request->getPost('ruang_area')
			);
			if(!empty($this->request->getPost('id_area'))){
				$data['id_area'] = $this->request->getPost('id_area');
			}
			//$d = $this->ruang->insert($data);
			$d = $this->ruang->save($data);
			if($d){
				$output = array(
					'success'	=> true,
					'pesan'		=> 'Transaksi berhasil'
				);
			}else{
				$output = array(
					'success'	=> false,
					'pesan'		=> 'Transaksi Gagal'
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
		$a = $this->ruang->where(array('id_area'=>$id));
		$b = $a->first();
		if($a->countAllResults() > 0):
			$data = [
				'judul' 	=> 'Edit master data jenis ruangan',
				'ruangan' => $b
			];
			return view('master/ruangan/editdata',$data);
			//echo json_encode($b);
		else:

		endif;
	}
	public function hapus($id = null){

	}
}
