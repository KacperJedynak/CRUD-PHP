const maddinvis = ["#l-mod-id", "#mod-id", "#l-mod-tytul", "#mod-tytul"];
const mreminvis = ["#mod-dane", ".m-cof", "#mod-zmiana", "#mod-tresc", "#h-mod-n-dane", "#mod-n-dane"];
const napisy = ["#h-mod-id", "#h-mod-tytul", "#h-usun-id", "#h-usun-tytul"];
const dform = document.querySelector("#dodaj-form");
const dformch = dform.children;
const mform = document.querySelector("#modyfikuj-form");
const mformch = mform.children;
const uform = document.querySelector("#usun-form");
const uformch = uform.children;

const wylaczenie = (formularz) => {
    for (const element of formularz) {
        if (element instanceof HTMLInputElement || element instanceof HTMLButtonElement) {
            element.disabled = true;
        }
    }
}

dform.addEventListener("input", () => {
    wylaczenie(mformch);
    wylaczenie(uformch);
    document.querySelector(".d-cof").classList.remove("invis");
});

document.querySelector("#mod-id").addEventListener("change", () => {
    
    maddinvis.forEach((e) => {
        document.querySelector(e).classList.add("invis");
    });

    mreminvis.forEach((e) => {
        document.querySelector(e).classList.remove("invis");
    });
    document.querySelector("#h-mod-id").classList.remove("invis");

    wylaczenie(dformch);
    wylaczenie(uformch);
});

document.querySelector("#mod-tytul").addEventListener("change", () => {
    
    maddinvis.forEach((e) => {
        document.querySelector(e).classList.add("invis");
    });

    mreminvis.forEach((e) => {
        document.querySelector(e).classList.remove("invis");
    });
    document.querySelector("#h-mod-tytul").classList.remove("invis");

    wylaczenie(dformch);
    wylaczenie(uformch);
});

const uaddinvis = ["#l-usun-id", "#usun-id", "#l-usun-tytul", "#usun-tytul"];
const ureminvis = ["#usun-dane", ".u-cof"];

document.querySelector("#usun-id").addEventListener("change", () => {
    
    uaddinvis.forEach((e) => {
        document.querySelector(e).classList.add("invis");
    });

    ureminvis.forEach((e) => {
        document.querySelector(e).classList.remove("invis");
    });
    document.querySelector("#h-usun-id").classList.remove("invis");

    wylaczenie(dformch);
    wylaczenie(mformch);
});

document.querySelector("#usun-tytul").addEventListener("change", () => {
    
    uaddinvis.forEach((e) => {
        document.querySelector(e).classList.add("invis");
    });

    ureminvis.forEach((e) => {
        document.querySelector(e).classList.remove("invis");
    });
    document.querySelector("#h-usun-tytul").classList.remove("invis");

    wylaczenie(dformch);
    wylaczenie(mformch);
});

const puste = (form, formm) => {
    const texts = form.querySelectorAll("input[type=text]");
    
    for (const text of texts) {
        text.value = "";
    }

    const checkboxes = form.querySelectorAll("input[type=checkbox]");

    for (const checkbox of checkboxes) {
        checkbox.checked = false;
    }

    for (const element of formm) {
        if (element instanceof HTMLInputElement || element instanceof HTMLButtonElement) {
            element.disabled = false;
        }
    }
    
}

const cofnijbutton = document.querySelectorAll("#cofnij");

cofnijbutton.forEach((button) => {
    button.addEventListener("click", () => {
        puste(dform, dformch);
        puste(mform, mformch);
        puste(uform, uformch);

        maddinvis.forEach((e) => {
            document.querySelector(e).classList.remove("invis");
        });
    
        mreminvis.forEach((e) => {
            document.querySelector(e).classList.add("invis");
        });
    
        uaddinvis.forEach((e) => {
            document.querySelector(e).classList.remove("invis");
        });
    
        ureminvis.forEach((e) => {
            document.querySelector(e).classList.add("invis");
        });
        napisy.forEach((e) => {
            document.querySelector(e).classList.add("invis");
        });
        document.querySelector(".d-cof").classList.add("invis");
    });
});