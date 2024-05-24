function abrirVentanaSerial() {
    // Abrir una ventana emergente
    var ventanaSerial = window.open("", "VentanaSerial", "width=600,height=400");

    // Hacer una solicitud GET al archivo serial.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Cuando se complete la solicitud con éxito, insertar el contenido en la ventana emergente
            ventanaSerial.document.write(this.responseText);
        }
    };
    xhttp.open("GET", "serial_modal.php", true);
    xhttp.send();
}

