<?php declare(strict_types=1);
require 'includes/app.php';
incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
  <h1>Consejos para tener una piscina en casa sin gastar demasiado</h1>
  <picture>
    <source srcset="build/img/destacada2.webp" type="image/webp" />
    <source srcset="build/img/destacada2.jpg" type="image/jpg" />
    <img loading="lazy" width="200" height="300" src="build/img/destacada2.jpg" alt="Casa con piscina" />
  </picture>

  <div class="texto-entrada">
    <p>Esctito el: <span>12-08-2023</span> por: <span>Admin</span></p>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo
      ratione alias quibusdam doloribus. Odit, laudantium dolore autem a
      placeat quo sapiente exercitationem quod, blanditiis tenetur ipsa odio
      minus animi eveniet. Necessitatibus repudiandae odio in porro ab
      voluptas beatae ipsam aperiam provident libero consequuntur ipsa,
      magni sed excepturi iusto doloribus accusantium temporibus
      reprehenderit illum molestias rem itaque! Repellat iste earum dolorem!
    </p>
    <p>
      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam
      facere harum possimus tempore ex, ea consequatur maiores, ratione
      ipsa, sapiente sunt qui laborum voluptates fugiat asperiores nihil.
      Harum, reprehenderit possimus.
    </p>
  </div>
</main>

<?php
incluirTemplate('footer');
?>