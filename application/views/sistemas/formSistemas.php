<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if ($sistema == null) {
  $titulo = "Novo Sistema";
  $sistema['id_sistema'] = "";
  $sistema['nome_sistema'] = "";
  
} else {
    $titulo = "Editar Sistema";
}
?>

<div class="container my-5">

    <h2 class="my-3">
        <?= $titulo ?>
        <?= anchor(base_url("Admin_Sistemas/listaSistemas"), "Ver Sistemas", array(
            "role" => "button",
            "class" => "btn btn-secondary"
        )); ?>
    </h2>

    <?php
    $div_form_row = '<div class="form-row">';
    $div_form_col = '<div class="col-md-6 mt-3 form-group">';
    $end_div = '</div>';

    echo form_open_multipart(base_url($formsubmit));
    echo ($div_form_row);

    echo form_hidden("id_sistema",$sistema['id_sistema']);


    echo ($div_form_col);
    echo form_label("Nome do Sistemas:", "nome_sistema");
    echo form_input(array(
        "name" => "nome_sistema",
        "id" => "nome_sistema",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>$sistema['nome_sistema']
    ));
    echo ($end_div);


    echo ($div_form_col);
    echo form_button(array(
        "class" => "btn btn-primary mt-4",
        "content" => "Salvar",
        "type" => "submit"
    ));
    echo ($end_div);

    echo ($end_div); //end form_row

    echo form_close();

    ?>
</div>
</div>

