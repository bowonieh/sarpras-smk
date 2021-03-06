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
		$dt = $this->prasarana
				->select('id_ruang,nama_ruang,jr.ruang_area')
				->join('jenis_ruang jr','jr.id_area=prasarana_ruang.id_area','inner')
				->findAll();
		$data = [
			'judul' => 'Daftar Ruangan',
			'ruangan' => $dt
		];
		return view('master/prasarana/index',$data);
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
	public function hapus(){
		$id = $this->request->getVar('id_ruang');
		$a = $this->prasarana->where(array('id_ruang'=>$id))
			->delete();
		if($a){
			$output =[
				'status'	=> true,
				'pesan'		=> 'Data Ruang berhasil dihapus'
			];
		}else{
			$output =[
				'status'	=> false,
				'pesan'		=> 'Data Ruang gagal dihapus'
			];
		}
		return $this->response->setJSON($output);
	}
}
