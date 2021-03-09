<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlatModel;

class Alat extends BaseController
{
	protected $alat;
	public function __construct()
	{
		$this->alat = new AlatModel;
		helper('App','Form');
	}
	public function index()
	{
		$a = $this->alat
			->join('prasarana_ruang pr','pr.id_ruang=alat_ruang.id_ruang','inner')
			->join('kompetensi_keahlian kk','kk.id_kk=alat_ruang.id_kk','inner')
			->join('jenis_alat ja','ja.id_alat=alat_ruang.id_alat','inner')
			->findAll();
			$data = [
				'judul'	=> 'Data Alat',
				'apl'	=> $this->aplikasi,
				'alat_ruang' => $a
			];
			return view('alat_ruang/index',$data);
	}
	public function tambah(){
		$data = [
			'judul' => 'Tambah data master kompetensi keahlian',
		];
		return view('alat_ruang/tambah',$data);
	}
	public function simpan(){
        //Upload FIle
        $data = array(
            'id_alat_ruang'         => '',
            'id_kk' 				=> $this->request->getPost('kompetensi_keahlian'),
            'id_ruang'				=> $this->request->getPost('id_ruang'),
            'id_alat'				=> $this->request->getPost('id_alat'),
            'rasio'					=> $this->request->getPost('rasio'),
            'deskripsi'				=> $this->request->getPost('deskripsi'),
            'level_tek'			=> $this->request->getPost('level_tek'),
            'level_keterampilan'			=> $this->request->getPost('level_keterampilan'),
        );
        if(!empty($this->request->getPost('id_alat_ruang'))){
            $data['id_alat_ruang'] = $this->request->getPost('id_alat_ruang');
        }
        $rules = array(
                            'id_ruang' => array(
                                'rules' => 'required',
                                'errors' => array(
                                    'required' => 'Ruangan tidak boleh kosong',
                                )
                            ),
                            'kompetensi_keahlian' => array(
                                'rules' => 'required',
                                'errors' => array(
                                    'required' => 'Kompetensi keahlian tidak boleh kosong',
                                )
							),
							'id_alat' => array(
								'rules' => 'required',
								'errors' => array(
									'required' => 'Kompetensi keahlian tidak boleh kosong',
								)
							)

                    );
        if ($this->validate($rules)):
            if (!empty($this->request->getFile('file')->getName())) {
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
                if ($validasi) {
                    $file_name = $file->getRandomName();
                    $file->move('./uploads/alatgambar/', $file_name);
                    $data = array_push_assoc($data, 'ilustrasi_alat', $file_name);
                    $a = $this->alat->save($data);
                    if ($a) {
                        $output = array(
                                        'success'	=> true,
                                        'pesan'		=> 'berhasil menyimpan data kedalam database'
                                    );
                    } else {
                        $output = array(
                                        'success'	=> false,
                                        'pesan'		=> 'Gagal saat menyimpan data kedalam database'
                                    );
                    }
                } else {
                    $output = array(
                        'success'	=> false,
                        'pesan'		=> 'Gagal saat mengunggah file'
                    );
                }
            } else {
                $a = $this->alat->save($data);
                if ($a) {
                    $output = array(
                        'success'	=> true,
                        'pesan'		=> 'berhasil menyimpan data kedalam database'
                    );
                } else {
                    $output = array(
                        'success'	=> false,
                        'pesan'		=> 'Gagal saat menyimpan data kedalam database'
                    );
                }
            }
		else:
			$output = [
				'success' => false,
				'pesan'		=> 'kompetensi keahlian dan ruangan tidak boleh kosong'
			];
		endif;
		return $this->response->setJSON($output);
	}
	public function edit($id = null){
        $a = $this->alat->where(array('alat_ruang.id_alat_ruang'=>$id));
        if($a->countAllResults()>0){
            $b = $this->alat->where(array('alat_ruang.id_alat_ruang'=>$id))
                ->select('
                    kk.id_kk,
                    kk.kompetensi_keahlian,
                    ja.id_alat,
                    ja.nama_alat,
                    pr.id_ruang,
                    pr.nama_ruang,
                    
                    alat_ruang.id_alat_ruang,
                    alat_ruang.deskripsi,
                    alat_ruang.rasio,
                    alat_ruang.level_tek,
                    alat_ruang.level_keterampilan,
                    alat_ruang.ilustrasi_alat')
                ->join('jenis_alat ja','ja.id_alat=alat_ruang.id_alat','inner')
                ->join('prasarana_ruang pr','pr.id_ruang = alat_ruang.id_ruang')
                ->join('kompetensi_keahlian kk','kk.id_kk=alat_ruang.id_kk','inner')
                ->first();
            $data = [
                'judul' => 'Edit Data ',
                'detil' => $b
            ];
            return view('alat_ruang/edit',$data);
            //return $this->response->setJSON($data);
        }else{

        }
        //return $this->response->setJSON($output);
	}
    public function hapus(){
        $id_alat_ruang = $this->request->getVar('id_alat_ruang');
        $del = $this->alat->where(array('id_alat_ruang'=>$id_alat_ruang))
                ->delete();
        if($del):
            $output = [
                'status'    => true,
                'pesan'     => 'Hapus data berhasil'
            ];
        else:
            $output = [
                'status'    => false,
                'pesan'     => 'Hapus data gagal'
            ];
        endif;
        return $this->response->setJSON($output);
    }
}
