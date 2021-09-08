require("./bootstrap");

$(".menu-icon").click(() => {
    $(".header-links").toggle("0.5s");
});

// resize page to full height
const resizeFullHeight = (className) => {
    /** @type {HTMLElement} */
    const header = document.querySelector("header");
    /** @type {HTMLElement} */
    const footer = document.querySelector("footer");
    /** @type {HTMLElement} */
    const main = document.querySelector(`.${className}`);

    const mainHeight =
        window.innerHeight - (header.clientHeight + footer.clientHeight);

    main.style.minHeight = `${mainHeight}px`;
};
