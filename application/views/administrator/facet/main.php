
<div class="card m-3">
    <div class="card-header">
        <h2 class="card-title">Data Facet</h2>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Big 5</th>
                    <th>Nama</th>
                    <th>Redaksi Low</th>
                    <th>Redaksi Average</th>
                    <th>Redaksi High</th>
                    <th>Is Active</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($facet as $items): ?>
                    <tr>
                        <td><?php echo $items->ID; ?></td>
                        <td><?php echo $items->Big5Desc; ?></td>
                        <td><?php echo $items->Nama; ?></td>
                        <td><?php echo $items->RedaksiLow; ?></td>
                        <td><?php echo $items->RedaksiAverage; ?></td>
                        <td><?php echo $items->RedaksiHigh; ?></td>
                        <td><?php echo $items->IsActive; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>