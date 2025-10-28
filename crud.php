<?php
    session_start(); 

    $connection=pg_connect("host=localhost port=5432 user=postgres password=3312 dbname=CRUD");
    if (!$connection){
        die("Error de conexion a la base de datos");
    }

    //create
    if (isset($_POST['crear'])){

        $nombre = $_POST['nombre'];
        $ingredientes = $_POST['ingredientes'];
        $instrucciones = $_POST['instrucciones'];
        $tipo = $_POST['tipo'];
        $tiempo = $_POST['tiempo'];
        $dificultad = $_POST['dificultad'];


        $query = "insert into recetas (nombre, ingredientes, instrucciones, tipo, tiempo, dificultad) values($1, $2, $3, $4, $5, $6)";
        $prepare = pg_prepare($connection, "insert_receta", $query);
        $result = pg_execute($connection, "insert_receta", [$nombre, $ingredientes, $instrucciones, $tipo, $tiempo, $dificultad]);

        if($result){
            echo "<script>
                    alert('¡Listo! Tu receta se guardo correctamente :)'); 
                    window.location.href='index.php';
                </script>";
        }else{
            echo "<script>
                    alert('Hubo un error al guardar tu receta :( lo siento');
                    window.location.href='login.html';
                </script>";
        }
    }

    //read
    $query = "SELECT id_receta, nombre, tipo, dificultad, tiempo, ingredientes, instrucciones FROM recetas ORDER BY id_receta DESC";
    $result = pg_query($connection, $query);

    if ($result && pg_num_rows($result) > 0) {

        echo "<table class='tabla-recetas'>";
        echo "<tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Tiempo</th>
                <th>Dificultad</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>";

        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tiempo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dificultad']) . "</td>";
            //boton para ver la receta completa
            echo "<td>
                <button class='btn-ver' 
                    onclick='mostrarReceta(
                        " . json_encode($row['nombre']) . ",
                        " . json_encode($row['ingredientes']) . ",
                        " . json_encode($row['instrucciones']) . ",
                        " . json_encode($row['tipo']) . ",
                        " . json_encode($row['tiempo']) . ",
                        " . json_encode($row['dificultad']) . "
                    )'>
                    Ver
                </button>
            </td>";
            //boton de editar
            echo "<td>
                <button class='btn-editar' 
                    onclick='editarReceta(
                        " . json_encode($row['id_receta']) . ",
                        " . json_encode($row['nombre']) . ",
                        " . json_encode($row['ingredientes']) . ",
                        " . json_encode($row['instrucciones']) . ",
                        " . json_encode($row['tipo']) . ",
                        " . json_encode($row['tiempo']) . ",
                        " . json_encode($row['dificultad']) . "
                    )'>
                    Editar
                </button>
            </td>";

            // boton de eliminar
            echo "<td>
                    <form method='POST' action='index.php' onsubmit='return confirm(\"¿Seguro que deseas eliminar esta receta?\");'>
                        <input type='hidden' name='id_receta' value='" . $row['id_receta'] . "'>
                        <button class='btn-eliminar' type='submit' name='eliminar'>Eliminar</button>
                    </form>
                </td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No hay recetas por mostrar </p>";
    }


    //delete
    if (isset($_POST["eliminar"])) {
        $id_eliminar = $_POST["id_receta"];

        $query = "DELETE FROM recetas WHERE id_receta = $1";
        $prepare = pg_prepare($connection, "delete_receta", $query);
        $result = pg_execute($connection, "delete_receta", [$id_eliminar]);

        if ($result) {
            echo "<script>
                    alert('Receta eliminada correctamente');
                    window.location.href='index.php';
                </script>";
        } else {
            echo "<script>
                    alert('Error al eliminar la receta');
                </script>";
        }
    }

    //update
    // update
if (isset($_POST['actualizar'])) {
    $id = $_POST['id_receta'];
    $nombre = $_POST['nombre'];
    $ingredientes = $_POST['ingredientes'];
    $instrucciones = $_POST['instrucciones'];
    $tipo = $_POST['tipo'];
    $tiempo = $_POST['tiempo'];
    $dificultad = $_POST['dificultad'];

    $query = "UPDATE recetas 
              SET nombre=$1, ingredientes=$2, instrucciones=$3, tipo=$4, tiempo=$5, dificultad=$6 
              WHERE id_receta=$7";

    $prepare = pg_prepare($connection, "update_receta", $query);
    $result = pg_execute($connection, "update_receta", [$nombre, $ingredientes, $instrucciones, $tipo, $tiempo, $dificultad, $id]);

    if ($result) {
        echo "<script>
                alert('Receta actualizada correctamente');
                window.location.href='index.php';
            </script>";
    } else {
        echo "<script>
                alert('Error al actualizar la receta');
            </script>";
    }
}

    pg_close($connection);
?>
