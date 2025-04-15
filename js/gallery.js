"use strict";

//
// This script adds all code samples, and put syntax highlighting.
//

const SPACES_REGEX = /^\s*/;

// Get each code block and highlight them.
let codeBlocks = document.querySelectorAll("code");
for (const codeBlock of codeBlocks) {
    // Target element.
    let target = document.getElementById(codeBlock.dataset.for);
    let indentedCode = target.innerHTML;

    // Count indentation.
    let indentSize = indentedCode.match(SPACES_REGEX)[0].length - 1;

    // Trim indentation.
    let code = "";
    for (const line of indentedCode.split("\n")) {
        code += `${line.substring(indentSize)}\n`;
    }
    code = code.trim();

    // Make highlighted code block.
    codeBlock.innerHTML = hljs.highlight(code, {language : "xml"}).value;
}

// Disable all forms.
const forms = document.querySelectorAll("form");
for(const form of forms) {
    form.addEventListener("submit", e => e.preventDefault());
}