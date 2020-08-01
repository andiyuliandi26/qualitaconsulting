<div class="card m-3">
    <div class="card-header">
        <span class="card-title">Data User - Change Password</span>
    </div>
    <div class="card-body">
        <div id="infoMessage"><?php echo $message;?></div>

        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url().'auth/change_password'); ?>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                  <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
                  <?php echo form_input($old_password, set_value('old_password'), 'class="form-control" id="old_password"');?>
                </div>
                
            </div>
            <div class="col-md-5">
                <div class="form-group">
                  <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                  <?php echo form_input($new_password, set_value('new_password'), 'class="form-control" id="new_password"');?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                  <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                  <?php echo form_input($new_password_confirm, set_value('new_password_confirm'), 'class="form-control" id="new_password_confirm"');?>
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
