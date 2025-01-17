else if (command.startsWith("modifica ")) {
    let eliminar = "Modifica";
    let restoCadena = command.substring(eliminar.length + 1); 
    restoCadena = restoCadena.trim();
    console.log("Modificar:" + eliminar);
    console.log("Resto de la cadena:" + restoCadena);

    let url = "update_produc.php?actualiza=" + encodeURIComponent(restoCadena);

    window.location.href = url;
  }
  else if (command.startsWith("actualiza ")) {
    let eliminar = "actualiza";
    let restoCadena = command.substring(eliminar.length + 1); 
    restoCadena = restoCadena.trim();
    console.log("Modificar:" + eliminar);
    console.log("Resto de la cadena:" + restoCadena);

    let url = "update_produc.php?actualiza=" + encodeURIComponent(restoCadena);

    window.location.href = url;
  }