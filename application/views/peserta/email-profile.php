<html>

<head>
    <style>
    .btn {
        text-decoration: none;
        display: inline-block;
        font-weight: 400;
        color: #373a3c;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 0.9375rem;
        line-height: 1.5;
        border-radius: 0;
        -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        margin-top:20px;
    }

    .btn-outline-primary {
        color: #2780E3;
        border-color: #2780E3;
    }
    </style>
</head>

<body>
    <div style="text-align:center;">
            <h3>Data Peserta Qualita Profiling</h3>
        <div>
            <p class="card-text">Gunakan token untuk melanjutkan atau melihat hasil profiling Anda.</p>
            
            <?php 
                    $tokenDateExpired = new DateTime($getPeserta->TestDate);
                    $tokenDateExpired->add(new DateInterval('P6M'));
                ?>
            <table class="table table-solid" style="width:60%; margin-left:35%">
                <tbody>
                    <tr>
                        <th scope="row" style="width:35%; text-align:left;">Token</th>
                        <td style="width:3%;">:</td>
                        <td style="width:62%; text-align:left;"><?php echo $getPeserta->Token ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width:35%; text-align:left;">Token Expired</th>
                        <td style="width:3%;">:</td>
                        <td style="width:62%;  text-align:left;">
                            <?php echo $tokenDateExpired->format('Y-m-d')?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width:35%; text-align:left;">Tanggal Tes</th>
                        <td style="width:3%;">:</td>
                        <td style="width:62%;  text-align:left;">
                            <?php echo date_format(new DateTime($getPeserta->TestDate),'d/m/Y')?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width:35%; text-align:left;">Perusahaan / Batch</th>
                        <td>:</td>
                        <td style="text-align:left;">
                            <?php echo "{$getPeserta->NamaClient} / {$getPeserta->NamaBatch}"; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width:35%; text-align:left;">Nama</th>
                        <td>:</td>
                        <td style="text-align:left;"><?php echo $getPeserta->NamaPeserta?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width:35%; text-align:left;">Jenis Kelamin</th>
                        <td>:</td>
                        <td style="text-align:left;"><?php echo $getPeserta->JenisKelamin?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width:35%; text-align:left;">Usia</th>
                        <td>:</td>
                        <td style="text-align:left;"><?php echo $getPeserta->Usia?> tahun</td>
                    </tr>
                    <tr>
                        <th scope="row" style="width:35%; text-align:left;">Bidang Pekerjaan</th>
                        <td>:</td>
                        <td style="text-align:left;"><?php echo $getPeserta->BidangPekerjaan?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width:35%; text-align:left;">Jabatan Pekerjaan</th>
                        <td>:</td>
                        <td style="text-align:left;"><?php echo $getPeserta->JabatanPekerjaan?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <a href="<?php echo base_url().'test/result?token='.$getPeserta->Token; ?>" class="btn btn-outline-primary">
                Lanjutkan atau lihat hasil
            </a>

        </div>
    </div>
</body>

</html>