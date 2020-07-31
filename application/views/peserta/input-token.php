<div class="container-fluid">
    <div class="row justify-content-md-center" style="margin-top: 150px;">
        <div class="col-md-8 col-lg-5 text-center form-group">
            <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?> " role="alert">
                <?php echo $this->session->flashdata('message'); ?> 
            </div>           
            <form method="post">
                <div class="form-group">
                    <label for="iToken" class="h2">Masukan Token Tes</label>
                    <input id="iToken" class="form-control form-control-lg text-center" name="token" type="text" required />
                </div>
                <!-- <div class="form-group">
                    <input id="iTokenPeserta" class="form-control form-control-lg text-center" name="tokenPeserta" type="text" placeholder="Masukan token peserta untuk melanjutkan tes" />
                </div> -->
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary" style="margin: 20px auto 0px auto;">Masuk</button>
                </div>
                <div class="form-group">
                <!-- <h4 class="mt-2 mb-2">Sudah pernah tes? <button type="button" class="btn btn-link text-decoration-none" style="margin: 20px auto;">Klik disini</button></h4> -->
                    <a href="/test/result" class="btn btn-link text-decoration-none">Klik disini untuk melanjutkan tes</a>
                </div>
            </form>
        </div>
    </div>
</div>