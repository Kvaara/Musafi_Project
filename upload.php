<?php include("./includes/includedNavbar.php") ?>

<header id="application-page-header" class="upload-header">
    <h1>Upload music here</h1>
</header>

<section id="application-page-section">
    <div id="upload-album-creation">
        <div id="upload-createdby-name-container">
            <label for="upload-createdby-name">Created by</label>
            <input type="text" id="upload-createdby-name" value="Niklas_Puganen" readonly>
        </div>

        <div id="upload-album-name-container">
            <label for="upload-album-name">Album name</label>
            <input type="text" id="upload-album-name" maxlength="20" placeholder="Preferred name">
        </div>

        <div id="upload-files-container" ondrop="dropFile(event)" ondragover="allowDrop(event)">
            <h2>Add files <span>(by dragging here)</span></h3>
                <div id="grid-file-container">

                </div>

        </div>
        <div id="upload-files-nodrag-container">
            <label for="upload-files">Add music without dragging</label>
            <input type="file" id="upload-files-nodrag">
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
    // After user has dropped in a file, add it into the "Add files" container
    var pushedFileNames = [];
    var dropFile = (event) => {
        event.preventDefault();

        if (event.dataTransfer.items) {
            var dataItemArray = [...event.dataTransfer.items];
            dataItemArray.forEach((item) => {
                var file = item.getAsFile();
                if (!pushedFileNames.includes(file.name)) {
                    pushedFileNames.push(file.name);
                    var span = document.createElement("span");
                    span.textContent = file.name;
                    span.currentFile = file;
                    span.classList.add("file-span");
                    document.querySelector("#grid-file-container").appendChild(span);
                }
            })
        }
    }

    // Prevents the default behaviour that, after dragging a file into a page, it opens a new window with the file and starts playing it
    var allowDrop = (event) => {
        event.preventDefault();
    }

    // If the user is using a mobile phone or tablet, they can add files without dragging
    document.querySelector("#mymusic-files-nodrag").addEventListener("change", (event) => {
        var nodragDataItemArray = [...event.target.files];
        nodragDataItemArray.forEach((file) => {
            pushedFileNames.push(file.name);
            var span = document.createElement("span");
            span.textContent = file.name;
            span.currentFile = file;
            span.classList.add("file-span");
            document.querySelector("#grid-file-container").appendChild(span);
        })
    })


    document.querySelector("#clear-all-btn").addEventListener("click", () => {
        document.querySelector("#grid-file-container").textContent = "";
    })

    document.querySelector("#create-album-btn").addEventListener("click", () => {
        var albumName = document.querySelector("#mymusic-album-name").value;
        if (document.querySelector("#grid-file-container").children.length !== 0 && albumName.length !== 0) {

            var fileSpans = document.querySelectorAll(".file-span");
            var formData = new FormData();
            fileSpans.forEach((file) => {
                var fileName = file.currentFile.name;
                var currentFile = file.currentFile;

                formData.append(fileName, currentFile);
            })


            // for (var [key, value] of formData.entries()) {
            //     console.log(key, value)
            // }

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
                mimeType: "multipart/form-data",
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