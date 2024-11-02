window.onload = function(){

// Cogemos nuestro espacio reservado para pintar tarjetas
var tarjeta = document.getElementById("tarjeta");
llamarPics();

let boton = document.getElementById("addPic");
boton.addEventListener("click", function(){

    // capturamos archivo
    let archivos = document.getElementById("imagen");
    let archivo = archivos.files[0];

    //Tenemos en la variable archivo un objeto de tipo imagen que tiene diferentes
    // atributos como nombre, tamaño, tipo...   
    verificarImagen(archivo);
});



function verificarImagen(archivo){

    // si no hay contenido...
    if (!archivo) {
        swal({
            title: "¡Error!",
            text: "No has seleccionado ningún archivo",
            icon: "error",       
        })   
        return;    
    }
      
    // si es mayor que 2 megas
    if (archivo.size > 2 * (1024 * 1024)) {
        swal({
            title: "¡Error!",
            text: "El tamaño máximo permitido es de 2 megas",
            icon: "error",       
        })    
        return;   
    }

    if (!["image/jpeg"].includes(archivo.type)) {
        swal({
            title: "¡Error!",
            text: "Solo se permiten archivos de tipo jpeg",
            icon: "error",       
        })    
        return;          
    }

    // La imágen es correcta
    let formData = new FormData();
    formData.append("archivo", archivo);    

    fetch("../controllers/subirArchivo.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {

        // Ventana que imprime mensaje de éxito del servidor
        
        swal({
            title: "¡Perfecto!",
            text: data,
            icon: "success",     
        })
        
        // repintamos pantalla
        location.reload();
    
    })
    .catch(error => {
    console.error("Error al subir el archivo:", error);
    });

}
    
}

// Función que pide al servidor las imágenes de los usuarios
function llamarPics(){
    
fetch('../controllers/controller_cogerPics.php', {
    method: 'GET',
    headers: {
    // se puede quitar
    }
})
.then(response => response.json())
.then(data => {
    imprimirPics(data);
})

}

function imprimirPics(pics){

for(let i=0; i<pics.length; i++){

let div1 = document.createElement("div");
div1.setAttribute("class", "card");
div1.setAttribute("style","width: 18rem;");
tarjeta.appendChild(div1);

let imagen = document.createElement("img");
imagen.setAttribute("class","rounded mx-auto d-block");
imagen.setAttribute("src", pics[i].user_pic);
imagen.setAttribute("alt","Imagen de usuario");
imagen.setAttribute("style","width: 70%");

div1.append(imagen);

let div2 = document.createElement("div");
div2.setAttribute("class","card-body");
div1.append(div2);

}

}


// Decidimos no implementar la función de
// borrado de fotos de pefil
/*
let a = document.createElement("input");
a.setAttribute("class","btn btn-secondary");
a.setAttribute("type","button");
a.setAttribute("value","eliminar");
a.setAttribute("id","boton-"+i);
div2.appendChild(a);
*/
