<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<style>
  .myAlert-top {
    position: fixed;
    top: 130px;
    left: 68%;
    width: 30%;
    z-index: 1;
  }

  .alert {
    display: none;
  }
</style>

<div class="myAlert-top alert alert-<?= $tipo?>">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong><?= $strongMsg ?></strong> <?= $msg?>
</div>


<script>
  function myAlertTop() {
    $(".myAlert-top").show();
    setTimeout(function() {
      $(".myAlert-top").hide();
    }, 3500);
  }
  window.onload = function(){
    myAlertTop();
}
</script>
