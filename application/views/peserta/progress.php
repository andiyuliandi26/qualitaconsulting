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
    $progress = round((($currentPage - 1) / 40) * 100,0)
?>
<div class="card m-3 test-progress">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <div class="list-group">
                    <div class="list-group-item border border-primary">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1"><?php echo $peserta->NamaPeserta; ?></h3>
                            <h5><?php echo date_format(new DateTime($peserta->TestDate), 'd/m/Y'); ?></h5>
                        </div>
                        <p class="mb-1 mt-1"><?php echo "{$peserta->NamaClient} / {$peserta->NamaBatch}"; ?></p>
                        <p class="mb-1"><?php echo "{$peserta->Email} / {$peserta->JenisKelamin} / {$peserta->Usia} tahun"; ?></p>
                        <small><?php echo "{$peserta->BidangPekerjaan} / {$peserta->JabatanPekerjaan}"; ?></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-auto text-center">
                <h1 id="runner" class="badges badge-secondary" width="410px"></h1>
                <input type="hidden" value="<?php echo $peserta->TestDuration; ?>" id="lastDurationTest">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $progress;?>%; font-size:12px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="list-group pernyataan">
                    <?php echo form_hidden('pesertaID', $peserta->ID); ?>
                    <?php 
                        $index = 0;
                        foreach($pernyataan as $items): ?>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between mt-1">
                                <h4 class="mb-1"><?php echo $items->Redaksi; ?></h4>
                                <h5><?php echo $items->Sequence; ?></h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3 mb-3">                                   
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">                 
                                        <?php foreach($defaultAnswer as $itemsAnswer):
                                            $uniqueID = $index.$itemsAnswer->Value; ?>    

                                            <label class="btn btn-outline-primary pl-4 pr-4 pt-2 pb-2">
                                                <input type="radio" name="jawaban<?php echo $index; ?>" id="pernyataan<?php echo $uniqueID; ?>"  value="<?php echo $itemsAnswer->Value; ?>" required> 
                                                <?php echo $itemsAnswer->Redaksi; ?>
                                            </label>
                                    
                                        <?php endforeach; ?>
                                    
                                    </div>  
                                </div>
                            </div>
                        </div>
                    <?php  $index++; endforeach; ?>
                </div>    
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12"> 
                <div class="list-group">   
                    <div class="list-group-item text-center">
                        <?php 
                            if($currentPage == 40){
                                echo '<button type="button" class="btn btn-lg btn-success" onclick="get_answer();"><< Selesai >></button>';
                            }else{
                                echo '<button type="button" class="btn btn-lg btn-primary" onclick="get_answer();">Lanjut >></button>';
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
            milliseconds: false,
            format: function(s,so) {
                var ms = s % 1000;
                s = (s - ms) / 1000;
                var secs = s % 60;
                s = (s - secs) / 60;
                var mins = s % 60;
                var hrs = (s - mins) / 60;

                secs = secs < 10 ? "0" + secs : secs;
                mins = mins < 10 ? "0" + mins : mins;
                hrs = hrs == 0 ? "" : hrs < 10 ? "0" + hrs + ":" : hrs + ":";

                return mins + ':' + secs;
            }
        });

        var currentPage = <?php echo $currentPage; ?>;
        console.log('currentPage : ' + currentPage);
    });

    function get_answer(){
        var jawaban0 = $("input[name='jawaban0']:checked").val();
        var jawaban1 = $("input[name='jawaban1']:checked").val();
        var jawaban2 = $("input[name='jawaban2']:checked").val();
        var jawabanArray = [jawaban0,jawaban1,jawaban2];
        var pesertaID = $("input[name='pesertaID']").val();
        var getDurationTime = $('#runner').runner('info');
        var currentPage = <?php echo $currentPage; ?>;
        //console.log('Jawaban 0 : ' + jawaban0);
        //console.log('Jawaban 1 : ' + jawaban1);
        //console.log('Jawaban 2 : ' + jawaban2);
        //console.log('currentPage : ' + currentPage);
        if(jawaban0 == undefined || jawaban1 == undefined || jawaban2 == undefined ){
            warningShow("Lengkapi jawaban Anda..!!");
        }else{
            $('#loadingSpinner').show();
            $.ajax({
                url:'<?php echo base_url()."api/apipeserta/peserta_update_answer";?>',
                type: 'POST',
                dataType: "json",
                data: { pesertaID: pesertaID, jawaban: jawabanArray, currentTestDuration: getDurationTime.time, currentPage: currentPage},
                success: function (data) {
                    // console.log(data.objectSend);
                    // console.log(data.objectResult);
                    // console.log(data.status);
                    // console.log(data.error);
                    // console.log(data.message);
                    // console.log(data.TestStatus);

                    if(!data.error){
                        //alert(data.TestStatus);
                        if(data.TestStatus == 'Progress'){                            
                            var url = '<?php echo base_url().'test/progress'; ?>';
                            var form = $('<form action="' + url + '" method="post">' +
                                        '<input type="hidden" name="tokenTest" value="<?php echo $peserta->TokenTest; ?>" />' +
                                        '<input type="hidden" name="tokenPeserta" value="<?php echo $peserta->Token; ?>" />' +
                                        '</form>');
                            $('body').append(form);
                            form.submit();
                        }else{
                            var url2 = '<?php echo base_url().'test/procced_to_report'; ?>';
                            var form2 = $('<form action="' + url2 + '" method="post">' +
                                                    '<input type="hidden" name="tokenTest" value="<?php echo $peserta->TokenTest; ?>" />' +
                                                    '<input type="hidden" name="tokenPeserta" value="<?php echo $peserta->Token; ?>" />' +
                                                    '</form>');
                            $('body').append(form2);
                            form2.submit();
                        }
                    }else{
                        $('#loadingSpinner').hide();
                        warningShow(data.message);
                    }
                }
            });
        }
    }       
</script>
