<div style="display: block;
		width: 80%;
		border:0px;
		color: #FFFFFF;
		padding:20px 40px;
		text-align:center;
		margin:auto;
		align-content:center;">

	<img src="<?php echo base_url(); ?>/assets/images/home-page-qas.png" style="max-width: 100%; max-height: 100%;" />
	<div style="display: block;
		background-color: #7AA0CB;
		border:0px;
		color: #FFFFFF;
		padding:15px 40px;
		text-align:center;
		margin:auto;
		margin-top:10px;
		align-content:center;">
		<h2>Profiling Result</h2>
		<table style="width:100%;margin-left:0px 10px; color:#FFFFFF; font-size:12px;">
			<tbody>
				<tr>
					<th style="width:25%;text-align: left; padding: 5px 0px;">
						Nama Peserta
					</th>
					<td style="width:5%;text-align: left; padding: 5px 0px;">:</td>
					<td style="width:70%;text-align: left; padding: 5px 0px;">
						<?php echo $peserta->NamaPeserta; ?>
					</td>
				</tr>
				<tr>
					<th style="width:25%;text-align: left; padding: 5px 0px;">Email Peserta </th>
					<td style="width:5%;text-align: left; padding: 5px 0px;">:</td>
					<td style="width:70%;text-align: left; padding: 5px 0px; text-decoration:none; color:#FFFFFF;">
						<?php echo $peserta->Email; ?>
					</td>
				</tr>
				<tr>
					<th style="width:25%;text-align: left; padding: 5px 0px;">Jenis Kelamin </th>
					<td style="width:5%;text-align: left; padding: 5px 0px;">:</td>
					<td style="width:70%;text-align: left; padding: 5px 0px;">
						<?php echo $peserta->JenisKelamin; ?>
					</td>
				</tr>
				<tr>
					<th style="width:25%;text-align: left; padding: 5px 0px;">Usia </th>
					<td style="width:5%;text-align: left; padding: 5px 0px;">:</td>
					<td style="width:70%;text-align: left; padding: 5px 0px;">
						<?php echo $peserta->Usia; ?> Tahun
					</td>
				</tr>
				<tr>
					<th style="width:25%;text-align: left; padding: 5px 0px;">Bidang Pekerjaan </th>
					<td style="width:5%;text-align: left; padding: 5px 0px;">:</td>
					<td style="width:70%;text-align: left; padding: 5px 0px;">
						<?php echo $peserta->BidangPekerjaan; ?>
					</td>
				</tr>
				<tr>
					<th style="width:25%;text-align: left; padding: 5px 0px;">Jabatan Pekerjaan </th>
					<td style="width:5%;text-align: left; padding: 5px 0px;">:</td>
					<td style="width:70%;text-align: left; padding: 5px 0px;">
						<?php echo $peserta->JabatanPekerjaan; ?>
					</td>
				</tr>
				<tr>
					<th style="width:25%;text-align: left; padding: 5px 0px;">Nama Client / Batch </th>
					<td style="width:5%;text-align: left; padding: 5px 0px;">:</td>
					<td style="width:70%;text-align: left; padding: 5px 0px;">
						<?php echo "{$peserta->NamaClient} / {$peserta->NamaBatch} "; ?>
					</td>
				</tr>
				<tr>
					<th style="width:25%;text-align: left; padding: 5px 0px;">Tanggal Tes </th>
					<td style="width:5%;text-align: left; padding: 5px 0px;">:</td>
					<td style="width:70%;text-align: left; padding: 5px 0px;">
						<?php echo date_format(new DateTime($peserta->TestDate), 'd/m/Y'); ?>
					</td>
				</tr>
				<tr>
					<th style="width:25%;text-align: left; padding: 5px 0px;">Durasi Tes </th>
					<td style="width:5%;text-align: left; padding: 5px 0px;">:</td>
					<td style="width:70%;text-align: left; padding: 5px 0px;">
						<?php
						$durasiTest = round($peserta->TestDuration/60,0);
						echo $durasiTest.' menit';  ?>
					</td>
				</tr>
			</tbody>
		</table>
		<p style="text-align:left;margin-top:30px;">
			Hormat kami,
			<br />
			<br />
			<br />
			Administrator Qualita Profiling
		</p>
	</div>
	<small>
		<a href="https://profiling.qualita.co.id">profiling.qualita.co.id</a>
	</small>
</div>

