window.onload = function() {

// Cogemos nuestro espacio reservado para pintar tarjetas
var tarjeta = document.getElementById("tarjeta");
llamarLibros("todos", "todos");


let aplicarFiltro = document.getElementById("aplicarFiltro");
aplicarFiltro.addEventListener("click", function(){

    let coleccion = document.getElementById("coleccion").value;      
    let estado = document.getElementById("estado").value;
    tarjeta.innerHTML="";
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
        } else pintarLibros(data);

        }
           
    })  

    }
    


    // Ya tenemos los libros, los pintamos en pantalla
    function pintarLibros(data){ 
        
        for(let i=0; i<data.length; i++){

        let puntuacion="";
        let coleccion="";
        let estado="";

        // Nos aseguramos de no pintar valores "null" en pantalla
        if(data[i].puntuacion==null){
           puntuacion="sin puntuar";
        } else puntuacion=data[i].puntuacion;

        if(data[i].coleccion==null){
           coleccion="sin definir";
        } else coleccion=data[i].coleccion;

        if(data[i].coleccion==null){
            estado="sin definir";            
         } else estado=data[i].estado;


        // Empezamos a crear elementos de DOM
        let div1 = document.createElement("div");
        div1.setAttribute("class","card mb-5");
        div1.setAttribute("style","width: 30%; height: 100%");
        tarjeta.appendChild(div1);

        let div2 = document.createElement("div");
        div2.setAttribute("class", "row g-0");
        div1.appendChild(div2);

        let div3 = document.createElement("div");
        div3.setAttribute("class","col-md-4");
        div2.appendChild(div3);

        let imagen = document.createElement("img");
        imagen.setAttribute("src",data[i].img_libro);
        imagen.setAttribute("class","img-fluid rounded-start");
        imagen.setAttribute("alt","imagen portada");
        div3.appendChild(imagen);

        let div4 = document.createElement("div");
        div4.setAttribute("class", "col-md-8");
        div2.appendChild(div4);
        
        let div5 = document.createElement("div");
        div5.setAttribute("class","card-body");
        div4.appendChild(div5);

        let h5 = document.createElement("h5");
        h5.setAttribute("class","card-title");
        h5.innerHTML=data[i].titulo;
        div5.appendChild(h5);

        let h61 = document.createElement("h6");
        h61.setAttribute("class","card-text");
        h61.innerHTML="Colección: " + coleccion;
        div5.appendChild(h61);

        let h62 = document.createElement("h6");
        h62.setAttribute("class","card-text");
        h62.innerHTML="Estado: " + estado;
        div5.appendChild(h62);

        let h63 = document.createElement("h6");
        h63.setAttribute("class","card-text");
        h63.innerHTML="Puntuación: " + puntuacion;
        div5.appendChild(h63);

        let p = document.createElement("p");
        p.setAttribute("class","card-text");
        p.innerHTML="Edita o reseñar tu libro";
        div5.appendChild(p);

        let a = document.createElement("input");
        a.setAttribute("class","btn btn-primary me-2");
        a.setAttribute("type","button");
        a.setAttribute("value","editar");
        a.setAttribute("id","edita_"+i);
        div5.appendChild(a);

        let b = document.createElement("input");
        b.setAttribute("class","btn btn-secondary");
        b.setAttribute("type","button");
        b.setAttribute("value","eliminar");
        b.setAttribute("id","elimina_"+i);
        div5.appendChild(b);
                        
        // Añadimos listener para cada botón
        a.addEventListener("click", function(event){
            let id = event.target.id.split("_");
            let libroEditar = data[id[1]];           
            window.location.href="editarLibro.php?id_libro=" + libroEditar.id_libro;         

        });    
        b.addEventListener("click", function(event){           
            let id = event.target.id.split("_");            
            let libroEliminar = data[id[1]];           
            eliminarLibro(libroEliminar); 
           
        });
        }
    }

    function eliminarLibro(libroEliminar){            
        
        // SweetAlert con callback
        // https://es.stackoverflow.com/questions/503462/sweet-alert-confirm
        swal({
            title: "¿Estás seguro",
            text: "El libro y la reseña asociada se borrarán de tu colección",
            icon: "warning",
            buttons: true,
            dangerMode: true,
         })
          .then((willDelete) => {
            if (willDelete) {                          
                   
                let libroJSON = JSON.stringify(libroEliminar);       
        
                // Llamada AJAX, enviando nuestro Objeto transformado
                // en JSON.        
                fetch('../controllers/eliminarLibro.php', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json'    
                },        
    
                    body: libroJSON
                })

                .then(response => response.json())
                .then(data => {

                if (data.error) {
                    console.error('Error:', data.error);                       
                    // Incorporamos librería SweetAlert para las alertas
                    // https://sweetalert.js.org/guides/#getting-started
                                      
                    swal({
                        title: "¡Error!",
                        text: data.error,
                        icon: "error",       
                        })                          
                    } 
                })
                
                swal("Libro eliminado correctamente", {
                icon: "success",
              });
              location.reload();

            } else {
              swal("Acción cancelada");              
            }
          });

    }
   
} 
 
         
