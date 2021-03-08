<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    <div class="card">
      <div class="card-body">
           <form id="formTambahData">
              <div class="box-body">
              
                <div class="form-group">
                  <label for="kompetensiKeahlian">Kompetensi Keahlian</label>
                  <input type="text" name="kompetensi_keahlian" class="form-control" id="kompetensiKeahlian" placeholder="Nama Kompetensi Keahlian">
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
        if(data.success){
          $.notify(data.pesan,'success');
          setTimeout(function(){ window.location.href = '../kompetensi-keahlian' }, 2000);
        }else{
          $.notify(data.pesan,'error');
        }
      }
    });
  });

</script>

<?php $this->endsection();?>