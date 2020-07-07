
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Result</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td class="font-weight-bold">Nama Peserta</td>
                            <td><?php echo $peserta[0]->NamaPeserta; ?></td>
                            <td class="font-weight-bold">Email</td>
                            <td><?php echo $peserta[0]->Email; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Jenis Kelamin</td>
                            <td><?php echo $peserta[0]->JenisKelamin; ?></td>
                            <td class="font-weight-bold">Usia</td>
                            <td><?php echo $peserta[0]->Usia; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Tanggal Test</td>
                            <td><?php echo $peserta[0]->TestDate; ?></td>
                            <td class="font-weight-bold">Jabatan Pekerjaan</td>
                            <td><?php echo $peserta[0]->JabatanPekerjaan; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Durasi Test</td>
                            <td><?php echo $peserta[0]->TestDuration.' menit'; ?></td>
                            <td class="font-weight-bold">Bidang Pekerjaan</td>
                            <td><?php echo $peserta[0]->BidangPekerjaan; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>        

        <div class="row">
            <div class="col-md-8">
                <table width="100%" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="8" class="text-center"> NEO - Summary</th>
                        </tr>
                        <tr class="thead-dark">
                            <th>Rendah</th>
                            <th>Keterangan</th>
                            <th>Sedang</th>
                            <th>Keterangan</th>
                            <th>Tinggi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $index = 0;
                            foreach($big5 as $items): ?>
                            <tr>
                                <td><?php if($resultbig5[$index]->LfsResult == 'Low') 
                                            echo 'Yes'; ?></td>
                                <td><?php echo $items->KeteranganLow; ?></td>
                                <td><?php if($resultbig5[$index]->LfsResult == 'Average') 
                                            echo 'Yes'; ?></td>
                                <td><?php echo $items->KeteranganAverage; ?></td>
                                <td><?php if($resultbig5[$index]->LfsResult == 'High') 
                                            echo 'Yes'; ?></td>
                                <td><?php echo $items->KeteranganHigh; ?></td>
                                <td><?php echo $items->Kode; ?></td>
                                <td><?php echo $resultbig5[$index]->LfsResult?></td>
                            </tr>
                        <?php 
                            $index++;
                            endforeach?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4 mt-5 pt-5">
                <canvas id="myChart" width="200" height="130"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <table width="70%" class="table table-responsive table-bordered table-striped">
                    <tbody>
                        <?php for($i = 0; $i < 5; $i++ ): ?>
                        <tr>
                            <td style="width:30%;font-weight:bold;"><?php echo $resultStyle[$i]->Style; ?></td>
                            <td style="width:70%;"><?php echo $resultStyle[$i]->Interpretasi; ?></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <table width="70%" class="table table-responsive table-bordered table-striped">
                    <tbody>
                        <?php for($i = 5; $i < 10; $i++ ): ?>
                        <tr>
                            <td style="width:30%;font-weight:bold;"><?php echo $resultStyle[$i]->Style; ?></td>
                            <td style="width:70%;"><?php echo $resultStyle[$i]->Interpretasi; ?></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <table width="70%" class="table table-responsive table-bordered table-striped">
            <tbody>
                <?php foreach($big5Summary as $items): ?>
                <tr>
                    <td style="width:20%;font-weight:bold;"><?php echo key($items); ?></td>
                    <td style="width:80%;"><?php echo current($items); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        

        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Big 5 Kategori</th>
                    <th>Kode</th>
                    <th>Total Score</th>
                    <th>Lfs</th>
                    <th>Matriks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $big5Label = '';
                    $totalScore = '';  
                    foreach($resultbig5 as $items): 
                    
                        $big5Label .= "'$items->Big5Desc'" . " , ";
                        $totalScore .= "'$items->TotalScore'". " , ";
                ?>
                    <tr>
                        <td><?php echo $items->Big5Desc; ?></td>
                        <td><?php echo $items->Kode; ?></td>
                        <td><?php echo $items->TotalScore; ?></td>
                        <td><?php echo $items->LfsResult; ?></td>
                        <td><?php echo $items->MatriksResult; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
        
    </div>
</div>
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