$('button#guardar').click(function(){
	$.post( $('#form1').attr('action'),
				$('#form1 :input').serializeArray(),
				function(data) {
					if(!data)
					{
						alert("Dato introducido correctamente");
                        location.reload();
					}
					else{
						$('#ack').html(data);				
					}
				});
	$('#form1').submit(function(){
		return false;
	});
});
$(document).ready(function(){

    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
    });

    //al enviar el formulario
    $('button#guardar').click(function(){
        //información del formulario
        var formData = new FormData($("#ima")[0]);
        var message = ""; 
        //hacemos la petición ajax  
        $.ajax({
            url: 'imagen.php',  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
        });
    });
    $('button#return').click(function(){
        window.location='index.php';
    });
})

//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message){
    $("#ack").html("").show();
    $("#ack").html(message);
}

//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg':
            return true;
        break;
        default:
            return false;
        break;
    }
}