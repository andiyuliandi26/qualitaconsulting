
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Data Big 5</span>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Matriks Low</th>
                    <th>Matriks Average</th>
                    <th>Matriks High</th>
                    <th>Is Active</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($big5 as $items): ?>
                    <tr>
                        <td><?php echo $items->ID; ?></td>
                        <td><?php echo $items->Nama; ?></td>
                        <td><?php echo $items->MatriksLow; ?></td>
                        <td><?php echo $items->MatriksAverage; ?></td>
                        <td><?php echo $items->MatriksHigh; ?></td>
                        <td><?php echo $items->IsActive; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>