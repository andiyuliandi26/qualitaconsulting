
<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Data Client - Update</span>
    </div>
    <div class="card-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open(base_url()."administrator/peserta/client/update/{$data->ID}"); ?>
        <div class="row">
            <div class="col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Kode Client', 'KodeClient'); ?>
                    <?php echo form_input('KodeClient', $data->KodeClient, 'class="form-control" id="KodeClient"'); ?>
                    <?php echo form_hidden('ID', $data->ID); ?>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Nama Client', 'NamaClient'); ?>
                    <?php echo form_input('NamaClient', $data->NamaClient, 'class="form-control" id="NamaClient"'); ?>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo form_label('Kategori', 'Kategori'); ?>
                    <?php echo form_dropdown('Kategori', $kategori, $data->Kategori, 'class="custom-select"'); ?>
                </div>
            </div>
            <div class="col-md-12 col-lg-7">
                <div class="form-group">
                    <?php echo form_label('Alamat', 'Alamat'); ?>
                    <?php echo form_textarea(array('name' => 'Alamat', 'rows'=> '2', 'cols' => '10'), $data->Alamat, 'class="form-control"'); ?>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back()" class="btn btn-outline-danger">Kembali</a>
            
        </form>
    </div>
</div>