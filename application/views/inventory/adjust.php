<h2>Penyesuaian Stok</h2>
<?php if (isset($inventory)): ?>
<form method="post">
  <div class="form-group">
    <label>Produk</label>
    <input type="text" class="form-control" value="<?php echo html_escape($inventory->id_product); ?>" readonly>
  </div>
  <div class="form-group">
    <label for="jumlah_stok">Jumlah Stok</label>
    <input type="number" name="jumlah_stok" class="form-control" value="<?php echo $inventory->jumlah_stok; ?>" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<?php else: ?>
<form method="post">
  <div class="form-group">
    <label for="id_product">Produk</label>
    <select name="id_product" class="form-control" required>
      <?php foreach ($products as $p): ?>
      <option value="<?php echo $p->id; ?>"><?php echo html_escape($p->nama_barang); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <?php if ($this->session->userdata('role') === 'superadmin'): ?>
  <div class="form-group">
    <label for="id_store">Toko</label>
    <select name="id_store" class="form-control" required>
      <?php foreach ($stores as $s): ?>
      <option value="<?php echo $s->id; ?>"><?php echo html_escape($s->nama_toko); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <?php endif; ?>
  <div class="form-group">
    <label for="jumlah">Jumlah</label>
    <input type="number" name="jumlah" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<?php endif; ?>