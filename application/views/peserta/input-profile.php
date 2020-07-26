<div class="container-fluid">
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card mt-3">
            <div class="card-header">
                <h3>Profile Peserta Tes</h3>
                <h5><?php echo "{$clientBatch->NamaClient} / {$clientBatch->NamaBatch}"; ?></h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url().'test/registerpeserta'; ?>">
                    <div class="form-group">
                        <label for="iNama">Nama</label>
                        <input name="iNama" type="text" class="form-control" id="iNama" required autocomplete="off"/>
                        <input name="iBatchID" type="hidden" class="form-control" id="iBatchID" value="<?php echo $clientBatch->ID; ?>"/>
                        <input name="iTokenTest" type="hidden" class="form-control" id="iTokenTest" value="<?php echo $clientBatch->Token; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="iEmail">Email</label>
                        <input name="iEmail" type="email" class="form-control col-md-6 col-md-4" id="iEmail" aria-describedby="emailHelp" required autocomplete="off">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="iJenisKelamin">Jenis Kelamin</label>
                        <select name="iJenisKelamin" class="form-control col-md-3 col-lg-2" id="iJenisKelamin" required>
                            <option value="">- Pilih -</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="iUsia">Usia</label>
                        <div class="input-group">
                            <input name="iUsia" type="number" min="1" class="form-control col-md-3 col-lg-2" id="iUsia" required  autocomplete="off"/>
                            <div class="input-group-append">
                                <span class="input-group-text">tahun</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="iJabatan">Jabatan Pekerjaan</label>
                        <input name="iJabatan" type="text" class="form-control col-sm-12 col-md-8 col-lg-6" id="iJabatan" required autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label for="iPekerjaan">Bidang Pekerjaan</label>
                        <input name="iPekerjaan" type="text" class="form-control col-sm-12 col-md-8 col-lg-6" id="iPekerjaan" required autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    
                </form>  
            </div> 
        </div>
    </div>
</div>
</div>


