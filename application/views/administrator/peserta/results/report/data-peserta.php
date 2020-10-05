
<div style="border:1px solid #000000; border-collapse: collapse; padding:15px;">
	<h2>Data Peserta</h2>
	<table class="table-peserta">
		<tbody>
			<tr>
				<th style="width:25%;">Nama Peserta </th>
				<td style="width:5%;">:</td>
				<td style="width:75%">
					<?php echo $peserta->NamaPeserta; ?>
				</td>
			</tr>
			<tr>
				<th style="width:25%;">Email Peserta </th>
				<td style="width:5%;">:</td>
				<td style="width:75%">
					<?php echo $peserta->Email; ?>
				</td>
			</tr>
			<tr>
				<th style="width:25%;">Jenis Kelamin </th>
				<td style="width:5%;">:</td>
				<td style="width:75%">
					<?php echo $peserta->JenisKelamin; ?>
				</td>
			</tr>
			<tr>
				<th style="width:25%;">Usia </th>
				<td style="width:5%;">:</td>
				<td style="width:75%">
					<?php echo $peserta->Usia; ?> Tahun
				</td>
			</tr>
			<tr>
				<th style="width:25%;">Bidang Pekerjaan </th>
				<td style="width:5%;">:</td>
				<td style="width:75%">
					<?php echo $peserta->BidangPekerjaan; ?>
				</td>
			</tr>
			<tr>
				<th style="width:25%;">Jabatan Pekerjaan </th>
				<td style="width:5%;">:</td>
				<td style="width:75%">
					<?php echo $peserta->JabatanPekerjaan; ?>
				</td>
			</tr>
			<tr>
				<th style="width:25%;">Nama Client / Batch </th>
				<td style="width:5%;">:</td>
				<td style="width:75%">
					<?php echo "{$peserta->NamaClient} / {$peserta->NamaBatch} "; ?>
				</td>
			</tr>
			<tr>
				<th style="width:25%;">Tanggal Tes </th>
				<td style="width:5%;">:</td>
				<td style="width:75%">
					<?php echo date_format(new DateTime($peserta->TestDate), 'd/m/Y'); ?>
				</td>
			</tr>
			<tr>
				<th style="width:25%;">Durasi Tes </th>
				<td style="width:5%;">:</td>
				<td style="width:75%">
					<?php
								  $durasiTest = round($peserta->TestDuration/60,0);
								  echo $durasiTest.' menit';  ?>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div style="margin-top:400px;">
	<h5>Disclaimer</h5>
	<p> INI AREA UNTUK DISCLAIMER</p>
</div>
