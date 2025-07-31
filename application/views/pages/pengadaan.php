<!-- datatable pengadaan -->
<div class="card" style="border-radius: 20px;">
    <div class="card-header header-elements-inline bg-primary">
        <h5 class="card-title"><?= $breadcrumb ?></h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p class="text-muted">Berikut adalah daftar buku yang perlu segera dibeli karena stoknya menipis:</p>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="pengadaanTable">
                <thead class="thead-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Nama Penerbit</th>
                        <th>Sisa Stok</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /datatable pengadaan -->

<script>
    $(function() {
        var t = $('table#pengadaanTable').DataTable({
            processing: true,
            ajax: {
                url: '<?= site_url('index/pengadaan') ?>',
                type: 'POST'
            },
            columns: [{
                    targets: 0,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_buku'
                },
                {
                    data: 'nama_penerbit'
                },
                {
                    data: 'stock'
                },
            ]
        });

    })
</script>