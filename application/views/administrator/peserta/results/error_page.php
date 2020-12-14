
<div class="container">
	<div style="height: 50px;"></div>
	<div class="d-none d-md-block">
		<h1 class="display-3">
			Mohon maaf, <?php echo $peserta->NamaPeserta; ?>
		</h1>
	</div>
	<div class="d-block d-sm-block d-md-none">
		<h1>
			Mohon maaf, <?php echo $peserta->NamaPeserta; ?>
		</h1>
	</div>
	<dl class="h4 list-inline">
		<dt class="list-inline-item">Jenis Kelamin</dt>
		<dd class="list-inline-item">
			<?php echo $peserta->JenisKelamin?>
		</dd>
	</dl>
	<dl class="h4 list-inline">
		<dt class="list-inline-item">Usia</dt>
		<dd class="list-inline-item">
			<?php echo $peserta->Usia?> tahun
		</dd>
	</dl>
	<div style="height: 50px;"></div>
	<p class="lead">
		<?php
			$durasi = round($peserta->TestDuration / 60, 0, PHP_ROUND_HALF_UP);
			echo "Anda telah menyelesaikan profiling qualita selama {$durasi} menit.<br \>{$message}";
		?>
	</p>
	<p>
		Anda dapat menghubungi administrator di nomor Whatsapp
		<strong class="copyClipboard" data-clipboard-text="+628111696196">+628111696196</strong>.
	</p>
</div>
