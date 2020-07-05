<div id="container">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" role="navigation" style="margin-bottom: 0">
        <a class="navbar-brand" href="#">Qualita Consulting</a>    
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
                    <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/pernaytaan">Pernyataan</a>
                </div>
            </li>
            </ul>    
        </div>
    </nav>

</div>
<!-- /#wrapper -->