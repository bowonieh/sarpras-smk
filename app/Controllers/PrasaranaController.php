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
		helper('App');
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
		$data = [
			'id_kk'	=> $this->request->getPost('kompetensi_keahlian'),
			'id_area'	=> $this->request->getPost('id_area'),
			'nama_ruang'	=> $this->request->getPost('nama_ruang'),
			'panjang'	=> $this->request->getPost('panjang'),
			'lebar'		=> $this->request->getPost('lebar')
		];
		if(!empty($this->request->getPost('id_ruang'))){
			$data = array_push_assoc($data,'id_ruang',$this->request->getPost('id_ruang'));
		}
		$rules = [
				'nama_ruang' => array(
					'rules' => 'required',
					'errors' => array(
						'required' => 'Ruang Area tidak boleh kosong',
					)
				),
				'kompetensi_keahlian' => array(
					'rules'	=> 'required',
					'errors' => array(
						'required'	=> 'Kompetensi Keahlian belum dipilih'
					)
				),
				'id_area' => array(
					'rules'	=> 'required',
					'errors' => array(
						'required'	=> 'Jenis Ruangan belum dipilih'
					)
				)
					

		];
		
		if($this->validate($rules)):
			if(!empty($this->request->getFile('file')->getName())){
				$validasi = $this->validate(
					array(
						'file' => [
							'uploaded[file]',
							'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
							'max_size[file,4096]',
						]
					)
				);
				$file = $this->request->getFile('file');
				if($validasi){
					//Upload File
					$file_name = $file->getRandomName();
							$file->move('./uploads/gambaruang/',$file_name);
                            $data = array_push_assoc($data,'gambar',$file_name);
							$a = $this->prasarana->save($data);
							if($a){
								$output = [
									'success' => true,
									'pesan'	 => 'Upload gambar berhasil, Transaksi Berhasil'
								];
							}else{
								$output =[
									'success'	=> false,
									'pesan'		=> 'Upload gambar berhasil, Transaksi gagal'
								];
							}
				}else{
					$output =[
						'success'	=> false,
						'pesan'		=> 'Upload Berkas Gagal'
					];
				}	
			}else{
				$a = $this->prasarana->save($data);
					if($a){
						$output = [
							'success' => true,
							'pesan'	 => 'Transaksi Berhasil'
						];
					}else{
						$output =[
							'success'	=> false,
							'pesan'		=> 'Transaksi gagal'
						];
					}
			}
		else:
			$output =[
				'success'	=> false,
				'pesan'		=> 'General Errors: #1 Transaksi gagal. Mohon lengkapi isian'
			];
		endif;
		return $this->response->setJSON($output);
	}
	public function edit($id = null){

	}
	public function hapus($id=null){

	}
}
