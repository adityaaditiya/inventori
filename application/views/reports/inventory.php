<h2>Laporan Inventaris</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Produk</th>
      <th>Toko</th>
      <th>Jumlah</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($inventory as $item): ?>
    <tr>
      <td><?php echo html_escape($item->nama_barang); ?></td>
      <td><?php echo html_escape($item->nama_toko); ?></td>
      <td><?php echo $item->jumlah_stok; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>