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