<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/tic-final/model/Producto.php');

class ProductosDAO {

    public static function ObtenerPorID($id)
    {
      try
      {
          $conn = new PDO("mysql:host=127.0.0.1;port=3306;dbname=tp-final", "root", "root");
          $sql = "SELECT * FROM Productos WHERE id = ".$id.";";
          $STH = $conn->prepare($sql);
          $STH->setFetchMode(PDO::FETCH_ASSOC);
          $STH->execute();
          $Producto = array();

          if ($STH->rowCount() > 0) {
              //RECORRO CADA FILA
              while($row = $STH->fetch()) {

                  $cat = new Producto();
                  $cat->id =$row['id'];
                  $cat->nombre = $row['nombre'];
                  $cat->idCategoria = $row["idCategoria"];
                  $cat->precio = $row["precio"];
                  $cat->codigo = $row["codigo"];
                  $cat->descripcion = $row["descripcion"];
                  $cat->destacado = $row["destacado"];
                  array_push($Producto, $cat);
              }
          }
          return $Producto;
      }
      catch(PDOException $e)
      {
           echo $sql . "<br>" . $e->getMessage();
      }
    }// get

    public static function ObtenerTodos()
    {
      try
      {
          $conn = new PDO("mysql:host=127.0.0.1;port=3306;dbname=tp-final", "root", "root");
          $query = "SELECT * from Productos";

          $Productos = array();

          $STH = $conn->prepare($query);
          $STH->setFetchMode(PDO::FETCH_ASSOC);

          $STH->execute();

          if ($STH->rowCount() > 0) {
              //RECORRO CADA FILA
              while($row = $STH->fetch()) {

                  $cat = new Producto();
                  $cat->id =$row['id'];
                  $cat->nombre = $row['nombre'];
                  $cat->idCategoria = $row["idCategoria"];
                  $cat->precio = $row["precio"];
                  $cat->codigo = $row["codigo"];
                  $cat->descripcion = $row["descripcion"];
                  $cat->destacado = $row["destacado"];

                  array_push($Productos, $cat);
              }
          }


          $conn=null;
          return $Productos;
      }
      catch(PDOException $e)
      {
           echo $sql . "<br>" . $e->getMessage();
      }
    }

    public static function agregar($item)
    {
      try
      {
        $conn = new PDO("mysql:host=127.0.0.1;port=3306;dbname=tp-final", "root", "root");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO Productos (nombre, idCategoria, codigo, precio, destacado, descripcion) VALUES ('" . $item->nombre . "', " . $item->idCategoria . ", '" . $item->codigo . "', " . $item->precio . ", " . $item->destacado . ", '" .$item->descripcion . "');";
        $conn->exec($sql);
        header("Location: ./index.php");
      }
      catch(PDOException $e)
      {
        echo $sql . "<br>" . $e->getMessage();
      }
    }// nuevo

    public static function modificar($item)
    {
      try
      {
        echo "hola";
        $conn = new PDO("mysql:host=127.0.0.1;port=3306;dbname=tp-final", "root", "root");
        echo "como";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "andas";
        $sql = "UPDATE Productos SET idCategoria = '".$item->idCategoria."', codigo = '".$item->codigo."', nombre = '".$item->nombre."', precio = '".$item->precio."', destacado = '".$item->destacado."', descripcion = '".$item->descripcion."' WHERE id = ".$item->id.";";
        echo "?";
        $conn->exec($sql);
        echo "bien";
        header("Location: ./index.php");
      }
      catch(PDOException $e)
      {
        echo $sql . "<br>" . $e->getMessage();
      }

    }// modificar

    public static function eliminar($id)
    {
      try
      {
        $conn = new PDO("mysql:host=127.0.0.1;port=3306;dbname=tp-final", "root", "root");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Productos WHERE id = ".$id.";";

        $conn->exec($sql);
      }
      catch(PDOException $e)
      {
           //echo $sql . "<br>" . $e->getMessage();
      }
    }// eliminar

}

?>
