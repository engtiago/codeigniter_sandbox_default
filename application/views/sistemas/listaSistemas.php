<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container my-5">
  <h2 class="my-4">
    Lista de Materiais de Merchan
    <?= anchor(base_url("Admin_sistemas/novoSistema"), "Novo Sistema", array(
      "role" => "button",
      "class" => "btn btn-secondary"
    )); ?>
  </h2>

  <?php echo form_open(base_url('Admin_sistemas/listaSistemas')); ?>
  <div class="row text-center my-3">
    <div class="col-8 col-sm-9">
      <?php
      echo form_input(
        array(
          "name" => "pesquisa",
          "id" => "pesquisa",
          "class" => "form-control",
          "maxlength" => "255",
          "placeholder" => "Buscar Programas"
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

  if ($sistemas == null) {
    echo '<h4>Não foi encontrado nenhum programa</h4>';
  }
  ?>

  <table class="table table-striped">
    <thead>
      <tr>
      
        <th><a href="<?= base_url('Admin_sistemas/listaSistemas/id_sistema/' . $pesquisa . "/" . $this->uri->segment(5)) ?>">Id<i class="fas fa-long-arrow-alt-down"></i></a></td>
        <th><a href="<?= base_url('Admin_sistemas/listaSistemas/novo_sistema/' . $pesquisa . "/" . $this->uri->segment(5)) ?>">Nome<i class="fas fa-long-arrow-alt-down"></i></a></td>
        <th>Editar</td>
        <th>Excluir</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sistemas as $sistemas) : ?>
        <tr>
          <td><?= html_escape($sistemas['id_sistema']) ?> </td>
          <td><?= html_escape($sistemas['nome_sistema']) ?></td>
          <td>
            <?= anchor("Admin_sistemas/verEditSistema/{$sistemas['id_sistema']}", "Editar", array(
              "role" => "button",
              "class" => "btn btn-primary"
            )); ?>
          </td>

          <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#post_<?= $sistemas['id_sistema'] ?>">Excluir</button>
          </td>
        </tr>

        <div class="modal fade" id="post_<?= $sistemas['id_sistema'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Excluir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Você deseja realmente excluir este sistemas: <?= html_escape($sistemas['nome_sistema']) ?> ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <?=anchor(base_url("Admin_sistemas/function_deletarSistemas/{$sistemas['id_sistema']}"), "Excluir", array(
                  "role" => "button",
                  "class" => "btn btn-danger"
                )); ?>
                <!-- <button type="button" class="btn btn-danger">Excluir</button> -->
              </div>
            </div>
          </div>
        </div>

        </tr>
      <?php endforeach ?>
  </table>
  <p><?php echo $links; ?></p>
</div>