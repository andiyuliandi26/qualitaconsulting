
<div class="card m-3">
    <div class="card-header">
        <h2 class="card-title">Data Norma Style</h2>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Style</th>
                    <th>Big 5 Value Left</th>
                    <th>Big 5 Value Right</th>
                    <th>Redaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $items): ?>
                    <tr>
                        <td><?php echo $items->ID; ?></td>
                        <td><?php echo $items->StyleDesc; ?></td>
                        <td><?php echo $items->Big5LeftValue; ?></td>
                        <td><?php echo $items->Big5RightValue; ?></td>
                        <td><?php echo $items->Redaksi; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>