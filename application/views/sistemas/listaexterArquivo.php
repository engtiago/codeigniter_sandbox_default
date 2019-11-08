<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container mt-3">
  <h5>Categorias</h5>
  <ul class="list-group list-group-horizontal-sm">
  <?php foreach ($categorias as $categorias) : ?>
    <a href="<?= base_url("Admin_view/listaArquivo/{$categorias['categoria_download_arquivo']}")?>">
      <li class="list-group-item"> <i class="far fa-hand-point-right"></i> <?=$categorias['categoria_download_arquivo']?> </li>
    </a>
    <?php endforeach ?>
  </ul>
</div>

<div class="container mt-3 text-center">
  <?php echo form_open(base_url('Admin_view/listaArquivo')); ?>
  <div class="row text-center my-3">
    <div class="col-8 col-sm-9">
      <?php
      echo form_input(
        array(
          "name" => "titulo_download_arquivo",
          "id" => "titulo_download_arquivo",
          "class" => "form-control",
          "maxlength" => "255",
          "placeholder" => "Buscar Arquivo"
        )
      );
      ?>

    </div>
    <div class="col-4 col-sm-3">
      <?php echo form_button(array(
        "class" => "btn btn-danger",
        "content" => "Pesquisar",
        "type" => "submit"
      )); ?>
    </div>
  </div>
  <?php echo form_close(); ?>

  <h2>Arquivos para download</h2>
  <?php if ($arquivo == null) echo '<h3>Não foi encontrado nenhum Arquivo</h3>'; ?>

  <div class="row">
    <?php foreach ($arquivo as $arquivo) : ?>
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card my-2">
          <div class="div-img-responsive">
            <img src="<?= base_url("upload/download/minhatura/{$arquivo['minhatura_download_arquivo']}") ?>" class="img-resposive" alt="...">
          </div>
          <h5 class="card-title"><?= $arquivo['titulo_download_arquivo'] ?></h5>
          <div class="card-body">
            <p class="card-text"><?= $arquivo['categoria_download_arquivo'] ?></p>
            <a href="<?= base_url("Admin_view/arquivo/{$arquivo['id_download_arquivo']}") ?>" class="btn btn-card-receitas">Ver Detalhes</a>
            <a href="<?= base_url("upload/download/arquivo/{$arquivo['arquivo_download_arquivo']}") ?>" download="<?= $arquivo['titulo_download_arquivo'] ?>" class="btn btn-success mt-1">Download</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
  <p><?php echo $links; ?></p>
</div>