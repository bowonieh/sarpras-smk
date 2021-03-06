<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    <div class="card">
      <div class="card-header">
          <h3 class="card-title"><?=$judul?></h3>
          <div class="float-right">
              <a href="<?=base_url()?>/alat/tambah">
              <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</button>
            </a>
          </div>
      </div>
      <div class="card-body">
      <table id="dataTable" class="table dataTable table-hovered table-bordered">
                <thead>
                  <tr>
                      <th>NAMA ALAT</th>
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
                        <td><?=$item['nama_alat']?></td>
                        <td><?=$item['kompetensi_keahlian']?></td>
                        <td><?=$item['nama_ruang']?></td>
                        <td>
                          <button class="btn btn-sm btn-info btnDetil" data-toggle="tooltip" data-placement="top" title="Lihat Detil"  attr-id="<?=$item['id_alat_ruang']?>" ><i class="fa fa-eye"></i></button>  
                          <a href="<?php echo base_url()?>/alat/edit/<?=$item['id_alat_ruang']?>"><button class="btn btn-sm btn-primary btnEdit" data-toggle="tooltip" data-placement="top" title="Edit" ><i class="fa fa-pencil-alt"></i></button></a> 
                          <button class="btn btn-sm btn-danger btnHps" data-toggle="tooltip" data-placement="top" title="Hapus" attr-id="<?=$item['id_alat_ruang']?>" ><i class="fa fa-trash"></i></button>  
                        </td>
                      </tr>
                  <?php endforeach;?>
                </tbody>
                
              </table>
    
      </div>
    </div>
      <!-- /.row (main row) -->

    </section>
    <!-- modal -->
    <div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog modal-lg">
 
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detil Alat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
 
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
     </div>
    </div>
   </div>
<?php $this->endsection();?>
<?php $this->section('footer')?>
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
 

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
                url     : '<?=base_url();?>/alat/hapus',
                data    : {
                  id_alat_ruang : id
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
                'Dibatalkan',
                'Kami tidak jadi menghapus data yang anda pilih :)',
                'error'
              )
            }
          })
    });

$('.btnDetil').on('click',function(a){
  var id_alat_ruang = $(this).attr('attr-id');
    $.ajax({
              url: '<?=base_url()?>/detil/alat/',
              type: 'post',
              data: {id_alat_ruang: id_alat_ruang},
              success: function(response){ 
              // Add response in Modal body
              $('.modal-title').html('Detil Alat');
              $('.modal-body').html(response);
                
              // Display Modal
              $('#empModal').modal('show'); 
              }
      });
});
var table = $('#dataTable').DataTable(
  {
    lengthChange: false,
    searching: true,
       /* initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }*/
    }
);
</script>
<?php $this->endsection()?>
