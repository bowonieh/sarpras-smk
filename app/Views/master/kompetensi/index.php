<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    
      <!-- Main row -->
      <div class="row">
        <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-table"></i>

              <h3 class="box-title">Daftar KOMPETENSI KEAHLIAN</h3>

              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                  <a href="<?=base_url()?>/master/kompetensi-keahlian/tambah">
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
                      <th>NAMA KOMPETENSI KEAHLIAN</th>
                      <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1; 
                    foreach($kompetensi as $item):?>
                      <tr>
                        <td><?= $no++?></td>
                        <td><?=$item['kompetensi_keahlian']?></td>
                        <td>
                          <a href="<?php echo base_url()?>/master/ruangan/edit/<?=$item['id_kk']?>"><button class="btn btn-sm btn-primary btnEdit"><i class="fa fa-plus"></i> Edit</button></a> 
                          <button class="btn btn-sm btn-danger btnEdit" attr-id="<?=$item['id_kk']?>" ><i class="fa fa-trash"></i> Hapus</button>  
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
