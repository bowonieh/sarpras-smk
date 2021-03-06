<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
  <div class="card">
    <div class="card-header">
    <h3 class="card-title"><?=$judul?></h3>
          <div class="card-tools">
            <a href="<?=base_url()?>/master/alat/tambah"><button class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button></a>
            
          </div>
    </div>
    <div class="card-body">
        <table id="dataTable" class="table dataTable table-hovered table-bordered">
          <thead>
            <tr>
                <th>NO</th>
                <th>NAMA JENIS ALAT</th>
                <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 1; 
              foreach($jenis_alat as $item):?>
                <tr>
                  <td><?= $no++?></td>
                  <td><?=$item['nama_alat']?></td>
                  <td>
                    <a href="<?php echo base_url()?>/master/alat/edit/<?=$item['id_alat']?>"><button class="btn btn-sm btn-primary btnEdit"><i class="fa fa-plus"></i> Edit</button></a> 
                    <button class="btn btn-sm btn-danger btnHps" attr-id="<?=$item['id_alat']?>" ><i class="fa fa-trash"></i> Hapus</button>  
                  </td>
                </tr>
            <?php endforeach;?>
          </tbody>
        </table>
    </div>
  </div>
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
                url     : '<?=base_url();?>/master/alat/hapus',
                data    : {
                  id_alat : id
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
  lengthChange:false,    
});
</script>
<?php $this->endsection()?>
