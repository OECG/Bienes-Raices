<?php  

    require 'includes/app.php';

    // Conectar a la BD
    $DB = conectarDB();

    /** Autenticar Usuario **/

    $errores = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST"){        
        // echo'<pre>';
        // var_dump($_POST);
        // echo'</pre>';
        
        // $email = filter_var(mysqli_real_escape_string($DB, $_POST['email']), FILTER_VALIDATE_EMAIL);
        $email = mysqli_real_escape_string($DB, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($DB, $_POST['password']);

        if(!$email){
            $errores[] = "La correo es obligatorio.";
        }

        if(!$password){
            $errores[] = "El password es obligatorio.";
        }

        if(empty($errores)){
            
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $query_result = mysqli_query($DB,$query);

            if ($query_result->num_rows) {
                // Revisar si el password es correcto 
                $usuario = mysqli_fetch_assoc($query_result);   // var_dump($usuario);

                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if($auth){
                    // El usuario esta autenticado
                    session_start();

                    // Llenar el arreglo de la sesion 
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');
                    
                }else{
                    $errores[] = "Introduce una contraseña válida.";
                }

                
            }else{ 
                $errores[] = "Introduce una dirección de correo válida.";
            }
        }
    }


    /** Incluye el Header **/
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
        <div class="alerta rojo">
           <?php echo $error;?>
        </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Usuario y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu E-mail" name="email" id="email">

                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" id="password">

                <label class="label_M-pass">Mostrar Contraseña</label>
                <input class="input_M-pass" type="checkbox">

            </fieldset>
            <input type="submit" class="boton-verde" value="Iniciar Sesión">
        </form>

    </main>

<?php 
    incluirTemplate('footer'); 
?>