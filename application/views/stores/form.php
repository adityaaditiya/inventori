<h2><?php echo isset($store) ? 'Edit Toko' : 'Tambah Toko'; ?></h2>
<form method="post">
  <div class="form-group">
    <label for="nama_toko">Nama Toko</label>
    <input type="text" name="nama_toko" class="form-control" value="<?php echo isset($store) ? html_escape($store->nama_toko) : ''; ?>" required>
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea name="alamat" class="form-control" required><?php echo isset($store) ? html_escape($store->alamat) : ''; ?></textarea>
  </div>
  <div class="form-group">
    <label for="kode_toko">Kode Toko</label>
    <input type="text" name="kode_toko" class="form-control" value="<?php echo isset($store) ? html_escape($store->kode_toko) : ''; ?>" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>