            <table class="app-data-table table table-hover table-bordered table-condensed table-striped" id="example" >
                <thead>
                <tr>
                    <th class="span4" style="width:80px"><small>Cabang</small></th>
                    <th class="span4" style="width:80px"><small>KCP</small></th>
                    <th style="width:100px"><small>Nama Tertanggung</small></th>
                    <th><small>Tgl Lahir</small></th>
                    <th><small>Tgl Mulai</small></th>
                    <th><small>Tenor</small></th>
                    <th><small>Tipe Ass</small></th>
                    <th><small>Tgl Akhir</small></th>
                    <th><small>Rp Pertanggungan</small></th>
                    <th><small>Rate</small></th>
                    <th><small>Rp Premi Gross</small></th>
                    <th><small>Rp Net premi</small></th>
                    <th><small>Rp Premi + PPH</small></th>
                    <th><small>Asuradur</small></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>   
<script type="text/javascript">
        var periode="<?php echo $periode;?>";
        $(document).ready(function() {

            table = $('#example').DataTable({
                "aoColumns":[null,null,{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false}],
                "searching":false,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('kgb/dpa/ajax_list')?>",
                    "data":{"periode":"<?php echo $periode;?>",
                            "branch":"<?php echo $branch;?>",
                            "subbranch":"<?php echo $subbranch;?>",
                            "customer":"<?php echo $customer;?>",
                            "asuradur":"<?php echo $asuradur;?>"},
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
</script>