function mostrarCampos() {
    var tipoCita = document.getElementById("tipocita").value;
    var medicDiv = document.getElementById("c2");   
    var enfermeroDiv = document.getElementById("c3");
    var EnferColDiv= document.getElementById("c4");

    medicDiv.classList.add("hidden");
    enfermeroDiv.classList.add("hidden");
    EnferColDiv.classList.add("hidden");

    
    if (tipoCita === "Consulta presencial" || tipoCita === "Consulta telefónica") {
        medicDiv.classList.remove("hidden");
    } else if (tipoCita === "Vacunas" || tipoCita === "Curaciones" || tipoCita === "Análisis") {
        enfermeroDiv.classList.remove("hidden");
    } 
}
