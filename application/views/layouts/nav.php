<div id="container">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" role="navigation" style="margin-bottom: 0">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Qualita Consulting</a>  
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>  
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav  mr-auto mt-2 mt-lg-0">
                <?php if($this->ion_auth->is_admin()): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Master Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/big5">Big5</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/facet">Facet</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/styleparameter">Style Parameter</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/pernyataan">Pernyataan</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/normabig5">Norma Big 5</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/normafacet">Norma Facet</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/normastyle">Norma Style</a>
                    </div>
                </li>                
                <?php endif; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Peserta
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if($this->ion_auth->is_admin()): ?>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/peserta/client">Client</a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/peserta/clientbatch">Client Batch</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/peserta/listpeserta">Peserta</a>
                        <!-- <a class="dropdown-item" href="<?php //echo base_url(); ?>administrator/getresult">Lihat Hasil</a> -->
                        <!-- <a class="dropdown-item" href="<?php //echo base_url(); ?>administrator/peserta/results">Results</a> -->
                    </div>
                </li>
                <?php if($this->ion_auth->is_admin()): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administrator
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/appsettings">Application Settings</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/auth/users">Users</a>
                        <!-- <a class="dropdown-item" href="<?php //echo base_url(); ?>administrator/auth/groups">Groups</a> -->
                        <!-- <a class="dropdown-item" href="<?php //echo base_url(); ?>administrator/auth/usergroups">User Groups</a> -->
                    </div>
                </li>
                <?php endif; ?>
            </ul> 
            <?php 
                if($this->ion_auth->logged_in()){
                    echo '<a class="btn btn-sm btn-outline-light my-2 my-sm-0 mr-2" href="'.base_url().'/auth/logout">'.$this->ion_auth->user()->row()->first_name.' - Logout</a>';
                }
            ?>
        </div>
    </nav>
</div>
<!-- /#wrapper -->