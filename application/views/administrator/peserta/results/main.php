
<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Result</h4>
        
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="window.history.back()">
                    Kembali
                </button>
    </div>
    <div class="card-body">
        <div class="row" style="max-height:200px; overflow:scroll;">
            <div class="col-md-12">
                <h5>Jawaban</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>PesertaID</th>
                            <th>JenisKelamin</th>
                            <th>Big5ID</th>
                            <th>FacetID</th>
                            <th>PernyataanID</th>
                            <th>Jawaban</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($getScore as $items): ?>
                             <tr>
                                <td><?php echo $items['PesertaID']; ?></td>
                                <td><?php echo $items['JenisKelamin']; ?></td>
                                <td><?php echo $items['Big5ID']." / ".$items['Big5Desc']; ?></td>
                                <td><?php echo $items['FacetID']." / ".$items['FacetDesc']; ?></td>
                                <td><?php echo $items['PernyataanID']; ?></td>
                                <td><?php echo $items['Jawaban']; ?></td>
                                <td><?php echo $items['Score']; ?></td>
                             </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>   
        <div class="row">
            <div class="col-md-12">
                <h5>Neo Summary</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>PesertaID</th>
                            <th>Domain</th>
                            <th>TotalScore</th>
                            <th>LfsResult</th>
                            <th>Matriks</th>
                            <th>Redaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result_big5 as $items): ?>
                             <tr>
                                <td style="width:5%"><?php echo $items['PesertaID']; ?></td>
                                <td style="width:20"><?php echo $items['Big5ID']." / ".$items['Big5Desc']; ?></td>
                                <td style="width:5%"><?php echo $items['TotalScore']; ?></td>
                                <td style="width:5%"><?php echo $items['LfsResult']; ?></td>
                                <td style="width:5%"><?php echo $items['MatriksResult']; ?></td>
                                <td style="width:60%" class="show-read-more text-wrap"><?php echo $items['RedaksiResult']; ?></td>
                             </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>   
        <div class="row" style="max-height:200px; overflow:scroll;">
            <div class="col-md-12">
                <h5>Facet Result</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>PesertaID</th>
                            <th>Domain</th>
                            <th>Facet</th>
                            <th>TotalScore</th>
                            <th>LfsResult</th>
                            <th>Redaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result_facet as $items): ?>
                             <tr>
                                <td style="width:5%"><?php echo $items['PesertaID']; ?></td>
                                <td style="width:20"><?php echo $items['Big5ID']." / ".$items['Big5Desc']; ?></td>
                                <td style="width:20"><?php echo $items['FacetID']." / ".$items['FacetDesc']; ?></td>
                                <td style="width:5%"><?php echo $items['TotalScore']; ?></td>
                                <td style="width:5%"><?php echo $items['LfsResult']; ?></td>
                                <td style="width:60%" class="show-read-more text-wrap"><?php echo $items['RedaksiResult']; ?></td>
                             </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-12">
                <h5>Facet Summary</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>PesertaID</th>
                            <th>Domain</th>
                            <th>Redaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result_facet_summary as $items): ?>
                             <tr>
                                <td style="width:5%"><?php echo $items['PesertaID']; ?></td>
                                <td style="width:20%"><?php echo $items['Big5ID']." / ".$items['Big5Desc']; ?></td>
                                <td style="width:60%" class="show-read-more text-wrap"><?php echo $items['RedaksiResult']; ?></td>
                             </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>   
        <div class="row">
            <div class="col-md-12">
                <h5>Style Summary</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>PesertaID</th>
                            <th>NormaStyleID</th>
                            <th>Style</th>
                            <th>Value Left</th>
                            <th>Value Right</th>
                            <th>Redaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result_style as $items): ?>
                             <tr>
                                <td style="width:5%"><?php echo $items['PesertaID']; ?></td>
                                <td style="width:10%"><?php echo $items['NormaStyleID']; ?></td>
                                <td style="width:20%"><?php echo $items['StyleDesc']; ?></td>
                                <td style="width:10%"><?php echo $items['Big5LeftValue']; ?></td>
                                <td style="width:10%"><?php echo $items['Big5RightValue']; ?></td>
                                <td style="width:60%" class="show-read-more text-wrap"><?php echo $items['RedaksiResult']; ?></td>
                             </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>   
    </div>
</div>