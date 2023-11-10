<?php declare(strict_types=1);
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor contenido-centrado">
  <h1>Nuestro blog</h1>

  <article class="entrada-blog">
    <div class="imagen">
      <picture>
        <source srcset="build/img/blog1.webp" type="image/webp" />
        <img loading="lazy" width="200" height="300" src="build/img/blog1.jpg" alt="Imagen entrada blog" />
      </picture>
    </div>

    <div class="texto-entrada">
      <a href="/entrada.html">
        <h4>Terraza en el techo de tu casa</h4>
        <p>Esctito el: <span>20-10-2022</span> por: <span>Admin</span></p>
        <p>
          Consejos para construir una casa con los mejores materiales y
          ahorrando dinero.
        </p>
      </a>
    </div>
  </article>

  <article class="entrada-blog">
    <div class="imagen">
      <picture>
        <source srcset="build/img/blog2.webp" type="image/webp" />
        <img loading="lazy" width="200" height="300" src="build/img/blog2.jpg" alt="Imagen entrada blog" />
      </picture>
    </div>

    <div class="texto-entrada">
      <a href="/entrada.html">
        <h4>Guía para la decoración de tu hogar</h4>
        <p>Esctito el: <span>12-08-2023</span> por: <span>Admin</span></p>
        <p>
          Maximiza el espacio en tu hogar con esta guía, aprende a
          combinar muebles y colores para darle vida a tu espacio.
        </p>
      </a>
    </div>
  </article>

  <article class="entrada-blog">
    <div class="imagen">
      <picture>
        <source srcset="build/img/blog3.webp" type="image/webp" />
        <img loading="lazy" width="200" height="300" src="build/img/blog3.jpg" alt="Imagen entrada blog" />
      </picture>
    </div>

    <div class="texto-entrada">
      <a href="/entrada.html">
        <h4>Guía para la decoración de tu hogar</h4>
        <p>Esctito el: <span>08-07-2023</span> por: <span>Álvaro</span></p>
        <p>
          Maximiza el espacio en tu hogar con esta guía, aprende a
          combinar muebles y colores para darle vida a tu espacio.
        </p>
      </a>
    </div>
  </article>

  <article class="entrada-blog">
    <div class="imagen">
      <picture>
        <source srcset="build/img/blog4.webp" type="image/webp" />
        <img loading="lazy" width="200" height="300" src="build/img/blog4 .jpg" alt="Imagen entrada blog" />
      </picture>
    </div>

    <div class="texto-entrada">
      <a href="/entrada.html">
        <h4>Guía para la decoración de tu habitación</h4>
        <p>Esctito el: <span>12-08-2023</span> por: <span>Admin</span></p>
        <p>
          Maximiza el espacio en tu hogar con esta guía, aprende a
          combinar muebles y colores para darle vida a tu espacio.
        </p>
      </a>
    </div>
  </article>
</main>

<?php
incluirTemplate('footer');
?>