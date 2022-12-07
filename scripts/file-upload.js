const dropzone = document.getElementById('upload');
const fileInput = document.getElementById('hidden-file-input');
const fileIndicatorsContainer = document.getElementById('file-indicators-container');
const files = [];

fileInput.addEventListener('change', () => {
    for (let i = 0; i < fileInput.files.length; i++) {
        const file = fileInput.files[i]
        if (!hasDuplicateFile(files, file)) {
            files.push(file)
            addFileIndicator(file, () => {
                files.splice(files.indexOf(file.name), 1);
                if (files.length === 0) {
                    fileIndicatorsContainer.hidden = true;
                }
            });
        } else {
            alert("Hmmm... It looks like you already added a file with that name. Make sure all of your files have unique names!")
        }     
    }
})

const dropHandler = (e) => {
    // console.log('File(s) dropped');
    // prevent file from being opened
    e.preventDefault();

    if (e.dataTransfer.items) {
        // use DataTransferItemList to access the file(s)
        [...e.dataTransfer.items].forEach((item, i) => {
            // reject non-file items
            if (item.kind === 'file') {
                // convert the item to a file
                const file = item.getAsFile();
                console.log(`attempting to add ${file.name}...`);

                if (!hasDuplicateFile(files, file)) {
                    files.push(file)
                    addFileIndicator(file, () => {
                        files.splice(files.indexOf(file.name), 1);
                        if (files.length === 0) {
                            fileIndicatorsContainer.hidden = true;
                        }
                    });
                } else {
                    alert("Hmmm... It looks like you already added a file with that name. Make sure all of your files have unique names!")
                }                
            }
        });
    }
    dropzone.classList.remove('hover');
}

const dragOverHandler = (e) => {
    // console.log('File(s) in drop zone');
    // prevent file from being opened
    e.preventDefault();
    
    if (!dropzone.classList.contains('hover')) {
        dropzone.classList.add('hover');
    }
}

const dragLeaveHandler = () => {
    dropzone.classList.remove('hover');
}

const browseFiles = (e) => {
    fileInput.click();
}

const uploadFiles = (e) => {
    console.log('hello')

    // populate the form data with the files to be uploaded
    const formData = new FormData();
    files.forEach((file) => {
        formData.append('files', file);
    });
    
    // send the POST request
    const xhttp = new XMLHttpRequest();
    xhttp.addEventListener("load", function() {
        alert("Files uploaded successfully!");
    });    

    xhttp.open('POST', 'upload-confirmation.php');
    xhttp.send(formData);
}

// HELPER FUNCTIONS

// creates a file indicator element for the provided file
// option to add additional delete functionality with onDelete
const addFileIndicator = (file, onDelete = () => {}) => {
    // make container div
    const container = document.createElement('div');
    container.classList.add('file-indicator');

    // create contents
    const text = document.createElement('p'); // filename text
    text.classList.add('filename-text');
    text.textContent = file.name;
    const icon = document.createElement('i'); // delete button
    icon.classList.add('bi', 'bi-x-circle-fill', 'fa-lg', 'delete-btn');
    icon.addEventListener('click', () => { // add functionality to delete button
        fileIndicatorsContainer.removeChild(container);
        onDelete(); // additional functionality you may want
    });

    // put contents in container
    container.appendChild(text);
    container.appendChild(icon);

    // show the indicator container if it's hidden
    if (fileIndicatorsContainer.hidden) { 
        fileIndicatorsContainer.hidden = false;
    }

    // add the new indicator to the container
    fileIndicatorsContainer.appendChild(container);
}

// checks if a copy of testFile is in allFiles
const hasDuplicateFile = (allFiles, testFile) => (
    allFiles.filter((file) => (
        file.lastModified === testFile.lastModified &&
        file.name === testFile.name &&
        file.size === testFile.size &&
        file.type === testFile.type 
    )).length !== 0
)