<?php
    session_start(); 

    $connection=pg_connect("host=localhost port=5432 user=postgres password=3312 dbname=CRUD");
    if (!$connection){
        die("Error de conexion a la base de datos");
    }

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

    pg_close($connection);
?>
