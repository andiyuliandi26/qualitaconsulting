
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Pernyataan - Update</span>
    </div>
    <div class="card-body">
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url()."administrator/pernyataan/update/{$data->ID}"); ?>
        <div class="row">
            <div class="col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Domain', 'Domain'); ?>
                    <?php echo form_input('Domain',  $data->Big5Desc, 'class="form-control" readonly'); ?>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Facet', 'FacetDesc'); ?>
                    <?php echo form_input('FacetDesc',  $data->FacetDesc, 'class="form-control" readonly'); ?>
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
            <div class="col-md-1">
                <div class="form-group">
                    <?php echo form_label('Sequence', 'Sequence'); ?>
                    <?php echo form_input('Sequence',  $data->Sequence, 'class="form-control text-center"'); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group text-center">
                    <?php echo form_label('Score', 'Score'); ?>
                    <div class="input-group">                        
                        <?php echo form_input(array('name' => 'Score1', 'maxlength' => 1),  $data->Score1, 'class="form-control text-center"'); ?> 
                        <?php echo form_input(array('name' => 'Score2', 'maxlength' => 1),  $data->Score2, 'class="form-control text-center"'); ?> 
                        <?php echo form_input(array('name' => 'Score3', 'maxlength' => 1),  $data->Score3, 'class="form-control text-center"'); ?> 
                        <?php echo form_input(array('name' => 'Score4', 'maxlength' => 1),  $data->Score4, 'class="form-control text-center"'); ?> 
                        <?php echo form_input(array('name' => 'Score5', 'maxlength' => 1),  $data->Score5, 'class="form-control text-center"'); ?> 
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back();" class="btn btn-outline-danger">Kembali</a>
            
        <?php echo form_close(); ?>
    </div>
</div>