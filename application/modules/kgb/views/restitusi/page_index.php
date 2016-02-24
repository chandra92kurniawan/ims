
<div class="view">
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-user"></i>
            <h3 class="box-title">RESTITUSI</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <!-- <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> 
                <button type="button" id="add" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> </button>-->
            </div><!-- /. tools -->
        </div>
        <div class="box-body">
        	<div class="row">
        		<div class="col-sm-12">
        			<center>
                    <form class="form-inline" id="form">
        				<div class="form-group">
						    <label for="exampleInputName2"><small>Date range</small></label>
						    <input type="text" name="range" class="form-control" id="range" placeholder="Pilih Rentang Tanggal">
						  </div>
						  <div class="form-group">
						    <label for="exampleInputName2"><small>Search Debitur</small></label>
						    <input type="text" name="debitur" class="form-control" placeholder="">
						  </div>
						  <div class="form-group">
						    <label for="exampleInputName2"></label>
						    <button type="button" id="cari" class="btn btn-primary"> Cari </button>
						  </div>
        			</form>
                    </center>
        		</div>
        	</div><br>
            <div id="data"></div>           
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#cari').click(function(){
        var form=$('#form').serialize();
        $.post("<?php echo base_url()?>kgb/restitusi/getData",form,function(data){
            $('#data').html(data);
        });
    });
    jQuery(document).ready(function($) {
        $('#cari').click();
    });
	$('#range').daterangepicker({timePicker: false, timePickerIncrement: false, format: 'MM/DD/YYYY'});
</script>