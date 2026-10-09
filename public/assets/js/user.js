window.document.getElementById("users").style.display = "none";
changePage(false)

document.querySelectorAll('tr.editzone').forEach(tr => {
    tr.style.display = 'none';
});

document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function () {
        const email = this.closest('tr').id;
        doEdit(email, true);
    });
});

document.querySelectorAll('.valid-button').forEach(button => {
    button.addEventListener('click', function () {
        const email = this.closest('tr').id;
        doEdit(email, false);
    });
});

document.querySelectorAll('.reset-button').forEach(button => {
    button.addEventListener('click', function () {
        const email = this.closest('tr').id;
        doEdit(email, false);
    });
});

function doEdit(email, edit) {
    const new_email = CSS.escape(email); // Échappe les caractères spéciaux
    let editzone = document.querySelector(`tr#${new_email}.editzone`); // Utilise template literal
    let normalzone = document.getElementById(email);
    console.log(edit); // Affiche l'élément (ou null si non trouvé)

    normalzone.style.display = edit ? 'none' : '';
    editzone.style.display = edit ? '' : 'none';

}

function changePage(page) {

    const waiters = document.getElementById("waiters");
    const users = document.getElementById("users");
    const page1 = document.getElementById("page1");
    const page2 = document.getElementById("page2");

    waiters.style.display = page ? "none" : "block";
    users.style.display = page ? "block" : "none";

    page1.classList.toggle("bg-[#DB9ECF]", page);
    page1.classList.toggle("bg-white", !page);
    page1.classList.toggle("text-white", page);
    page1.classList.toggle("text-[#DB9ECF]", !page);

    page2.classList.toggle("bg-[#DB9ECF]", !page);
    page2.classList.toggle("bg-white", page);
    page2.classList.toggle("text-white", !page);
    page2.classList.toggle("text-[#DB9ECF]", page);
}