
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Norma Style - Update</span>
    </div>
    <div class="card-body">
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url()."administrator/normastyle/update/{$data->ID}"); ?>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo form_label('Style', 'Style'); ?>
                    <?php echo form_input('Style',  $data->StyleDesc, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?php echo form_label('Domain Value', 'DomainValue'); ?>
                    <?php echo form_input('DomainValue',  "{$data->Big5LeftValue}{$data->Big5RightValue}", 'class="form-control" readonly'); ?>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">            
                <div class="form-group">
                    <?php echo form_label('Redaksi', 'Redaksi'); ?>
                    <?php echo form_textarea(array('name' => 'Redaksi', 'rows'=> '2', 'cols' => '15'), $data->Redaksi, 'class="form-control"'); ?>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back();" class="btn btn-outline-danger">Kembali</a>
            
        <?php echo form_close(); ?>
    </div>
</div>