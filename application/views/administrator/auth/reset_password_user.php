<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Data User - Edit</span>
    </div>
    <div class="card-body">
        <div id="infoMessage"><?php echo $message;?></div>

        <?php $generatedToken = random_string('alnum',10); ?>
        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url().'administrator/auth/reset_password_user/'.$user->id); ?>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <?php echo form_label('Username', 'username'); ?>
                    <?php echo form_input($user->username, $user->username, 'class="form-control" id="first_name" disabled'); ?>
                    <?php echo form_hidden($user->id, $user->id, 'class="form-control" id="ids" disabled'); ?>
                </div>                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo form_label('Password', 'password'); ?>
                    <div class="input-group">                        
                        <?php echo form_input(array('name' => 'password'), $generatedToken, 'class="form-control" id="password"'); ?>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" OnClick="generate_random_token('password');">Generate Password</button>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="row mt-3">
            <div class="col-md-12">
                  <button type="submit" class="btn btn-outline-success">Simpan</button>
                  <a href="javascript:history.back()" class="btn btn-outline-danger">Kembali</a>
            </div>
      </div>
            
        <?php echo form_close(); ?>
    </div>
</div>