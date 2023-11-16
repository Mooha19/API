function comprobardatos() { //Permite comprobar si todos los elementos del registro están añadidos y son correctos
    let tipo = document.getElementById("tipocita").value;
    let colegiado;
    if (tipo === "consultap" || tipo === "consultat") {
       colegiado = document.getElementById("cole").value;
    } else if (tipo === "vacu" || tipo === "cura" || tipoCita === "anali") {
        colegiado = document.getElementById("colenfer").value;
    } 
    let fecha = document.getElementById("date").value;
    let hora = document.getElementById("hora").value;
    
    
    let e = false;

     //Se eliminan los mensajes de error para que no se amontonen
    

    if (!e) document.reg.submit(); //Si no existe ningún error se hace submit del form
}




function contieneNumeros(pal) {
    if (pal.length == 0) {
        return true;
    } else {
        var b = false;
        var i = 0;
        while (i < pal.length && !b) {
            if (!isNaN(pal[i]) && pal[i] != ' ') b = true
            i++;
        }
        return b
    }
    
}
function contieneSoloNumeros(str) {
    return /^[0-9]+$/.test(str);
}



function esFecha(f) {
    if (f.length == 0) {
        return false
    } else {
        let fech = Date.now() //Tomamos la fecha de hoy
        let act = new Date(fech) //Creamos un nuevo objeto Date
        let fAct = act.toISOString().substring(0,10) //Cambiamos la fecha a ISO y obtenemos los 11 primeros caracteres
        if (Date.parse(f) >= Date.parse(fAct)) return false //Si la fecha introducida es mayor que la actual return false
        else return true
    }
}
