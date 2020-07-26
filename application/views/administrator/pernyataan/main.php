
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Data Pernyataan</h3>
    </div>
    <div class="card-body table-responsive-lg">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th rowspan=2>Action</th>
                    <th rowspan=2>Sequence</th>
                    <th rowspan=2>Redaksi</th>
                    <th colspan=5>Score</th>
                    <th rowspan=2>Big 5</th>
                    <th rowspan=2>Facet</th>
                </tr>
                <tr>
                    <th>Score 1</th>
                    <th>Score 2</th>
                    <th>Score 3</th>
                    <th>Score 4</th>
                    <th>Score 5</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $items): ?>
                    <tr>
                        <td style="width:3%;" class="text-center">
                            <a href="<?php echo base_url()."administrator/pernyataan/update/{$items->ID}"; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td style="width:5%; text-align:center;" ><?php echo $items->Sequence; ?></td>
                        <td style="width:30%" class="show-read-more text-wrap"><?php echo $items->Redaksi; ?></td>
                        <td style="width:5%; text-align:center;" ><?php echo $items->Score1; ?></td>
                        <td style="width:5%; text-align:center;" ><?php echo $items->Score2; ?></td>
                        <td style="width:5%; text-align:center;" ><?php echo $items->Score3; ?></td>
                        <td style="width:5%; text-align:center;" ><?php echo $items->Score4; ?></td>
                        <td style="width:5%; text-align:center;" ><?php echo $items->Score5; ?></td>
                        <td style="width:10%" ><?php echo $items->Big5Desc; ?></td>
                        <td style="width:10%" ><?php echo $items->FacetDesc; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>