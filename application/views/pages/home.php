<!-- views/pages/home.php -->
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">📚 Daftar Buku</h4>
    </div>
    <div class="card-body">
        <!-- Tabel Buku -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="bukuTable">
                <thead class="thead-light">
                    <tr>
                        <th>ID Buku</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Nama Penerbit</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- Info -->
        <div class="text-muted">
            * Menampilkan seluruh data buku. Gunakan kolom search/pencarian untuk mencari buku tertentu.
        </div>
    </div>
</div>

<script>
    $(function() {
        var tb_buku = $('table#bukuTable').DataTable({
            processing: true,
            ajax: {
                url: '<?= site_url('index/admin') ?>',
                type: 'POST'
            },
            columns: [{
                    data: 'IDBuku'
                },
                {
                    data: 'nama_buku'
                },
                {
                    data: 'kategori'
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