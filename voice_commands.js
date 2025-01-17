function startListening() {
    // Solicitar permisos para acceder al micrófono
    navigator.mediaDevices.getUserMedia({ audio: true })
        .then(function (stream) {
            // Hacer algo con el flujo de audio
            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'es-ES';
            recognition.start();
            recognition.onresult = function (event) {
                const result = event.results[0][0].transcript.toLowerCase();
                document.getElementById('output').innerHTML = 'Comando recibido: ' + result;
                separador(result);
            };
        })
        .catch(function (error) {
            console.log('Error al acceder al micrófono: ', error);
        });
}
function separador(palabra) {
    let palabrasAEliminar = ["la", "el", "los", "en", "y", "lo","las","de","del"];
    let expresionRegular = new RegExp("\\b(" + palabrasAEliminar.join("|") + ")\\b", "gi");
    let nuevaCadena = palabra.replace(expresionRegular, "").replace(/\s+/g, ' ');
    // Eliminar punto al final de la cadena si lo hay
    nuevaCadena = nuevaCadena.replace(/\.$/, "").trim();
    console.log("Original:", palabra);
    console.log("Nueva:", nuevaCadena);
    executeCommand(nuevaCadena);
}
function executeCommand(command) {
    if(command == 'nuevo producto' ){
	window.location.href = "Tienda_1.php";
	}
    else if(command == 'agregar producto' ){
	window.location.href = "Tienda_1.php";
	}
    else if(command == 'salir' ){
        window.location.href = "index.php";
        }
    else if (command.startsWith("eliminar ")||command.startsWith("elimina ")||command.startsWith("borra ")||command.startsWith("borrar ")) {
        let primerEspacio = command.indexOf(' ');
        if (primerEspacio !== -1) {
            let restoCadena = command.substring(primerEspacio + 1);
            restoCadena = restoCadena.trim();
            let url = "eliminar_produc.php?actualiza=" + encodeURIComponent(restoCadena);
            window.location.href = url;
          }     
    }

    else if (command.startsWith("actualizar ")||command.startsWith("modificar ")||command.startsWith("modifica ")||command.startsWith("editar ")||command.startsWith("edita ")||command.startsWith("actualiza ")||command.startsWith("edito ")) {
        let primerEspacio = command.indexOf(' ');
        if (primerEspacio !== -1) {
            let restoCadena = command.substring(primerEspacio + 1);
            restoCadena = restoCadena.trim();
            let url = "update_produc.php?actualiza=" + encodeURIComponent(restoCadena);
            window.location.href = url;
          }     
    }
    else if (command.startsWith("dame precio") || command.startsWith("dame costo") || command.startsWith("precio") || command.startsWith("costo")) {
        let primerEspacio = command.indexOf(' ');
        if (primerEspacio !== -1) {
            let restoCadena = command.substring(primerEspacio + 1);
            restoCadena = restoCadena.trim();
            let url = "precio.php?consulta=" + encodeURIComponent(restoCadena);
    
            // Abrir una ventana emergente con la URL
            let popup = window.open(url, "_blank", "width=400, height=300, top=200, left=400");
    
            // Opcional: cerrar la ventana emergente después de 5 segundos
            setTimeout(function () {
                if (popup && !popup.closed) {
                    popup.close();
                }
            }, 5000);
        }
    }
}

