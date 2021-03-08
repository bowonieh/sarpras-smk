<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    <div class="card">
      <div class="card-body">
              <table id="dataTable" class="table dataTable table-hovered table-bordered">
                <thead>
                  <tr>
                      <th>NO</th>
                      <th>NAMA JENIS RUANGAN</th>
                      <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1; 
                    foreach($ruang as $item):?>
                      <tr>
                        <td><?= $no++?></td>
                        <td><?=$item['ruang_area']?></td>
                        <td>
                          <a href="<?php echo base_url()?>/master/ruangan/edit/<?=$item['id_area']?>"><button class="btn btn-sm btn-primary btnEdit"><i class="fa fa-plus"></i> Edit</button></a> 
                          <button class="btn btn-sm btn-danger btnEdit" attr-id="<?=$item['id_area']?>" ><i class="fa fa-trash"></i> Hapus</button>  
                        </td>
                      </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
      </div>
    </div>
  
        </section>
    
      </div>
   
      <!-- /.row (main row) -->

    </section>

<?php $this->endsection();?>
<?php $this->section('footer')?>
<script type="text/javascript">
$('#dataTable').DataTable({
  lengthChange: false,
})
</script>
<?php $this->endsection()?>
