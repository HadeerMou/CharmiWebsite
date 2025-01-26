let cm = document.getElementById("cm");  // Link that toggles visibility
let comment = document.getElementsByClassName("comment"); // All rows to toggle visibility

cm.addEventListener('click', (event) => {
    event.preventDefault();  // Prevent default anchor behavior (optional)
    
    // Loop through each row and toggle visibility
    Array.from(comment).forEach(comment => {
        if (comment.style.display === "none") {
            comment.style.display = "flex";  // Show the row
        } else {
            comment.style.display = "none";  // Hide the row
        }
    });
});
