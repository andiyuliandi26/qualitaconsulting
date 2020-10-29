
<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Data Peserta</h4>
        <?php $this->load->view('layouts/filterandpaging', $dataInfo); ?>
    </div>
    <div class="card-body table-responsive-lg">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th></th>                    
                    <th>Client/ Batch</th>
                    <th>Nama Peserta</th>                    
                    <th>Email</th>
                    <th>Whatsapp</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Tes</th>
                    <th>Status</th>
                    <th>Durasi</th>
                    <th>Admin Assignment</th>
                    <th>Token</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($dataInfo->dataItems as $items):
                    ?>
                    <tr>
                        <td style="width:5%" class="text-center">
                            <!-- <a href="<?php //echo base_url()."administrator/peserta/list/update/{$items->ID}" ;?>" class="btn btn-sm btn-outline-primary" >Edit</a> -->
                            
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <?php if($this->ion_auth->is_admin()): ?>
                                        <button OnClick="send_email_peserta(<?php echo $items->ID; ?>)" class="dropdown-item" >Email Data Peserta</button>                                    
                                    <?php endif; ?>
                                    <?php if($items->TestStatus == 'Completed'): ?>                                    
                                        <div class="dropdown-divider"></div>
                                        <a href="<?php echo base_url()."administrator/peserta/results/check_result/{$items->ID}" ;?>" class="dropdown-item btn btn-outline-info" >Cek Hasil</a>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" OnClick="update_peserta_result(<?php echo $items->ID; ?>)">Update Hasil</button>
                                    <?php if($this->ion_auth->is_admin()): ?>
                                        <div class="dropdown-divider"></div>
                                        <a href="<?php echo base_url()."administrator/peserta/assignment/{$items->ID}" ;?>" class="dropdown-item btn btn-outline-info" >Assignment Additional Report</a>
                                    <?php endif; ?>
                                        <div class="dropdown-divider"></div>
                                        <a href="<?php echo base_url()."administrator/peserta/results/additional_report/{$items->ID}" ;?>" class="dropdown-item btn btn-outline-info" >Tambah Additional Report</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="<?php echo base_url()."administrator/peserta/results/export_pdf/{$items->ID}" ;?>" class="dropdown-item btn btn-outline-info" >Export Hasil (PDF)</a>
                                        
                                        <div class="dropdown-divider"></div>
									    <?php if($this->ion_auth->is_admin()): ?>
									        <button onclick="send_email_hasil_peserta(<?php echo $items->ID; ?>)" class="dropdown-item">Email Hasil ke Peserta</button>
									    <?php endif; ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td style="width:15%"><?php echo "{$items->NamaClient} / {$items->NamaBatch}"; ?></td>
                        <td style="width:15%"><?php echo $items->NamaPeserta; ?></td>
                        <td style="width:5%"><?php echo $items->Email; ?></td>
                        <td style="width:5%"><?php echo $items->Handphone; ?></td>
                        <td style="width:10%"><?php echo $items->JenisKelamin; ?></td>
                        <td style="width:10%" class="text-center"><?php echo date_format(new DateTime($items->TestDate), 'd/m/yy'); ?></td>
                        <td style="width:10%" class="text-center"><?php echo $items->TestStatus; ?></td>
                        <td style="width:10%" class="text-center"><?php echo round($items->TestDuration / 60, 0); ?></td>
                        <td style="width:10%" class="text-left"><?php echo $items->username; ?></td>
                        <td style="width:5%" class="text-center">
                            <button class="btn btn-sm btn-outline-info copyClipboard" data-clipboard-text="<?php echo $items->Token; ?>">Copy Token</button>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    function update_peserta_result(pesertaID){
        $.ajax({
            url:'<?php echo base_url()."/api/apipeserta/update_result";?>',
            type: 'POST',
            dataType: "json",
            data: { pesertaID: pesertaID },
            success: function (data) {
                warningShow(data.message);
                // if(!data.error){
                //     console.log(data);
                //     alert(data.message);
                // }else{
                //     console.log(data);
                    
                // }
            }
        });
    }

    function send_email_peserta(pesertaID){
        $.ajax({
            url:'<?php echo base_url()."/api/apipeserta/send_email_peserta";?>',
            type: 'POST',
            dataType: "json",
            data: { pesertaID: pesertaID },
            success: function (data) {
                warningShow(data.message);
                //console.log(data.emailMessage);
            },
            beforeSend: function(){
                warningShow('Proses mengirim email....', true);
            },
            error:function(){
                warningShow("Pengiriman email terjadi masalah.");
            }
        });
    }

    function send_email_hasil_peserta(pesertaID){
        $.ajax({
            url:'<?php echo base_url()."/api/apipeserta/send_email_hasil_peserta";?>',
            type: 'POST',
            dataType: "json",
            data: { pesertaID: pesertaID },
            success: function (data) {
                warningShow(data.message);
                //console.log(data.emailMessage);
            },
            beforeSend: function(){
                warningShow('Proses mengirim email....', true);
            },
            error:function(){
                warningShow("Pengiriman email terjadi masalah.");
            }
        });
    }
</script>
