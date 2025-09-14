<h2>Inventaris</h2>
<?php if ($this->session->userdata('role') === 'superadmin'): ?>
<form method="get" class="form-inline mb-3">
  <label for="store_id" class="mr-2">Pilih Toko:</label>
  <select name="store_id" class="form-control mr-2">
    <option value="">Semua</option>
    <?php foreach ($stores as $s): ?>
    <option value="<?php echo $s->id; ?>" <?php echo ($this->input->get('store_id') == $s->id) ? 'selected' : ''; ?>>
      <?php echo html_escape($s->nama_toko); ?>
    </option>
    <?php endforeach; ?>
  </select>
  <button type="submit" class="btn btn-secondary">Filter</button>
</form>
<?php endif; ?>
<?php if (in_array($this->session->userdata('role'), array('superadmin','admin'))): ?>
<a href="<?php echo site_url('inventory/add_stock'); ?>" class="btn btn-success mb-3">Tambah Stok</a>
<?php endif; ?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Produk</th>
      <th>Toko</th>
      <th>Jumlah</th>
      <?php if (in_array($this->session->userdata('role'), array('superadmin','admin'))): ?>
      <th>Aksi</th>
      <?php endif; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($inventory as $item): ?>
    <tr>
      <td><?php echo html_escape($item->nama_barang); ?></td>
      <td><?php echo isset($item->nama_toko) ? html_escape($item->nama_toko) : ''; ?></td>
      <td><?php echo $item->jumlah_stok; ?></td>
      <?php if (in_array($this->session->userdata('role'), array('superadmin','admin'))): ?>
      <td>
        <a href="<?php echo site_url('inventory/adjust_stock/'.$item->id); ?>" class="btn btn-sm btn-primary">Ubah</a>
      </td>
      <?php endif; ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>