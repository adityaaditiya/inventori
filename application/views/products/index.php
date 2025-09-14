<h2>Daftar Produk</h2>
<a href="<?php echo site_url('products/create'); ?>" class="btn btn-success mb-3">Tambah Produk</a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Kode</th>
      <th>Nama</th>
      <th>Deskripsi</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $product): ?>
    <tr>
      <td><?php echo html_escape($product->kode_barang); ?></td>
      <td><?php echo html_escape($product->nama_barang); ?></td>
      <td><?php echo html_escape($product->deskripsi); ?></td>
      <td><?php if ($product->gambar): ?><img src="<?php echo base_url('uploads/products/'.$product->gambar); ?>" width="50"><?php endif; ?></td>
      <td>
        <a href="<?php echo site_url('products/edit/'.$product->id); ?>" class="btn btn-sm btn-primary">Edit</a>
        <a href="<?php echo site_url('products/delete/'.$product->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>