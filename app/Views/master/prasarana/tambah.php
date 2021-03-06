<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    
      <!-- Main row -->
      <div class="row">
        <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-form"></i>
              <h3 class="box-title">Form Tambah Data</h3>
            </div>
            <div class="box-body">
            <form id="formTambahData" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="jenisRuangan">JENIS RUANGAN</label>
                  <select name='id_area' class="form-control ruangan"></select>
                </div>
                <div class="form-group">
                  <label for="jenisAlat">NAMA RUANGAN</label>
                  <input type="text" name="nama_ruang" class="form-control" />
                  <input type="hidden" name="id_ruang" class="form-control" />
                </div>
                <div class="form-group">
                  <label for="panjangRuang">Panjang (m)</label>
                  <input type="number" name="panjang" class="form-control" />
                </div>
                <div class="form-group">
                  <label for="lebarRuang">Lebar (m)</label>
                  <input type="number" name="lebar" class="form-control" />
                </div>
              
                <div style="position:relative;">
                          <a class='btn btn-primary' href='javascript:;'>
                              Choose File...
                              <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                          </a>
                          &nbsp;
                          <span class='label label-info' id="upload-file-info"></span>
                  </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-primary btnSimpan">Simpan</button>
              </div>
            </form>
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
          setTimeout(function(){ window.location.href = '<?=base_url()?>/master/prasarana-ruang' }, 2000);
        }else{
          $.notify(data.pesan,'error');
        }
      }
    });
  });

</script>

<script type="text/javascript">
$('.kompetensi_keahlian').select2({
  ajax: {
    type: 'POST',
    url: '<?=base_url();?>/referensi/kompetensi_keahlian',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
$('.ruangan').select2({
  ajax: {
    type: 'POST',
    url: '<?=base_url();?>/referensi/ruangan',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});

</script>
<?php $this->endsection();?>