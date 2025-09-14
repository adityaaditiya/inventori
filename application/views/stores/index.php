<h2>Daftar Toko</h2>
<a href="<?php echo site_url('stores/create'); ?>" class="btn btn-success mb-3">Tambah Toko</a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Kode</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($stores as $store): ?>
    <tr>
      <td><?php echo html_escape($store->nama_toko); ?></td>
      <td><?php echo html_escape($store->alamat); ?></td>
      <td><?php echo html_escape($store->kode_toko); ?></td>
      <td>
        <a href="<?php echo site_url('stores/edit/'.$store->id); ?>" class="btn btn-sm btn-primary">Edit</a>
        <a href="<?php echo site_url('stores/delete/'.$store->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus toko?')">Hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>