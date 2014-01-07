<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Trabajos de titulo | <?php echo $title; ?></title>
        <link rel="stylesheet" href="<?= base_url() . '/css/foundation.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . '/css/main.css'; ?>">
        <script src="<?= base_url() . '/js/modernizr.js'; ?>"></script>
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
                                <a href="<?php echo site_url(); ?>">Trabajos de Titulacion</a>
                            </h1>
                        </li>
                    </ul>
                    <ul id="otros_drop" class="tiny f-dropdown" data-dropdown-content>
                        <li><?= anchor('/carrera', 'Carreras'); ?></li>
                        <li><?= anchor('/categoria', 'Categorias'); ?></li>
                        <li><?= anchor('/facultad', 'Facultades'); ?></li>
                    </ul>
                    <ul id="account_drop" class="tiny f-dropdown" data-dropdown-content>
                        <li><?= anchor('/account/cambiar_password', 'Cambiar password'); ?></li>
                        <li><?= anchor('/account/logout', 'Logout'); ?></li>
                    </ul>
                    <section class="top-bar-section">
                        <ul class="left">
                            <li><?= anchor('/tesis', 'Home'); ?></li>
                            <?php if ($this->ion_auth->is_admin()): ?>
                                <li><?= anchor('/estudiante', 'Estudiantes'); ?></li>
                                <li><?= anchor('/profesor', 'Profesores'); ?></li>
                                <li><?= anchor('#', 'Otros &raquo;', array('data-options' => 'is_hover:true', 'data-dropdown' => 'otros_drop')); ?></li>

                            <?php endif; ?>
                        </ul>
                        <?php if ($this->ion_auth->is_admin()): ?>
                            <ul class="right">
                                <li><?= anchor('#', $this->ion_auth->user()->row()->username . ' &raquo;', array('data-options' => 'is_hover:true', 'data-dropdown' => 'account_drop')); ?></li>

                            </ul>
                        <?php endif; ?>
                    </section>
                </nav>
            </div>
        </div>

        <?php if (isset($msg) and $msg): ?>
            <div class="row">
                <div class="small-8 columns large-centered">
                    <div class="small-6">
                        <div data-alert class="alert-box info radius">
                            <?= $msg; ?>
                            <a href="#" class="close">&times;</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>