<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Data User - Tambah</span>


    </div>
    <div class="card-body">
        <div id="infoMessage"><?php echo $message;?></div>

        <?php $generatedToken = random_string('alnum',10); ?>
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url().'administrator/auth/create_user'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo form_label('Nama', 'first_name'); ?>
                    <?php echo form_input($first_name, set_value('first_name'), 'class="form-control" id="first_name"'); ?>
                </div>
                
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo form_label('Username', 'identity'); ?>
                    <?php echo form_input($identity, set_value('identity'), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo form_label('Email', 'email'); ?>
                    <?php echo form_input($email, set_value('email'), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo form_label('Password', 'password'); ?>
                    <div class="input-group">                        
                        <?php echo form_input(array('name' => 'password'), $generatedToken, 'class="form-control" id="password"'); ?>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" OnClick="generate_random_token('Token');">Generate Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Simpan</button>
        <a href="javascript:history.back()" class="btn btn-outline-danger">Kembali</a>
            
        <?php echo form_close(); ?>
    </div>
</div>

