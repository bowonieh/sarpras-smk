<div class="row">
    <div class="col-sm-4">
        Nama Barang
    </div>
    <div class="col-sm-1">
        :
    </div>
    <div class="col-sm-6">
        <?=$detil['nama_alat']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
       Ruangan
    </div>
    <div class="col-sm-1">
        :
    </div>
    <div class="col-sm-6">
        <?=$detil['nama_ruang']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        Kompetensi Keahlian
    </div>
    <div class="col-sm-1">
        :
    </div>
    <div class="col-sm-6">
        <?=$detil['kompetensi_keahlian']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        Deskripsi
    </div>
    <div class="col-sm-1">
        :
    </div>
    <div class="col-sm-6">
        <?=$detil['deskripsi']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        Rasio
    </div>
    <div class="col-sm-1">
        :
    </div>
    <div class="col-sm-6">
        <?=$detil['rasio']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
       Gambar
    </div>
    <div class="col-sm-1">
        :
    </div>
    <div class="col-sm-6">
        <?php 
            if(!empty($detil['ilustrasi_alat'])){
        ?>
                <img class="img-fluid" src="<?=base_url()?>/uploads/alatgambar/<?=$detil['ilustrasi_alat']?>" />
        <?php
            }else{
        ?>
                <img class="img-fluid" src="<?=base_url()?>/uploads/no_image.png" />
        <?php
            }
        ?>
    </div>
</div>