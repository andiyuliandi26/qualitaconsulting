<?php                 
//var_dump($dataInfo->columnFilterList);
echo form_open(); ?>
<div class="card">
    <div class="card-body">
        <div class="input-group">
            <select class="custom-select col-md-2" id="filterColumn" name="filterColumn">
                <?php 
                    foreach($dataInfo->columnFilterList as $key => $value){
                        if($dataInfo->filterColumn == $key){
                            echo "<option value='{$key}' selected>{$value}</option>";
                        }else{
                            echo "<option value='{$key}'>{$value}</option>";
                        }
                    }
                ?>
            </select>
            <select class="custom-select col-md-1" id="filterOperator" name="filterOperator">                
                <option value="Like" <?php echo ($dataInfo->filterOperator == "Like") ? 'selected' : ''; ?>>Like</option>
                <option value="NotLike" <?php echo ($dataInfo->filterOperator == "NotLike") ? 'selected' : ''; ?>>Not Like</option>
                <option value="Equal" <?php echo ($dataInfo->filterOperator == "Equal") ? 'selected' : ''; ?>>Equal</option>
                <option value="NotEqual" <?php echo ($dataInfo->filterOperator == "NotEqual") ? 'selected' : ''; ?>>Not Equal</option>
            </select>
            <input type="text" class="form-control col-md-3" placeholder="Search term" id="filterValue" name="filterValue" value="<?php echo $dataInfo->filterValue; ?>" autocomplete="off">
            <button type="submit" class="btn btn-primary" id="submit" >Cari</button>
        </div>
        <div class="input-group mt-2">
            <select class="custom-select col-md-2" id="sortBy" name="sortBy">
                <?php 
                    foreach($dataInfo->columnSortList as $key => $value){
                        if($dataInfo->sortBy == $key){
                            echo "<option value='{$key}' selected>{$value}</option>";
                        }else{
                            echo "<option value='{$key}'>{$value}</option>";
                        }
                    }
                ?>
            </select>
            <div class="input-group-append">            
                <div class="input-group-text custom-control custom-radio custom-control-inline m-0">
                    <input type="radio" id="asc" name="sortOrder" value="ASC" class="custom-control-input position-relative" <?php echo ($dataInfo->sortOrder == "ASC") ? 'checked' : ''; ?>>
                    <label class="custom-control-label" for="asc">Ascending</label>
                </div>
                <div class="input-group-text custom-control custom-radio custom-control-inline">
                    <input type="radio" id="desc" name="sortOrder" value="DESC" class="custom-control-input position-relative" <?php echo ($dataInfo->sortOrder == "DESC" || $dataInfo->sortOrder == "") ? 'checked' : ''; ?>>
                    <label class="custom-control-label" for="desc">Descending</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 justify-content-start">
                <div class="input-group mt-4">
                    <div class="input-group-text">
                        Halaman
                    </div>
                    <select class="custom-select col-md-2" id="pageSelected" name="pageSelected">
                        <?php 
                        for($i = 1; $i <= $dataInfo->totalPage; $i++){
                                    if($dataInfo->currentPage == $i || $dataInfo->currentPage == ''){
                                        echo "<option value='{$i}' selected>{$i}</option>";
                                    }else{
                                        echo "<option value='{$i}'>{$i}</option>";
                                    }
                                }
                        ?>
                            
                    </select>
                    <div class="input-group-text">
                        / <?php echo $dataInfo->totalPage; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mt-4 justify-content-end">
                    <div class="input-group-text">
                        Per halaman
                    </div>
                    <select class="custom-select col-md-2" id="pageSizeSelected" name="pageSizeSelected">
                        
                        <option value="10" <?php echo ($dataInfo->currentPageSize == 10) ? 'selected' : ''; ?>>10</option>
                        <option value="20"<?php echo ($dataInfo->currentPageSize == 20) ? 'selected' : ''; ?>>20</option>
                        <option value="50"<?php echo ($dataInfo->currentPageSize == 50) ? 'selected' : ''; ?>>50</option>
                        <option value="100"<?php echo ($dataInfo->currentPageSize == 100) ? 'selected' : ''; ?>>100</option>
                        <option value="99999"<?php echo ($dataInfo->currentPageSize == 99999) ? 'selected' : ''; ?>>All</option>
                    </select>
                    <div class="input-group-text">
                        / <?php echo $dataInfo->totalSize; ?>
                    </div>
                </div>
            </div>            
        </div>        
    </div>
</div>

<?php echo form_close(); ?>
<script type="text/javascript">
$(document).ready(function(){
    var currentFilterColumn = $('#filterColumn').val();
    if(currentFilterColumn.includes('Tanggal') || currentFilterColumn.includes('Date')){
            //warningShow("TRUE");
            //$('#filterValue').attr('class', 'form-control col-md-3 standardDate');
            $('#filterValue').datepicker({
                format: "yyyy-mm-dd",
                language: "id",
                autoclose: true
            });
            $('#filterValue').val('<?php echo $dataInfo->filterValue; ?>');
        }else{
            $('#filterValue').datepicker("destroy");
            $('#filterValue').val('<?php echo $dataInfo->filterValue; ?>');
        }

    $('#filterColumn').change(function(){
        var value = $(this).val();
        if(value.includes('Tanggal') || value.includes('Date')){
            //warningShow("TRUE");
            //$('#filterValue').attr('class', 'form-control col-md-3 standardDate');
            $('#filterValue').datepicker({
                format: "yyyy-mm-dd",
                language: "id",
                autoclose: true
            });
            $('#filterValue').val('<?php echo date('Y-m-d'); ?>');
        }else{
            $('#filterValue').datepicker("destroy");
            $('#filterValue').val("");
        }
    });

    $('#pageSelected').change(function(){
        $('#submit').click();
    });

    $('#pageSizeSelected').change(function(){
        $('#submit').click();
    });

    $('#sortBy').change(function(){
        $('#submit').click();
    });

    $('input[name=sortOrder]').change(function(){
        $('#submit').click();
    });
});
</script>
