window.onload = function () {

    let id = document.getElementById("id").value;
        
        let idJSON = JSON.stringify(id);

    fetch('../controllers/controller_editarUsuario.php', {
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
          //  console.log(data);
        })


    function pintarDatos(usuario) {

        //console.log(usuario);

        let nombre = document.getElementById("nombre");
        if (usuario.nombre == null) {
            nombre.value = "";
        } else nombre.value = usuario.nombre;

        let apellido = document.getElementById("apellido");
        if (usuario.apellido == null) {
            apellido.value = "por leer";
        } else apellido.value = usuario.apellido;

        let email = document.getElementById("email");
        if (usuario.email == null) {
            email.value = 1;
        } else email.value = usuario.email;

        let password = document.getElementById("pass");
        if (usuario.password == null) {
            password.value = "123456";
        } else password.value = usuario.password;

        let confirmPassword = document.getElementById("confirm-pass");
        if (usuario.password == null) {
            confirmPassword.value = "123456";
        } else confirmPassword.value = usuario.password;

        //Guardo en variables el email y el password original, para compararlo después
        let originalEmail = usuario.email;
        let originalPassword = usuario.password;


        let rol = document.getElementById("rol");
        if (usuario.rol == null) {
            rol.value = "";
        } else rol.value = usuario.rol;

        let guardar = document.getElementById("guardar");
        guardar.addEventListener('click', actualizarUsuario);

        //console.log(confirmPassword.value);
        function actualizarUsuario(e) {
            if (!validarPassword()) {
                e.preventDefault();
                return;
            };

            let usuarioActualizar = new Object();
            usuarioActualizar.id = document.getElementById('id').value;
            usuarioActualizar.nombre = nombre.value;
            usuarioActualizar.apellido = apellido.value;
            usuarioActualizar.email = email.value;
            usuarioActualizar.originalEmail = originalEmail;
            usuarioActualizar.originalPassword = originalPassword;
            usuarioActualizar.password = password.value;
            usuarioActualizar.rol = rol.value;         

            let usuarioActualizarJSON = JSON.stringify(usuarioActualizar);

            fetch('../controllers/controller_actualizarUsuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },

                body: usuarioActualizarJSON
            })

                // si no hay error, recibimos valor como objeto "data"
                // .then(response => response.json())
                .then(response => response.json())
                .then(data => {
                  
                    if (data.error) {
                        console.error('Error:', data.error);
                    }

                    if(data.length == 26){
                        swal({
                            title: "Éxito",
                            text: data,
                            icon: "success",
                        })
                        .then(() => { 
                            window.location.href = "todosLosUsuarios.php";
                        });
                    } 
                   
                    if(data.length == 22){
                        swal({
                            title: "¡Error!",
                            text: data,
                            icon: "error",
                        })
                    }


                })

        }

        let cancelar = document.getElementById("cancelar");
        cancelar.addEventListener('click', function () {
            window.location.href = "home.php";
        });


    }

    //Comprobación de los passwords
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

}

