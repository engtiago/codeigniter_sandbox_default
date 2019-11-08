<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div style="mt-4;" class="container">

    <h2 class="my-3">
        Arquivo para download
    </h2>

    <div align="center" class="container">
        <img src=" <?= base_url("upload/download/minhatura/{$arquivo['minhatura_download_arquivo']}") ?>" alt="..." style="
                max-width: 350px;
                max-height: 350px;
                margin: 25px;
                border-style: dashed;
                border-color: #dc3545;
        ">
    </div>

    <table class="table">
        <thead>
            <tr class="thead-dark">
                <th scope="col">Dados:</th>
                <th scope="col">Arquivo:</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>Titulo:</td>
                <td><?= $arquivo['titulo_download_arquivo'] ?></td>
            </tr>

            <tr>
                <td>Categoria:</td>
                <td><?= $arquivo['categoria_download_arquivo'] ?></td>
            </tr>

            <tr>
                <td>Descrição:</td>
                <td><?= $arquivo['descricao_download_arquivo'] ?></td>
            </tr>

            <tr>
                <td>Status:</td>
                <td><?= $arquivo['status_download_arquivo'] ?></td>
            </tr>

            <tr>
                <td>Download Arquivo:</td>
                <td> <?= anchor(base_url("upload/download/arquivo/{$arquivo['arquivo_download_arquivo']}"), "Download", array(
                            "role" => "button",
                            "class" => "btn btn-primary",
                            "download" => $arquivo['titulo_download_arquivo']
                        )); ?>
                </td>
            </tr>



        </tbody>
    </table>



</div>