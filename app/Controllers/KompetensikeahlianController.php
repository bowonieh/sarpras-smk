<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KompetensiModel;
use Config\Exceptions;

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
			$id_kk = $this->request->getVar('id_kk');
			$data = array(
				'kompetensi_keahlian' => $this->request->getPost('kompetensi_keahlian'),
				'id_kk'	=> ''
			);
				if(!empty($id_kk)){
					$data['id_kk'] = $id_kk;
				}
				//array_merge($data,array('id_kk'=>$id_kk));
			
			//echo json_encode($data);
			
			$d = $this->kk->save($data);
			if($d){
				$output = array(
					'success'	=> true,
					'pesan'		=> 'Transaksi data berhasil'
				);
			}else{
				$output = array(
					'success'	=> false,
					'pesan'		=> 'transaksi data Gagal'
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
		try{
			//
			if(isset($id)):
				$kompetensi = $this->kk->where(array('id_kk'=>$id))
								->first();
				$data = [
					'judul'	=> 'Edit Kompetensi Keahlian'.$kompetensi['kompetensi_keahlian'],
					'data'	=> $kompetensi
				];
				return view('master/kompetensi/edit',$data);
			endif;
		}catch(Exceptions $e){
			echo $e->message();
		}
	}
	public function lihat_barang($id=null){
		try{
			$dt = $this->kk->where(array('id_kk'=>$id))
					->join('alat_ruang al','al.id_kk=kompetensi_keahlian.id_kk','inner')
					->findAll();
		}catch(Exceptions $e){

		}
	}
}
