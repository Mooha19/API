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
    
    // Muestra los campos correspondientes según la opción seleccionada
    if (tipoCita === "consultap" || tipoCita === "consultat") {
        medicDiv.classList.remove("hidden");
           
    } else if (tipoCita === "vacu" || tipoCita === "cura" || tipoCita === "anali") {
        enfermeroDiv.classList.remove("hidden");
           
    } else if (tipoCita === "dig" ) {
        digDiv.classList.remove("hidden");
        
    } else if (tipoCita === "car") {
        carDiv.classList.remove("hidden");
        
    } else if (tipoCita === "trau" ) {
        trauDiv.classList.remove("hidden");
        
    } else if (tipoCita === "oft" ) {
        oftDiv.classList.remove("hidden");
          
    } else if (tipoCita === "gin" ) {
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

    if (tipo === "consultap" || tipo === "consultat") {
        document.getElementById("tipo").value = tm;
        document.getElementById("lugar").value = lm;
    } else if (tipo === "vacu" || tipo === "cura" || tipo === "anali") {
        document.getElementById("tipo").value = te;
        document.getElementById("lugar").value = le ;
    } else if (tipo === "dig") {
        document.getElementById("tipo").value = td;
        document.getElementById("lugar").value = ld;
    } else if (tipo === "car") {
        document.getElementById("tipo").value = tc;
        document.getElementById("lugar").value = lc;
    } else if (tipo === "trau") {
        document.getElementById("tipo").value = tt;
        document.getElementById("lugar").value = lt;
    } else if (tipo === "oft") {
        document.getElementById("tipo").value = to;
        document.getElementById("lugar").value = lo;
    }else if (tipo === "gin") {
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
        return data.citas; // Devolvemos las citas para que estén disponibles en la cadena de promesas
    })
    .catch(error => {
        console.error('Error al obtener citas:', error);
        return []; // Devolvemos un array vacío en caso de error
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
    if (tipo === "consultap" || tipo === "consultat") {
        cole = document.getElementById("cole").value;
    } else if (tipo === "vacu" || tipo === "cura" || tipo === "anali") {
        cole = document.getElementById("colenfer").value;
    }else if (tipo === "dig" ) {
        cole = document.getElementById("coledig").value;
    }else if (tipo === "car" ) {
        cole = document.getElementById("colecar").value;
    }else if (tipo === "trau" ) {
        cole = document.getElementById("coletrau").value;
    }else if (tipo === "oft" ) {
        cole = document.getElementById("coleoft").value;
    }else if (tipo === "gin" ) {
        cole = document.getElementById("colegin").value;
    }    
   
    if (esDiaHabil(fechaSeleccionada)) {
        var horaInicio = new Date('2023-01-01T08:00:00');
        var horaFin = new Date('2023-01-01T15:00:00');
        var incremento = 20 * 60 * 1000; // 20 minutos en milisegundos
  
        // Obtener las citas del médico para la fecha seleccionada
        obtenerCitasMedico(fechaSeleccionada, cole)
          .then(citasMedico => {
              for (var hora = horaInicio; hora <= horaFin; hora.setTime(hora.getTime() + incremento)) {
                  var horaActual = hora.getHours().toString().padStart(2, '0') + ':' + hora.getMinutes().toString().padStart(2, '0') + ':00';
  
                  // Verificar si la hora actual NO está ocupada (NO está en el array de citas)
                  if (!citasMedico.includes(horaActual)) {
                      var option = document.createElement('option');
                      option.value = horaActual;
                      option.text = horaActual.slice(0, 5); // Tomar solo las primeras 5 posiciones (hh:mm)
                      horaSelect.add(option);
                  }
              }
          });
  }
  }
