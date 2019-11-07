<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if ($programa == null) {
    $titulo = "Novo programa";
    $programa['id_programa'] = "";
    $programa['nome_programa'] = "";
} else {
    $titulo = "Editar programa";
}
?>

<div class="container my-5">
    <h2 class="my-3"><?= $titulo ?></h2>

    <?php
    $div_form_row = '<div class="form-row">';
    $div_form_col = '<div class="col-md-12 mt-3 form-group">';
    $end_div = '</div>';

    echo form_open_multipart($formsubmit);
    echo ($div_form_row);

    echo form_hidden("id_programa", $programa['id_programa']);

    echo ($div_form_col);
    echo form_label("Nome do Programa:", "nome_programa");
    echo form_input(array(
        "name" => "nome_programa",
        "id" => "nome_programa",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $programa['nome_programa']
    ));
    echo ($end_div);


    echo ($div_form_col);
    echo form_button(array(
        "class" => "btn btn-primary ml-alto mt-4",
        "content" => "Salvar",
        "type" => "submit"
    ));
    echo ($end_div);
    echo ($end_div); //end form_row
    echo form_close();
    ?>
</div>
</div>