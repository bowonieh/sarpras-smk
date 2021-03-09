<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?=$judul?></h3>
        <div class="float-right">
            <?=$detil['nama_alat']?>
        </div>
      </div>
      <div class="card-body">
      <form id="formTambahData" enctype="multipart/form-data">
              <div class="box-body">
              
                <div class="form-group">
                  <label for="kompetensiKeahlian">KOMPETENSI KEAHLIAN</label>
                  <select name='kompetensi_keahlian' class="form-control kompetensi_keahlian">
                        <option value="<?=$detil['id_kk']?>" selected="selected"><?=$detil['kompetensi_keahlian']?></option>
                  </select>
                  
                </div>
                <div class="form-group">
                  <label for="jenisRuangan">NAMA RUANGAN</label>
                  <select name='id_ruang' class="form-control ruangan">
                     <option value="<?=$detil['id_ruang']?>" selected="selected"><?=$detil['nama_ruang']?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="jenisAlat">JENIS ALAT</label>
                  <input type="hidden" name="id_alat_ruang" value="<?=$detil['id_alat_ruang']?>" />
                  <select name='id_alat' class="form-control id_alat">
                  <option value="<?=$detil['id_alat']?>" selected="selected"><?=$detil['nama_alat']?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="kompetensiKeahlian">RASIO</label>
                  <input type="text" name="rasio" value="<?=$detil['rasio']?>" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="deskRipsi">LEVEL TEK</label>
                    <input type="number" class="form-control" name="level_tek" value="<?=$detil['level_tek']?>" />
                </div>
                <div class="form-group">
                  <label for="deskRipsi">LEVEL KETERAMPILAN</label>
                    <input type="number" class="form-control" name="level_keterampilan" value="<?=$detil['level_keterampilan']?>" />
                </div>
                <div class="form-group">
                  <label for="keterangan">KETERANGAN</label>
                  <textarea class="form-control deskRipsi" name="deskripsi" id="keterangan"><?= esc($detil['deskripsi'])?></textarea>
                </div>
                <div style="position:relative;" class="form-group">
                          <a class='btn btn-primary' href='javascript:;'>
                              Choose File...
                              <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                          </a>
                          &nbsp;
                          <span class='label label-info' id="upload-file-info"></span>
                  </div>

                  <div class="form-group">
                  <button class="btn btn-primary btnSimpan">Simpan</button>
                </div>
              </div>
              <!-- /.box-body -->

      
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
      url   : '<?=base_url()?>/alat/simpan',
      data  : dt,
      success: function(data){
        if(data.success){
          $.notify(data.pesan,'success');
          setTimeout(function(){ window.location.href = '<?=base_url()?>/alat' }, 2000);
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
    theme: 'bootstrap4',
	width: 'auto',
	dropdownAutoWidth: true,
  ajax: {
    type: 'POST',
    url: '<?=base_url();?>/referensi/kompetensi_keahlian',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
$('.ruangan').select2({
  theme: 'bootstrap4',
	width: 'auto',
	dropdownAutoWidth: true,
  ajax: {
    type: 'POST',
    url: '<?=base_url();?>/referensi/prasarana',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
$('.id_alat').select2({
  theme: 'bootstrap4',
	width: 'auto',
	dropdownAutoWidth: true,
  ajax: {
    type: 'POST',
    url: '<?=base_url();?>/referensi/alat',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
</script>
<?php $this->endsection();?>