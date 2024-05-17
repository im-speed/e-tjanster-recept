document.querySelectorAll(".textarea-auto").forEach((textarea) => {
    textarea.addEventListener("input", () => {
        textarea.style.height = "auto";
        textarea.style.height = textarea.scrollHeight + "px";
    });
});
