function comprobardatos() { 
    let name = document.getElementById("controlName").value;
    let surname = document.getElementById("controlSurname").value;    
    let tel = document.getElementById("controlTel").value;
    let fecha = document.getElementById("controlFecha").value;
    let id = document.getElementById("controlId").value;
    let contra = document.getElementById("controlPass").value;
    let contraRepeat = document.getElementById("controlPassRepeat").value;
    
    let e = false;

    eliminarHijos(); 
    
    if (contieneNumeros(name)) {
        var er = document.createElement("p")    
        er.setAttribute('class', 'text-danger') 
        var t = document.createTextNode("El nombre no puede contener números")
        er.setAttribute('id', 'erNombre') 
        er.appendChild(t) 
        document.getElementById("c1").appendChild(er) 
        e= true
    }
    if (contieneNumeros(surname)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Los apellidos no pueden tener números")
        er.setAttribute('id', 'erApellido')
        er.appendChild(t)
        document.getElementById("c2").appendChild(er)
        e= true
    }
    if (!esTel(tel)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Número incorrecto")
        er.setAttribute('id', 'eTel')
        er.appendChild(t)
        document.getElementById("c3").appendChild(er)
        e= true
    }
   
    if (!esFecha(fecha)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Fecha incorrecta")
        er.setAttribute('id', 'eFecha')
        er.appendChild(t)
        document.getElementById("c4").appendChild(er)
        e= true
    }
    if (!contieneSoloNumeros(id)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("La tarjeta sanitaria solo puede tener números y de 8 cifras")
        er.setAttribute('id', 'erId')
        er.appendChild(t)
        document.getElementById("c10").appendChild(er)
        e= true
    }

    if (!(esContraSegura(contra))) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("La contraseña debe tener al menos 8 caracteres, con mayúsculas, minúsculas, números ")
        er.setAttribute('id', 'eContra')
        er.appendChild(t)
        document.getElementById("c11").appendChild(er)
        e= true
    }
    
    if (contra != contraRepeat) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Las contraseñas deben ser iguales")
        er.setAttribute('id', 'eDiferentes')
        er.appendChild(t)
        document.getElementById("c12").appendChild(er)
        e = true
    }   

    if (!e) document.reg.submit(); 
}


function eliminarHijos() {
    for (var i =1; i< 13; i++) {
        var c = "c" + i
        var elem = document.getElementById(c)
        if (elem.lastChild.nodeName == 'P') {
            elem.removeChild(elem.lastChild);
        }
        
    }
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
    return /^[0-9]{8}$/.test(str);}



function esFecha(f) {
    if (f.length == 0) {
        return false
    } else {
        let fech = Date.now() 
        let act = new Date(fech) 
        let fAct = act.toISOString().substring(0,10) 
        if (Date.parse(f) >= Date.parse(fAct)) return false 
        else return true
    }
}

function esTel(t) {
    var b = true
    if (t.length != 9) b = false;
    var i = 0
    while (i < t.length && b) {
        if(isNaN(parseInt(t.charAt(i)))) b = false 
        i++
    }
    return b
}
function esContraSegura(contra) {
    var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (re.test(contra))
        return true;
    else
        return false;
}

////////////////////////////Funciones registro//////////////////////////////////////////
function cargarCiudades() {
    var provincia = document.getElementById('provincia').value;
    fetch('server/obtener_ciudades.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'provincia=' + encodeURIComponent(provincia),
    })
    .then(response => response.json())
    .then(data => {
        var selectCiudad = document.getElementById('ciudad');
        selectCiudad.innerHTML = '<option value="">Selecciona una ciudad</option>';

        data.forEach(ciudad => {
            var option = document.createElement('option');
            option.value = ciudad;
            option.text = ciudad;
            selectCiudad.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
function buscarAmbulatorioYMedico() {
    var ciudadInput = document.getElementById('ciudad');
    var ambulatorioField = document.getElementById('ambulatorio');
    var medicoField = document.getElementById('medico');
    var colegiadoField = document.getElementById('cole');
    
    var ciudad = ciudadInput.value;
    
    
    fetch('server/obtener_ambulatorio_medico.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'ciudad=' + encodeURIComponent(ciudad),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la solicitud. Código: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
       
        ambulatorioField.value = data.ambulatorio;
        medicoField.value = data.medico;
        colegiadoField.value = data.cole;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}






