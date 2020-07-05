
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Data Pernyataan</h3>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Sequence</th>
                    <th>Redaksi</th>
                    <th>Score 1</th>
                    <th>Score 2</th>
                    <th>Score 3</th>
                    <th>Score 4</th>
                    <th>Score 5</th>
                    <th>Big 5</th>
                    <th>Facet</th>
                    <th>Is Active</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $items): ?>
                    <tr>
                        <td><?php echo $items->ID; ?></td>
                        <td><?php echo $items->Sequence; ?></td>
                        <td><?php echo $items->Redaksi; ?></td>
                        <td><?php echo $items->Score1; ?></td>
                        <td><?php echo $items->Score2; ?></td>
                        <td><?php echo $items->Score3; ?></td>
                        <td><?php echo $items->Score4; ?></td>
                        <td><?php echo $items->Score5; ?></td>
                        <td><?php echo $items->Big5Desc; ?></td>
                        <td><?php echo $items->FacetDesc; ?></td>
                        <td><?php echo $items->IsActive; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>