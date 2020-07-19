<div id="container">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" role="navigation" style="margin-bottom: 0">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Qualita Consulting</a>    
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Test</a>
            </li>
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Peserta
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/peserta/client">Client</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/peserta/clientbatch">Client Batch</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/peserta">Peserta</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/getresult">Lihat Hasil</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/peserta/results">Results</a>
                </div>
            </li>
            </ul>    
        </div>
    </nav>

</div>
<!-- /#wrapper -->