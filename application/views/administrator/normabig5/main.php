
<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Data Norma Domain Big 5</h4>        
        <?php $this->load->view('layouts/filterandpaging', $dataInfo); ?>
    </div>
    <div class="card-body table-responsive-lg">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Action</th>
                    <th>Domain</th>
                    <th>Jenis Kelamin</th>
                    <th>Batas Bawah</th>
                    <th>Batas Atas</th>
                    <th>Lfs</th>
                    <!-- <th>Matriks</th> -->
                </tr>
            </thead>
            <tbody>
                <?php  foreach($dataInfo->dataItems as $items): ?>
                    <tr>
                        <td style="width:3%;" class="text-center">
                            <a href="<?php echo base_url()."administrator/normabig5/update/{$items->ID}"; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td style="width:10%;" ><?php echo $items->Big5Desc; ?></td>
                        <td style="width:5%;" ><?php echo $items->JenisKelamin; ?></td>
                        <td style="width:10%;" class="text-center"><?php echo $items->BatasBawah; ?></td>
                        <td style="width:10%;" class="text-center"><?php echo $items->BatasAtas; ?></td>
                        <td style="width:10%;" ><?php echo $items->Lfs; ?></td>
                        <!-- <td style="width:5%;" class="text-center"><?php //echo $items->Matriks; ?></td> -->
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>