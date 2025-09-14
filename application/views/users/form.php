<h2><?php echo isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna'; ?></h2>
<form method="post">
  <div class="form-group">
    <label for="nama_lengkap">Nama Lengkap</label>
    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo isset($user) ? html_escape($user->nama_lengkap) : ''; ?>" required>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" value="<?php echo isset($user) ? html_escape($user->username) : ''; ?>" required>
  </div>
  <div class="form-group">
    <label for="password">Password <?php echo isset($user) ? '(biarkan kosong jika tidak berubah)' : ''; ?></label>
    <input type="password" name="password" class="form-control" <?php echo isset($user) ? '' : 'required'; ?>>
  </div>
  <div class="form-group">
    <label for="role">Role</label>
    <select name="role" class="form-control" id="role-select" required>
      <option value="superadmin" <?php echo (isset($user) && $user->role==='superadmin') ? 'selected' : ''; ?>>Superadmin</option>
      <option value="owner" <?php echo (isset($user) && $user->role==='owner') ? 'selected' : ''; ?>>Owner</option>
      <option value="admin" <?php echo (isset($user) && $user->role==='admin') ? 'selected' : ''; ?>>Admin</option>
    </select>
  </div>
  <div class="form-group" id="store-select-group" style="display: none;">
    <label for="id_toko">Toko</label>
    <select name="id_toko" class="form-control">
      <option value="">- Pilih Toko -</option>
      <?php foreach ($stores as $s): ?>
      <option value="<?php echo $s->id; ?>" <?php echo (isset($user) && $user->id_toko==$s->id) ? 'selected' : ''; ?>>
        <?php echo html_escape($s->nama_toko); ?>
      </option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script>
$(function() {
  function toggleStore() {
    if ($('#role-select').val() === 'admin') {
      $('#store-select-group').show();
    } else {
      $('#store-select-group').hide();
    }
  }
  toggleStore();
  $('#role-select').on('change', toggleStore);
});
</script>