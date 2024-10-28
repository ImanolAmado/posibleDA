window.onload = function () {


    let url = window.location.href;
    let corte = url.split("=");
    let id = corte[1];


    let idJSON = JSON.stringify(id);

    fetch('../controllers/controller_editar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },

        body: idJSON
    })


        // si no hay error, recibimos valor como objeto "data"
        .then(response => response.json())
        .then(data => {
            pintarDatos(data);
           
        })


    function pintarDatos(libro) {        

        let titulo = document.getElementById("titulo");
        titulo.innerHTML = libro[0].titulo;

        let selectColeccion = document.getElementById("selectColeccion");
        if (libro[0].coleccion == null) {
            selectColeccion.value = "si";
        } else selectColeccion.value = libro[0].coleccion;

        let selectEstado = document.getElementById("selectEstado");
        if (libro[0].estado == null) {
            selectEstado.value = "por leer";
        } else selectEstado.value = libro[0].estado;

        let selectPuntuacion = document.getElementById("selectPuntuacion");
        if (libro[0].puntuacion == null) {
            selectPuntuacion.value = 1;
        } else selectPuntuacion.value = libro[0].puntuacion;

        let textarea = document.getElementById("textarea");
        if (libro[0].review == null) {
            textarea.value = "";
        } else textarea.value = libro[0].review;

        let guardar = document.getElementById("guardar");
        guardar.addEventListener('click', actualizarLibro);

        function actualizarLibro() {
            let libroActualizar = new Object();
            libroActualizar.id_libro = libro[0].id_libro;
            libroActualizar.coleccion = selectColeccion.value;
            libroActualizar.estado = selectEstado.value;
            libroActualizar.puntuacion = selectPuntuacion.value;
            libroActualizar.review = textarea.value;

            let libroActualizarJSON = JSON.stringify(libroActualizar);

            fetch('../controllers/controller_actualizar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },

                body: libroActualizarJSON
            })

                // si no hay error, recibimos valor como objeto "data"
                .then(response => response.json())
                .then(data => {    
                    
                    swal({
                        title: "¡Bien hecho!",
                        text: "El libro ha sido modificado correctamente",
                        icon: "success",       
                        })  

                    window.location.href = "home.php";                                        
                })          
                       
        }

        let cancelar = document.getElementById("cancelar");
        cancelar.addEventListener('click', function () {
            window.location.href = "home.php";
        });


    }
}