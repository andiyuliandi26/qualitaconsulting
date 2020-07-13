<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="iNama">Nama</label>
            <input name="iNama" type="text" class="form-control" id="iNama" />
        </div>
        <div class="form-group">
            <label for="iEmail">Email</label>
            <input name="iEmail" type="email" class="form-control" id="iEmail" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="iJenisKelamin">Jenis Kelamin</label>
            <select name="iJenisKelamin" class="form-control" id="iJenisKelamin" required>
                <option value="">- Pilih -</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="iUsia">Usia</label>
            <div class="input-group">
                <input name="iUsia" type="number" min="1" class="form-control" id="iUsia" required />
                <div class="input-group-append">
                    <span class="input-group-text">tahun</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="iJabatan">Jabatan Pekerjaan</label>
            <input name="iJabatan" type="text" class="form-control" id="iJabatan" />
        </div>
        <div class="form-group">
            <label for="iPekerjaan">Bidang Pekerjaan</label>
            <input name="iPekerjaan" type="text" class="form-control" id="iPekerjaan" />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>