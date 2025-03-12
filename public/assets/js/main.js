// Left navbar, click toggle
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu_toggle");
    const navText = document.getElementById("nav_text");
    const body = document.body; // Adapte si ta navbar a une autre classe

    menuToggle.addEventListener("click", function () {
        body.classList.toggle("nav-collapsed"); // Supposons que la navbar a cette classe quand elle est réduite
        
        if (body.classList.contains("nav-collapsed")) {
            navText.style.display = "none"; // Cache le texte
        } else {
            navText.style.display = "inline"; // Affiche le texte
        }
    });
});

