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