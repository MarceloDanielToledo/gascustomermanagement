<?php
    session_start();
    $nombre= $_POST["nombre"];
    $apellido= $_POST["apellido"];
    $dni= $_POST["dni"];
    $contrasenia= $_POST["pass"];
    
    

        $pass_cifrado=password_hash($contrasenia,PASSWORD_DEFAULT);
        if ($_POST['tmptxt'] == $_SESSION['tmptxt']){			
            try{
        
                $base=new PDO('mysql:host=localhost; dbname=final_sv', 'root', '');
                
                $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $base->exec("SET CHARACTER SET utf8");	
                include("conectabdlocal.php");
                if(buscaRepetido($dni,$link)==0){
                    $tipo="cliente";
                    $sql="INSERT INTO usuario (nombre,apellido,dni,pass,tipo) VALUES (:nombre,:apellido,:dni, :pass,:tipo)";
                    
                    $resultado=$base->prepare($sql);		
                    
                    $resultado->execute(array(":nombre"=>$nombre,":apellido"=>$apellido,":dni"=>$dni, ":pass"=>$pass_cifrado,":tipo"=>$tipo));		
    
                    $basecliente=new PDO('mysql:host=localhost; dbname=final_usuario', 'root', '');
                    
                    $basecliente->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $basecliente->exec("SET CHARACTER SET utf8");		
    
                    $sqlcliente="INSERT INTO usuario (nombre,apellido,dni) VALUES (:nombre,:apellido,:dni)";
                    
                    $resultadocliente=$basecliente->prepare($sqlcliente);		
                    
                    $resultadocliente->execute(array(":nombre"=>$nombre,":apellido"=>$apellido,":dni"=>$dni));		                
                                    
                    echo "Registro insertado";
                    header( "refresh:3;url=login.php" ); 
                    
                    $resultado->closeCursor();
                }	
                else{
                    echo "Usuario ya registrado!";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=registro.php" ); 
                }

        
            }catch(Exception $e){			
                
                
                echo "Línea del error: " . $e->getLine();
                
            }finally{
                
                $base=null;
                
                
            }
            }
            else{
                echo "captcha incorrecto!";
                echo "<br>";
                echo "Redireccionando..";
                header( "refresh:3;url=registro.php" ); 
            }

    function buscaRepetido($dni,$conexion){
        $sql="SELECT * FROM usuario WHERE dni = $dni";
        $result=mysqli_query($conexion,$sql);
        if(mysqli_num_rows($result) > 0){
            return 1;   // Repetido
        }
        else{
            return 0;   // No repetido
        }

    }


?>