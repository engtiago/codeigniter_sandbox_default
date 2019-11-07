<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- //var_dump($categoriaReceita); exit;  -->
<div class="container my-5">
    <h2 class="my-4">Lista Nível de acessos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome do Nível de acesso</td>
                <th>Editar</td>
                <th>Excluir</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nivel_acessos as $nivel_acesso) : ?>
                <tr>
                    <td><?= html_escape($nivel_acesso['nome_nivel_acesso']) ?></td>
                    <td>
                        <?= anchor("Admin_auth/vereditnivel_acesso/{$nivel_acesso['id_nivel_acesso']}", "Editar", array(
                            "role" => "button",
                            "class" => "btn btn-primary"
                        )); ?>
                    </td>

                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#nivel_acesso_<?= $nivel_acesso['id_nivel_acesso'] ?>">Excluir</button>
                    </td>

                </tr>

                <div class="modal fade" id="nivel_acesso_<?= $nivel_acesso['id_nivel_acesso'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Excluir</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Você deseja realmente excluir o Nível de acesso: <?= html_escape($nivel_acesso['nome_nivel_acesso']) ?> ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <?= anchor("Admin_auth/function_deletenivel_acesso/{$nivel_acesso['id_nivel_acesso']}", "Excluir", array(
                                    "role" => "button",
                                    "class" => "btn btn-danger"
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
    </table>
</div>