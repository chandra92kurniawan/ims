            <table class="app-data-table table table-hover table-bordered table-condensed table-striped" id="example" >
                <thead>
                <tr>
                    <th class="span4"><small>Cabang</small></th>
                    <th><small>KCP</small></th>
                    <th style="width: 70px"><small>Jumlah Peserta</small></th>
                    <th><small>Total Pertanggungan</small></th>
                    <th><small>TotalPremi Gross</small></th>
                    <th><small>Total Premi Net</small></th>
                    <th><small>Premi + PPH</small></th>
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
                "aoColumns":[null,null,{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false}],
                "searching":false,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('kgb/rekap/ajax_list')?>",
                    "data":{"periode":"<?php echo $periode;?>",
                            "branch":"<?php echo $branch;?>",
                            "subbranch":"<?php echo $subbranch;?>",
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