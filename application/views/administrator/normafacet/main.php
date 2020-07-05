
<div class="card m-3">
    <div class="card-header">
        <h2 class="card-title">Data Norma Facet</h2>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Facet</th>
                    <th>Jenis Kelamin</th>
                    <th>Batas Bawah</th>
                    <th>Batas Atas</th>
                    <th>Lfs</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $items): ?>
                    <tr>
                        <td><?php echo $items->ID; ?></td>
                        <td><?php echo $items->FacetDesc; ?></td>
                        <td><?php echo $items->JenisKelamin; ?></td>
                        <td><?php echo $items->BatasBawah; ?></td>
                        <td><?php echo $items->BatasAtas; ?></td>
                        <td><?php echo $items->Lfs; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>