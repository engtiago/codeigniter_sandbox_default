<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<div class="container my-5">
  <h2 class="my-4">
    Usuários por sistemas
  </h2>


  <?php echo form_open(base_url('Admin_usuarios/listaUsuarios')); ?>

  <div class="form-group">
    <?php
    $optionsEmpresas[''] = '- Selecionar - ';
    foreach ($empresas as $valueEmpresas) {
      $optionsEmpresas[$valueEmpresas['empresa']] = $valueEmpresas['empresa'];
    }
    echo form_label("Empresa:", "empresa");
    echo form_dropdown('empresa', $optionsEmpresas, $empresa, array(
      "name" => "empresa",
      "id" => "empresa",
      "class" => "form-control",
      "maxlength" => "255",
    ));
    ?>
  </div>

  
  <div class="form-group">
    <?php
    $optionSetores[''] = '- Selecionar - ';
    foreach ($setores as $valueSetores) {
      $optionSetores[$valueSetores['local']] = $valueSetores['local'];
    }
    echo form_label("Setor:", "setor");
    echo form_dropdown('setor', $optionSetores, $setor, array(
      "name" => "setor",
      "id" => "setor",
      "class" => "form-control",
      "maxlength" => "255",
    ));
    ?>
  </div>

  <div class="form-group">
    <?php
    $optionsCargos[''] = '- Selecionar - ';
    foreach ($cargos as $valueCargos) {
      $optionsCargos[$valueCargos['cargo']] = $valueCargos['cargo'];
    }

    echo form_label("Cargo:", "cargo");
    echo form_dropdown('cargo', $optionsCargos, $cargo, array(
      "name" => "cargo",
      "id" => "cargo",
      "class" => "form-control",
      "maxlength" => "255",
    ));
    ?>
  </div>

  <div class="form-check form-check-inline">
    <?php
    if ($status == '1') {
      $statusValue = false;
    } else {
      $statusValue = true;
    }
    echo form_hidden("status", 1);
    echo form_label("Demitidos", 'status');
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
  </div>

  <?php
  if ($dt_inicial == '1900-01-01') {
    $dt_inicialPOG = 'POG';
  }else{
    $dt_inicialPOG = 'value';
  };
  if ($dt_final == '3000-12-31') {
    $dt_finalPOG = 'POG';
  }else{
    $dt_finalPOG = 'value';
  };
  ?>

  <div class="form-group">
    <?php
    echo form_label("Data Inicial:", "dt_inicial");
    echo form_input(array(
      "type" => "date",
      "name" => "dt_inicial",
      "id" => "dt_inicial",
      "class" => "form-control",
      $dt_inicialPOG => $dt_inicial

    ));
    ?>
  </div>

  <div class="form-group">
    <?php
    echo form_label("Data Final:", "dt_final");
    echo form_input(array(
      "type" => "date",
      "name" => "dt_final",
      "id" => "dt_final",
      "class" => "form-control",
      $dt_finalPOG => $dt_final

    ));
    ?>
  </div>

  <div class="row text-center my-3">
    <div class="col-8 col-sm-9">
      <?php
      if ($pesquisa == 'all') {
        $pesquisaValue = '';
      } else {
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
        "class" => "btn btn-info",
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

  <table class="table table-striped" style="font-size: 12px;">
    <thead>
      <tr>
        <th>CPF</td>
        <th>Nome</td>
        <th>Cargo</td>
        <th>Setor</td>
        <th>Empresa</td>
        <th>Programas</td>
        <th>Incluir</td>
        <th>Exluir</td>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($usuarios as $usuarios) : ?>
        <tr>

          <td><?= str_pad(($usuarios['cpf']), 11, "0", STR_PAD_LEFT);  ?> </td>
          <td><?= html_escape($usuarios['nome']) ?></td>
          <td><?= html_escape($usuarios['cargo']) ?></td>
          <td><?= html_escape($usuarios['local']) ?></td>
          <td><?= html_escape($usuarios['empresa']) ?></td>
          <td>
            <?php
              foreach ($usuariosProgramas[$usuarios['codigo']] as $value) {
                print_r($value);
                echo '<br>';
              }
              ?>
          </td>

          <td>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#incluir_<?= $usuarios['codigo'] ?>">Incluir</button>
          </td>



          <!-- modal incluir -->
          <div class="modal fade" id="incluir_<?= $usuarios['codigo'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-laptop-code"></i> Incluir programas</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <?php echo form_open_multipart(base_url('Admin_usuarios/function_novoSistemasUsuarios'));
                    echo form_hidden("usuarios_sistemas_codigo", $usuarios['codigo']);
                    ?>
                  <?php foreach ($sistemas as $sistema) : ?>
                    <div class="form-check">
                      <?php if (array_key_exists($sistema['id_sistema'], $usuariosProgramas[$usuarios['codigo']])) continue; ?>
                      <?php
                          echo form_checkbox(
                            array(
                              'name'          => "sistemas_id_sistemas_{$sistema['nome_sistema']}",
                              'id'            => $sistema['id_sistema'] . '-' . $usuarios['codigo'],
                              'value'         => $sistema['id_sistema'],
                              'checked'       => false,
                            )
                          );
                          ?>

                      <label class="form-check-label" for="<?= $sistema['id_sistema'] . '-' . $usuarios['codigo'] ?>">
                        <?= html_escape($sistema['nome_sistema']) ?>
                      </label>
                    </div>
                  <?php endforeach ?>
                  <?php

                    if (count($sistemas) <> count($usuariosProgramas[$usuarios['codigo']])) {
                      echo form_button(array(
                        "class" => "btn btn-primary mt-2",
                        "content" => "Incluir programas <i class='fas fa-plus'></i>",
                        "type" => "submit"
                      ));
                    } else {
                      echo '<p>Não existem sistemas para inclusão</p>';
                    }
                    echo form_close();
                    ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
              </div>
            </div>
          </div>


          <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir_<?= $usuarios['codigo'] ?>">Excluir</button>
          </td>
        </tr>

        <!-- modal excluir -->
        <div class="modal fade" id="excluir_<?= $usuarios['codigo'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="far fa-trash-alt"></i> Excluir programas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <?php echo form_open_multipart(base_url('Admin_usuarios/function_deletarSistemaUsuario'));
                  echo form_hidden("usuarios_sistemas_codigo", $usuarios['codigo']);
                  ?>
                <?php foreach ($sistemas as $sistema) : ?>
                  <div class="form-check">
                    <?php if (!array_key_exists($sistema['id_sistema'], $usuariosProgramas[$usuarios['codigo']])) continue; ?>
                    <?php
                        echo form_checkbox(
                          array(
                            'name'          => "sistemas_id_sistemas_{$sistema['nome_sistema']}",
                            'id'            => $sistema['id_sistema'] . '-' . $usuarios['codigo'],
                            'value'         => $sistema['id_sistema'],
                            'checked'       => false,
                          )
                        );
                        ?>

                    <label class="form-check-label" for="<?= $sistema['id_sistema'] . '-' . $usuarios['codigo'] ?>">
                      <?= html_escape($sistema['nome_sistema']) ?>
                    </label>
                  </div>
                <?php endforeach ?>
                <?php


                  if (!count($sistemas) <> count($usuariosProgramas[$usuarios['codigo']])) {
                    echo form_button(array(
                      "class" => "btn btn-danger mt-2",
                      "content" => 'Excluir programas <i class="far fa-trash-alt"></i>',
                      "type" => "submit"
                    ));
                  } else {
                    echo '<p>Não existem sistemas para Excluir</p>';
                  }
                  echo form_close();
                  ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
              </div>
            </div>
          </div>
        </div>



      <?php endforeach ?>

  </table>
  <p><?php echo $links; ?></p>
</div>