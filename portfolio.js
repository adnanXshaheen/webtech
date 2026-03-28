console.log("Adnan Portfolio Loaded");

const cards = document.querySelectorAll('.card');

cards.forEach(card => {
card.addEventListener('mouseover', () => {
card.style.transform = "scale(1.03)";
card.style.transition = "0.3s";
});

card.addEventListener('mouseout', () => {
card.style.transform = "scale(1)";
});
});


alert("Welcome to Adnan's Portfolio 🇧🇩");
