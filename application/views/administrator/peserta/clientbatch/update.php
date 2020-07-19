
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Data Client Batch - Update</span>
    </div>
    <div class="card-body">
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url()."administrator/peserta/clientbatch/update/{$data->ID}"); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo form_label('Nama Client', 'ClientID'); ?>
                    <?php echo form_dropdown("ClientID", $client_list, $data->ClientID, 'class="custom-select"');?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo form_label('Nama Batch', 'NamaBatch'); ?>
                    <?php echo form_input('NamaBatch',  $data->NamaBatch, 'class="form-control" id="NamaBatch"'); ?>
                    <?php echo form_hidden('ID',  $data->ID); ?>
                </div>
                
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo form_label('Tanggal Test', 'TanggalTest'); ?>
                    <?php echo form_input('TanggalTest', $data->TanggalTest, 'class="form-control standardDate"'); ?>
                </div></div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo form_label('Jam Test', 'JamAwalTest'); ?>
                        <div class="input-group">                    
                            <?php echo form_input('JamAwalTest', $data->JamAwalTest, 'class="form-control timemask"'); ?> 
                            <div class="input-group-prepend">
                                <span class="input-group-text">s/d</span>
                            </div>             
                            <?php echo form_input('JamAkhirTest', $data->JamAkhirTest, 'class="form-control timemask"'); ?>
                        </div>
                </div>
            </div>
            <div class="col-md-1">            
                <div class="form-group">
                    <?php echo form_label('Total Peserta', 'TotalPeserta'); ?>
                    <?php echo form_input('TotalPeserta', $data->TotalPeserta, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?php echo form_label('Durasi Test', 'DurasiTest'); ?>
                    <?php echo form_input('DurasiTest', $data->DurasiTest, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo form_label('Token', 'Token'); ?>
                    <div class="input-group">                        
                        <?php echo form_input('Token', $data->Token, 'class="form-control" id="Token"'); ?>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" OnClick="generate_random_token('Token');">Generate Token</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back();" class="btn btn-outline-danger">Kembali</a>
            
        <?php echo form_close(); ?>
    </div>
</div>