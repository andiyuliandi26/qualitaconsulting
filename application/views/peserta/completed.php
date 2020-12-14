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

                        <div class="d-flex w-100 justify-content-between mt-4">
                            <h3 class="mb-1">Status Tes : <strong> <?php echo $peserta->TestStatus; ?> </strong></h3>
                        </div>
                        <p>
		                    Untuk informasi lebih lanjut, Anda dapat menghubungi administrator di nomor Whatsapp
		                    <strong class="copyClipboard" data-clipboard-text="+628111696196">+628111696196</strong>.
	                    </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-auto text-center">
                <h1 id="runner" class="badges badge-secondary" width="410px"></h1>
                <input type="hidden" value="<?php echo $peserta->TestDuration; ?>" id="lastDurationTest">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var lastDurationTest = $('#lastDurationTest').val();

        $('#runner').runner({
            autostart: false,
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
    });    
</script>
