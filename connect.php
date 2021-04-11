<?php
  try
  {

    //Connect to the localhost
    $dsn = 'mysql:host=localhost;
            port=3308;
            dbname=comp1006_winter2021;
            charset=utf8;'; 
    $username = 'root';
    $password = '';

    /*
    //Connect to the Lamp Server
    $dsn = 'mysql:host=172.31.22.43;
            dbname=Yuriko200448500'; 
    $username = 'Yuriko200448500'; 
    $password = 'foJpzK_3NG';
    */


    $dbo = new PDO($dsn, $username, $password);    

    // This attribute ensures that any SQL errors are reported
    $dbo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } 
  catch (PDOException $e) 
  {
    echo "<p>Failed to connect to the database.</p>";
    echo $e->getMessage();
    // exit();
  }
?>