<div class=container>
    <div style="height: 50px;"></div>
    <h1 class="display-3">Halo, <?php echo $peserta->NamaPeserta?></h1>
    
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
    <p class="h1"><strong class="text-success">Waktu test sudah dimulai!</strong> Apakah anda siap?</p>
    <form method="post" action="<?php echo base_url().'test/progress'; ?>">
        <input type="hidden" name="tokenTest" value="<?php echo $tokenTest; ?>" />
        <input type="hidden" name="tokenPeserta" value="<?php echo $tokenPeserta; ?>" />
        <button type="submit" class="btn btn-lg btn-success"><?php echo $buttonStartTitle; ?></button>
    </form>
</div>