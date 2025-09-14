<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="<?php echo site_url('/'); ?>">Inventory</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <?php $role = $this->session->userdata('role'); ?>
      <?php if ($role === 'superadmin'): ?>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('users'); ?>">Users</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('stores'); ?>">Stores</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('transfer'); ?>">Transfers</a></li>
      <?php endif; ?>
      <?php if (in_array($role, array('superadmin','admin'))): ?>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('products'); ?>">Products</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('inventory'); ?>">Inventory</a></li>
      <?php endif; ?>
      <?php if (in_array($role, array('owner','superadmin'))): ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="reportDropdown" data-toggle="dropdown">Reports</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?php echo site_url('reports/inventory'); ?>">Inventory Report</a>
          <a class="dropdown-item" href="<?php echo site_url('reports/transfers'); ?>">Transfer Report</a>
        </div>
      </li>
      <?php endif; ?>
    </ul>
    <span class="navbar-text">
      <?php echo $this->session->userdata('username'); ?>
    </span>
    <a class="btn btn-outline-light ml-2" href="<?php echo site_url('auth/logout'); ?>">Logout</a>
  </div>
</nav>
<div class="container">