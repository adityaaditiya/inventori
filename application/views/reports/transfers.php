<h2>Laporan Transfer Stok</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Produk</th>
      <th>Toko Asal</th>
      <th>Toko Tujuan</th>
      <th>Jumlah</th>
      <th>Tanggal</th>
      <th>Operator</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($transfers as $t): ?>
    <tr>
      <td><?php echo html_escape($t->nama_barang); ?></td>
      <td><?php echo html_escape($t->asal); ?></td>
      <td><?php echo html_escape($t->tujuan); ?></td>
      <td><?php echo $t->jumlah; ?></td>
      <td><?php echo $t->tanggal_transfer; ?></td>
      <td><?php echo html_escape($t->operator); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>