<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- //var_dump($categoriaReceita); exit;  -->
<div class="container my-5">
    <h2 class="my-4">Lista programas</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome do programa</td>
                <th>Editar</td>
                <th>Excluir</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($programas as $programa) : ?>
                <tr>
                    <td><?= html_escape($programa['nome_programa']) ?></td>
                    <td>
                        <?= anchor("Admin_auth/vereditprograma/{$programa['id_programa']}", "Editar", array(
                            "role" => "button",
                            "class" => "btn btn-primary"
                        )); ?>
                    </td>

                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#programa_<?= $programa['id_programa'] ?>">Excluir</button>
                    </td>

                </tr>

                <div class="modal fade" id="programa_<?= $programa['id_programa'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Excluir</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Você deseja realmente excluir o programa: <?= html_escape($programa['nome_programa']) ?> ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <?= anchor('Admin_auth/function_deletprograma/' . $programa['id_programa'], "Excluir", array(
                                    "role" => "button",
                                    "class" => "btn btn-danger"
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>


                </tr>
            <?php endforeach ?>
    </table>
</div>