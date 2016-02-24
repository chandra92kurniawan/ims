            <table class="app-data-table table table-hover table-bordered table-condensed table-striped" id="example" >
                <thead>
                <tr>
                    <th class="span4" style="width:100px"><small>Nama Debitur</small></th>
                    <th style="width:100px"><small>Cabang/KCP</small></th>
                    <th style="width:20px"><small>Jenis</small></th>
                    <th><small>Asuransi</small></th>
                    <th><small>Jenis Klaim</small></th>
                    <th><small>Tgl Klaim Bank</small></th>
                    <th><small>Tgl Terima Klaim</small></th>
                    <th><small>Tgl Batas Limit</small></th>
                    <th><small>Tgl Bayar</small></th>
                    <th><small>Jumlah Klaim</small></th>
                    <th><small>Status Klaim</small></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>   
<script type="text/javascript">
        $(document).ready(function() {

            table = $('#example').DataTable({
                "aoColumns":[null,null,{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false},{"bSortable":false}],
                "searching":false,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('kgb/klaim/ajax_list')?>",
                    "data":{"range":"<?php echo $range;?>",
                            "debitur":"<?php echo $debitur;?>"},
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