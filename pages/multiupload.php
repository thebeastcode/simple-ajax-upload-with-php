<!DOCTYPE html>
<head>
    <title>Subir imagen via ajax</title>
</head>
<body>
    <form id="uploadForm" method="post" action="app/ajax/upload.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Text</label>
            <input type="text" name="texto" value="algo"/>
        </div>
        <div class="form-group">
            <label>Imagen</label>
            <input name="media[]" type="file" accept="image/*"/>
        </div>
        <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="media[]" accept="image/*"/>
        </div>
        <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="media[]" accept="image/*"/>
        </div>
        <div class="form-group">
            <button type="submit">Guardar</button>
        </div>
    </form>
    <script type="text/javascript" src="assets/plugins/jquery2.1/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var uploadForm = $("#uploadForm");

            uploadForm.submit(function (e) {
                e.preventDefault();
//mod feadtures by https://stackoverflow.com/questions/5392344/sending-multipart-formdata-with-jquery-ajax#answer-12426630
                var obj = $(this);
                var formData = new FormData();
                $.each($(obj).find("input[type='file']"), function (i, tag) {
                    $.each($(tag)[0].files, function (i, file) {
                        formData.append(tag.name, file);
                    });
                });
                var params = $(obj).serializeArray();
                $.each(params, function (i, val) {
                    formData.append(val.name, val.value);
                });

                $.ajax({
                    url: "app/ajax/upload.php",
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response)
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</body>
</html>
