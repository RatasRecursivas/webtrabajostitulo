<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Trabajos de titulo | <?php echo $title; ?></title>
        <link rel="stylesheet"
              href="http://foundation.zurb.com/assets/css/templates/foundation.css">
        <script
        src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.1.js"></script>
    
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

                <!-- End Navigation -->

            </div>
        </div>
