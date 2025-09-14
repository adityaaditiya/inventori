<h2>Transfer Stok</h2>
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<form method="post">
  <div class="form-group">
    <label for="id_toko_asal">Toko Asal</label>
    <select name="id_toko_asal" class="form-control" required>
      <?php foreach ($stores as $s): ?>
      <option value="<?php echo $s->id; ?>"><?php echo html_escape($s->nama_toko); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="id_product">Produk</label>
    <select name="id_product" class="form-control" required>
      <?php foreach ($products as $p): ?>
      <option value="<?php echo $p->id; ?>"><?php echo html_escape($p->nama_barang); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="jumlah">Jumlah</label>
    <input type="number" name="jumlah" class="form-control" min="1" required>
  </div>
  <div class="form-group">
    <label for="id_toko_tujuan">Toko Tujuan</label>
    <select name="id_toko_tujuan" class="form-control" required>
      <?php foreach ($stores as $s): ?>
      <option value="<?php echo $s->id; ?>"><?php echo html_escape($s->nama_toko); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="keterangan">Keterangan</label>
    <textarea name="keterangan" class="form-control"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Proses Transfer</button>
</form>