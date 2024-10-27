window.onload = function() {




let aplicarFiltro = document.getElementById("aplicarFiltro");
aplicarFiltro.addEventListener("click", function(){

    let coleccion = document.getElementById("coleccion").value;      
    let estado = document.getElementById("estado").value;  
        
    llamarLibros(coleccion, estado);

})


function llamarLibros(coleccion, estado){

 // Llamada AJAX, enviando nuestros parametros transformados en JSON
 
    // Construimos un objeto con los datos    
    let filtroLibro = new Object();
    filtroLibro.coleccion = coleccion;
    filtroLibro.estado = estado;
    
    let filtroJSON = JSON.stringify(filtroLibro);

        fetch('../controllers/filtrarLibros.php', {
            method: 'POST',
            headers: {
        'Content-Type': 'application/json'    
        },        
        
        body: filtroJSON
        })

    
    // si no hay error, recibimos valor como objeto "data"
    .then(response => response.json())
    .then(data => {
          
        if (data.error) {
        console.error('Error:', data.error);
       
    } else {  
        // Sabemos que no se han encontrado libros con los filtros aplicados
        // si recibimos del servidor un mensaje de 27 caracteres.
        if (data.length==27){
            swal({
                title: "Lo siento...",
                text: "No se han encontrado libros con esos filtros",
                icon: "error",       
            }) 
        }
        pintarLibros(data);

        }
           
    })  

}
    


    // Ya tenemos los libros, los pintamos en pantalla
    function pintarLibros(data){
   
        console.log(data);
        console.log(data[0].titulo);
        console.log(data[0].img_libro);

        // Cogemos nuestro espacio reservado para pintar tarjetas
        let tarjeta = document.getElementById("tarjeta");        


        for(let i=0; i<data.length; i++){
        // Empezamos a crear elementos de DOM
        let div1 = document.createElement("div");
        div1.setAttribute("class","card mb-5");
        div1.setAttribute("style","width: 30%; height: 100%");
        tarjeta.appendChild(div1);

        let div2 = document.createElement("div");
        div2.setAttribute("class", "row g-0");
        div1.appendChild(div2);

        let div3 = document.createElement("div");
        div3.setAttribute("class","col-md-2");
        div2.appendChild(div3);

        let imagen = document.createElement("img");
        imagen.setAttribute("src",data[i].img_libro);
        imagen.setAttribute("class","img-fluid rounded-start");
        imagen.setAttribute("alt","imagen portada");
        div3.appendChild(imagen);

        let div4 = document.createElement("div");
        div4.setAttribute("class", "col-md-10");
        div2.appendChild(div4);
        
        let div5 = document.createElement("div");
        div5.setAttribute("class","card-body d-flex flex-column mt");
        div4.appendChild(div5);

        let h5 = document.createElement("h5");
        h5.setAttribute("class","card-title");
        h5.innerHTML=data[i].titulo;
        div5.appendChild(h5);

        let h61 = document.createElement("h6");
        h61.setAttribute("class","card-text");
        h61.innerHTML="Editorial: " + data[i].editorial;
        div5.appendChild(h61);

        let h62 = document.createElement("h6");
        h62.setAttribute("class","card-text");
        h62.innerHTML="Fecha edición: " + data[i].fecha_publicacion;
        div5.appendChild(h62);
        }

    }
} 
 
         
