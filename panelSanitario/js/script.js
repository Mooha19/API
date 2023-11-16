function aceptarDiagnostico(id) {
    fetch('server/actualizar_estado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + id + '&estado=aceptado',
    })
    .then(response => response.json())
    .then(data => {
        console.log('Estado actualizado a aceptado:', data);
        // Puedes realizar más acciones después de una actualización exitosa si es necesario
        location.reload();
    })
    .catch(error => console.error('Error al actualizar el estado:', error));
}
function denegarDiagnostico(id) {
    fetch('server/actualizar_estado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + id + '&estado=denegado',
    })
    .then(response => response.json())
    .then(data => {
        console.log('Estado actualizado a denegado:', data);
        location.reload();
        // Puedes realizar más acciones después de una actualización exitosa si es necesario
    })
    .catch(error => console.error('Error al actualizar el estado:', error));
}