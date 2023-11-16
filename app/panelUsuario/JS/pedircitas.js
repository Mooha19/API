function mostrarCampos() {
    var tipoCita = document.getElementById("tipocita").value;
    var medicDiv = document.getElementById("c2");   
    var enfermeroDiv = document.getElementById("c3");
    var EnferColDiv= document.getElementById("c4");

    medicDiv.classList.add("hidden");
    enfermeroDiv.classList.add("hidden");
    EnferColDiv.classList.add("hidden");

    // Muestra los campos correspondientes según la opción seleccionada
    if (tipoCita === "consultap" || tipoCita === "consultat") {
        medicDiv.classList.remove("hidden");
    } else if (tipoCita === "vacu" || tipoCita === "cura" || tipoCita === "anali") {
        enfermeroDiv.classList.remove("hidden");
    } 
}
