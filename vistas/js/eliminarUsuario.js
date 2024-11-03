document.getElementById("eliminarUsuario").addEventListener("click", function () {
    let id = document.getElementById("id").value;
    let idJSON = JSON.stringify(id);

    fetch('../controllers/eliminarUsuario.php', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json' 
        },
        body: idJSON
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.length);
            if (data.error) {
                console.error('Error:', data.error);
            }
            if (data.length == 31) {
                console.log(data);
                swal({
                    title: "Éxito",
                    text: data,
                    icon: "success",
                })
                //si lo hago sin then se redirige, sino, se queda en la misma pagina
                    window.location.href = "todosLosUsuarios.php";
                /* 
                    swal({
                        title: "Éxito",
                        text: data,
                        icon: "success",
                    })
                    .then(() => { 
                            window.location.href = "todosLosUsuarios.php";
                    }); */
            }
            if (data.length == 36) {
                swal({
                    title: "¡Error!",
                    text: data,
                    icon: "error",
                })
            }
        })
});