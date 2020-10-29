
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Domain Big 5 - Update</span>
    </div>
    <div class="card-body">
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url()."administrator/big5/update/{$data->ID}"); ?>
        <div class="row">
            <div class="col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Domain', 'Nama'); ?>
                    <?php echo form_input('Nama',  $data->Nama, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-2 col-lg-1">
                <div class="form-group">
                    <?php echo form_label('Kode', 'Kode'); ?>
                    <?php echo form_input('Kode',  $data->Kode, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-2 col-lg-1">
                <div class="form-group">
                    <?php echo form_label('Matriks Low', 'Matriks1'); ?>
                    <?php echo form_input('MatriksLow',  $data->MatriksLow, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-2 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Matriks Average', 'Matriks2'); ?>
                    <?php echo form_input('MatriksAverage',  $data->MatriksAverage, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-2 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Matriks High', 'Matriks2'); ?>
                    <?php echo form_input('MatriksHigh',  $data->MatriksHigh, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-12">            
                <div class="form-group">
                    <?php echo form_label('Redaksi Low', 'RedaksiLow'); ?>
                    <?php echo form_textarea(array('name' => 'RedaksiLow', 'rows'=> '4', 'cols' => '20'), $data->RedaksiLow, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-12">            
                <div class="form-group">
                    <?php echo form_label('Redaksi Average', 'RedaksiAverage'); ?>
                    <?php echo form_textarea(array('name' => 'RedaksiAverage', 'rows'=> '4', 'cols' => '20'), $data->RedaksiAverage, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-12">            
                <div class="form-group">
                    <?php echo form_label('Redaksi High', 'RedaksiHigh'); ?>
                    <?php echo form_textarea(array('name' => 'RedaksiHigh', 'rows'=> '4', 'cols' => '20'), $data->RedaksiHigh, 'class="form-control"'); ?>
                </div>
            </div>
			<div class="col-md-4">
				<div class="form-group">
					<?php echo form_label('Definisi Low', 'DefinisiLow'); ?>
					<?php echo form_textarea(array('name' => 'DefinisiLow', 'rows'=> '1', 'cols' => '20'), $data->DefinisiLow, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<?php echo form_label('Definisi Average', 'DefinisiAverage'); ?>
					<?php echo form_textarea(array('name' => 'DefinisiAverage', 'rows'=> '1', 'cols' => '20'), $data->DefinisiAverage, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<?php echo form_label('Definisi High', 'DefinisiHigh'); ?>
					<?php echo form_textarea(array('name' => 'DefinisiHigh', 'rows'=> '1', 'cols' => '20'), $data->DefinisiHigh, 'class="form-control"'); ?>
				</div>
			</div>
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back();" class="btn btn-outline-danger">Kembali</a>
            
        <?php echo form_close(); ?>
    </div>
</div>
