let prLink = document.getElementById("prLink");  // Link that toggles visibility
let product = document.getElementsByClassName("pr"); // All rows to toggle visibility
let line = document.getElementById('hr');

prLink.addEventListener('click', (event) => {
    event.preventDefault();  // Prevent default anchor behavior (optional)
    
    // Loop through each row and toggle visibility
    Array.from(product).forEach(pr => {
        if (pr.style.display === "none") {
            pr.style.display = "flex";  // Show the row
        } else {
            pr.style.display = "none";  // Hide the row
        }
    });
    if (line.style.display === "none") {
        line.style.display = "block";  // Show the row
    } else {
        line.style.display = "none";  // Hide the row
    }
});
