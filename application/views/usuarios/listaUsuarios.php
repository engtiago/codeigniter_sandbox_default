<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container my-5">
  <h2 class="my-4">
    Lista de Materiais de Merchan
  </h2>

  <?php echo form_open(base_url('Admin_usuarios/listaUsuarios')); ?>

  <div class="form-check form-check-inline">
    <?php
  if ($status == '1'){
    $statusValue = false;
  }else{
    $statusValue = true;
  }
    echo form_hidden("status",1);
    echo form_checkbox(
      array(
        'name'          => 'status',
        'id'            => 'status',
        'value'         => '0',
        'checked'       => $statusValue,
        'style'         => 'margin:10px'
      )
    );
    ?>
    <label class="form-check-label" for="status">
      Demitidos
    </label>
  </div>

  <div class="row text-center my-3">
    <div class="col-8 col-sm-9">
      <?php
      if($pesquisa == 'all'){
        $pesquisaValue = '';
      }else{
        $pesquisaValue = $pesquisa;
      }
      echo form_input(
        array(
          "name" => "pesquisa",
          "id" => "pesquisa",
          "class" => "form-control",
          "maxlength" => "255",
          "placeholder" => "Buscar Usuários",
          'value' => $pesquisaValue
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

  if ($usuarios == null) {
    echo '<h4>Não foi encontrado nenhum Usuário</h4>';
  }
  ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th><a href="<?= base_url("Admin_usuarios/listaUsuarios/cpf/$pesquisa/$status/". $this->uri->segment(6))?>">CPF<i class="fas fa-long-arrow-alt-down"></i></a></td>
        <th><a href="<?= base_url("Admin_usuarios/listaUsuarios/nome/$pesquisa/$status/" . $this->uri->segment(6)) ?>">Nome<i class="fas fa-long-arrow-alt-down"></i></a></td>
        <th>Editar - Programas</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($usuarios as $usuarios) : ?>
        <tr>

          <td><?= str_pad(($usuarios['cpf']), 11, "0", STR_PAD_LEFT);  ?> </td>
          <td><?= html_escape($usuarios['nome']) ?></td>
        
          <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#post_<?= $usuarios['cpf'] ?>">Excluir</button>
          </td>
        </tr>

        <div class="modal fade" id="post_<?= $usuarios['cpf'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Excluir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
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