<style>
body{
   background-color: #eaeaea;
}

.form-signin {
	width: 100%;
	max-width: 330px;
	padding: 15px;
	margin: auto;
  top:50px;
}
</style>

<div class="container-fluid">

  <div class="row" style="position:relative; top: 75px;">
    <div class="col-md-12">
      <?php echo form_open("auth/login", array('class'=> 'form-signin'));?>
        <div class="text-center mb-4">          
          <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?> text-center" role="alert">
              <span><?php echo $this->session->flashdata('message'); ?> </span>        
          </div>
          <img class="mb-4" src="<?php echo base_url(); ?>assets/images/psychology.png" alt="" width="72" height="72">
          
          <h1 class="h3 mb-1 font-weight-normal">Qualita Consulting</h1>
          <p class="lead">Administrator Panel</p>
          <!-- <p>Build form controls with floating labels via the <code>:placeholder-shown</code> pseudo-element. <a href="https://caniuse.com/#feat=css-placeholder-shown">Works in latest Chrome, Safari, and Firefox.</a></p> -->
        </div>
        <div class="form-group">
          <?php echo form_input($identity, '', array("id"=>"inputEmail", "class" => "form-control", "placeholder" => "Username", "required" => "", "autocomplete" => "off", "autofocus" => ""));?>
          <!-- <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus=""> -->
        </div>

        <div class="form-group">
          <?php echo form_password($password, '', array("id"=>"inputPassword", "class" => "form-control", "placeholder" => "Password", "required" => ""));?>
          <!-- <input type="password" id="inputPassword" class="form-control" placeholder="Password" required=""> -->
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted text-center">© www.qualitaconsulting.co.id</p>
      <?php echo form_close();?>
    </div>
  </div>
</div>
