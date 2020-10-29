
<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Data Peserta - Assignment User Additional Report</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action active">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $peserta->NamaPeserta; ?></h5>
                        <small><?php echo date_format(new DateTime($peserta->TestDate), 'd/m/yy'); ?></small>
                        </div>
                        <p class="mb-1"><?php echo "{$peserta->NamaClient} / {$peserta->NamaBatch}"; ?></p>
                        <small><?php echo "{$peserta->JenisKelamin} / {$peserta->Usia} tahun"; ?></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-3">
                <form method="get">                    
                    <div class="form-group">
                        <?php echo form_dropdown("userid", $userlist, null, 'class="custom-select"');?>
                        <?php echo form_hidden('pesertaID',  $peserta->ID); ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success" >Simpan</button>
                        <button type="button" class="btn btn-outline-danger" onclick="window.history.back()">
                            Kembali
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?> " role="alert">
                <?php echo $this->session->flashdata('message'); ?> 
            </div> 


    </div>
</div>
