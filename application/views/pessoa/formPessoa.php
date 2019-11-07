<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if ($pessoa == null) {
    $titulo = "Nova Pessoa";
    $pessoa['id_pessoa'] = "";
    $pessoa['nome_pessoa'] = "";
    $pessoa['email_pessoa'] = "";
    $pessoa['senha_pessoa'] = "";
    $pessoa['nivel_acesso_id_nivel_acesso'] = 1;
    $pessoa['cep_endereco'] = "";
    $pessoa['logradouro_endereco'] = "";
    $pessoa['bairro_endereco'] = "";
    $pessoa['numero_endereco'] = "";
    $pessoa['cidade_endereco'] = "";
    $pessoa['complemento_endereco'] = "";
    $pessoa['uf_endereco'] = "";
} else {
    $titulo = "Editar Pessoa";
}

?>
<div class="container my-5">
<h2 class="my-3">
        <?= $titulo ?>
        <?= anchor("Admin_pessoa/listapessoa", "Ver Pessoas", array(
            "role" => "button",
            "class" => "btn btn-secondary"
        )); ?>
    </h2>

    <?php
    $div_form_row = '<div class="form-row">';
    $div_form_col = '<div class="col-md-6 mt-3 form-group">';
    $end_div = '</div>';


    echo form_open_multipart($formsubmit);
    echo ($div_form_row);

    echo form_hidden("id_pessoa", $pessoa['id_pessoa']);

    echo ($div_form_col);
    echo form_label("Nome completo:", "nome_pessoa");
    echo form_input(array(
        "name" => "nome_pessoa",
        "id" => "nome_pessoa",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $pessoa['nome_pessoa']
    ));
    echo ($end_div);

    if ($pessoa['email_pessoa'] == "") {
        $disabled = "POG";
    } else {
        $disabled = "disabled";
    }
    echo ($div_form_col);
    echo form_label("Email", "email_pessoa");
    echo form_input(array(
        "name" => "email_pessoa",
        "id" => "email_pessoa",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $pessoa['email_pessoa'],
        $disabled => "true"
    ));
    echo ($end_div);


    if ($pessoa['senha_pessoa'] != "") {
        echo form_hidden("senha_pessoa_escondido", $pessoa['senha_pessoa']);
        $required = "POG";
    } else {
        $required = "required";
    }
    echo ($div_form_col);
    echo form_label("Senha", "senha_pessoa");
    echo form_input(array(
        "type" => "password",
        "name" => "senha_pessoa",
        "id" => "senha_pessoa",
        "class" => "form-control",
        "maxlength" => "255",
        $required => "true"
    ));
    echo ($end_div);


    echo ($div_form_col);
    foreach ($nivel_acesso as $nivel_acesso) {
        $optionsnivel_acesso[$nivel_acesso["id_nivel_acesso"]] = $nivel_acesso["nome_nivel_acesso"];
    }
    echo form_label("Nível de Acesso:", "nivel_acesso_id_nivel_acesso");
    echo form_dropdown(
        'nivel_acesso_id_nivel_acesso',
        $optionsnivel_acesso,
        $pessoa['nivel_acesso_id_nivel_acesso'],
        array(
            "name" => "nivel_acesso_id_nivel_acesso",
            "id" => "nivel_acesso_id_nivel_acesso",
            "required" => "true",
            "class" => "form-control"
        )
    );
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Cep", "cep_endereco");
    echo form_input(array(
        "name" => "cep_endereco",
        "id" => "cep_endereco",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $pessoa['cep_endereco']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Logradouro", "logradouro_endereco");
    echo form_input(array(
        "name" => "logradouro_endereco",
        "id" => "logradouro_endereco",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $pessoa['logradouro_endereco']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Bairro", "bairro_endereco");
    echo form_input(array(
        "name" => "bairro_endereco",
        "id" => "bairro_endereco",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $pessoa['bairro_endereco']
    ));
    echo ($end_div);

    echo ('<div class="col-md-3 mt-3 form-group">');
    echo form_label("Cidade", "cidade_endereco");
    echo form_input(array(
        "name" => "cidade_endereco",
        "id" => "cidade_endereco",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $pessoa['cidade_endereco']
    ));
    echo ($end_div);

    echo ('<div class="col-md-3 mt-3 form-group">');
    echo form_label("Estado", "uf_endereco");
    echo form_input(array(
        "name" => "uf_endereco",
        "id" => "uf_endereco",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $pessoa['uf_endereco']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Complemento", "complemento_endereco");
    echo form_input(array(
        "name" => "complemento_endereco",
        "id" => "complemento_endereco",
        "class" => "form-control",
        "maxlength" => "255",
        "value" =>  $pessoa['complemento_endereco']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Número", "numero_endereco");
    echo form_input(array(
        "name" => "numero_endereco",
        "id" => "numero_endereco",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $pessoa['numero_endereco']
    ));
    echo ($end_div);



    echo ($div_form_col);
    echo form_button(array(
        "class" => "btn btn-primary ml-alto",
        "content" => "Salvar",
        "type" => "submit"
    ));
    echo ($end_div);


    echo ($end_div); //end form_row


    echo form_close();
  
    ?>
</div>
</div>