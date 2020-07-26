<div class="container-fluid">
    <div class="row justify-content-md-center" style="margin-top: 150px;">
        <div class="col-md-8 col-lg-5 text-center form-group">
            <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?> " role="alert">
                <?php echo $this->session->flashdata('message'); ?> 
            </div>           
            <form method="post">
                <!-- <div class="form-group">
                    <label for="iToken" class="h2">Masukan Token Tes</label>
                    <input id="iToken" class="form-control form-control-lg text-center" name="token" type="text" required />
                </div> -->
                <div class="form-group">
                    <!-- <label for="iTokenPeserta" class="h2">Masukan Token Peserta</label> -->
                    <input id="iTokenPeserta" class="form-control form-control-lg text-center" name="tokenPeserta" type="text" placeholder="Masukan token peserta untuk melihat hasil tes" required/>
                </div>
                <div class="form-group">
                    <!-- <button type="button" class="btn btn-primary" style="margin: 20px auto;">Sudah Pernah tes?</button> -->
                    <button type="submit" class="btn btn-lg btn-primary" style="margin: 20px auto;">Lihat hasil</button>
                </div>
            </form>
        </div>
    </div>
</div>