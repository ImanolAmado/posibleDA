window.onload = function () {

    let tarjeta = document.getElementById("tarjeta");

    // Listener para el botón de búsqueda
    let miBoton = document.getElementById("miBoton");
    miBoton.addEventListener("click", busqueda);

    // Recogemos el "input" para la búsqueda 
    function busqueda() {
        let cadena = document.getElementById("libro").value;
        tarjeta.innerHTML = "";
        loadDoc(cadena);
    }

    async function loadDoc(cadena) {

        // Realizamos la busqueda de la cadena que hemos preparado en la API
        let url = 'https://www.googleapis.com/books/v1/volumes?q=';
        url = url.concat(cadena);

        let apiKey = "AIzaSyBdvBcJPTekik2-2GtvYfz6vN7BhzuXwqg";
        url = url.concat('&key=').concat(apiKey);

        try {
            let response = await fetch(url);
            let result = await response.json();
            console.log(result);
            let libros = result.items;
            pintarLibros(libros);
        } catch (error) {
            console.error(error);
        }

    }

    // función para pintar en pantalla los libros encontrados
    function pintarLibros(libros) {

        let largo = libros.length


        for (let i = 0; i < libros.length; i++) {


            // validamos y asignamos variables
            let titulo = libros[i].volumeInfo.title;
            let imagen = "../img/imagenNoDisponible.jpg";

            let autor = "";

            if(Object.hasOwn(libros[i].volumeInfo, 'authors') == true){
                 autor = libros[i].volumeInfo.authors[0];
            }
            if(Object.hasOwn(libros[i].volumeInfo, 'imageLinks') == true){
                imagen = libros[i].volumeInfo.imageLinks.thumbnail;
           }
            let descripcion = libros[i].volumeInfo.description;


            // Comprobación imágen
            //if(libros[i].volumeInfo.imageLinks)


            let masInfo = libros[i].volumeInfo.infolink;
            let fecha = libros[i].volumeInfo.publishedDate;
            let editorial = libros[i].volumeInfo.publisher;


            tarjeta.innerHTML += `           
            <div class="card mb-5" style="max-width: 900px;"> 
            <div class="row g-0">
            <div class="col-md-2">            
            <img src="` + imagen + `" class="img-fluid rounded-start" alt="imagen portada">
            </div>
            <div class="col-md-10">
            <div class="card-body">
            <h5 class="card-title">${titulo}</h5>
            <p class="card-text">Autor/es: ${autor}</p>
            <p class="card-text">Fecha edición: ${fecha}</p>
            <p class="card-text">Editorial: ${editorial}</p>
            <a href="#" class="btn btn-primary">Añadir</a>
            </div>       
            </div>  
            </div>  
            </div>`
        }




    }

}