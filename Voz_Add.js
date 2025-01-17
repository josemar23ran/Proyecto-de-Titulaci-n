function startListening() {
    const recognition = new webkitSpeechRecognition();
    recognition.lang = 'es-ES'; 
    recognition.start();
    recognition.onresult = function (event) {
        const result = event.results[0][0].transcript.toLowerCase();
        document.getElementById('Result').innerHTML = 'Comando recibido: ' + result;
        separador(result);
    };
}

var valoresActuales = {
    Producto: "",
    Marca: "",
    Precio: 0,
    Inventario: 0
};
function cadenaADic(cadena) {
    var palabras = cadena.split(" ");
    var diccionario = {
        producto: "",
        marca: "generica",
        precio: 1.0,
        inventario: 1
    };

    for (var i = 0; i < palabras.length; i++) {
        switch (palabras[i]) {
            case "productos":
            case "producto":
                diccionario.producto = obtenerSiguientePalabra(palabras, i);
                i += contarPalabras(diccionario.producto) - 1;
                break;
            case "marca":
                diccionario.marca = obtenerSiguientePalabra(palabras, i);
                i += contarPalabras(diccionario.marca) - 1;
                break;
            case "precio":
                diccionario.precio = parseFloat(obtenerSiguientePalabra(palabras, i));
                break;
            case "inventario":
                diccionario.inventario = parseFloat(obtenerSiguientePalabra(palabras, i));
                break;
            default:
                break;
        }
    }

    return diccionario;
}

function obtenerSiguientePalabra(palabras, indice) {
    var palabra = "";
    for (var i = indice + 1; i < palabras.length; i++) {
        if (palabras[i] === "marca" || palabras[i] === "precio" || palabras[i] === "inventario") {
            break;
        }
        palabra += palabras[i] + " ";
    }
    return palabra.trim();
}

function contarPalabras(cadena) {
    return cadena.split(/\s+/).length;
}
function limpiarTexto(cadena) {
    // Eliminar puntos y comas no seguidos por números
    console.log("numero: ",cadena)
    var sinPuntosComas = cadena.replace(/(?<!\d)[.,](?!\d)/g, '');
  
    // Eliminar palabras específicas
    var palabrasAEliminar = ['agregar', 'nuevo', 'añade', 'añadir'];
  
    // Construir una expresión regular para buscar y eliminar las palabras específicas
    var regexPalabrasAEliminar = new RegExp('\\b(' + palabrasAEliminar.join('|') + ')\\b', 'gi');
  
    // Aplicar la eliminación de las palabras específicas
    var sinPalabrasEspecificas = sinPuntosComas.replace(regexPalabrasAEliminar, '');
  
    return sinPalabrasEspecificas.trim(); // Eliminar espacios en blanco al principio y al final
}

function obtenerFechaActual() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    return yyyy + '-' + mm + '-' + dd;
}

function separador(palabra) {
    let palabrasAEliminar = ["la", "el", "los", "en", "y", "lo","las","del","de"];
    let expresionRegular = new RegExp("\\b(" + palabrasAEliminar.join("|") + ")\\b", "gi");
    let nuevaCadena = palabra.replace(expresionRegular, "");
    nuevaCadena = nuevaCadena.replace(/\.$/, "");
    console.log("Original:", palabra);
    console.log("Nueva:", nuevaCadena);
    executeCommand(nuevaCadena);
}

function executeCommand(command) {
    var form = document.forms['Agregar_producto'];
    form.elements['Fecha'].value = obtenerFechaActual();

    if (command == 'salir' || command == 'cancelar') {
        window.location.href = "muestraTodo.php";
    } else if (command.startsWith("eliminar ") || command.startsWith("elimina ") || command.startsWith("borra ") || command.startsWith("borrar ")) {
        let primerEspacio = command.indexOf(' ');
        if (primerEspacio !== -1) {
            let restoCadena = command.substring(primerEspacio + 1);
            restoCadena = restoCadena.trim();
            let url = "eliminar_produc.php?actualiza=" + encodeURIComponent(restoCadena);
            window.location.href = url;
        }
    } else if (command.startsWith("inventario")||command.startsWith("producto")||command.startsWith("precio") || command.startsWith("marca") || command.startsWith("agregar") || command.startsWith("nuevo")) {
       
        const resultado = limpiarTexto(command);
        
        var dicc = cadenaADic(resultado);
        console.log("dicc",dicc);

        // Actualiza solo los valores que han sido modificados
        if (dicc.producto !== "") valoresActuales.Producto = dicc.producto;
        if (dicc.marca !== "generica") valoresActuales.Marca = dicc.marca;
        if (dicc.precio!==1) valoresActuales.Precio = dicc.precio;
        if (dicc.inventario!==1) valoresActuales.Inventario = dicc.inventario;
        // Asigna los valores actuales al formulario
        form.elements['Producto'].value = valoresActuales.Producto;
        form.elements['Marca'].value = valoresActuales.Marca;
        form.elements['Precio'].value = valoresActuales.Precio;
        form.elements['Inventario'].value = valoresActuales.Inventario;
        form.elements['Fecha'].value = obtenerFechaActual();
    }
    else if(command.startsWith("aceptar")||command.startsWith("modificar")||command.startsWith("actualizar")||command.startsWith("enviar")){
        form.submit();
    } 
    else {
        document.getElementById('output').innerHTML = 'Lo siento, no he entendido el comando!';
    }
}