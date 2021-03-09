<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    <div class="card">
      <div class="card-header">
      </div>
      <div class="card-body">
      <form id="formTambahData">
              <div class="box-body">
              
                <div class="form-group">
                  <label for="ruangArea">Jenis Alat</label>
                  <input type="text" name="nama_alat" class="form-control" id="namaAlat" placeholder="Jenis Alat">
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
      url   : 'simpan',
      data  : dt,
      success: function(data){
        if(data.status){
          $.notify(data.pesan,'success');
          setTimeout(function(){ window.location.href = '../ruangan' }, 2000);
        }else{
          $.notify(data.pesan,'error');
        }
      }
    });
  });

</script>

<?php $this->endsection();?>