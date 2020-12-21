
<div class="card m-3">
    <div class="card-header">        
        <h4 class="card-title">Result</h4>
        <div class="row mb-2">
            <div class="col">
                <div class="list-group">
                    <div class="list-group-item border border-primary">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1"><?php echo $peserta->NamaPeserta; ?></h3>
                            <h5><?php echo date_format(new DateTime($peserta->TestDate), 'd/m/Y'); ?></h5>
                        </div>
                        <p class="mb-1 mt-1"><?php echo "{$peserta->NamaClient} / {$peserta->NamaBatch}"; ?></p>
                        <p class="mb-1"><?php echo "{$peserta->Email} / {$peserta->JenisKelamin} / {$peserta->Usia} tahun"; ?></p>
                        <small><?php echo "{$peserta->BidangPekerjaan} / {$peserta->JabatanPekerjaan}"; ?></small>

                        <div class="d-flex w-100 justify-content-between mt-4">
                            <h3 class="mb-1">Status Tes : <strong> <?php echo $peserta->TestStatus; ?> </strong></h3>
                        </div>
                        <p>
		                    Untuk informasi lebih lanjut, Anda dapat menghubungi administrator di nomor Whatsapp
		                    <strong class="copyClipboard" data-clipboard-text="+628111696196">+628111696196</strong>.
	                    </p>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="window.history.back()">
                    Kembali
                </button>
    </div>
    <div class="card-body">
        <div class="row mb-3" style="max-height:400px; overflow:scroll;">
            <div class="col-md-12">
                <h5 class="font-weight-bold">Jawaban</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <!--<th>PesertaID</th>
                            <th>JenisKelamin</th>-->
                            <th>Domain</th>
                            <th>Facet</th>
                            <th>PernyataanID</th>
                            <th>Jawaban</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($getScore as $items): ?>
                             <tr>
                                <!--<td><?php echo $items['PesertaID']; ?></td>
                                <td><?php echo $items['JenisKelamin']; ?></td>-->
                                <td><?php echo $items['Big5ID']." / ".$items['Big5Desc']; ?></td>
                                <td><?php echo $items['FacetID']." / ".$items['FacetDesc']; ?></td>
                                <td><?php echo $items['Pernyataan']; ?></td>
                                <td><?php echo $items['Jawaban']; ?></td>
                                <td><?php echo $items['Score']; ?></td>
                             </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>   
        <div class="row mb-3">
            <div class="col-md-12">
                <h5 class="font-weight-bold">Neo Summary</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <!--<th>PesertaID</th>-->
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
                                <!--<td style="width:5%"><?php echo $items['PesertaID']; ?></td>-->
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
        <div class="row mb-3" style="max-height:400px; overflow:scroll;">
            <div class="col-md-12">
                <h5 class="font-weight-bold">Facet Result</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <!--<th>PesertaID</th>-->
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
                                <!--<td style="width:5%"><?php echo $items['PesertaID']; ?></td>-->
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
        <div class="row mb-3">
            <div class="col-md-12">
                <h5 class="font-weight-bold">Facet Summary</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <!--<th>PesertaID</th>-->
                            <th>Domain</th>
                            <th>Redaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result_facet_summary as $items): ?>
                             <tr>
                                <!--<td style="width:5%"><?php echo $items['PesertaID']; ?></td>-->
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
                <h5 class="font-weight-bold">Style Summary</h5>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <!--<th>PesertaID</th>-->
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
                                <!--<td style="width:5%"><?php echo $items['PesertaID']; ?></td>-->
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
