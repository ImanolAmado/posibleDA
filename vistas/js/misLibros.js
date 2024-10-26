window.onload = function() {

let aplicarFiltro = document.getElementById("aplicarFiltro");
aplicarFiltro.addEventListener("click", function(){
    let coleccion = document.getElementById("coleccion").checked;
    console.log(coleccion);    
    let seleccion = document.getElementById("seleccion").value;
    console.log(seleccion);
    pintarLibros(coleccion, seleccion);

})

function pintarLibros(coleccion, seleccion){

 // Llamada AJAX, enviando nuestros parametros transformados en JSON
 
    // Construimos un objeto con los datos    
    let filtroLibro = new Object();
    filtroLibro.coleccion = coleccion;
    filtroLibro.seleccion = seleccion;
    
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
        console.log(data);     
       
        }   
    })  

/*
    <div class="d-flex flex-wrap justify-content-start ms-5 gap-3">
    <?php foreach ($librosPopulares as $libro): ?>
        <div class="card mb-5" style="width: 30%; height: 100%;">
            <div class="row g-0">
                <div class="col-md-2">
                    <img src="<?= $libro['img_libro'] ?>" class="img-fluid rounded-start" alt="imagen portada">
                </div>
                <div class="col-md-10">
                    <div class="card-body d-flex flex-column mt">
                        <h5 class="card-title"><?= htmlspecialchars($libro['titulo']) ?></h5>
                        <h6 class="card-text">Editorial: <?= htmlspecialchars($libro['editorial']) ?></h6>
                        <h6 class="card-text" style="font-weight:400">Fecha edición: <?= htmlspecialchars($libro['fecha_publicacion']) ?></h6>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
*/



}
















}