
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Data Client</h3>
        <a href="<?php echo base_url(); ?>/administrator/peserta/client/create" class="btn btn-outline-primary"> Tambah </a>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Action</th>
                    <th>Kode Client</th>
                    <th>Nama Client</th>
                    <th>Alamat</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $items): ?>
                    <tr>
                        <td style="width:5%;" class="text-center">
                            <a href="<?php echo base_url()."administrator/peserta/client/update/{$items->ID}"; ?>" class="btn btn-sm btn-outline-primary" >Edit</a>
                        </td>
                        <td style="width:10%"><?php echo $items->KodeClient; ?></td>
                        <td style="width:30%"><?php echo $items->NamaClient; ?></td>
                        <td style="width:30%"><?php echo $items->Alamat; ?></td>
                        <td style="width:10%"><?php echo $items->Kategori; ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>