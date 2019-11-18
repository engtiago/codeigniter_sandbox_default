<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="pg-admin">
    <div class="container">
        <h2 class="mt-5">Dashboard</h2>

        <div class="row mt-5">

            <div class="col-md-12 col-lg-6 col-xl-4 mt-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="bg-white text-dark"><i class="fas fa-users"></i>  Usuários Contratados </h5>
                        <p class="card-text">Usuários contratados com sistemas</p>  
                        <h2 class="card-text"><?=$QuantidaDeUsuariosProgramasContrados?></h2>  
                        <a href="<?= base_url('Admin_usuarios/listaUsuarios') ?>" class="btn btn-primary btn-lg btn-block">Ver</a>
                    </div>
                </div>
            </div>
        
            <div class="col-md-12 col-lg-6 col-xl-4 mt-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="bg-white text-dark"><i class="fas fa-user-times"></i>  Usuários Demitidos</h5>
                        <p class="card-text">Usuários demitidos com sistemas</p>  
                        <h2 class="card-text"><?=$QuantidaDeUsuariosProgramasDemitidos?></h2>  
                        <a href="<?= base_url('Admin_usuarios/listaUsuarios/sistemas_id_sistemas/all/0/all/all/all/1900-01-01/3000-12-31') ?>" class="btn btn-danger btn-lg btn-block">Ver</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6 col-xl-4 mt-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="bg-white text-dark"><i class="fas fa-laptop-code"></i>  Quantidade de Programas</h5>
                        <p class="card-text">Todos os programas cadastrados</p>  
                        <h2 class="card-text"><?=$QuantidadeDeSistemas?></h2>  
                        <a href="<?= base_url('Admin_sistemas/listaSistemas') ?>" class="btn btn-secondary btn-lg btn-block">Ver</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>