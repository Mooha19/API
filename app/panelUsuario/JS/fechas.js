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