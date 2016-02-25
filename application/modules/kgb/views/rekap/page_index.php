<div class="view">
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-user"></i>
            <h3 class="box-title">Rekap Peserta Asuransi</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <!-- <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> 
                <button type="button" id="add" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> </button>-->
            </div><!-- /. tools -->
        </div>
        <div class="box-body">
            <div class="row">
                <form class="form-horizontal" id="form">
                <div class="col-sm-6">
                    
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label"><small>Periode</small></label>
                            <div class="col-sm-6">
                              <?php echo form_dropdown('periode', $periode, '',"class='form-control' id='periode'");?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label"><small>Cabang</small></label>
                            <div class="col-sm-6">
                              <?php 
                              if($this->session->userdata('id_bank_branch')!=''){
                                echo "<input type='hidden' name='branch' value='".$this->session->userdata('id_bank_branch')."'>";
                                echo "<input type='text' class='form-control' readonly='' name='asdc' value='".$this->Mpassword->getBranch($this->session->userdata('id_bank_branch'))."'>";
                              }else{                                
                                echo form_dropdown('branch', $branch, $this->session->userdata('id_bank_branch'),"class='form-control' id='branch'");
                              }
                              ?>
                            </div>
                          </div> 
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label"><small>KCP</small></label>
                            <div class="col-sm-6">
                              <?php 
                              if($this->session->userdata('id_bank_subbranch')!=''){
                                echo "<input type='hidden' name='subbranch' value='".$this->session->userdata('id_bank_subbranch')."'>";
                                echo "<input type='text' class='form-control' readonly='' name='asdc' value='".$this->Mpassword->getSubBranch($this->session->userdata('id_bank_subbranch'))."'>";
                              }else{                                
                                echo form_dropdown('subbranch', $subbranch, $this->session->userdata('id_bank_subbranch'),"class='form-control' id='subbranch'");
                              }
                              ?>
                            </div>
                          </div>

                    
                </div>
                <div class="col-sm-6">
                        <!-- <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Search Customer</label>
                            <div class="col-sm-6">
                              <input type="text" name="customer" class="form-control" id="customer" placeholder="">
                            </div>
                          </div> -->
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label"><small>Asurandur</small></label>
                            <div class="col-sm-6">
                              <?php echo form_dropdown('asuradur', $asuradur, '',"class='form-control' id='asuradur'");?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label"></label>
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-success btn-frm" id="cari"> Cari</button>
                            </div>
                          </div>
                </div>
                </form>
            </div>
            <?php echo $this->session->flashdata('msg');?><br>
            <div id="data"></div>
            
        </div>
        <!--<div class="box-footer clearfix">
            <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
        </div>-->
    </div>
</div>

<script type="text/javascript">
    $('#cari').click(function(){
        var form=$('#form').serialize();
        $.post("<?php echo base_url()?>kgb/rekap/getData",form,function(data){
            $('#data').html(data);
        });
    });
    jQuery(document).ready(function($) {
      $('#cari').click();
    });
    $('select[name="branch"]').change(function(){
        $.post('<?php echo base_url()?>kgb/rekap/getSubBranch',{branch:$(this).val()},function(data){
            $('select[name="subbranch"]').html(data);
        });
    });
</script>
