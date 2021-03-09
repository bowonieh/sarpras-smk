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
                  <label for="ruangArea">Jenis Ruang</label>
                  <input type="hidden" name="id_area" value="<?=$ruangan['id_area']?>" />
                  <input type="text" name="ruang_area" class="form-control" id="RuangArea" value="<?=$ruangan['ruang_area']?>" placeholder="Nama Ruangan">
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
      url   : '<?=base_url()?>/master/ruangan/simpan',
      data  : dt,
      success: function(data){
        if(data.success){
          $.notify(data.pesan,'success');
          setTimeout(function(){ window.location.href = '<?=base_url()?>/master/ruangan' }, 2000);
        }else{
          $.notify(data.pesan,'error');
        }
      }
    });
  });

</script>

<?php $this->endsection();?>