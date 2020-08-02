<div class=container>
    <div style="height: 50px;"></div>
    <div class="d-none d-md-block">
        <h1 class="display-3">Halo, <?php echo $peserta->NamaPeserta; ?></h1>
    </div>
    <div class="d-block d-sm-block d-md-none">
        <h1>Halo, <?php echo $peserta->NamaPeserta; ?></h1>
    </div>
    <dl class="h4 list-inline">
        <dt class="list-inline-item">Jenis Kelamin</dt>
        <dd class="list-inline-item"><?php echo $peserta->JenisKelamin?></dd>
    </dl>
    <dl class="h4 list-inline">
        <dt class="list-inline-item">Usia</dt>
        <dd class="list-inline-item"><?php echo $peserta->Usia?> tahun</dd>
    </dl>
    <dl class="h4 list-inline">
        <dt class="list-inline-item">Jabatan Pekerjaan</dt>
        <dd class="list-inline-item"><?php echo $peserta->JabatanPekerjaan?></dd>
    </dl>
    <dl class="h4 list-inline">
        <dt class="list-inline-item">Bidang Pekerjaan</dt>
        <dd class="list-inline-item"><?php echo $peserta->BidangPekerjaan?></dd>
    </dl>
    <div style="height: 50px;"></div>
    <p class="lead">
        Jika Anda terputus dalam mengerjakan, Anda dapat melanjutkan kembali menggunakan token yang sudah dikirim ke email Anda yang terdaftar dari <strong>admin@qualitaconsulting.co.id</strong></p>
        <p>Apabila Anda tidak menerima email tersebut, Anda dapat menghubungi administrator di nomor Whatsapp <strong class="copyClipboard" data-clipboard-text="+628111696196">+628111696196</strong>.
    </p>
    <div class="d-none d-md-block">
        <p class="h1"><strong class="text-success">Waktu profiling sudah dimulai!</strong> Apakah Anda siap?</p>
    </div>
    <div class="d-block d-sm-block d-md-none">
        <p class="h5"><strong class="text-success">Waktu profiling sudah dimulai!</strong> Apakah Anda siap?</p>
    </div>
    
    <form method="post" action="<?php echo base_url().'test/progress'; ?>">
        <input type="hidden" name="tokenTest" value="<?php echo $tokenTest; ?>" />
        <input type="hidden" name="tokenPeserta" value="<?php echo $tokenPeserta; ?>" />
        <button type="submit" class="btn btn-lg btn-success"><?php echo $buttonStartTitle; ?></button>
    </form>
</div>