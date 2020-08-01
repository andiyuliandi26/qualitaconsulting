
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Data Client Batch</h3>
        <a href="<?php echo base_url(); ?>/administrator/peserta/clientbatch/create" class="btn btn-outline-primary mb-2"> Tambah </a>
        <?php $this->load->view('layouts/filterandpaging', $dataInfo); ?>
    </div>
    <div class="card-body table-responsive-lg">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>Action</th>
                    <th>Nama Client</th>
                    <th>Nama Batch</th>
                    <th>Tanggal Test</th>
                    <th>Jam</th>
                    <th>Durasi Test</th>                    
                    <th>Total Peserta</th>
                    <th>Peserta Terdaftar</th>
                    <th>Link Test</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($dataInfo->dataItems as $items):
                        $linkTest = $this->config->item('default_test_url').$items->Token;
                        $jamAwal = date_format(new DateTime($items->JamAwalTest,), 'H:i');
                        $jamAkhir = date_format(new DateTime($items->JamAkhirTest), 'H:i');
                        $isUsed = ($items->IsUsed) ? "checked" : "";
                    ?>
                    <tr>
                        <td style="width:3%" class="text-center">
                            <a href="<?php echo base_url()."administrator/peserta/clientbatch/update/{$items->ID}" ;?>" class="btn btn-sm btn-outline-primary" >Edit</a>
                        </td>
                        <td style="width:15%"><?php echo $items->NamaClient; ?></td>
                        <td style="width:15%"><?php echo $items->NamaBatch; ?></td>
                        <td style="width:5%" class="text-center"><?php echo date_format(new DateTime($items->TanggalTest), 'd/m/yy'); ?></td>
                        <td style="width:10%" class="text-center"><?php echo "{$jamAwal} - {$jamAkhir}"; ?></td>
                        <td style="width:5%" class="text-center"><?php echo $items->TotalPeserta; ?></td>
                        <td style="width:5%" class="text-center"><?php echo $items->DurasiTest; ?></td>
                        <td style="width:10%" class="text-center">
                            <?php echo $this->pesertamodel->get_jumlah_peserta_bybatch($items->ID); ?>
                        </td>
                        <td style="width:15%" class="text-center">
                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                                <div class="dropdown-menu">
                                    <a href="<?php echo $linkTest; ?>" class="dropdown-item btn btn-sm btn-outline-primary" target="_blank">Goto Test</a>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item btn btn-sm btn-outline-secondary copyClipboard" data-clipboard-text="<?php echo $linkTest; ?>">Copy Link</button>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item btn btn-sm btn-outline-info copyClipboard" data-clipboard-text="<?php echo $items->Token; ?>">Copy Token</button>
                                </div>
                            
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>