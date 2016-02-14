<div class="view">
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-user"></i>
            <h3 class="box-title">Data User</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <!-- <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                <button type="button" id="add" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> </button>
            </div><!-- /. tools -->
        </div>
        <div class="box-body">
            <?php echo $this->session->flashdata('msg');?>
            <table class="app-data-table table table-hover table-bordered table-condensed table-striped" id="example" >
                <thead>
                <tr>
                    <th class="span4"><small>Username</small></th>
                    <th><small>Role</small></th>
                    <th><small>No HP</small></th>
                    <th><small>Email</small></th>
                    <th style="width:120px"><small>Aksi</small></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!--<div class="box-footer clearfix">
            <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
        </div>-->
    </div>
</div>
<div class="form" style="display:none">
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-user"></i>
            <h3 class="box-title" id="judul">Tambah User</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <!-- <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                <!-- <button type="button" id="add" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> </button> -->
            </div><!-- /. tools -->
        </div>
        <div class="box-body">
            <form class="form-horizontal" id="form" action="<?php echo base_url()?>users/add" method="POST">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-4">
                  <input type="text" name="username" class="form-control" id="username" placeholder="">
                </div>
              </div> 
              <div id="pwd">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-4">
                  <input type="password" name="password1" class="form-control" id="password1" placeholder="">
                </div>
              </div> 
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-4">
                  <input type="password" name="password2" class="form-control" id="password2" placeholder="">
                </div>
              </div>
              </div> 
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">No Hp</label>
                <div class="col-sm-4">
                  <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="">
                </div>
              </div> 
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-4">
                  <input type="text" name="email" class="form-control" id="email" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Role</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown('role', $role, '',"class='form-control' id='role'");?>
                  <!-- <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder=""> -->
                </div>
              </div> 
              <div id="added"></div>
              <div id="brk">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Sebagai</label>
                    <div class="col-sm-4">
                        <?php echo form_dropdown('bagian', $rl, '',"class='form-control' id='bagian'");?>
                    </div>
                  </div>
              </div>
              <div id="bnk">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Bank</label>
                    <div class="col-sm-4">
                        <?php echo form_dropdown('bank', $bank, '',"class='form-control' id='bank'");?>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Branch</label>
                    <div class="col-sm-4">
                        <?php echo form_dropdown('branch', array(''=>'- All -'), '',"class='form-control' id='branch'");?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Sub Branch</label>
                    <div class="col-sm-4">
                        <?php echo form_dropdown('subbranch', array(''=>'- All -'), '',"class='form-control' id='subbranch'");?>
                    </div>
                  </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-4">
                  <?php
                  echo form_dropdown('tipe', array(),'' ,'class="form-control" id="tipe"');
                  ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-4">
                  <button class="btn btn-success btn-frm" type="submit">Simpan</button> <button type="button" class="btn btn-danger btn-frm back">Batal</button>
                </div>
              </div> 
            </form>           
        </div>
    </div>
</div>


<script>
    $('#role').change(function(){
        var role=$(this).val();
        if(role==1){
            $('#brk').show();
            $('#bnk').hide();
        }else if(role==2){
            $('#bnk').show();
            $('#brk').hide();
        }else{
            $('#bnk').hide();
            $('#brk').hide();
        }
        /*$.post('<?php echo base_url()?>users/getAdded', {role: $(this).val()}, function(data, textStatus, xhr) {
            /*optional stuff to do after success /
            $('#added').html(data);
        });*/
        tipe(role);
    });
    function tipe(role){
        $.post('<?php echo base_url()?>users/getTipe', {role: role}, function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            $('select[name="tipe"]').html(data);
        });
    }
    $('#branch').change(function(){
        subbranch($(this).val());
    });
    function branch(bank){
        $.post('<?php echo base_url()?>users/getBranch', {bank: bank}, function(data, textStatus, xhr) {
            $('#branch').html(data);
        });
    }
    function subbranch(branch){
        $.post('<?php echo base_url()?>users/getSubBranch', {branch: branch}, function(data, textStatus, xhr) {
            $('#subbranch').html(data);
        });
    }
    $('#bank').change(function(){
        branch($(this).val());
    });
    function edit(username){
        $.post('<?php echo base_url()?>users/getDtUser', {username: username}, function(data) {
            /*optional stuff to do after success */
            var a=$.parseJSON(data);
            $('#pwd').hide();
            $('#form').attr('action',"<?php echo base_url()?>users/edit");
            $('input[name="username"]').val(a.USERNAME).attr('readonly','');
            $('select[name="role"]').val(a.ROLE);
            if(a.ROLE==1){
                $('#brk').show();
                $('#bnk').hide();
            }else if(a.ROLE==2){
                $('#bnk').show();
                $('#brk').hide();
            }else{
                $('#bnk').hide();
                $('#brk').hide();
            }
            $('select[name="bank"]').val(a.ID_BANK);
            branch(a.ID_BANK);
            $('select[name="branch"]').val(a.ID_BANK_BRANCH);
            $('select[name="subbranch"]').val(a.ID_BANK_SUBBRANCH);
            $('select[name="bagian"]').val(a.JENIS);
            $('input[name="no_hp"]').val(a.NO_HP);
            $('input[name="email"]').val(a.EMAIL);
            tipe(a.ROLE);
            $('select[name="tipe"]').val(a.TYPE);
            $('.view').hide();
            $('.form').fadeIn('slow');
        });
    }
    function hapus(username){
        var c=confirm("Apakah anda yakin akan menghapus user "+username+" ?");
        if(c==true){
            window.location.href="<?php echo base_url()?>users/hapus/"+username;
            //$.post('<?php echo base_url()?>users/hapus', {username: username});
        }else{
            return false;
        }
    }
        $("#form").validate({
            rules: {
                username: "required",
                password1: {
                    required: true,
                    minlength: 6
                },
                password2: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password1"
                },
                jabatan: "required",
                role:"required",
                bagian:"required",
                tipe:"required",
                bank:"required",
                no_hp: {
                    required: true,
                    number:true,
                    minlength: 8,
                    
                },
                email: {
                    required: true,
                    email: true
                },
                
            },
            messages: {
                username: "Harap isi username anda",
                password1: {
                    required: "Harap isi password anda",
                    minlength: "Minimal 6 karakter"
                },
                no_hp: {
                    required: "Harap isi No HP anda",
                    number: "Inputan harus angka",
                    minlength: "Your password must be at least 8 characters long"
                },
                password2: {
                    required: "Harap isi password anda",
                    minlength: "Minimal 6 karakter",
                    equalTo: "Harap isi dengan password yang sama"
                },
                email: "harap isi email anda dengan benar",
                role: "harap isi role anda",
                bagian:"harap isi sebagai",
                tipe:"harap isi type",
                bank:"harap isi "
            }
        });
    $('#add').click(function(){
        $('.view').hide();
        $('.form').fadeIn('slow');
        $('#judul').html("Tambah User");
        $('#form').attr("action","<?php echo base_url()?>users/add");
        $('#brk').hide();
        $('#bnk').hide();
        $('input[name="username"]').removeAttr('readonly');
    });
    $('.back').click(function(event) {
        $('.form').hide();
        $('.view').fadeIn('slow');
        $('select[name="role"],input[name="username"],input[name="password1"],input[name="password2"],input[name="jabatan"],input[name="email"],input[name="no_hp"]').val('');
        $('#pwd').show();
        $('select[name="tipe"]').empty();
    });
    $('#form').submit(function(event) {
        /* Act on the event */
        var a=$('input[name="username"]').val();
        $.post('<?php echo base_url()?>users/cekUser', {username: a}, function(data) {
          if(data==0){
            return true;
          }else{
            return false;
          }
        });
        
    });
    $(document).ready(function() {
        $(document).ready(function() {
            table = $('#example').DataTable({

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('users/ajax_list')?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                    {
                        "targets": [ -1 ], //last column
                        "orderable": false, //set not orderable
                    },
                ],

            });
        });
    } );

</script>