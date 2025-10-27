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
    $query = "SELECT * FROM recetas ORDER BY id_receta DESC";
    $result = pg_query($connection, $query);

    if ($result && pg_num_rows($result) > 0) {
        while ($row = pg_fetch_assoc($result)) {
            echo "<div class='receta-item'>";
            echo "<h3>" . htmlspecialchars($row['nombre']) . "</h3>";
            echo "<p><strong>Tipo:</strong> " . htmlspecialchars($row['tipo']) . "</p>";
            echo "<p><strong>Tiempo:</strong> " . htmlspecialchars($row['tiempo']) . " min</p>";
            echo "<p><strong>Dificultad:</strong> " . htmlspecialchars($row['dificultad']) . "</p>";
            echo "<p><strong>Ingredientes:</strong> " . nl2br(htmlspecialchars($row['ingredientes'])) . "</p>";
            echo "<p><strong>Instrucciones:</strong> " . nl2br(htmlspecialchars($row['instrucciones'])) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No se pudieron cargar las recetas :( </p>";
    } 

    pg_close($connection);
?>
