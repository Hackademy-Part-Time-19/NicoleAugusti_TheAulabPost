// Get the current year
const currentYear = new Date().getFullYear();

// Find the element with the ID "yearUpdate"
const yearSpan = document.getElementById("yearUpdate");

// Set the content of the span to the current year
yearSpan.textContent = currentYear;
