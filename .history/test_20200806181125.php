<script>

function previewImage() {
    var file = document.getElementById("file").files;
    if(file.length > 0) {
        var fileReader = new fileReader();

        fileReader.onload = function (e) {
            document.getElementById("preview").setAttribute("src", e.target.result);
        };

        fileReader.ReadAsDataURL(file[0]);
    }
}

</script>

<form action="">
<img id="preview">
<input type="file" name="HinhAnh" id="file" accept="image/*" onchange="previewImage()">
</form>