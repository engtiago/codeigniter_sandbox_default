<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- //var_dump($categoriaReceita); exit;  -->
<div class="container my-5">
    <h2 class="my-4">Lista de Níveis de Acesso aos Programas</h2>
    <?php foreach ($nivel_acesso_programas as $key => $nivel_acesso_programas) : ?>
        <table class="table table-striped">
            <thead>
                <h4><?= html_escape($nivel_acesso_programas["NivelAcesso"]) ?>:</h4>
                <tr>
                    <th>Programas</td>
                    <th>Editar</td>
                    <th>Excluir</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nivel_acesso_programas['Programa'] as $id => $programa) : ?>
                    <tr>
                        <td> <?= html_escape($programa); ?></td>
                        <td> <?= anchor("Admin_auth/vereditnivel_acesso_programa/{$id}", "Editar", array(
                                    "role" => "button",
                                    "class" => "btn btn-primary"
                                )); ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal<?=$id?>">Excluir</button>
                        </td>

                    </tr>

                    <div class="modal fade" id="modal<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Excluir</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Você deseja realmente excluir o programa <b><?= html_escape($programa)?></b> deste nível de acesso?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <?= anchor("Admin_auth/function_deletnivel_acesso_programa/{$id}", "Excluir", array(
                                        "role" => "button",
                                        "class" => "btn btn-danger"
                                    )); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
        </table>
    <?php endforeach ?>
</div>