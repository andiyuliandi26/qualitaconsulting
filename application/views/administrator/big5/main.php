<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Data Domain Big 5</h4>
        <?php $this->load->view('layouts/filterandpaging', $dataInfo); ?>
    </div>
    <div class="card-body table-responsive-lg">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark text-center" style="v-align:middle">
                <tr>
                    <th rowspan=2>Action</th>
                    <th rowspan=2>Nama</th>
                    <th rowspan=2>Kode</th>
                    <th colspan=3>Matriks</th>
                    <th colspan=3>Redaksi</th>
                </tr>
                <tr>
                    <th>Low</th>
                    <th>Average</th>
                    <th>High</th>
                    <th>Low</th>
                    <th>Average</th>
                    <th>High</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($dataInfo->dataItems as $items): ?>
                    <tr>
                        <td style="width:3%;" class="text-center">
                            <a href="<?php echo base_url()."administrator/big5/update/{$items->ID}"; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td style="width:10%"><?php echo $items->Nama; ?></td>
                        <td style="width:5%"><?php echo $items->Kode; ?></td>
                        <td style="width:5%"><?php echo $items->MatriksLow; ?></td>
                        <td style="width:5%"><?php echo $items->MatriksAverage; ?></td>
                        <td style="width:5%"><?php echo $items->MatriksHigh; ?></td>
                        <td style="width:20%" class="show-read-more text-wrap"><?php echo $items->RedaksiLow; ?></td>
                        <td style="width:20%" class="show-read-more text-wrap"><?php echo $items->RedaksiAverage; ?></td>
                        <td style="width:20%" class="show-read-more text-wrap"><?php echo $items->RedaksiHigh; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>