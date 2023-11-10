<?php

declare(strict_types=1);
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h2>Casas y Departamentos en venta</h2>

  <section class="seccion contenedor">
    <?php 
    
      $limit = 100;
      include './includes/templates/anuncios.php' 
    
    ?>
  </section>

</main>

<?php
incluirTemplate('footer');
?>