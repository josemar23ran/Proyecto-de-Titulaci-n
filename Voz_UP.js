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
        precio: 0,
        inventario: 0
    };

    for (var i = 0; i < palabras.length; i++) {
        switch (palabras[i]) {
            case "productos":
            case "producto":
                diccionario.producto = obtenerSiguientePalabra(palabras, i);
                i += contarPalabras(diccionario.producto) - 1;
                break;
            case "marca":
            case "marcas":
                diccionario.marca = obtenerSiguientePalabra(palabras, i);
                i += contarPalabras(diccionario.marca) - 1;
                break;
            case "precio":
            case "precios":
                diccionario.precio = parseFloat(obtenerSiguientePalabra(palabras, i));
                break;
            case "inventario":
            case "inventarios":
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
    var sinPuntosComas = cadena.replace(/(?<!\d)[.,](?!\d)/g, '');

    // Eliminar palabras específicas
    var palabrasAEliminar = ['agregar', 'nuevo', 'añade', 'añadir'];
    
    // Construir una expresión regular para buscar y eliminar las palabras específicas
    var regexPalabrasAEliminar = new RegExp('\\b(' + palabrasAEliminar.join('|') + ')\\b', 'gi');
    
    // Aplicar la eliminación de las palabras específicas
    var sinPalabrasEspecificas = sinPuntosComas.replace(regexPalabrasAEliminar, '');

    // Eliminar espacios en blanco al principio y al final
    return sinPalabrasEspecificas.trim();
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
        console.log("dicc", dicc);

        // Actualiza solo el valor que ha sido modificado por el comando
        if (dicc.producto !== "") {
            form.elements['Producto'].value = dicc.producto;
            valoresActuales.Producto = dicc.producto;
        }
        if (dicc.marca !== "generica") {
            form.elements['Marca'].value = dicc.marca;
            valoresActuales.Marca = dicc.marca;
        }
        if (dicc.precio!==0) {
            form.elements['Precio'].value = dicc.precio;
            valoresActuales.Precio = dicc.precio;
        }
        if (dicc.inventario!==0) {
            form.elements['Inventario'].value = dicc.inventario;
            valoresActuales.Inventario = dicc.inventario;
        }
    } 
    else if(command.startsWith("aceptar")||command.startsWith("modificar")||command.startsWith("actualizar")||command.startsWith("enviar")){
        form.submit();
    } 
    
    else {
        document.getElementById('output').innerHTML = 'Lo siento, no he entendido el comando!';
    }
}
