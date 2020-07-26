
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Data Client Batch</h3>
        <a href="<?php echo base_url(); ?>/administrator/peserta/clientbatch/create" class="btn btn-outline-primary"> Tambah </a>
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
                    <th>Total Peserta</th>
                    <th>Durasi Test</th>
                    <th>Used</th>
                    <th>Link Test</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $items):
                        $linkTest = $this->config->item('default_test_url').$items->Token;
                        $jamAwal = date_format(new DateTime($items->JamAwalTest), 'h:i');
                        $jamAkhir = date_format(new DateTime($items->JamAkhirTest), 'h:i');
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
                        <td style="width:3%" class="text-center">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" disabled="" <?php echo $isUsed; ?>>
                                <label class="custom-control-label" for="customCheck1"></label>
                            </div>
                        </td>
                        <td style="width:25%" class="text-center">
                            <a href="<?php echo $linkTest; ?>" class="btn btn-sm btn-outline-primary" target="_blank">Goto Test</a>
                            <button class="btn btn-sm btn-outline-secondary copyClipboard" data-clipboard-text="<?php echo $linkTest; ?>">Copy Link</button>
                            <button class="btn btn-sm btn-outline-info copyClipboard" data-clipboard-text="<?php echo $items->Token; ?>">Copy Token</button>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>