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
                  <label for="kompetensiKeahlian">KOMPETENSI KEAHLIAN</label>
                  <select name='kompetensi_keahlian' class="form-control kompetensi_keahlian"></select>
                  
                </div>
                <div class="form-group">
                  <label for="jenisRuangan">NAMA RUANGAN</label>
                  <select name='id_ruang' class="form-control ruangan"></select>
                </div>
                <div class="form-group">
                  <label for="jenisAlat">JENIS ALAT</label>
                  <select name='id_alat' class="form-control id_alat"></select>
                </div>
                <div class="form-group">
                  <label for="kompetensiKeahlian">RASIO</label>
                  <input type="text" name="rasio" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="deskRipsi">DESKRIPSI</label>
                  <textarea class="form-control deskRipsi" name="deskripsi" id="deskRipsi"></textarea>
                </div>
                <div class="form-group">
                  <label for="keterangan">KETERANGAN</label>
                  <textarea class="form-control deskRipsi" name="keterangan" id="keterangan"></textarea>
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
          setTimeout(function(){ window.location.href = '../alat' }, 2000);
        }else{
          $.notify(data.pesan,'error');
        }
      }
    });
  });

</script>

<?php $this->endsection();?>
<?php $this->section('footer')?>
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
    url: '<?=base_url();?>/referensi/prasarana',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
$('.id_alat').select2({
  ajax: {
    type: 'POST',
    url: '<?=base_url();?>/referensi/alat',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
</script>
<?php $this->endsection();?>