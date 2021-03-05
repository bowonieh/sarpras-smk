<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlatModel;
use App\Models\KompetensiModel;
use App\Models\PrasaranaModel;

class DetilController extends BaseController
{
	protected $prasarana;
	protected $kompetensi;
	protected $alat;
	public function __construct()
	{
		$this->prasarana = new PrasaranaModel;
		$this->kompetensi = new KompetensiModel;
		$this->alat			= new AlatModel;
		
	}
	public function index()
	{
		//
	}
	public function kompetensi($id = null){
		$a = $this->kompetensi->asArray()->where(array('id_kk'=>$id))->countAllResults();
		//echo json_encode($a);
		if($a > 0){
			$kk = $this->kompetensi->where(array('id_kk'=>$id))->first();
			$cr = $this->kompetensi->where(array('kompetensi_keahlian.id_kk'=>$id))
					->join('alat_ruang ar','kompetensi_keahlian.id_kk=ar.id_kk','inner')
					->findAll();
			$data = [
				'judul'	=> 'Data alat pada kompetensi keahlian '.$kk['kompetensi_keahlian'],
				'alat'  => $cr
			];

			//tampilkan table alat berdasarkan kompetensi keahlian
		}else{
			return redirect()->to(base_url());
		}
	}
	public function alat(){
		$id_alat_ruang = $this->request->getVar('id_alat_ruang');
	}
}
