function mostrarCampos() {
    var tipoCita = document.getElementById("tipocita").value;
    var medicDiv = document.getElementById("c3");   
    var enfermeroDiv = document.getElementById("c4");
    var digDiv = document.getElementById("c5");
    var carDiv = document.getElementById("c6");
    var trauDiv = document.getElementById("c7");
    var oftDiv = document.getElementById("c8");
    var ginDiv = document.getElementById("c9");
    
    
    medicDiv.classList.add("hidden");
    enfermeroDiv.classList.add("hidden");
    digDiv.classList.add("hidden");
    carDiv.classList.add("hidden");
    trauDiv.classList.add("hidden");
    oftDiv.classList.add("hidden");
    ginDiv.classList.add("hidden");
    
   
    if (tipoCita === "Consulta presencial" || tipoCita === "Consulta telefónica") {
        medicDiv.classList.remove("hidden");
           
    } else if (tipoCita === "Vacunas" || tipoCita === "Curaciones" || tipoCita === "Análisis") {
        enfermeroDiv.classList.remove("hidden");
           
    } else if (tipoCita === "Digestivo" ) {
        digDiv.classList.remove("hidden");
        
    } else if (tipoCita === "Cardiología") {
        carDiv.classList.remove("hidden");
        
    } else if (tipoCita === "Traumatología" ) {
        trauDiv.classList.remove("hidden");
        
    } else if (tipoCita === "Oftalmología" ) {
        oftDiv.classList.remove("hidden");
          
    } else if (tipoCita === "Ginecología" ) {
        ginDiv.classList.remove("hidden");
        
    } 
    

}
function obtenerlugar() {
    var tipo = document.getElementById("tipocita").value;
    var lm = datosSanitario.lm;
    var tm = datosSanitario.tm;
    var le = datosSanitario.le;
    var te = datosSanitario.te;
    var ld = datosSanitario.ld;
    var td = datosSanitario.td;
    var lc = datosSanitario.lc;
    var tc = datosSanitario.tc;
    var lt = datosSanitario.lt;
    var tt = datosSanitario.tt;
    var lo = datosSanitario.lo;
    var to = datosSanitario.to;
    var lg = datosSanitario.lg;
    var tg = datosSanitario.tg;

    if (tipo === "Consulta presencial" || tipo === "Consulta telefónica") {
        document.getElementById("tipo").value = tm;
        document.getElementById("lugar").value = lm;
    } else if (tipo === "Vacunas" || tipo === "Curaciones" || tipo === "Análisis") {
        document.getElementById("tipo").value = te;
        document.getElementById("lugar").value = le ;
    } else if (tipo === "Digestivo") {
        document.getElementById("tipo").value = td;
        document.getElementById("lugar").value = ld;
    } else if (tipo === "Cardiología") {
        document.getElementById("tipo").value = tc;
        document.getElementById("lugar").value = lc;
    } else if (tipo === "Traumatología") {
        document.getElementById("tipo").value = tt;
        document.getElementById("lugar").value = lt;
    } else if (tipo === "Oftalmología") {
        document.getElementById("tipo").value = to;
        document.getElementById("lugar").value = lo;
    }else if (tipo === "Ginecología") {
        document.getElementById("tipo").value = tg;
        document.getElementById("lugar").value = lg;

    
}
}

function esDiaHabil(fecha) {
    var diaSemana = new Date(fecha).getDay();
    return diaSemana !== 0 && diaSemana !== 6;
  }
  
  function obtenerCitasMedico(fecha, colegiado) {
    return fetch('server/citas.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'fecha=' + encodeURIComponent(fecha) + '&colegiado=' + encodeURIComponent(colegiado),
    })
    .then(response => response.json())
    .then(data => {
        console.log('tiene citas:', data.citas);
        return data.citas; 
    })
    .catch(error => {
        console.error('Error al obtener citas:', error);
        return []; 
    });
  }
  
  function filtrarFechas() {
    var dateInput = document.getElementById('date');
    var horaSelect = document.getElementById('hora');
    horaSelect.innerHTML = '';
  
    var fechaSeleccionada = dateInput.value;
    var tipoInput = document.getElementById("tipocita");
    var tipo = tipoInput.value;
  
    var cole;
    if (tipo === "Consulta presencial" || tipo === "Consulta telefónica") {
        cole = document.getElementById("cole").value;
    } else if (tipo === "Vacunas" || tipo === "Curaciones" || tipo === "Análisis") {
        cole = document.getElementById("colenfer").value;
    }else if (tipo === "Digestivo" ) {
        cole = document.getElementById("coledig").value;
    }else if (tipo === "Cardiología" ) {
        cole = document.getElementById("colecar").value;
    }else if (tipo === "Traumatología" ) {
        cole = document.getElementById("coletrau").value;
    }else if (tipo === "Oftalmología" ) {
        cole = document.getElementById("coleoft").value;
    }else if (tipo === "Ginecología" ) {
        cole = document.getElementById("colegin").value;
    }    
   
    if (esDiaHabil(fechaSeleccionada)) {
        var horaInicio = new Date('2023-01-01T08:00:00');
        var horaFin = new Date('2023-01-01T15:00:00');
        var incremento = 20 * 60 * 1000; 
  
        
        obtenerCitasMedico(fechaSeleccionada, cole)
          .then(citasMedico => {
              for (var hora = horaInicio; hora <= horaFin; hora.setTime(hora.getTime() + incremento)) {
                  var horaActual = hora.getHours().toString().padStart(2, '0') + ':' + hora.getMinutes().toString().padStart(2, '0') + ':00';
  
                 
                  if (!citasMedico.includes(horaActual)) {
                      var option = document.createElement('option');
                      option.value = horaActual;
                      option.text = horaActual.slice(0, 8); 
                      horaSelect.add(option);
                  }
              }
          });
  }
}
function comprobardatos() { 
    let id = document.getElementById("controlId").value;
    let e = false;
    eliminarHijos(); 

    if (!contieneSoloNumeros(id)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("La tarjeta sanitaria solo puede tener números y de 8 cifras")
        er.setAttribute('id', 'erId')
        er.appendChild(t)
        document.getElementById("c1").appendChild(er)
        e= true
    }  
 
    if (!e) document.reg.submit(); 
}
function eliminarHijos() {
    for (var i =1; i< 21; i++) {
        var c = "c" + i
        var elem = document.getElementById(c)
        if (elem.lastChild.nodeName == 'P') {
            elem.removeChild(elem.lastChild);
        }
        
    }
}
function contieneSoloNumeros(str) {
    return /^[0-9]{8}$/.test(str);}


