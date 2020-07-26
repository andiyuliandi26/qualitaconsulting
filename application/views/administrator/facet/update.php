
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Facet - Update</span>
    </div>
    <div class="card-body">
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url()."administrator/facet/update/{$data->ID}"); ?>
        <div class="row">
            <div class="col-md-4 col-lg-1">
                <div class="form-group">
                    <?php echo form_label('Domain', 'Domain'); ?>
                    <?php echo form_input('Domain',  $data->Big5Desc, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-2 col-lg-1">
                <div class="form-group">
                    <?php echo form_label('Nama', 'Nama'); ?>
                    <?php echo form_input('Nama',  $data->Nama, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-12">            
                <div class="form-group">
                    <?php echo form_label('Redaksi Awal', 'RedaksiAwal'); ?>
                    <?php echo form_textarea(array('name' => 'RedaksiAwal', 'rows'=> '4', 'cols' => '20'), $data->RedaksiAwal, 'class="form-control"'); ?>
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
            
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back();" class="btn btn-outline-danger">Kembali</a>
            
        <?php echo form_close(); ?>
    </div>
</div>