<?php
session_start();
if ($_SESSION['ult_actividad'] < time() - $_SESSION['expira']) {
    session_unset();    
    session_destroy();
} else {
    $_SESSION['ult_actividad'] = time(); //SETEAMOS NUEVO TIEMPO DE ACTIVIDAD
    $db = mysqli_connect('localhost', 'admin', 'test', 'medicina');
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
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/openai"></script>
    <title>Sistema de Autodiagnóstico de Síntomas</title>
</head>
<body>
    <header>
        <h1>Sistema de Autodiagnóstico de Síntomas</h1>
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
    <footer>
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>
    </footer>

    <script>
        function realizarDiagnostico() {
            // Mostrar spinner
            const spinner = document.querySelector(".loading-spinner");
            spinner.style.display = "block";

            const apiKey = "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";
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
</body>
</html>