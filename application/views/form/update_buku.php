<form method="POST" id="form_update_buku">
    <input type="hidden" name="id" id="id">
    <div class="form-group row">
        <label class="col-form-label col-sm-3">Nama Penerbit</label>
        <div class="col-sm-9">
            <select name="nama_penerbit" class="form-control">
                <?php if ($penerbit) { ?>
                    <?php foreach ($penerbit as $o_data) { ?>
                        <option value="<?= $o_data->id ?>"><?= $o_data->nama_penerbit ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Kategori</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="kategori">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Nama Buku</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="nama_buku">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Harga</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="harga">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Stock</label>
        <div class="col-sm-9">
            <input type="number" class="form-control" name="stock">
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn bg-primary">Submit</button>
    </div>
</form>