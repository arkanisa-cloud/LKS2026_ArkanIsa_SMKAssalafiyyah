<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('layouts/header');
?>

<div class="row h-100">
  <div class="col-lg-5 col-12">
    <div id="auth-left">
      <h1 class="auth-title"><?php echo lang('login_heading'); ?></h1>
      <br>

      <?php echo form_open("auth/login"); ?>
      <div class="form-group position-relative has-icon-left mb-4">
        <?php echo form_input($identity + ['class' => 'form-control form-control-xl', 'placeholder' => lang('login_identity_label')]); ?>
        <div class="form-control-icon">
          <i class="bi bi-person"></i>
        </div>
      </div>
      <div class="form-group position-relative has-icon-left mb-4">
        <?php echo form_input($password + ['class' => 'form-control form-control-xl', 'placeholder' => lang('login_password_label')]); ?>
        <div class="form-control-icon">
          <i class="bi bi-shield-lock"></i>
        </div>
      </div>
      <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5"
        type="submit"><?php echo lang('login_submit_btn'); ?></button>
      <?php echo form_close(); ?>


      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">
        </div>
      </div>
    </div>