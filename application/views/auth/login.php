<?php $this->load->view('templates/header'); ?>
<h2>Login</h2>
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<form method="post" action="<?php echo site_url('auth/login'); ?>">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
<?php $this->load->view('templates/footer'); ?>