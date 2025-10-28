<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD recetario</title>
    <link rel="stylesheet" href="public/css/estilo.css">
</head>
<body>
    
    <div class="container">
        <h2>¡Mira y guarda todas tus recetas favoritas!</h2>
        <button id="btn_agregar" onclick="abrirFormulario()">+ Nueva receta</button>

        <br></br>
        <h2>Listado de recetas</h2>

        <?php
            include "crud.php";
        ?>

    </div>

    <div id="modalReceta" class="modal">
        <div class="modal-content">
            <span class="cerrar">&times;</span>
            <h2 id="tituloReceta"></h2>
            <p><strong>Tipo:</strong> <span id="tipoReceta"></span></p>
            <p><strong>Tiempo:</strong> <span id="tiempoReceta"></span></p>
            <p><strong>Dificultad:</strong> <span id="dificultadReceta"></span></p>
            <p><strong>Ingredientes:</strong></p>
            <p id="ingredientesReceta"></p>
            <p><strong>Instrucciones:</strong></p>
            <p id="instruccionesReceta"></p>
        </div>
        </div>


        <div id="modalFormulario" class="modal">
            <div class="modal-content">
                <span class="cerrarFormulario">&times;</span>
                <h2>Añade una nueva receta</h2>

                <form method="post" action="index.php" id="formReceta">

                    <label for ="nombre">Nombre:</label>
                    <input type="text" name="nombre" placeholder="Ej: Pastel de tres leches." required>

                    <label for="ingredientes">Ingredientes:</label>
                    <textarea name="ingredientes" rows="4" placeholder="Ej: 2 huevos, 1 taza de harina, 1/2 taza de leche..." required></textarea>

                    <label for="instrucciones">Instrucciones:</label>
                    <textarea name="instrucciones" rows="5" placeholder="Describe paso a paso cómo preparar la receta..." required></textarea>

                    <label for="tipo">Tipo de receta:</label>
                    <select id="tipo" name="tipo" class="form-control">
                        <option selected></option>
                        <option>Desayuno</option>
                        <option>Almuerzo</option>
                        <option>Cena</option>
                        <option>Postre</option>
                        <option>Snack</option>
                    </select>

                    <label for="tiempo">Tiempo de preparación:</label>
                    <input id="tiempo" type="number" name="tiempo" placeholder="En minutos" min="1" step="1" required>

                    <label for="dificultad">Dificultad:</label>
                    <select id="dificutad" name="dificultad" class="form-control">
                        <option selected></option>
                        <option>Facil</option>
                        <option>Intermedio</option>
                        <option>Dificil</option>
                    </select>

                    <?php if (isset($id_actualizar)) : ?>
                        <button type="submit" name="actualizar">atualizar</button>
                        <?php else : ?>

                    <button type="submit" name="crear">Crear</button>

                    <?php endif; ?>
                </form>
            </div>
        </div>

    <script>
    function mostrarReceta(nombre, ingredientes, instrucciones, tipo, tiempo, dificultad) {
    document.getElementById("tituloReceta").textContent = nombre;
    document.getElementById("ingredientesReceta").textContent = ingredientes;
    document.getElementById("instruccionesReceta").textContent = instrucciones;
    document.getElementById("tipoReceta").textContent = tipo;
    document.getElementById("tiempoReceta").textContent = tiempo + " minutos";
    document.getElementById("dificultadReceta").textContent = dificultad;

    document.getElementById("modalReceta").style.display = "block";
    }

    document.querySelector(".cerrar").onclick = function() {
    document.getElementById("modalReceta").style.display = "none";
    };

    window.onclick = function(event) {
    const modal = document.getElementById("modalReceta");
    if (event.target === modal) {
        modal.style.display = "none";
    }
    };

    function abrirFormulario() {
    document.getElementById("modalFormulario").style.display = "block";
    }

    document.querySelector(".cerrarFormulario").onclick = function() {
    document.getElementById("modalFormulario").style.display = "none";
    };

    </script>


</body>
</html>