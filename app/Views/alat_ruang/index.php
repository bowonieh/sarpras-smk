<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    
      <!-- Main row -->
      <div class="row">
        <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-table"></i>

              <h3 class="box-title">Daftar Alat</h3>

              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                  <a href="<?=base_url()?>/alat/tambah">
                      <button class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah
                      </button>
                  </a>
              </div>
            </div>
            <div class="box-body">
              <table id="dataTable" class="table dataTable table-hovered table-bordered">
                <thead>
                  <tr>
                      <th>NO</th>
                      <th>NAMA</th>
                      <th>KOMPETENSI KEAHLIAN</th>
                      <th>RUANGAN</th>
                      <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1; 
                    foreach($alat_ruang as $item):?>
                      <tr>
                        <td><?= $no++?></td>
                        <td><?=$item['nama_alat']?></td>
                        <td><?=$item['kompetensi_keahlian']?></td>
                        <td><?=$item['ruang_area']?></td>
                        <td>
                          <a href="<?php echo base_url()?>/master/ruangan/edit/<?=$item['id_alat_ruang']?>"><button class="btn btn-sm btn-primary btnEdit"><i class="fa fa-plus"></i> Edit</button></a> 
                          <button class="btn btn-sm btn-danger btnEdit" attr-id="<?=$item['id_alat_ruang']?>" ><i class="fa fa-trash"></i> Hapus</button>  
                        </td>
                      </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
            <!-- /.chat -->
           
          </div>
        </section>
    
      </div>
   
      <!-- /.row (main row) -->

    </section>

<?php $this->endsection();?>
<?php $this->section('footer')?>
<script type="text/javascript">
$('#dataTable').DataTable()
</script>
<?php $this->endsection()?>
