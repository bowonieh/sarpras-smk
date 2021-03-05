<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlatjenisModel;
use App\Models\KompetensiModel;
use App\Models\PrasaranaModel;
use App\Models\RuangModel;

class Referensi extends BaseController
{
	protected $kompetensi;
	protected $ruang;
	protected $alat;
	protected $prasarana;
	public function __construct()
	{
		$this->kompetensi = new KompetensiModel;
		$this->ruang = new RuangModel;
		$this->alat = new AlatjenisModel;
		$this->prasarana = new PrasaranaModel;
	}
	public function index()
	{
		//
	}
	public function alat(){
		$kk = $this->request->getPost('term');
		
		if(isset($kk)):
			$a = $this->alat
					->like('nama_alat',$kk)
					->select('id_alat as id, nama_alat as text')
					->findAll();
					$data = array(
						'results' => $a
					);
		else:
			$a = $this->alat
						->select('id_alat as id, nama_alat as text')
						->findAll();
					$data = array(
						'results' => $a
					);
		endif;
		return $this->response->setJSON($data);
	}


	public function ruangan(){
		$kk = $this->request->getPost('term');
		
		if(isset($kk)):
			$a = $this->ruang
					->like('ruang_area',$kk)
					->select('id_area as id, ruang_area as text')
					->findAll();
					$data = array(
						'results' => $a
					);
		else:
			$a = $this->ruang
					->select('id_area as id, ruang_area as text')
					->findAll();
					$data = array(
						'results' => $a
					);
		endif;
		return $this->response->setJSON($data);
	}
	public function prasarana(){
		$kk = $this->request->getPost('term');
		
		if(isset($kk)):
			$a = $this->prasarana
					->like('nama_ruang',$kk)
					->select('id_ruang as id, nama_ruang as text')
					->findAll();
					$data = array(
						'results' => $a
					);
		else:
			$a = $this->prasarana
					->select('id_ruang as id, nama_ruang as text')
					->findAll();
					$data = array(
						'results' => $a
					);
		endif;
		return $this->response->setJSON($data);
	}
	public function kompetensi_keahlian(){
		$kk = $this->request->getPost('term');
		
		if(isset($kk)):
			$a = $this->kompetensi
					->like('kompetensi_keahlian',$kk)
					->select('id_kk as id, kompetensi_keahlian as text')
					->findAll();
					$data = array(
						'results' => $a
					);
		else:
			$a = $this->kompetensi
			//->like('kompetensi_keahlian',$kk)
			->select('id_kk as id, kompetensi_keahlian as text')
			->findAll();
			$data = array(
				'results' => $a
			);
		endif;
		return $this->response->setJSON($data);
	}
}
