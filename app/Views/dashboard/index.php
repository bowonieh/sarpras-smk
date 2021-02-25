<?php $this->extend('layout/header')?>
<?php $this->section('content')?>
<section class="content">
    
      <!-- Main row -->
      <div class="row">
        <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-table"></i>

              <h3 class="box-title">Daftar Alat</h3>
            </div>
            <div class="box-body">
              
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
$('#dataTable').DataTable()
</script>
<?php $this->endsection()?>
