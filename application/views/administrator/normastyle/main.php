
<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Data Norma Style</h4>
    </div>
    <div class="card-body table-responsive-lg">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Action</th>
                    <th>Style</th>
                    <th>Domain Value</th>
                    <th>Redaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $items):
                        $big5LeftMatriks = $this->normastylemodel->get_big5_matriks($dataBig5, $items->Big5LeftID, $items->Big5LeftLfs);
                        $big5RightMatriks = $this->normastylemodel->get_big5_matriks($dataBig5, $items->Big5RightID, $items->Big5RightLfs);
                ?>
                    <tr>
                        <td style="width:3%;" class="text-center">
                            <a href="<?php echo base_url()."administrator/normastyle/update/{$items->ID}"; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td style="width:15%;" ><?php echo $items->StyleDesc; ?></td>
                        <td style="width:10%;" class="text-center"><?php echo $big5LeftMatriks.$big5RightMatriks; ?></td>
                        <td style="width:70%;" ><?php echo $items->Redaksi; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>