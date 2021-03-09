<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    <div class="card">
      <div class="card-header">
          <h3 class="card-title"><?=$judul?></h3>
      </div>
      <div class="card-body">
      <form id="formTambahData">
              <div class="box-body">
              
                <div class="form-group">
                  <label for="ruangArea">Jenis Alat</label>
                  <input type="hidden" name="id_alat" value="<?=$detil['id_alat']?>" />
                  <input type="text" name="nama_alat" class="form-control" value="<?=$detil['nama_alat']?>" id="namaAlat" placeholder="Jenis Alat">
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-primary btnSimpan">Simpan</button>
              </div>
            </form>
      </div>
    </div>  
      <!-- Main row -->
     
      <!-- /.row (main row) -->

    </section>

<?php $this->endsection();?>
<?php $this->section('footer')?>
<script type="text/javascript">
  $('.btnSimpan').on('click',function(a){
    a.preventDefault();
    var dt = new FormData(document.getElementById('formTambahData'));
    $.ajax({
      type  : 'POST',
      contentType: false,
      contentType: false,  
      cache: false,  
      processData:false, 
      url   : '<?=base_url()?>/master/alat/simpan',
      data  : dt,
      success: function(data){
        if(data.status){
          $.notify(data.pesan,'success');
          setTimeout(function(){ window.location.href = '<?=base_url()?>/master/alat' }, 2000);
        }else{
          $.notify(data.pesan,'error');
        }
      }
    });
  });

</script>

<?php $this->endsection();?>