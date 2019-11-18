<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
$this->output->set_header('Cache-Control:  no-cache, must-revalidate, post-check=0, pre-check=0');
$this->output->set_header('Pragma: no-cache');
$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>

<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <meta name="description" content="<?= $description ?>">
    <title><?= $title ?></title>
    <!-- FAVICON MUITO TOP  realfavicongenerator.net -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('assets/favicon') ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon') ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon') ?>/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url('assets/favicon') ?>/site.webmanifest">
    <link rel="mask-icon" href="<?= base_url('assets/favicon') ?>/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">

    <script defer src="<?= base_url('assets/fontawesome/js/all.js') ?>"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="<?= base_url() ?>"><img class="navbar-brand" src="<?= base_url('assets/img/GRUPO_MAIS.png') ?>" alt=""></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('/admin') ?>">Home</a>
                </li>

                <?php if ($this->session->userdata("usuario_logado")) : ?>
                    <?php
                        $acesso = $this->session->userdata("usuario_logado")['nivel_acesso_id_nivel_acesso'];
                        $nivel = $this->Auth_model->buscaAcesso($acesso);
                        ?>

                    <!-- <?php if (verificaniveldeacesso($nivel, "Admin")) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownmerchan" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dashboard
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownmerchan">
                                <a class="dropdown-item" href="<?= base_url() ?>">Lorem</a>
                            </div>
                        </li>
                    <?php endif; ?> -->

                    <?php if (verificaniveldeacesso($nivel, "Admin_usuarios")) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownmerchan" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Usuários
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownmerchan">
                                <a class="dropdown-item" href="<?= base_url('Admin_usuarios/listaUsuarios') ?>">Usuários</a>
                            </div>
                        </li>
                    <?php endif; ?>

                    <?php if (verificaniveldeacesso($nivel, "Admin_sistemas")) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownmerchan" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sistemas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownmerchan">
                                <a class="dropdown-item" href="<?= base_url('Admin_sistemas/listaSistemas') ?>">Sistemas</a>
                                <a class="dropdown-item" href="<?= base_url('Admin_sistemas/novoSistema') ?>">Novo Sistema</a>
                            </div>
                        </li>
                    <?php endif; ?>

                    <?php if (verificaniveldeacesso($nivel, "Admin_pessoa")) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCarrousel" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pessoas Admin
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownCarrousel">
                                <a class="dropdown-item" href="<?= base_url("Admin_pessoa/listapessoa") ?>">Pessoas</a>
                                <a class="dropdown-item" href="<?= base_url("Admin_pessoa/novapessoa") ?>">Nova Pessoa</a>
                            </div>
                        </li>
                    <?php endif; ?>

                    <?php if (verificaniveldeacesso($nivel, "Admin_auth")) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Admin
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                                <a class="dropdown-item" href="<?= base_url("Admin_auth/listaprogramas") ?>">Programas</a>
                                <a class="dropdown-item" href="<?= base_url("Admin_auth/novoprograma") ?>">Novo Programa</a>
                                <a class="dropdown-item" href="<?= base_url("Admin_auth/listanivel_acessos") ?>">Níveis de acesso</a>
                                <a class="dropdown-item" href="<?= base_url("Admin_auth/novonivel_acesso") ?>">Novo Nível de acesso</a>
                                <a class="dropdown-item" href="<?= base_url("Admin_auth/listanivel_acesso_programas") ?>">Programas por níveis de acesso</a>
                                <a class="dropdown-item" href="<?= base_url("Admin_auth/novonivel_acesso_programa") ?>">Cadastro de programa em nível de acesso</a>
                            </div>
                        </li>
                    <?php endif; ?>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="<?= base_url('login/logout') ?>">Sair</a>
                </li>
            </ul>
        <?php endif; ?>

        </div>
    </nav>

    <?php if ($this->session->flashdata("alert")) : ?>
        <?php
            $data = $this->session->flashdata("alert");
            $this->load->alert($data['tipo'], $data['strongMsg'], $data['msg']);
            ?>
    <?php endif ?>

    <main>