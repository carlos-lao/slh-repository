const selection = window.getSelection(); // represents current cursor position

let tagDisplay = document.getElementById('tag-display'); // div that user can see and edit
let tagInput = document.getElementById('tag-input'); // textarea that sends PHP data

// event listener for when the user changes the content of tagDisplay
tagDisplay.addEventListener('input', () => {
    // get the current text content of tagDisplay
    const text = tagDisplay.textContent;
    // copy the content into tagInput
    tagInput.value = text;

    // update tag bubbles
    updateTagDisplay(text.split(','), true)
    
    // place cursor at the end of tagDisplay
    resetCursor();
});

tagDisplay.addEventListener('focus', () => { updateTagDisplay(tagInput.value.split(','), true) })

tagDisplay.addEventListener('blur', () => { updateTagDisplay(tagInput.value.split(','), tagInput.value.length === 0) })

const setUpEditMode = () => {
    if (tagInput.value.length !== 0) {
        updateTagDisplay(tagInput.value.split(','), false);
    }
}

// HELPER FUNCTIONS
// replaces the contents of tagDisplay with tag bubbles from the given array
// does not create a tag bubble for the last tag if leaveLast is true
const updateTagDisplay = (tags, leaveLast) => {
    // clear the contents of tagDisplay
    tagDisplay.innerHTML = '';

    // add all tags as tag bubbles except the last
    for (const tag of tags.slice(0,tags.length-1)) {
        addTagBubble(tag, true)
    }
    
    if (leaveLast) {
        // add the last tag as a text node
        tagDisplay.appendChild(document.createTextNode(tags[tags.length-1]))
    } else {
        // add the last tag as a tag bubble
        addTagBubble(tags[tags.length-1], false)
    }
}

// adds a new tag bubble with the specified text to the end of tagDisplay
// adds an invisible comma after the tag if withComma is true
const addTagBubble = (text, withComma) => {
    // Create a new span element for the tag
    const tagSpan = document.createElement('span');
    tagSpan.textContent = text;
    // Add the new span to the div
    tagDisplay.appendChild(tagSpan);

    if (withComma) {
        // Create an invisible comma
        const hiddenComma = document.createElement('b');
        hiddenComma.style.opacity = 0;
        hiddenComma.textContent = ',';
        tagDisplay.appendChild(hiddenComma)
    }
}

// moves cursor to the end of the contents of the tagDisplay div
const resetCursor = () => {
    // create range object to represent tagDisplay contents
    const range = document.createRange();
    range.selectNodeContents(tagDisplay);
    // collapse range to place cursor at the end of tagDisplay
    range.collapse(false);
    // get rid of cursor's current range and replace with created one
    selection.removeAllRanges();
    selection.addRange(range);
}