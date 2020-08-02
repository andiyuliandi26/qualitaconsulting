<style>
    .badges {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        /* transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out; */
        /* transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; */
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    }
</style>
<?php
    $progress = round(($currentPage / 40) * 100,0)
?>
<div class="card m-3">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action border border-primary">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1"><?php echo $peserta->NamaPeserta; ?></h3>
                            <h4><?php echo date_format(new DateTime($peserta->TestDate), 'd/m/yy'); ?></h4>
                        </div>
                        <p class="mb-1 mt-1"><?php echo "{$peserta->NamaClient} / {$peserta->NamaBatch}"; ?></p>
                        <p class="mb-1"><?php echo "{$peserta->Email} / {$peserta->JenisKelamin} / {$peserta->Usia} tahun"; ?></p>
                        <small><?php echo "{$peserta->BidangPekerjaan} / {$peserta->JabatanPekerjaan}"; ?></small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <h1 id="runner" class="display-2 badges badge-secondary"></h1>
                <input type="hidden" value="<?php echo $peserta->TestDuration; ?>" id="lastDurationTest">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progress;?>%; font-size:12px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="list-group">
                    <?php echo form_open(base_url().'/pretest/update_data_test'); ?>
                    <?php echo form_hidden('pesertaID', $peserta->ID); ?>
                    <?php 
                        $index = 0;
                        foreach($pernyataan as $items): ?>
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between mt-3">
                                <h4 class="mb-1"><?php echo $items->Redaksi; ?></h4>
                                <h5><?php echo $items->Sequence; ?></h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3 mb-3">                    
                                    <?php foreach($defaultAnswer as $itemsAnswer):
                                        $uniqueID = $index.$itemsAnswer->Value; ?>                    
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="pernyataan<?php echo $uniqueID; ?>" name="jawaban<?php echo $index; ?>" class="custom-control-input" value="<?php echo $itemsAnswer->Value; ?>" required>
                                            <label class="custom-control-label" for="pernyataan<?php echo $uniqueID; ?>"><?php echo $itemsAnswer->Redaksi; ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php  $index++; endforeach; ?>
                </div>    
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12"> 
                <div class="list-group">   
                    <div class="list-group-item list-group-item-action text-right">
                        <?php 
                            if($currentPage == 40){
                                echo '<button type="button" class="btn btn-lg btn-outline-success" onclick="get_answer();"><< Selesai >></button>';
                            }else{
                                echo '<button type="button" class="btn btn-lg btn-outline-primary" onclick="get_answer();">Lanjut >></button>';
                            }
                        ?>
                        
                        <!-- <button type="button" class="btn btn-lg btn-outline-primary">Lanjut</button> -->
                    </div>  
                </div>
            </div>
        </div>         
    </div> 
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var lastDurationTest = $('#lastDurationTest').val();

        $('#runner').runner({
            autostart: true,
            countdown: false,
            startAt: <?php echo $peserta->TestDuration; ?> * 1000, // alternatively you could just write: 60*1000
            milliseconds: true
        });
    });

    function get_answer(){
        var jawaban0 = $("input[name='jawaban0']:checked").val();
        var jawaban1 = $("input[name='jawaban1']:checked").val();
        var jawaban2 = $("input[name='jawaban2']:checked").val();
        var jawabanArray = [jawaban0,jawaban1,jawaban2];
        var pesertaID = $("input[name='pesertaID']").val();
        var getDurationTime = $('#runner').runner('info');
        console.log('Jawaban 0 : ' + jawaban0);
        console.log('Jawaban 1 : ' + jawaban1);
        console.log('Jawaban 2 : ' + jawaban2);
        if(jawaban0 == undefined || jawaban1 == undefined || jawaban2 == undefined ){
            alert("Lengkapi jawaban Anda..!!");
        }else{
            $.ajax({
                url:'<?php echo base_url()."api/apipeserta/peserta_update_answer";?>',
                type: 'POST',
                dataType: "json",
                data: { pesertaID: pesertaID, jawaban: jawabanArray, currentTestDuration: getDurationTime.time},
                success: function (data) {
                    console.log(data.objectSend);
                    console.log(data.objectResult);
                    console.log(data.status);
                    console.log(data.error);
                    console.log(data.message);

                    if(!data.error){
                        location.replace('<?php echo base_url().'pretest/2'; ?>');
                    }else{
                        alert(data.message);
                    }
                }
            });
        }
    }       
</script>