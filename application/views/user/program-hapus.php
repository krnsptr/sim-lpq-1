  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Hapus Program
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> SIM LPQ</a></li>
          <li>User</li>
          <li>Program</li>
          <li class="active">Hapus</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
		<?php
			if($keanggotaan == 1) {
		?>
        <div class="box box-default">
            <div class="box-header with-border">
				<h4><?php echo SANTRI.PROGRAM[$program]; ?></h4>
            </div>
			<div class="box-body">
				<?php echo form_open(site_url('user/hapus/program'), '', array('keanggotaan' => $keanggotaan, 'program' => $program)); ?>
					<div class="form-group col-md-12">
						Hapus program?
					</div>
						<div class="col-md-2">						
							<button type="submit" class="btn btn-danger btn-flat">Hapus</button>
							<a href="<?php echo site_url('user/dasbor');?>" class="btn btn-default btn-flat">Batal</a>
						</div>
				<?php echo form_close(); ?>
			</div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php
			}
			else if($keanggotaan == 2) {
		?>
         <div class="box box-default">
            <div class="box-header with-border">
				<h4><?php echo PENGAJAR[$program].PROGRAM[$program]; ?></h4>
            </div>
			<div class="box-body">
				<?php echo form_open(site_url('user/hapus/program'), '', array('keanggotaan' => $keanggotaan, 'program' => $program)); ?>
					<div class="form-group col-md-12">
						Hapus program?
					</div>
						<div class="col-md-2">						
							<button type="submit" class="btn btn-danger btn-flat">Hapus</button>
							<a href="<?php echo site_url('user/dasbor');?>" class="btn btn-default btn-flat">Batal</a>
						</div>
				<?php echo form_close(); ?>
			</div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php
			}
		?>
      </section>
    </div>
    <!-- /.container -->
  </div>