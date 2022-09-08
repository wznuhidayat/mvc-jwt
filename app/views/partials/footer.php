<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
<script>
    function process() {
        const file = document.querySelector("#upload").files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.readAsDataURL(file);

        reader.onload = function(event) {
            const imgElement = document.createElement("img");
            imgElement.src = event.target.result;
            document.querySelector("#input").src = event.target.result;

            imgElement.onload = function(e) {
                const canvas = document.createElement("canvas");
                const MAX_WIDTH = 600;

                const scaleSize = MAX_WIDTH / e.target.width;
                canvas.width = MAX_WIDTH;
                canvas.height = e.target.height * scaleSize;

                const ctx = canvas.getContext("2d");

                ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);

                const srcEncoded = ctx.canvas.toDataURL(e.target, "image/jpeg");
                // you can send srcEncoded to the server
                console.log(srcEncoded);
                document.querySelector("#output").src = srcEncoded;
                // $.ajax({
                //     type: "POST",
                //     url: "",
                //     data: {
                //         image: srcEncoded
                //     }
                // }).done(function(respond) {
                //     console.log('saved'); 
                // });
                fetch("<?= BASEURL; ?>/dashboard/savegambar", {
                        method: "POST",
                        mode: "no-cors",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: srcEncoded
                    }).then(response => response.text())
                    .then(success => console.log(success))
                    .catch(error => console.log(error));
            };
        };
    }
</script>
</body>

</html>