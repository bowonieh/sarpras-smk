<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlatModel;
use App\Models\AuthModel;
use App\Models\KompetensiModel;
use App\Models\PrasaranaModel;

class Dashboard extends BaseController
{
	protected $alat;
	protected $ruang;
	protected $kompetensi;
	protected $pengguna;
	public function __construct()
	{
		$this->alat = new AlatModel;
		$this->ruang = new PrasaranaModel;
		$this->kompetensi = new KompetensiModel;
		$this->pengguna = new AuthModel;
	}
	public function index()
	{
		//
		$data = [
			'judul'	=> 'Selamat Datang di Aplikasi Sarpras',
			'apl'	=> $this->aplikasi
		];
		return view('dashboard/index',$data);
	}
	public function rekap(){
		$jumlah_barang = $this->alat->countAllResults();
		$jumlah_ruang = $this->ruang->countAllResults();
		$jumlah_kompetensi = $this->kompetensi->countAllResults();
		$jumlah_pengguna = $this->pengguna->countAllResults();
		$data = [
			'alat' => $jumlah_barang,
			'ruang' => $jumlah_ruang,
			'kompetensi' => $jumlah_kompetensi,
			'pengguna' => $jumlah_pengguna
		];
		return $this->response->setJSON($data);
	}
}
