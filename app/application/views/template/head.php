<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Trabajos de titulo | <?php echo $title; ?></title>
        <link rel="stylesheet" href="<?= base_url() . '/css/foundation.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . '/css/main.css'; ?>">
        <script src="<?= base_url() . '/js/modernizr.js';?>"></script>
        <link rel="stylesheet" href="<?= base_url() . '/css/pickadate/classic.css'; ?>" id="theme_base">
        <link rel="stylesheet" href="<?= base_url() . '/css/pickadate/classic.date.css'; ?>" id="theme_date">
        <link rel="stylesheet" href="<?= base_url() . '/css/pickadate/classic.time.css'; ?>" id="theme_time">
        <meta charset="utf-8" />
    </head>
    <body>
        <div class="row">
            <div class="large-12 columns">
                <!-- Navigation -->
                <nav class="top-bar" data-topbar>
                    <ul class="title-area">
                        <!-- Title Area -->
                        <li class="name">
                            <h1>
                                <a href="<?php echo base_url(); ?>tesis">Trabajos de Titulacion</a>
                            </h1>
                        </li>
                        <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
                    </ul>

                    <section class="top-bar-section">
                        <ul class="left">
                            <li><a href="<?php base_url(); ?>tesis/agregar">Agregar</a></li>
                        </ul>

                        <ul class="right">
                            <li class="search">
                                <form>
                                    <input type="search">
                                </form>
                            </li>

                            <li class="has-button"><a class="small button" href="#">Search</a>
                            </li>
                        </ul>
                    </section>
                </nav>
            </div>
        </div>
        <?php if ($this->ion_auth->is_admin()): ?>
            <div class="row">
                <div class="small-6 columns right panel callout">
                    <nav class="user-bar right">
                        <p>Hola <?= $this->ion_auth->user()->row()->username; ?>
                            <?= anchor('#', 'Logout', array('data-dropdown' => 'drop', 'class' => 'tiny secondary button dropdown')); ?>
                        <ul id="drop" data-dropdown-content class="f-dropdown">
                            <li><?= anchor('/account/cambiar_password', 'Cambiar password'); ?></li>
                            <li><?= anchor('/account/logout', 'Logout'); ?></li>
                        </ul>
                        </p>
                    </nav>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($msg) and $msg): ?>
            <div class="row">
                <div class="large-12 columns large-centered">
                    <div class="small-6">
                        <div data-alert class="alert-box info radius">
                            <?= $msg; ?>
                            <a href="#" class="close">&times;</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>