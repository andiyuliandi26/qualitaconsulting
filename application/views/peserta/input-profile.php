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
                            <input name="iNama" type="text" class="form-control" id="iNama" onchange="$('#iNamaConfirm').val($(this).val());" required autocomplete="off" />
                            <input name="iBatchID" type="hidden" class="form-control" id="iBatchID"
                                value="<?php echo $clientBatch->ID; ?>" />
                            <input name="iTokenTest" type="hidden" class="form-control" id="iTokenTest"
                                value="<?php echo $clientBatch->Token; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="iEmail">Email</label>
                            <input name="iEmail" type="email" class="form-control col-md-6 col-lg-4" id="iEmail" onchange="$('#iEmailConfirm').val($(this).val());" 
                                aria-describedby="emailHelp" required autocomplete="off">
                            <small id="emailHelp" class="form-text text-muted">Silahkan gunakan <strong>email sebenarnya
                                    dan masih aktif</strong>. Token peserta akan dikirimkan ke e-mail Anda melalui
                                <strong>admin@qualitaconsulting.co.id</strong>.</small>
                        </div>
                        <div class="form-group">
                            <label for="iHandphone">Nomor Whatsapp</label>
                            <input name="iHandphone" type="text" class="form-control col-md-6 col-lg-4" onchange="$('#iHandphoneConfirm').val($(this).val());" 
                                id="iHandphone" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="iJenisKelamin">Jenis Kelamin</label>
                            <select name="iJenisKelamin" class="form-control col-md-3 col-lg-2" id="iJenisKelamin" onchange="$('#iJenisKelaminConfirm').val($(this).val());" 
                                required>
                                <option value="">- Pilih -</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="iUsia">Usia</label>
                            <div class="input-group">
                                <input name="iUsia" type="number" min="1" class="form-control col-md-3 col-lg-2" onchange="$('#iUsiaConfirm').val($(this).val());" 
                                    id="iUsia" required autocomplete="off" />
                                <div class="input-group-append">
                                    <span class="input-group-text">tahun</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="iJabatans">Jabatan Pekerjaan</label>
                            <select name="iJabatansSelected" class="form-control col-md-3 col-lg-2" onchange="$('#iJabatanConfirm').val($(this).val());" 
                                id="iJabatansSelected" required>
                                <option value="">- Pilih -</option>
                                <?php foreach($jabatanList as $jabatan): ?>
                                <option value="<?php echo $jabatan; ?>"><?php echo $jabatan; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="iPekerjaan">Bidang Pekerjaan</label>
                            <input name="iPekerjaan" type="text" class="form-control col-sm-12 col-md-8 col-lg-6" onchange="$('#iPekerjaanConfirm').val($(this).val());" 
                                id="iPekerjaan" required autocomplete="off" />
                            <small id="iPekerjaanHelp" class="form-text text-muted">Contoh bidang pekerjaan: Sales, Konsultan, HR, dll. </small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary d-none" id="btnSubmit">Submit</button>
                            <button type="button" class="btn btn-primary" onclick="onBeforeSubmit();">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmationData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-top modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi data peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="iNama">Nama</label>
                    <input type="text" class="form-control" id="iNamaConfirm" autocomplete="off" disabled />
                </div>
                <div class="form-group">
                    <label for="iEmail">Email</label>
                    <input type="email" class="form-control col-md-6 col-lg-5" id="iEmailConfirm"
                        aria-describedby="emailHelp" autocomplete="off" disabled>
                </div>
                <div class="form-group">
                    <label for="iHandphone">Nomor Whatsapp</label>
                    <input type="text" class="form-control col-md-6 col-lg-4" id="iHandphoneConfirm" autocomplete="off" disabled>
                </div>
                <div class="form-group">
                    <label for="iJenisKelamin">Jenis Kelamin</label>
                    <input type="text" class="form-control col-md-6 col-lg-4" id="iJenisKelaminConfirm" autocomplete="off" disabled>
                </div>
                <div class="form-group">
                    <label for="iUsia">Usia</label>
                    <div class="input-group">
                        <input type="text" min="1" class="form-control col-md-3 col-lg-2" id="iUsiaConfirm" autocomplete="off" disabled />
                        <div class="input-group-append">
                            <span class="input-group-text">tahun</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="iJabatans">Jabatan Pekerjaan</label>
                    <input type="text" class="form-control col-sm-12 col-md-8 col-lg-6" id="iJabatanConfirm" autocomplete="off" disabled/>
                </div>
                <div class="form-group">
                    <label for="iPekerjaan">Bidang Pekerjaan</label>
                    <input type="text" class="form-control col-sm-12 col-md-8 col-lg-6" id="iPekerjaanConfirm" autocomplete="off" disabled/>
                </div>
                <div class="form-group">
                    <strong>Pastikan data Anda sudah benar, data akan dikirim ke alamat e-mail Anda.</strong>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-outline-success" onclick="$('#btnSubmit').click();$('#confirmationData').modal('hide');">Submit</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function onBeforeSubmit() {
    // warningShow("Lengkapi jawaban Anda..!!");
    $('#confirmationData').modal("show");
}
</script>
