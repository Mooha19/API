<?php
session_start();
if ($_SESSION['ult_actividad'] < time() - $_SESSION['expira']) {
    session_unset();    
    session_destroy();
    header('location: ../index.php');
} else {
    $_SESSION['ult_actividad'] = time(); 
    $db = mysqli_connect('localhost', 'root', '', 'osakidetza');
    $user = $_SESSION['user'];
    $user_check_query = "SELECT * FROM usuario WHERE tarjeta = '$user';";
    $res = mysqli_query($db, $user_check_query);
    $usuario = mysqli_fetch_assoc($res);   
    
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/second.css'>
    <script src="https://cdn.jsdelivr.net/npm/openai"></script>
    <title>Sistema de Autodiagnóstico de Síntomas</title>
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #fff;;
            color: #333;
        }

        
        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #3498db;
        }

       
        .symptom-input {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        textarea {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .loading-spinner {
            display: none;
            margin-top: 10px;
        }

        
        .diagnosis {
            margin-top: 20px;
        }

        
       
    </style>
</head>
<body>
<div class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container-fluid">
                <img  src="../img/logo.png">
                <a class="navbar-brand" href="#">Osakidetza</a> 
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navi" aria-control="navi" 
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <img  src="../img/DS.png">
                <div class="collapse navbar-collapse" id="navi">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Inicio</a>               

                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Edición para Ciudadanos </a>              

                        </li>
                      
                    </ul>              
                    <button onclick="location.href='../server/cerrar.php'" type="button" class="btn btn-outline-dark me-2">Cerrar Sesión</button>
                   
                    <button onclick="location.href='cambiar_contrasena.php'" type="button" class="btn btn-dark">Cambiar Contraseña</button>
                   
                </div>
            </div>
        </nav>
    </div>    
    <header>
        <h1>     Autodiagnóstico de Síntomas</h1>
    </header>
    <main>
        <section class="symptom-input">
            <h2>Ingrese sus síntomas:</h2>
            <form id="symptom-form">
                <label for="symptoms">Síntomas:</label>
                <textarea id="symptoms" name="symptoms" rows="4" cols="50" required></textarea>
                <button type="button" onclick="realizarDiagnostico()">Autodiagnosticar</button>
                <div class="loading-spinner"></div>
            </form>
        </section>
        <section class="diagnosis">
            <h2>Diagnóstico:</h2>
            <div id="diagnosis-result"></div>
        </section>
    </main>
    

    <script>
        function realizarDiagnostico() {
            // Mostrar spinner
            const spinner = document.querySelector(".loading-spinner");
            spinner.style.display = "block";

            const apiKey = "";
            const symptoms = document.getElementById("symptoms").value;

            // Configurar la solicitud a la API de ChatGPT
            fetch("https://api.openai.com/v1/chat/completions", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${apiKey}`,
                },
                body: JSON.stringify({
                    model: "gpt-4",
                    messages: [
                        { role: "system", content: "El médico está solicitando un diagnóstico en respuesta corta. Formato: Posible diagnóstico: RESPUESTA" },
                        { role: "user", content: symptoms },
                    ],
                }),
            })
            .then((response) => response.json())
            .then((data) => {
                const diagnosisResult = data.choices[0].message.content;
                document.getElementById("diagnosis-result").innerText = diagnosisResult;

                // Verificar si la respuesta contiene "COVID-19"
                if (/COVID-19/i.test(diagnosisResult)) {
                    setTimeout(function () {
                        // Mostrar la ventana emergente
                        alert("¡Se ha detectado COVID-19! Antes de comunicarse con su médico, se recomienda que realice un test de antígenos.");
                    }, 1000);
                }
                fetch('server/insertarautodiagnostico.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `symptoms=${encodeURIComponent(symptoms)}&result=${encodeURIComponent(diagnosisResult)}&colegiado=${encodeURIComponent('<?php echo $usuario['cabecera']; ?>')}&tarjeta=${encodeURIComponent('<?php echo $user; ?>')}`,
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Datos guardados en la base de datos:', data);
                })
                .catch(error => console.error('Error al guardar datos en la base de datos:', error));


            })
            .catch((error) => {
                console.error("Error al comunicarse con la API de ChatGPT:", error);
            })
            .finally(() => {
                //ocultar spinner
                spinner.style.display = "none";
            });

        }
    </script>
    <div class="contenedorRegistro margenVolver">
        <a class="textLinks" href="usuario.php"> < Volver atrás</a>
    </div>
    <footer class="modal-footer">
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>
    </footer>
</body>
</html>