
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Data Style Parameter</h3>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Style</th>
                    <th>Big 5 Left</th>
                    <th>Big 5 Right</th>
                    <th>Is Active</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($facet as $items): ?>
                    <tr>
                        <td><?php echo $items->ID; ?></td>
                        <td><?php echo $items->Style; ?></td>
                        <td><?php echo $items->Big5LeftKode; ?></td>
                        <td><?php echo $items->Big5RightKode; ?></td>
                        <td><?php echo $items->IsActive; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>