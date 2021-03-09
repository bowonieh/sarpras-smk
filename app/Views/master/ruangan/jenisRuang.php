<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    <div class="card">
      <div class="card-header">
      <h3 class="card-title">
        <?=$judul?>
      </h3>
      <div class="card-tools">
            <a href="<?=base_url()?>/master/ruangan/tambah"><button class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button></a>
            
          </div>
      </div>
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
                          <button class="btn btn-sm btn-danger btnHps" attr-id="<?=$item['id_area']?>" ><i class="fa fa-trash"></i> Hapus</button>  
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
$('#dataTable').on('click','.btnHps',function(b){
        b.preventDefault();
        let id= $(this).closest('tr').find('td .btnHps').attr('attr-id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Data yang dihapus tidak bisa direcovery!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.value) {
             
              $.ajax({
                type    : 'POST',
                url     : '<?=base_url();?>/master/ruangan/hapus',
                data    : {
                  id_area : id
                },
                success   : function(data){
                  if(data.status){
                    Swal.fire(
                      'Berhasil',
                      data.pesan,
                      'success'
                    );
                    setTimeout(function(a){
                      location.reload();
                    },2000)
                  }else{
                    Swal.fire(
                      'Gagal',
                      data.pesan,
                      'error'
                    )
                  }
                }
              });
              
              
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              Swal.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
              )
            }
          })
    });
$('#dataTable').DataTable({
  lengthChange: false,
})
</script>
<?php $this->endsection()?>
