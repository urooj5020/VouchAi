import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

const root = document.documentElement;
const sunIcon = `
    <path d="M12 2.75a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 12 2.75Zm0 16.5a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5a.75.75 0 0 1 .75-.75ZM4.93 4.93a.75.75 0 0 1 1.06 0l1.06 1.06a.75.75 0 1 1-1.06 1.06L4.93 6a.75.75 0 0 1 0-1.06Zm12.14 12.14a.75.75 0 0 1 1.06 0l1.06 1.06a.75.75 0 1 1-1.06 1.06l-1.06-1.06a.75.75 0 0 1 0-1.06ZM2.75 12a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 2.75 12Zm16.5 0a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm-12.14-7.07a.75.75 0 0 1 0 1.06L6.05 7.06A.75.75 0 0 1 4.99 6l1.06-1.06a.75.75 0 0 1 1.06 0Zm12.14 12.14a.75.75 0 0 1 0 1.06L18.19 18.2a.75.75 0 0 1-1.06-1.06l1.06-1.06a.75.75 0 0 1 1.06 0ZM12 7.25A4.75 4.75 0 1 1 12 16.75A4.75 4.75 0 0 1 12 7.25Z"/>
`;
const moonIcon = `
    <path d="M20.42 15.58A8.75 8.75 0 0 1 8.42 3.58a.75.75 0 0 0-.98-.98A9.5 9.5 0 1 0 21.4 16.56a.75.75 0 0 0-.98-.98Z"/>
`;

const applyTheme = (theme) => {
    if (theme === "dark") {
        root.classList.add("dark");
    } else {
        root.classList.remove("dark");
    }

    document.querySelectorAll("[data-theme-toggle]").forEach((button) => {
        const icon = button.querySelector("[data-theme-icon]");
        if (icon) {
            icon.innerHTML = root.classList.contains("dark")
                ? sunIcon
                : moonIcon;
        }
    });
};

const savedTheme = localStorage.getItem("theme");
const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;

applyTheme(
    savedTheme === "dark" || (!savedTheme && prefersDark) ? "dark" : "light",
);

window.toggleTheme = () => {
    const nextTheme = root.classList.contains("dark") ? "light" : "dark";
    applyTheme(nextTheme);
    localStorage.setItem("theme", nextTheme);
};

document.querySelectorAll("[data-theme-toggle]").forEach((button) => {
    button.addEventListener("click", () => {
        window.toggleTheme();
    });
});

Alpine.start();
