<!-- datatable buku -->
<div class="card" style="border-radius: 20px;">
    <div class="card-header header-elements-inline bg-primary">
        <h5 class="card-title"><?= $breadcrumb ?></h5>
        <div class="header-elements">
            <div class="list-icons">
                <button class="btn btn-sm bg-info mr-3" id="addNewBuku"><i class="icon-add"></i></button>
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3 text-center" id="bukuTable" width="100%">
                <thead class="thead-light">
                    <th>ID Buku</th>
                    <th>Kategori</th>
                    <th>Nama Buku</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /datatable buku -->

<!-- modal buku -->
<?= $this->modalslib->modal_component(
    [
        'modal_id' => 'add_buku',
        'modal_title' => 'Tambah Data Buku',
        'modal_body' => $this->load->view('form/add_buku', ['penerbit' => $data_penerbit], true)
    ]
)  ?>

<?= $this->modalslib->modal_component(
    [
        'modal_id' => 'update_buku',
        'modal_title' => 'Update Data Buku',
        'modal_body' => $this->load->view('form/update_buku', ['penerbit' => $data_penerbit], true)
    ]
)  ?>
<!-- /modal buku -->

<!-- datatable penerbit -->
<div class="card" style="border-radius: 20px;">
    <div class="card-header header-elements-inline bg-primary">
        <h5 class="card-title"><?= $breadcrumb2 ?></h5>
        <div class="header-elements">
            <div class="list-icons">
                <button class="btn btn-sm bg-info mr-3" id="addNewPenerbit"><i class="icon-add"></i></button>
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3 text-center" id="penerbitTable" width="100%">
                <thead class="thead-light">
                    <th>ID Penerbit</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /datatable penerbit -->

<!-- modal penerbit -->
<?= $this->modalslib->modal_component(
    [
        'modal_id' => 'add_penerbit',
        'modal_title' => 'Tambah Data Penerbit',
        'modal_body' => $this->load->view('form/add_penerbit', '', true)
    ]
)  ?>

<?= $this->modalslib->modal_component(
    [
        'modal_id' => 'update_penerbit',
        'modal_title' => 'Update Data Penerbit',
        'modal_body' => $this->load->view('form/update_penerbit', '', true)
    ]
)  ?>
<!-- /modal penerbit -->

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
                    data: 'kategori'
                },
                {
                    data: 'nama_buku'
                },
                {
                    data: 'harga'
                },
                {
                    data: 'stock'
                },
                {
                    data: 'nama_penerbit'
                },
                {
                    data: 'id',
                    orderable: false,
                    render: function(data, type, rows) {
                        var html = '<div class="btn-group" role="group" aria-label="">';
                        html += '<button type="button" class="btn btn-sm btn-primary" id="editBuku">Edit</button>';
                        html += '<button type="button" class="btn btn-sm btn-danger" id="deleteBuku" >Delete</i></button>';
                        html += '</div>';
                        return html;
                    }
                }
            ]
        });

        var tb_penerbit = $('table#penerbitTable').DataTable({
            processing: true,
            ajax: {
                url: '<?= site_url('index/get_penerbit') ?>',
                type: 'POST'
            },
            columns: [{
                    data: 'IDPenerbit'
                },
                {
                    data: 'nama_penerbit'
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'kota'
                },
                {
                    data: 'telepon'
                },
                {
                    data: 'id',
                    orderable: false,
                    render: function(data, type, rows) {
                        var html = '<div class="btn-group" role="group" aria-label="">';
                        html += '<button type="button" class="btn btn-sm btn-primary" id="editPenerbit">Edit</button>';
                        html += '<button type="button" class="btn btn-sm btn-danger" id="deletePenerbit" >Delete</i></button>';
                        html += '</div>';
                        return html;
                    }
                }
            ]
        });


        $('#addNewPenerbit').on('click', function() {
            $('form#form_add_penerbit')[0].reset();
            $('#add_penerbit').modal('show');
        })

        $('form#form_add_penerbit').on('submit', function(e) {
            e.preventDefault();

            $.blockUI({
                baseZ: 9999
            });
            var data = $(this).serialize();
            $.post('<?= site_url() ?>index/save_penerbit', data, function(response) {
                $.unblockUI();
                if (response.code == 0) {
                    iziToast.success({
                        title: 'OK',
                        message: response.message,
                        position: 'topRight'
                    });
                    tb_penerbit.ajax.reload();
                    $('#add_penerbit').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: response.message,
                        position: 'topRight'
                    });
                }
            }, 'json').fail(function(params) {
                $.unblockUI();
                iziToast.error({
                    title: 'Error',
                    message: 'Error processing data.',
                    position: 'topRight'
                });
            });
        });

        $('#penerbitTable tbody').on('click', '#editPenerbit', function() {
            // console.log('tes');
            var o_data = tb_penerbit.row($(this).parents('tr')).data();
            $('#id').val(o_data.id);
            $('input[name="nama_penerbit"]').val(o_data.nama_penerbit);
            $('input[name="alamat"]').val(o_data.alamat);
            $('input[name="kota"]').val(o_data.kota);
            $('input[name="telp"]').val(o_data.telepon);

            $('#update_penerbit').modal('show');
        })

        $('form#form_update_penerbit').on('submit', function(e) {
            e.preventDefault();

            $.blockUI({
                baseZ: 9999
            });
            var data = $(this).serialize();
            $.post('<?= site_url() ?>index/save_penerbit', data, function(response) {
                $.unblockUI();
                if (response.code == 0) {
                    iziToast.success({
                        title: 'OK',
                        message: response.message,
                        position: 'topRight'
                    });
                    tb_penerbit.ajax.reload();
                    $('#update_penerbit').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: response.message,
                        position: 'topRight'
                    });
                }
            }, 'json').fail(function(params) {
                $.unblockUI();
                iziToast.error({
                    title: 'Error',
                    message: 'Error processing data.',
                    position: 'topRight'
                });
            });
        });

        $('#penerbitTable tbody').on('click', '#deletePenerbit', function() {
            var o_data = tb_penerbit.row($(this).parents('tr')).data();
            var id = o_data.id;

            iziToast.question({
                title: '[Confirmation] :',
                message: 'Yakin ingin menghapus data?',
                position: 'center',
                progressBarColor: 'rgb(30 101 213)',
                close: false,
                buttons: [
                    ['<button><b>Yes</b></button>', function(instance, toast) {
                        $.ajax({
                            url: '<?= site_url('index/delete_data_penerbit'); ?>',
                            type: 'POST',
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                var result = JSON.parse(response);
                                if (result.code == 0) {
                                    iziToast.success({
                                        title: 'OK',
                                        message: result.message,
                                        position: 'topRight'
                                    });
                                    tb_penerbit.ajax.reload();
                                } else {
                                    iziToast.error({
                                        title: 'Error',
                                        message: result.message,
                                        position: 'topRight'
                                    });
                                }
                            },
                            error: function(error) {
                                iziToast.error({
                                    title: 'Error',
                                    message: 'Error processing data.',
                                    position: 'topRight'
                                });
                            }
                        });

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast);

                    }, true],
                    ['<button>No</button>', function(instance, toast) {
                        tb_penerbit.ajax.reload();
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast);
                    }, false],
                ],
            });
        })


        // buku
        $('#addNewBuku').on('click', function() {
            $('form#form_add_buku')[0].reset();
            $('#add_buku').modal('show');
        })

        $('form#form_add_buku').on('submit', function(e) {
            e.preventDefault();

            $.blockUI({
                baseZ: 9999
            });
            var data = $(this).serialize();
            $.post('<?= site_url() ?>index/save_buku', data, function(response) {
                $.unblockUI();
                if (response.code == 0) {
                    iziToast.success({
                        title: 'OK',
                        message: response.message,
                        position: 'topRight'
                    });
                    tb_buku.ajax.reload();
                    $('#add_buku').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: response.message,
                        position: 'topRight'
                    });
                }
            }, 'json').fail(function(params) {
                $.unblockUI();
                iziToast.error({
                    title: 'Error',
                    message: 'Error processing data.',
                    position: 'topRight'
                });
            });
        });

        $('#bukuTable tbody').on('click', '#editBuku', function() {
            // console.log('tes');
            var o_data = tb_buku.row($(this).parents('tr')).data();
            $('#id').val(o_data.id);
            $('select[name="nama_penerbit"]').val(o_data.id_penerbit);
            $('input[name="kategori"]').val(o_data.kategori);
            $('input[name="nama_buku"]').val(o_data.nama_buku);
            $('input[name="harga"]').val(o_data.harga);
            $('input[name="stock"]').val(o_data.stock);

            $('#update_buku').modal('show');
        })

        $('form#form_update_buku').on('submit', function(e) {
            e.preventDefault();

            $.blockUI({
                baseZ: 9999
            });
            var data = $(this).serialize();
            $.post('<?= site_url() ?>index/save_buku', data, function(response) {
                $.unblockUI();
                if (response.code == 0) {
                    iziToast.success({
                        title: 'OK',
                        message: response.message,
                        position: 'topRight'
                    });
                    tb_buku.ajax.reload();
                    $('#update_buku').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: response.message,
                        position: 'topRight'
                    });
                }
            }, 'json').fail(function(params) {
                $.unblockUI();
                iziToast.error({
                    title: 'Error',
                    message: 'Error processing data.',
                    position: 'topRight'
                });
            });
        });

        $('#bukuTable tbody').on('click', '#deleteBuku', function() {
            var o_data = tb_buku.row($(this).parents('tr')).data();
            var id = o_data.id;

            iziToast.question({
                title: '[Confirmation] :',
                message: 'Yakin ingin menghapus data?',
                position: 'center',
                progressBarColor: 'rgb(30 101 213)',
                close: false,
                buttons: [
                    ['<button><b>Yes</b></button>', function(instance, toast) {
                        $.ajax({
                            url: '<?= site_url('index/delete_data_buku'); ?>',
                            type: 'POST',
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                var result = JSON.parse(response);
                                if (result.code == 0) {
                                    iziToast.success({
                                        title: 'OK',
                                        message: result.message,
                                        position: 'topRight'
                                    });
                                    tb_buku.ajax.reload();
                                } else {
                                    iziToast.error({
                                        title: 'Error',
                                        message: result.message,
                                        position: 'topRight'
                                    });
                                }
                            },
                            error: function(error) {
                                iziToast.error({
                                    title: 'Error',
                                    message: 'Error processing data.',
                                    position: 'topRight'
                                });
                            }
                        });

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast);

                    }, true],
                    ['<button>No</button>', function(instance, toast) {
                        tb_buku.ajax.reload();
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast);
                    }, false],
                ],
            });
        })


    })
</script>