
<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Data Peserta - Additional Report</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Laporan Peserta
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <?php $this->load->view('administrator/peserta/results/reportforadmin', $laporanData);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModal" onclick="add_additional(<?php echo $peserta->ID; ?>);">
                    Tambah
                </button>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="window.history.back()">
                    Kembali
                </button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-8">
                <div class="list-group">
                    <?php foreach($dataAdditional as $items):?>
                        <div href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?php echo $items->Item; ?></h5>
                                <button type="button" class="btn btn-sm btn-link text-success" data-toggle="modal" data-target="#exampleModal" onclick="get_additional(<?php echo $items->ID; ?>);">
                                    Edit
                                </button>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1"><?php echo $items->ItemDescription; ?></p>
                                
                                <button type="button" class="btn btn-sm btn-link text-danger" onclick="hapus_additional(<?php echo $items->ID; ?>, '<?php echo $items->Item; ?>');">Hapus </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static"  data-keyboard="false" >
  <div class="modal-dialog modal-dialog-top modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Additional Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo form_label('Item', 'Item'); ?>
                    <?php echo form_textarea(array('name' => 'Item', 'rows'=> '2'),'', 'class="form-control" id="Item"'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo form_label('Item Description', 'ItemDescription'); ?>
                    <?php echo form_textarea(array('name' => 'ItemDescription', 'rows'=> '5'), '', 'class="form-control" id="ItemDescription"'); ?>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tutup</button>-->
        <button type="button" class="btn btn-outline-success" id="btnSave">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function add_additional(pesertaID){
        $('#Item').val('');
        $('#ItemDescription').val('');
        $('#btnSave').attr('onclick', 'tambah_additional(' + pesertaID + ');');
    }

    function get_additional(id){
        $.ajax({
            url:'<?php echo base_url()."/api/apipeserta/additional_report_byid";?>',
            type: 'GET',
            dataType: "json",
            data: { id: id },
            success: function (data) {
                $('#Item').val(data.data.Item);
                $('#ItemDescription').val(data.data.ItemDescription);
                $('#btnSave').attr('onclick', 'update_additional(' + data.data.ID + ');');
            }
        });
    }

    function update_additional(id)
    {
        var item = $('#Item').val();
        var itemdescription = $('#ItemDescription').val();

        $.ajax({
            url:'<?php echo base_url()."/api/apipeserta/additional_report_update";?>',
            type: 'POST',
            dataType: "json",
            data: { id: id, item: item, itemdescription: itemdescription},
            success: function (data) {
                alert(data.message);
                $('#exampleModal').modal('hide');
                location.reload(true);
            }
        });
    }

    function tambah_additional(pesertaID)
    {
        var item = $('#Item').val();
        var itemdescription = $('#ItemDescription').val();

        $.ajax({
            url:'<?php echo base_url()."/api/apipeserta/additional_report_create";?>',
            type: 'POST',
            dataType: "json",
            data: { pesertaID: pesertaID, item: item, itemdescription: itemdescription},
            success: function (data) {
                alert(data.message);
                $('#exampleModal').modal('hide');
                location.reload(true);
            }
        });
    }

    function hapus_additional(id, item)
    {        
        if(confirm("Yakin akan menghapus data " + item + " ?")){
            $.ajax({
                url:'<?php echo base_url()."/api/apipeserta/additional_report_delete";?>',
                type: 'POST',
                dataType: "json",
                data: { id: id},
                success: function (data) {
                    alert(data.message);
                    location.reload(true);
                }
            });
        }
    }
</script>
