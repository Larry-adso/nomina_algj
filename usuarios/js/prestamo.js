document.addEventListener('DOMContentLoaded', (event) => {
    function actualizarFechaHora() {
      const campoFecha = document.getElementById('fechaActual');
      const ahora = new Date();
      
      // Formatear fecha y hora para que se ajuste al valor esperado por input[type="datetime-local"]
      const year = ahora.getFullYear();
      const month = String(ahora.getMonth() + 1).padStart(2, '0');
      const day = String(ahora.getDate()).padStart(2, '0');
      const hours = String(ahora.getHours()).padStart(2, '0');
      const minutes = String(ahora.getMinutes()).padStart(2, '0');
      const seconds = String(ahora.getSeconds()).padStart(2, '0');

      const fechaHoraActual = `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;

      campoFecha.value = fechaHoraActual;
    }

    // Actualizar la fecha y hora inmediatamente y luego cada segundo
    actualizarFechaHora();
    setInterval(actualizarFechaHora, 1000);
  });

  function toggleButtons() {
    var estado = "<?php echo $resul['estado']; ?>";
    var button4 = document.getElementById('button4');
    var button8 = document.getElementById('button8');

    if (estado === '4') {
        button4.style.display = 'inline-block';
        button8.style.display = 'none';
    } else if (estado === '8') {
        button4.style.display = 'none';
        button8.style.display = 'inline-block';
    } else {
        button4.style.display = 'none';
        button8.style.display = 'none';
    }
}

// Llama a la función cuando el documento esté completamente cargado
document.addEventListener("DOMContentLoaded", function(event) {
    toggleButtons();
}); 

  function eliminarRegistro(id) {
    // Puedes agregar confirmaciones adicionales aquí si lo deseas
    if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
        // Redireccionar a la página de eliminación con el ID del registro
        window.location.href = "eliminar_registro.php?id=" + id;
    }
}

