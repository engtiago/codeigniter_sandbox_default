<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if ($nivel_acesso_programa == null) {
    $titulo = "Novo nível de acesso ao programa";
    $nivel_acesso_programa['id_nivel_acesso_programa'] = "";
    $nivel_acesso_programa['programa_id_programa'] = 1;
    $nivel_acesso_programa['nivel_acesso_id_nivel_acesso'] = 1;
} else {
    $titulo = "Editar nível de acesso ao programa";
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

    echo form_hidden("id_nivel_acesso_programa", $nivel_acesso_programa['id_nivel_acesso_programa']);

    echo ($div_form_col);
    foreach ($programa as $programa) {
        $optionsprograma[$programa["id_programa"]] = $programa["nome_programa"];
    }
    echo form_label("Programa:", "programa_id_programa");
    echo form_dropdown('programa_id_programa', $optionsprograma, $nivel_acesso_programa['programa_id_programa'], array(
        "name" => "programa_id_programa",
        "id" => "programa_id_programa",
        "required" => "true",
        "class" => "form-control"
    ));
    echo ($end_div);


    echo ($div_form_col);
    foreach ($nivel_acesso as $nivel_acesso) {
        $optionsnivel_acesso[$nivel_acesso["id_nivel_acesso"]] = $nivel_acesso["nome_nivel_acesso"];
    }
    echo form_label("Nível de acesso:", "nivel_acesso_id_nivel_acesso");
    echo form_dropdown('nivel_acesso_id_nivel_acesso', $optionsnivel_acesso, $nivel_acesso_programa['nivel_acesso_id_nivel_acesso'], array(
        "name" => "nivel_acesso_id_nivel_acesso",
        "id" => "nivel_acesso_id_nivel_acesso",
        "required" => "true",
        "class" => "form-control"
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