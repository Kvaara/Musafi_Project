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
            <h2>Add files <span>(by dragging them here)</span></h3>
                <div id="grid-file-container">
                    <div id="upload-files-nodrag-container">
                        <span>or</span>
                        <label for="upload-files-nodrag">Browse files</label>
                        <input type="file" id="upload-files-nodrag" style="display: none;" multiple>
                    </div>
                </div>

        </div>

        <button id="clear-all-btn">Clear all songs</button>
        <button id="create-album-btn">CREATE</button>

    </div>

    <!-- This is mandatory because else the page will break. Part of PHP features? -->
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
                    document.querySelector("#upload-files-nodrag-container").style.display = "none";
                }
            })
        }
    }

    // Prevents the default behaviour that, after dragging a file into a page, it opens a new window with the file and starts playing it
    var allowDrop = (event) => {
        event.preventDefault();
    }

    // If the user is using a mobile phone or tablet, they can add files without dragging
    document.querySelector("#upload-files-nodrag").addEventListener("change", (event) => {
        var nodragDataItemArray = [...event.target.files];
        nodragDataItemArray.forEach((file) => {
            pushedFileNames.push(file.name);
            var span = document.createElement("span");
            span.textContent = file.name;
            span.currentFile = file;
            span.classList.add("file-span");
            document.querySelector("#grid-file-container").appendChild(span);
            document.querySelector("#upload-files-nodrag-container").style.display = "none";
        })
    })

    // Clear all button functionality
    document.querySelector("#clear-all-btn").addEventListener("click", () => {
        //Saving the upload files nodrag container
        document.querySelector("#upload-files-nodrag-container").style.display = "flex";
        var uploadFilesNodragContainer = document.querySelector("#grid-file-container").firstElementChild;
        // Resetting the grid file container that contains the files
        document.querySelector("#grid-file-container").textContent = "";
        // Appending the upload file nodrag container
        document.querySelector("#grid-file-container").appendChild(uploadFilesNodragContainer);
        // Resetting the hidden input type file element. Making the .files null doesn't work FULLY for some reason... Resetting .value does work.
        document.querySelector("#upload-files-nodrag").value = "";
        // Resetting also the pushedFileNames that are used for preventing duplicates
        pushedFileNames = [];
    })

    // Create album button functionality. Should only work if the user has provided the mandatory information
    document.querySelector("#create-album-btn").addEventListener("click", () => {
        var albumName = document.querySelector("#upload-album-name").value;
        if (document.querySelector("#grid-file-container").children.length !== 0 && albumName.length !== 0) {

            var fileSpans = document.querySelectorAll(".file-span");
            var formData = new FormData();
            fileSpans.forEach((file) => {
                var fileName = file.currentFile.name;
                var currentFile = file.currentFile;

                formData.append(fileName, currentFile);
            })

            // *** This is a way to print the formData entries. Regular console.log doesn't work.
            // for (var [key, value] of formData.entries()) {
            //     console.log(key, value)
            // }

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