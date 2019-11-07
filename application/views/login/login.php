<div class="container ">


    <div class="text-center mt-4">
        <h3><?=$titulo?></h3>
    </div>
    <div class="row">

        <div class="col-sm">
            <!-- paginação -->
        </div>

        <div class="m-5 col-sm">
            <?php echo form_open(base_url("login/autenticar")); ?>

            <div class="form-group">
                <?php
                echo form_label("E-mail", "email_pessoa");
                echo form_input(array(
                    "class" => "form-control",
                    "placeholder" => "E-mail",
                    "name" => "email_pessoa",
                    "id" => "email_pessoa",
                    "type" => "email",
                    "maxlength" => "255",
                    "required" => "true"
                ));
                ?>
            </div>

            <div class="form-group">
                <?php echo form_label("Senha", "senha_pessoa");
                echo form_password(array(
                    "class" => "form-control",
                    "placeholder" => "Senha",
                    "name" => "senha_pessoa",
                    "id" => "senha_pessoa",
                    "type" => "password",
                    "required" => "true"
                )); ?>
            </div>
            <?php
            echo form_button(array(
                "class" => "btn btn-lg btn-success btn-block",
                "type" => "submit",
                "content" => "Entrar"
            ));
            ?>
            <?php echo form_close(); ?>
        </div>

        <div class="col-sm">
            <!-- paginação -->
        </div>

    </div>
</div>