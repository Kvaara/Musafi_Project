<?php include("./includes/includedNavbar.php") ?>

<header id="application-page-header" class="mymusic-header">
    <h1>Checkout your own music</h1>
</header>

<section id="application-page-section">
    <div id="mymusic-album-creation">
        <div id="mymusic-createdby-name-container">
            <label for="mymusic-createdby-name">Created by</label>
            <input type="text" id="mymusic-createdby-name" value="Niklas_Puganen" readonly>
        </div>

        <div id="mymusic-album-name-container">
            <label for="mymusic-album-name">Album name</label>
            <input type="text" id="mymusic-album-name" maxlength="20" placeholder="Preferred name">
        </div>

        <div id="mymusic-files-container" ondrop="dropFile(event)" ondragover="allowDrop(event)">
            <h2>Add files <span>(by dragging here)</span></h3>
                <div id="grid-file-container">

                </div>
                <!-- <label for="mymusic-files">Add music</label>
            <input type="file" id="mymusic-files"> -->
        </div>
        <button id="clear-all-btn">Clear all songs</button>
        <button id="create-album-btn">CREATE</button>

    </div>
    <?php
    echo "<div>
                            </div";
    ?>
</section>

</div>

<script>
    var dropFile = (event) => {
        event.preventDefault();
        if (event.dataTransfer.items) {
            for (var i = 0; i < event.dataTransfer.items.length; i++) {
                var file = event.dataTransfer.items[i].getAsFile();
                console.log('... file[' + i + '].name = ' + file.name);
                // var div = document.createElement("div");
                var span = document.createElement("span");
                span.textContent = file.name;
                span.currentFile = file;
                span.classList.add("file-span");
                console.log(span.currentFile);
                // div.appendChild(pTag);
                document.querySelector("#grid-file-container").appendChild(span);
            }
        } else {
            for (var i = 0; i < event.dataTransfer.files.length; i++) {
                console.log('... file[' + i + '].name = ' + ev.dataTransfer.files[i].name);
            }
        }
    }

    var allowDrop = (event) => {
        event.preventDefault();
    }

    document.querySelector("#clear-all-btn").addEventListener("click", () => {
        document.querySelector("#grid-file-container").textContent = "";
    })

    document.querySelector("#create-album-btn").addEventListener("click", () => {
        var albumName = document.querySelector("#mymusic-album-name").value;
        if (document.querySelector("#grid-file-container").children.length !== 0 && albumName.length !== 0) {

            var fileSpans = document.querySelectorAll(".file-span");
            var files = [];
            var formData = new FormData();
            fileSpans.forEach((file) => {
                var fileName = file.currentFile.name;
                var currentFile = file.currentFile;

                formData.append("file", currentFile);
            })


            for (var [key, value] of formData.entries()) {
                console.log(key, value)
            }

            // $.post("./includes/handlers/ajax/addAlbumToDb.php", {
            //     albumName
            // }, (result) => {
            //     var data = JSON.parse(result);
            // })
            $.ajax({
                type: "POST",
                url: "./includes/handlers/ajax/addAlbumToDb.php",
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    alert(response);
                }
            })
        } else if (albumName.length === 0) {
            alert("You need to specify a name!");
        } else {
            alert("You need to add songs!");
        }
    })
</script>

<?php include("./includes/includedFooterPlayer.php") ?>