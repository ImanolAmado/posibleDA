window.onload = function () {

    // Listener para el botón de volver
    let botonCancelar = document.getElementById("cancelar");
    botonCancelar.addEventListener("click", function () {
        window.location.href = "../index.php";

    });

    // Ponemos un listener al botón de enviar formulario
    let botonRegistrar = document.getElementById("guardar");
    botonRegistrar.addEventListener("click", function () {

        // Si se ha pulsado el botón, enviamos datos del formulario  
        if (!validarPassword()) {
            return;
        }
        // Construimos un objeto con los datos    
        let registro = new Object();
        registro.nombre = document.getElementById("nombre").value;
        registro.apellido = document.getElementById("apellido").value;
        registro.email = document.getElementById("email").value;
        registro.pass = document.getElementById("pass").value;
        registro.pass2 = document.getElementById("confirm-pass").value;
        registro.rol = document.getElementById("rol").value;
        console.log(registro.nombre);
        console.log(registro.apellido);
        console.log(registro.email);
        console.log(registro.pass);
        console.log(registro.pass);
        console.log(registro.rol);

        let registroJSON = JSON.stringify(registro);


        // Llamada AJAX, enviando nuestro Objeto transformado
        // en JSON.        
        fetch('../controllers/validarRegistro.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },

            body: registroJSON
        })

            // si hay error, recibimos valor como "data.error"
            .then(response => response.json())
            .then(data => {

                if (data.length == 22) {
                    swal({
                        title: "¡Error!",
                        text: data.error,
                        icon: "error",
                    })
                }
                if (data.length == 26) {
                        swal({
                            title: "¡Éxito!",
                            text: data,
                            icon: "success",
                        })                    
                        // Login exitoso
                        window.location.href = "../vistas/home.php";
                }

            })
        function validarPassword() {
            var caract_longitud = 6;
            var pass1 = document.getElementById("pass").value;
            var pass2 = document.getElementById("confirm-pass").value;

            if (pass1 === '' && pass2 === '') {
                swal({
                    title: "¡Error!",
                    text: "No se ha ingresado nada en ninguno de los campos.",
                    icon: "warning"
                });
                return false;
            }

            if (pass1.trim() !== pass1 || pass2.trim() != pass2) {
                swal({
                    title: "¡Error!",
                    text: "Las claves no pueden contener espacios.",
                    icon: "warning"
                });
                return false;
            }

            if (pass1.length < caract_longitud || pass2.length < caract_longitud) {
                swal({
                    title: "¡Error!",
                    text: "Las claves no pueden tener menos de 6 caracteres.",
                    icon: "warning"
                });
                return false;
            }

            if (pass1 !== pass2) {
                swal({
                    title: "¡Error!",
                    text: "Las claves no coinciden.",
                    icon: "warning"
                });
                return false;
            }
            return true;
        }
    });

}

