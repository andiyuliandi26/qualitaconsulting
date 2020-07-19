
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Domain Big 5 - Update</span>
    </div>
    <div class="card-body">
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url()."administrator/big5/update/{$data->ID}"); ?>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo form_label('Domain', 'Domain'); ?>
                    <?php echo form_input('Domain',  $data->Nama, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?php echo form_label('Kode', 'Kode'); ?>
                    <?php echo form_input('Kode',  $data->Kode, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?php echo form_label('Matriks Low', 'Matriks1'); ?>
                    <?php echo form_input('Matriks1',  $data->MatriksLow, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?php echo form_label('Matriks Average', 'Matriks2'); ?>
                    <?php echo form_input('Matriks2',  $data->MatriksAverage, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?php echo form_label('Matriks High', 'Matriks2'); ?>
                    <?php echo form_input('Matriks2',  $data->MatriksHigh, 'class="form-control" readonly'); ?>
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