window.onload = function () {

    let tarjeta = document.getElementById("tarjeta");
    var listaLibros = []; // lista para objetos libro    

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

        // largo del array de objetos json
        let largo = libros.length;
        let imagen = "../resources/img/imagenNoDisponible.jpg";               
        
        var listaLibros = []; // lista para objetos libro              

        for (let i = 0; i < libros.length; i++) {

            let miLibro = new Object();  // nuevo objeto "miLibro"
            miLibro.autores=[];

            // validamos y asignamos variables
            miLibro.id_google = libros[i].id;
            miLibro.titulo = libros[i].volumeInfo.title;
           
            if(Object.hasOwn(libros[i].volumeInfo, 'authors') == true){
                if(libros[i].volumeInfo.authors.length==1){
                 miLibro.autores.push(libros[i].volumeInfo.authors[0]);

                } else {
                    for(let j=0; j<libros[i].volumeInfo.authors.length; j++){
                        miLibro.autores.push(libros[i].volumeInfo.authors[j]);
                    }
                }
            } else miLibro.autores=[];

            if(Object.hasOwn(libros[i].volumeInfo, 'imageLinks') == true){
                if(Object.hasOwn(libros[i].volumeInfo.imageLinks, 'thumbnail') == true){
                miLibro.imagen = libros[i].volumeInfo.imageLinks.thumbnail;
                } else miLibro.imagen = libros[i].volumeInfo.imageLinks.smallThumbnail;
           } else miLibro.imagen = "../resources/img/imagenNoDisponible.jpg";

            if(Object.hasOwn(libros[i].volumeInfo, 'description') == true){
            miLibro.descripcion = libros[i].volumeInfo.description; 
            } else miLibro.descripcion = "Información no disponible";      
            
            if(Object.hasOwn(libros[i].volumeInfo, 'infoLink') == true){
            miLibro.masInfo = libros[i].volumeInfo.infoLink;
            } else miLibro.masInfo = "Información no disponible";    

            if(Object.hasOwn(libros[i].volumeInfo, 'publishedDate') == true){
            miLibro.fecha = libros[i].volumeInfo.publishedDate;
            } else miLibro.fecha = "Desconocido";
               
            if(Object.hasOwn(libros[i].volumeInfo, 'publisher') == true){
            miLibro.editorial = libros[i].volumeInfo.publisher;  
            } else miLibro.editorial = "Desconocido";

            // div1
            let div1 = document.createElement("div");
            div1.setAttribute("class","card mb-5");
            div1.setAttribute("style","max-width: 900px;");
            tarjeta.appendChild(div1);

            // div2
            let div2 = document.createElement("div");
            div2.setAttribute("class","row g-0");
            div1.appendChild(div2);

            // div3
            let div3 = document.createElement("div");
            div3.setAttribute("class","col-md-2");
            let img = document.createElement("img");
            img.setAttribute("src",miLibro.imagen);           
            img.setAttribute("class","img-fluid rounded-start");
            img.setAttribute("alt","imagen portada");
            div3.appendChild(img);
            div2.appendChild(div3);

            // div4
            let div4 = document.createElement("div");
            div4.setAttribute("class","col-md-10");
            div2.appendChild(div4);

            // div5
            let div5 = document.createElement("div");
            div5.setAttribute("class","card-body");
            div4.appendChild(div5);

            // Componentes de la tarjeta

            let h5 = document.createElement("h5");
            h5.setAttribute("class","card-title");
            h5.innerHTML=miLibro.titulo;
            div5.appendChild(h5);

            let p = document.createElement("p");
            p.setAttribute("class","card-text");

            let cadenaAutores="";

            for(let j=0; j<miLibro.autores.length; j++){
                if(j==0){
                    cadenaAutores=miLibro.autores[j];
                }else cadenaAutores = cadenaAutores + ", " + miLibro.autores[j]; 
            }
            p.innerHTML='Autor/es: ' + cadenaAutores;
            div5.appendChild(p);

            let h61 = document.createElement("h6");
            h61.setAttribute("class", "card-text");
            h61.setAttribute("style", "font-weight:400");
            h61.innerHTML= 'Fecha edición: ' + miLibro.fecha;                          
            div5.appendChild(h61);

            let h62 = document.createElement("h6");
            h62.setAttribute("class", "card-text");
            h62.setAttribute("style", "font-weight:400");
            h62.innerHTML= `Editorial: ${miLibro.editorial}`;                              
            div5.appendChild(h62);

            let h63 = document.createElement("h6");
            h63.setAttribute("class", "card-text");
            h63.setAttribute("style", "font-weight:400");
            
            h63.innerHTML='Más información: <a href="' + miLibro.masInfo + '" target="_blank">aquí</a>';                      
            div5.appendChild(h63);

            let a = document.createElement("input");
            a.setAttribute("class","btn btn-primary");
            a.setAttribute("type","button");
            a.setAttribute("value","añadir");
            a.setAttribute("id","boton_"+i);
            div5.appendChild(a);

            listaLibros.push(miLibro);       
          
           // Añadimos listener para cada botón
            a.addEventListener("click", enviarLibro);       
            
        }


        function enviarLibro(event){
            
        // Cogemos el Id del evento y accedemos al objeto 
        // que nos interese por su índice
        let id = event.target.id.split("_");        
        let libroJSON = JSON.stringify(listaLibros[id[1]]);
       
        
        // Llamada AJAX, enviando nuestro Objeto transformado
        // en JSON.        
        fetch('../controllers/controller_anadirLibro.php', {
            method: 'POST',
            headers: {
        'Content-Type': 'application/json'    
        },        
        
        body: libroJSON
        })

    
    // si no hay error, recibimos valor como objeto "data"
    .then(response => response.json())
    .then(data => {
          
        if (data.error) {
        console.error('Error:', data.error);
        ventanaSuccess(data.error);
    } else {  
        console.log(data);     
        ventanaSuccess(data);
        }   
    })  

    }

        // Ventana emergente con mensaje de éxito
        function ventanaSuccess(data){      
            
            let msj = JSON.stringify(data);

            // Cojo el valor del ancho y de la altura de la pantalla
            let ancho = window.innerWidth;
            let alto = window.innerHeight;      

            // Cálculo de la posición centrada 
            ancho = (ancho / 2) - 150;
            alto = (alto / 2) - 150;               
                  
            // Creo una nueva ventana, 400px de alto y de 200px ancho
            let nuevaVentana=window.open("../vistas/ventanasEmergentes/vistaVentanaConfirmacion.html", "Pag",
            "left="+ancho+" top="+alto+"toolbar=yes,location=yes,menubar=yes,resizable=no,width=400,height=200" );
        
            //nuevaVentana.document.getElementById("mensaje").innerHTML=msj;
                       
        }     
        
    }

}