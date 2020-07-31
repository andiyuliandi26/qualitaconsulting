<div class=container>
    <div style="height: 50px;"></div>
    <h3 class="display-4">Halo, <?php echo $peserta->NamaPeserta?></h3>

    <dl class="h5 list-inline">
        <dt class="list-inline-item">Jenis Kelamin</dt>
        <dd class="list-inline-item"><?php echo $peserta->JenisKelamin?></dd>
    </dl>
    <dl class="h5 list-inline">
        <dt class="list-inline-item">Usia</dt>
        <dd class="list-inline-item"><?php echo $peserta->Usia?> tahun</dd>
    </dl>
    <dl class="h5 list-inline">
        <dt class="list-inline-item">Jabatan Pekerjaan</dt>
        <dd class="list-inline-item"><?php echo $peserta->JabatanPekerjaan?></dd>
    </dl>
    <dl class="h5 list-inline">
        <dt class="list-inline-item">Bidang Pekerjaan</dt>
        <dd class="list-inline-item"><?php echo $peserta->BidangPekerjaan?></dd>
    </dl>
    <dl class="h5 list-inline">
        <dt class="list-inline-item">Tanggal Tes</dt>
        <dd class="list-inline-item"><?php echo date_format(new DateTime($peserta->TestDate), 'd/m/Y')?></dd>
    </dl>
    <dl class="h5 list-inline">
        <dt class="list-inline-item">Token Peserta</dt>
        <dd class="list-inline-item"><?php echo $peserta->Token?></dd>
    </dl>
    <div style="height: 50px;"></div>
    <form method="post" action="<?php echo base_url().'test/result'; ?>">
        <input type="hidden" name="tokenTest" value="<?php echo $peserta->TokenTest; ?>" />
        <input type="hidden" name="tokenPeserta" value="<?php echo $peserta->Token; ?>" />
        <button type="submit" class="btn btn-lg btn-success">Lanjutkan atau Lihat hasil tes</button>
    </form>
</div>