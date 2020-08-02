
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Data Client Batch - Tambah</span>
    </div>
    <div class="card-body">
        <?php $generatedToken = random_string('alnum',10); ?>
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url().'administrator/peserta/clientbatch/create'); ?>
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="form-group">
                    <?php echo form_label('Nama Client', 'ClientID'); ?>
                    <?php echo form_dropdown("ClientID", $client_list, null, 'class="custom-select"');?>
                    <?php echo form_hidden('ID',  0); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo form_label('Nama Batch', 'NamaBatch'); ?>
                    <?php echo form_input('NamaBatch', set_value('NamaBatch'), 'class="form-control" id="NamaBatch"'); ?>
                </div>
                
            </div>
            <div class="col-md-3 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Tanggal Test', 'TanggalTest'); ?>
                    <?php echo form_input('TanggalTest', set_value('TanggalTest'), 'class="form-control standardDate"'); ?>
                </div></div>
            <div class="col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Jam Test', 'JamAwalTest'); ?>
                        <div class="input-group">                    
                            <?php echo form_input('JamAwalTest', '', 'class="form-control timemask"'); ?> 
                            <div class="input-group-prepend">
                                <span class="input-group-text">s/d</span>
                            </div>             
                            <?php echo form_input('JamAkhirTest', set_value('JamAkhirTest'), 'class="form-control timemask"'); ?>
                        </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-2">            
                <div class="form-group">
                    <?php echo form_label('Total Peserta', 'TotalPeserta'); ?>
                    <?php echo form_input('TotalPeserta', set_value('TotalPeserta'), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-3 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Durasi Test', 'DurasiTest'); ?>
                    <?php echo form_input('DurasiTest', set_value('DurasiTest'), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="form-group">
                    <?php echo form_label('Token', 'Token'); ?>
                    <div class="input-group">                        
                        <?php echo form_input(array('name' => 'Token', 'minlength' => 10), $generatedToken, 'class="form-control" id="Token"'); ?>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" OnClick="generate_random_token('Token');">Generate Token</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back()" class="btn btn-outline-danger">Kembali</a>
            
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript"> 
</script>