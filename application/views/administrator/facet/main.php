
<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Data Facet</h4>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th rowspan=2>Action</th>
                    <th rowspan=2>Big 5</th>
                    <th rowspan=2>Nama</th>
                    <th colspan=4>Redaksi</th>
                </tr>
                <tr>
                    <th>Redaksi Awal</th>
                    <th>Redaksi Low</th>
                    <th>Redaksi Average</th>
                    <th>Redaksi High</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $items): ?>
                    <tr>
                        <td style="width:3%;" class="text-center">
                            <a href="<?php echo base_url()."administrator/facet/update/{$items->ID}"; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td style="width:10%;"><?php echo $items->Big5Desc; ?></td>
                        <td style="width:10%;"><?php echo $items->Nama; ?></td>
                        <td style="width:15%" class="show-read-more text-wrap"><?php echo $items->RedaksiAwal; ?></td>
                        <td style="width:15%" class="show-read-more text-wrap"><?php echo $items->RedaksiLow; ?></td>
                        <td style="width:15%" class="show-read-more text-wrap"><?php echo $items->RedaksiAverage; ?></td>
                        <td style="width:15%" class="show-read-more text-wrap"><?php echo $items->RedaksiHigh; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>