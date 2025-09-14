<h2><?php echo isset($product) ? 'Edit Produk' : 'Tambah Produk'; ?></h2>
<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="kode_barang">Kode Barang</label>
    <input type="text" name="kode_barang" class="form-control" value="<?php echo isset($product) ? html_escape($product->kode_barang) : ''; ?>" required>
  </div>
  <div class="form-group">
    <label for="nama_barang">Nama Barang</label>
    <input type="text" name="nama_barang" class="form-control" value="<?php echo isset($product) ? html_escape($product->nama_barang) : ''; ?>" required>
  </div>
  <div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" class="form-control"><?php echo isset($product) ? html_escape($product->deskripsi) : ''; ?></textarea>
  </div>
  <div class="form-group">
    <label for="gambar">Foto</label>
    <?php if (isset($product) && $product->gambar): ?>
      <div><img src="<?php echo base_url('uploads/products/'.$product->gambar); ?>" width="80"></div>
    <?php endif; ?>
    <input type="file" name="gambar" class="form-control-file">
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>