<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Qualita Consulting</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/cosmo/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap-datepicker/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/chartjs/Chart.min.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/css/open-iconic/font/css/open-iconic-bootstrap.min.css" rel="stylesheet" type="text/css">
	
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.inputmask.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.runner-min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.id.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/clipboard.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/chartjs/Chart.bundle.min.js"></script>
    <script>
$(document).ready(function(){
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $big5Label; ?>],
            datasets: [{
                label: 'Total Score',
                data: [<?php echo $totalScore; ?>],
                fill: "true",
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        steps: 10,
                        stepValue: 5,
                        max: 100
                    }
                }],
                xAxes: [{
                    gridLines: {
                        offsetGridLines: true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Summary'
            },
            legend: {
                display: false,
            }
        }
    });
});
</script>
</head>

<body>

<div class="card m-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td class="font-weight-bold">Nama Peserta</td>
                            <td><?php echo $peserta[0]->NamaPeserta; ?></td>
                            <td class="font-weight-bold">Email</td>
                            <td><?php echo $peserta[0]->Email; ?></td>
                            <td class="font-weight-bold">Client / Batch</td>
                            <td><?php echo "{$peserta[0]->NamaClient} / {$peserta[0]->NamaBatch} "; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Jenis Kelamin</td>
                            <td><?php echo $peserta[0]->JenisKelamin; ?></td>
                            <td class="font-weight-bold">Bidang Pekerjaan</td>
                            <td><?php echo $peserta[0]->BidangPekerjaan; ?></td>                            
                            <td class="font-weight-bold">Tanggal Tes</td>
                            <td><?php echo date_format(new DateTime($peserta[0]->TestDate), 'd/m/Y'); ?></td>
                        </tr>
                        <tr>                        
                            <td class="font-weight-bold">Usia</td>
                            <td><?php echo $peserta[0]->Usia; ?> tahun</td>
                            <td class="font-weight-bold">Jabatan Pekerjaan</td>
                            <td><?php echo $peserta[0]->JabatanPekerjaan; ?></td>
                            <td class="font-weight-bold">Durasi Tes</td>
                            <td><?php 
                                $durasiTest = round($peserta[0]->TestDuration/60,0);
                                echo $durasiTest.' menit'; 
                            ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>        

        <div class="row">
            <div class="col-md-12 col-lg-8">                
                <h3>NEO Summary</h3>
                <ul class="list-group">
                    <?php foreach($big5 as $items): ?>
                        <li href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-start">
                                <h4 class="font-weight-bold mb-1 text-primary"><?php echo $items->Big5Desc; ?>
                                    <span class="badge badge-pill badge-light"><?php echo "{$items->Kode}"; ?></span>
                                </h4>
                            </div>
                            <p class="text-black-50"><?php echo "{$items->MatriksResult} / {$items->LfsResult}"; ?></p>
                            <p class="mb-1"><?php echo $items->RedaksiResult; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="col-md-12 col-lg-4 mt-2 pt-5">
                <!-- <canvas id="myChart" width="200" height="230"></canvas> -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-3">
                <h3>Style of Character</h3>
                <div class="list-group">
                    <?php foreach($style as $items): ?>
                        <div href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h4 class="font-weight-bold mb-1"><?php echo $items->StyleDesc; ?></h4>
                            </div>
                            <p class="text-black-50"><?php echo $items->Big5LeftValue.$items->Big5RightValue; ?></p>
                            <p class="mb-1"><?php echo $items->RedaksiResult; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-3">
                <h3>Summary dari keseluruhan facet</h3>
                <div class="list-group">
                    <?php foreach($result_facet_summary as $items): ?>
                        <div href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h4 class="font-weight-bold mb-1"><?php echo $items['Big5Desc']; ?></h4>                                
                            </div>
                            <p class="mb-1"><?php echo $items['RedaksiResult']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php if(count($additional) > 0): ?>
        <div class="row">
            <div class="col-md-12 mt-5">
                <h2>Additional Report</h2>
                <div class="list-group">
                    <?php foreach($additional as $items): ?>
                        <div href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h4 class="font-weight-bold mb-1"><?php echo $items->Item; ?></h4>                                
                            </div>
                            <p class="mb-1"><?php echo $items->ItemDescription; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>

<?php
    $big5Label = '';
    $totalScore = '';  
    foreach($big5 as $items){
        $big5Label .= "'$items->Big5Desc'" . " , ";
        $totalScore .= "'$items->TotalScore'". " , ";
    } 
?>

</body>

</html>
