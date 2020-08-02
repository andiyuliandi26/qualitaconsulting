
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Result</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <?php foreach($data as $items): ?>
                             <tr>
                                <!-- <td><?php //echo $items['PesertaID']; ?></td>
                                <td><?php //echo $items['FacetID']; ?></td>
                                <td><?php //echo $items['TotalScore']; ?></td>
                                <td><?php //echo $items['LfsResult']; ?></td> -->

                                <td><?php echo $items['PesertaID']; ?></td>
                                <td><?php echo $items['Big5ID']; ?></td>
                                <td><?php echo $items['TotalScore']; ?></td>
                                <td><?php echo $items['LfsResult']; ?></td>
                                <td><?php echo $items['Matriks']; ?></td>
                             </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>   
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <?php foreach($data_style as $items): ?>
                             <tr>
                                <!-- <td><?php //echo $items['PesertaID']; ?></td>
                                <td><?php //echo $items['FacetID']; ?></td>
                                <td><?php //echo $items['TotalScore']; ?></td>
                                <td><?php //echo $items['LfsResult']; ?></td> -->

                                <td><?php //echo $items['StyleID']; ?></td>
                                <td><?php //echo $items['Big5LeftID']; ?></td>
                                <td><?php //echo $items['Big5LeftValue']; ?></td>
                                <td><?php //echo $items['Big5RightID']; ?></td>
                                <td><?php //echo $items['Big5RightValue']; ?></td>
                             </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>   
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <?php foreach($data_style as $items): ?>
                             <tr>
                                <!-- <td><?php //echo $items['PesertaID']; ?></td>
                                <td><?php //echo $items['FacetID']; ?></td>
                                <td><?php //echo $items['TotalScore']; ?></td>
                                <td><?php //echo $items['LfsResult']; ?></td> -->

                                <td><?php echo $items['PesertaID']; ?></td>
                                <td><?php echo $items['StyleID']; ?></td>
                                <td><?php echo $items['Style']; ?></td>
                                <td><?php echo $items['NormaStyleID']; ?></td>
                                <td><?php echo $items['Big5LeftValue']; ?></td>
                                <td><?php echo $items['Big5RightValue']; ?></td>
                                <td><?php echo $items['Redaksi']; ?></td>
                             </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>   
    </div>
</div>