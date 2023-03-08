const deleteForms = document.querySelectorAll(".delete-form");
deleteForms.forEach((form) => {
    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const name = form.getAttribute("title");
        const confirm = window.confirm(
            `Sei sicuro di voler eliminare il progetto?`
        );
        if (confirm) form.submit();
    });
});
