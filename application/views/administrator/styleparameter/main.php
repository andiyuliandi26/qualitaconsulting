
<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Data Style</h4>
    </div>
    <div class="card-body col-md-12 col-xl-6 table-responsive-lg">
        <table width="50%" class="table table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Action</th>
                    <th>Style</th>
                    <th>Domain Left</th>
                    <th>Domain Right</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $items): ?>
                    <tr>
                        <td style="width:3%;" class="text-center">
                            <a href="<?php echo base_url()."administrator/styleparameter/update/{$items->ID}"; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td style="width:50%;" ><?php echo $items->Style; ?></td>
                        <td style="width:20%;" ><?php echo $items->Big5LeftKode; ?></td>
                        <td style="width:20%;" ><?php echo $items->Big5RightKode; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>