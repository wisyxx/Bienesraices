<?php

// Importar conexión
require './includes/config/database.php';
$db = conectarDB();

// Consulta
$queryPropiedades = "SELECT * FROM propiedades LIMIT $limit;";

// Resultado
$resultadoPropiedades = mysqli_query($db, $queryPropiedades);

?>

<div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resultadoPropiedades)) : ?>
        <div class="anuncio">
            <picture>
                <source srcset="<?php echo './imagenes/' . $propiedad['imagen']; ?>" type="image/jpg" />
                <img loading="lazy" width="200" height="300" src="<?php echo $propiedad['imagen']; ?>" alt="Imagen anuncio vivienda" />
            </picture>

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['titulo']; ?></h3>
                <p><?php echo $propiedad['descripcion']; ?></p>

                <p class="precio"><?php echo '$' . $propiedad['precio']; ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC" />
                        <p><?php echo $propiedad['wc']; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" />
                        <p><?php echo $propiedad['garages']; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio" />
                        <p><?php echo $propiedad['habitaciones']; ?></p>
                    </li>
                </ul>
                <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton boton-amarillo">Ver Propiedad</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>