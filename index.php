<!DOCTYPE html>
<head>
    <title>Subir imagen via ajax</title>
</head>
<style>
    .container{
        width: 100%;
        margin: 0 auto;
    }

    .panel{
        width: 50%;
        float: left;
        min-height: 300px;
    }

    .gray{
        background: #f5f5f5;
    }
    
    .img-responsive{
        display: inline-block;
        margin: 0 auto;
        width: 100%
    }
</style>
<body>
    <div class="container">
        <div class="panel">
            <form id="uploadForm" method="post" action="app/ajax/simpleUpload.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Text</label>
                    <input type="text" name="texto" value="algo"/>
                </div>
                <div class="form-group">
                    <label>Imagen</label>
                    <input id="myImagen" name="myImagen" type="file"/>
                </div>
                <div class="form-group">
                    <button type="submit">Guardar</button>
                </div>
            </form>

        </div>
        <div class="panel gray">
            <p><span id="statusUpload">No hay cambios por guardar</span></p>
            <div id="preview"></div>
        </div>
    </div>
    <script type="text/javascript" src="assets/plugins/jquery2.1/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var uploadForm = $("#uploadForm");
            var imagen = $("#myImagen");
            var preview = $("#preview");
            var statusUpload = $("#statusUpload");

            uploadForm.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: uploadForm.prop('action'),
                    type: "post",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response)
                        if(response.status){
                            changeStatus('Archivo almacenado en servidor', '#008800');
                        } else {
                            changeStatus('No se a podido almacenar archivo', '#ff8930');
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        changeStatus('Error de servidor', '#f00');
                    }
                });
            });

            imagen.change(function () {
                changeStatus('Archivo pendiente de subir', '#00f');
                var fileReader = new FileReader();
                fileReader.readAsDataURL(this.files[0]);

                fileReader.onload = function (e) {
                    preview.html('<img src="' + e.target.result + '" class="img-responsive"/>');
                };
            });
            
            function changeStatus(text, colorHex){
                statusUpload.text(text);
                statusUpload.css({'color':colorHex});
            }
        });
    </script>
</body>
</html>
