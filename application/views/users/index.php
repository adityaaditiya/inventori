<h2>Daftar Pengguna</h2>
<a href="<?php echo site_url('users/create'); ?>" class="btn btn-success mb-3">Tambah Pengguna</a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Username</th>
      <th>Role</th>
      <th>Toko</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
      <td><?php echo html_escape($user->nama_lengkap); ?></td>
      <td><?php echo html_escape($user->username); ?></td>
      <td><?php echo html_escape($user->role); ?></td>
      <td><?php echo $user->id_toko; ?></td>
      <td>
        <a href="<?php echo site_url('users/edit/'.$user->id); ?>" class="btn btn-sm btn-primary">Edit</a>
        <a href="<?php echo site_url('users/delete/'.$user->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pengguna?')">Hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>