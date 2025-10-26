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
        <form method="post" action="crud.php" enctype="multipart/form-data">

            <h2>¡Añade una nueva receta!</h2>

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

            <label for="imagen">Puedes subir una imagen de tu receta aquí:</label>
            <input type="file" name="imagen" accept="image/*">

            <button type="submit" name="crear">Crear</button>

        </form>

        <br></br>
        <h2>Listado de recetas</h2>
        <ul class="user-list">

        <?php

        ?>

    </div>

</body>
</html>