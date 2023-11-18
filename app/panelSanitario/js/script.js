function aceptarDiagnostico(id) {
    var observaciones = document.getElementById('observaciones' + id).value;
    fetch('server/actualizar_estado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + id + '&estado=aceptado&observaciones=' + encodeURIComponent(observaciones),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Estado actualizado a aceptado:', data);
       
        location.reload();
    })
    .catch(error => console.error('Error al actualizar el estado:', error));
}
function denegarDiagnostico(id) {
    var observaciones = document.getElementById('observaciones' + id).value;
    fetch('server/actualizar_estado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + id + '&estado=aceptado&observaciones=' + encodeURIComponent(observaciones),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Estado actualizado a denegado:', data);
        location.reload();
       
    })
    .catch(error => console.error('Error al actualizar el estado:', error));
}