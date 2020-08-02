<div class="container-fluid">
    <div class="row border mx-0 mt-3 p-2 bg-white">
        <div class="col-md-4 col-lg-4 col-sm-12 col-12">
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1">Nama Peserta</h6>
                        <span><?php echo $peserta->NamaPeserta; ?></span>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1">Jenis Kelamin</h6>
                        <span><?php echo $peserta->JenisKelamin; ?></span>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1">Email</h6>
                        <span><?php echo $peserta->Email; ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-lg-3 col-sm-12 col-12">
            <div class="list-group list-group-flush">                    
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1">Usia</h6>
                        <span><?php echo $peserta->Usia; ?> tahun</span>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1">Tanggal Tes</h6>
                        <span><?php echo date_format(new DateTime($peserta->TestDate), 'd/m/Y'); ?></span>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1">Durasi Tes</h6>
                        <span><?php
                            $durasiTest = round($peserta->TestDuration/60,0);
                            echo $durasiTest.' menit';  ?>
                        </span>
                    </div>
                </div>                    
            </div>
        </div>

        <div class="col-md-5 col-lg-5 col-sm-12 col-12">
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1">Client / Batch</h6>
                        <span><?php echo "{$peserta->NamaClient} / {$peserta->NamaBatch} "; ?></span>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1">Bidang Pekerjaan</h6>
                        <span><?php echo $peserta->BidangPekerjaan; ?></span>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1">Jabatan Pekerjaan</h6>
                        <span><?php echo $peserta->JabatanPekerjaan; ?></span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="border mt-3 p-2 justify-content-center bg-white">        
        <div id="chartContainer" class="mx-auto" style="max-width: 850px;">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h3>Summary</h3>
            <div class="list-group">
                <?php foreach($big5 as $items): ?>
                <div href="#" class="list-group-item list-group-item-action" style="overflow: visible; page-break-before: always;">
                    <div class="d-flex w-100 justify-content-start">
                        <h4 class="font-weight-bold mb-1 text-primary"><?php echo $items->Big5Desc; ?>
                            <span class="badge badge-pill badge-light"><?php echo "{$items->Big5Kode}"; ?></span>
                        </h4>
                    </div>
                    <p class="text-black-50"><?php echo "{$items->MatriksResult} / {$items->LfsResult}"; ?></p>
                    <p class="mb-1"><?php echo $items->RedaksiResult; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="card-body">
            <h3>Style</h3>
            <div class="list-group">
                <?php foreach($style as $items): ?>
                <div href="#" class="list-group-item list-group-item-action" style="overflow: visible;">
                    <div class="d-flex w-100 justify-content-between">
                        <h4 class="font-weight-bold mb-0"><?php echo $items->StyleDesc; ?></h4>
                    </div>
                    <p class="text-black-50"><?php echo $items->Big5LeftValue.$items->Big5RightValue; ?></p>
                    <p class="mb-0"><?php echo $items->RedaksiResult; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if(count($additional) > 0): ?>
            <div class="card-body">
                <h3>Additional Report</h3>
                <div class="list-group">
                    <?php foreach($additional as $items): ?>
                    <div href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="font-weight-bold mb-1"><?php echo $items->Item; ?></h5>
                        </div>
                        <p class="mb-1"><?php echo $items->ItemDescription; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif;?>
    </div>
    <div class="d-print-none mt-3 row justify-content-center">
        <div class="col-auto align-self-center">
            <button class="btn btn-outline-primary btn-sm" onclick="printPreview();">Print PDF</button>
        </div>
    </div>
</div>
<!------ Start Print Area -------->


<!------ End Print Area -------->

<?php
    $big5Label = '';
    $totalScore = '';  
    foreach($big5 as $items){
        $big5Label .= "'$items->Big5Desc'" . " , ";
        $totalScore .= "'$items->TotalScore'". " , ";
    } 
?>

<script>
function resizeCanvas()
{
    var canvas = $('#myChart');
    canvas.css("width", $('#chartContainer').width());
    canvas.css("height", $('#chartContainer').height());
}

function printPreview(){
    window.resizeTo(1366,786);
    window.print();
}

$(document).ready(function() {
    $(function(){
        resizeCanvas();
    });

    $(window).on('resize', function(){
        resizeCanvas();
    });

    var ctx = $('#myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [ <?php echo $big5Label; ?> ],
            datasets: [{
                label: 'Total Score',
                data: [ <?php echo $totalScore; ?> ],
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

    var ctx2 = document.getElementById('myChart2');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [ <?php echo $big5Label; ?> ],
            datasets: [{
                label: 'Total Score',
                data: [ <?php echo $totalScore; ?> ],
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