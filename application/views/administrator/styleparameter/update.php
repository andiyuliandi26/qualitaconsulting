
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Style - Update</span>
    </div>
    <div class="card-body">
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url()."administrator/styleparameter/update/{$data->ID}"); ?>
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="form-group">
                    <?php echo form_label('Style', 'Style'); ?>
                    <?php echo form_input('Style',  $data->Style, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-3 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Domain Left', 'Value'); ?>
                    <?php echo form_input('Value',  $data->Big5LeftKode, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-3 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Domain Right', 'Value'); ?>
                    <?php echo form_input('Value',  $data->Big5RightKode, 'class="form-control" readonly'); ?>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back();" class="btn btn-outline-danger">Kembali</a>
            
        <?php echo form_close(); ?>
    </div>
</div>