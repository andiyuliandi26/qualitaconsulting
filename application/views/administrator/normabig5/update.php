
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Norma Domain - Update</span>
    </div>
    <div class="card-body">
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url()."administrator/normabig5/update/{$data->ID}"); ?>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo form_label('Domain', 'Domain'); ?>
                    <?php echo form_input('Domain',  $data->Big5Desc, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo form_label('Jenis Kelamin', 'JenisKelamin'); ?>
                    <?php echo form_input('JenisKelamin',  $data->JenisKelamin, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?php echo form_label('Matriks', 'Matriks'); ?>
                    <?php echo form_input('Matriks',  $data->Matriks, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?php echo form_label('Lfs', 'Lfs'); ?>
                    <?php echo form_input('Lfs',  $data->Lfs, 'class="form-control" readonly'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group text-center">
                    <?php echo form_label('Score', 'Score'); ?>
                    <div class="input-group">                        
                        <?php echo form_input(array('name' => 'BatasBawah', 'maxlength' => 2),  $data->BatasBawah, 'class="form-control text-center"'); ?> 
                        <div class="input-group-prepend">
                            <span class="input-group-text">s/d</span>
                        </div>
                        <?php echo form_input(array('name' => 'BatasAtas', 'maxlength' => 2),  $data->BatasAtas, 'class="form-control text-center"'); ?>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back();" class="btn btn-outline-danger">Kembali</a>
            
        <?php echo form_close(); ?>
    </div>
</div>