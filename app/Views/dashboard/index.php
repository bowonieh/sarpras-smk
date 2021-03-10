<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    <div class="container-fluid">
      <div class="row">
      
      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 class="alatRekap"></h3>

                <p>Jumlah Barang</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
      </div>
      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="rekapRuang"></h3>

                <p>Jumlah Ruang</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
      </div>
      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="kompetensiRekap"></h3>

                <p>Kompetensi Keahlian</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="penggunaRekap"></h3>

                <p>Pengguna</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

      </div>
    </div>
</section>

<?php $this->endsection();?>
<?php $this->section('footer')?>
<script type="text/javascript">
$(document).ready(function(){
 ambilRekap();
 $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
});
$('#dataTable').DataTable()
function ambilRekap(){
  $.ajax({
    type : 'GET',
    url   : '<?=base_url()?>/rekap',
    success: function(b){
      $('.alatRekap').html(b.alat);
      $('.rekapRuang').html(b.ruang);
      $('.kompetensiRekap').html(b.kompetensi);
      $('.penggunaRekap').html(b.pengguna);
    }

  });
}
</script>
<?php $this->endsection()?>
