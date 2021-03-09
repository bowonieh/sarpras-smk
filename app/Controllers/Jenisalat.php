<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisalatModel;
use Config\Exceptions;

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
		$data = [
			'judul' => 'Tambah data jenis alat'
		];
		return view('master/alat/tambahdata',$data);
	}
	public function edit($id = null){
		$a = $this->jenisAlatModel->where(array('id_alat'=>$id))->countAllResults();
		/*try{*/
			if($a>0){
				$b = $this->jenisAlatModel->where(array('id_alat'=>$id))->first();
				$data = [
					'judul' => 'Edit Master Data alat',
					'detil' => $b
				];
				return view('master/alat/edit',$data);
				//return json_encode($data);
			}else{
				return redirect()->to(base_url().'/master/alat');
			}
		/*}catch(Exceptions $e){
			$e->message();
		}*/
	}
	public function hapus(){
		$id_alat = $this->request->getVar('id_alat');
		$del = $this->jenisAlatModel->where(array('id_alat'=>$id_alat))->delete();
		if($del){
			$output = [
				'status'	=> true,
				'pesan'		=> 'Hapus Data Berhasil'
			];
		}else{
			$output = [
				'status'	=> false,
				'pesan'		=> 'Hapus Data Gagal'
			];
		}
		return $this->response->setJSON($output);
	}
	public function simpan(){
		$data = [
			'id_alat' => '',
			'nama_alat' => $this->request->getVar('nama_alat')
		];
		if(!empty($this->request->getVar('id_alat'))){
			$data['id_alat'] = $this->request->getVar('id_alat');
		}
		$ex = $this->jenisAlatModel->save($data);
		if($ex){
			$output = [
				'status'	=> true,
				'pesan'		=> 'Transaksi berhasil'
			];
		}else{
			$output =[
				'status'	=> false,
				'pesan'		=> 'transaksi data gagal'
			];
		}
		return $this->response->setJSON($output);
	}
}
