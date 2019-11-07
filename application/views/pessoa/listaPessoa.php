<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container my-5">
  <h2 class="my-4">
    Lista de Pessoas
    <?= anchor("Admin_pessoa/novapessoa", "Nova Pessoa", array(
      "role" => "button",
      "class" => "btn btn-secondary"
    )); ?>
  </h2>

  <?php echo form_open(base_url('Admin_pessoa/listaPessoa')); ?>
  <div class="row text-center my-3">
    <div class="col-8 col-sm-9">
      <?php
      echo form_input(
        array(
          "name" => "nome_pessoa",
          "id" => "nome_pessoa",
          "class" => "form-control",
          "maxlength" => "255",
          "placeholder" => "Buscar Pessoas"
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
  <?php echo form_close(); 
  
  if ($pessoas == null) {
    echo '<h4>Não foi encontrado nenhuma Pessoa</h4>';
  }
  ?>

  <table class="table table-striped">
    <thead>
      <tr>

        <th><a href="<?= base_url('Admin_pessoa/listaPessoa/nome_pessoa/'.$pesquisa."/".$this->uri->segment(5)) ?>">Nome<i style="font-size:11px" class="fas fa-chevron-down"></i></a></td>
        <th><a href="<?= base_url('Admin_pessoa/listaPessoa/email_pessoa/'.$pesquisa."/".$this->uri->segment(5)) ?>">E-mail<i style="font-size:11px" class="fas fa-chevron-down"></i></a></td>
        <th><a href="<?= base_url('Admin_pessoa/listaPessoa/nome_nivel_acesso/'.$pesquisa."/".$this->uri->segment(5)) ?>">Nível<i style="font-size:11px" class="fas fa-chevron-down"></i></a></td>
        <th>Editar</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pessoas as $pessoas) : ?>
        <tr>
          <td><?= html_escape($pessoas['nome_pessoa']) ?> </td>
          <td><?= html_escape($pessoas['email_pessoa']) ?></td>
          <td><?= html_escape($pessoas['nome_nivel_acesso']) ?></td>
          <td>
            <?= anchor("Admin_pessoa/editpessoa/{$pessoas['id_pessoa']}", "Editar", array(
              "role" => "button",
              "class" => "btn btn-primary"
            )); ?>
          </td>

        </tr>
      <?php endforeach ?>
  </table>
  <p><?php echo $links; ?></p>
</div>