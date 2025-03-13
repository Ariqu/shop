const root = document.documentElement;
const marqueeContent = document.querySelector(".marquee-content");
const marqueeContainer = document.querySelector(".marquee");

// Pobranie danych z CSS
const marqueeElementWidth = parseFloat(getComputedStyle(root).getPropertyValue("--marquee-element-width"));
const marqueeElementsDisplayed = parseInt(getComputedStyle(root).getPropertyValue("--marquee-elements-displayed"), 10);

// Ustawienie liczby elementów w marquee
root.style.setProperty("--marquee-elements", marqueeContent.children.length);

// Klonowanie elementów, aby uzyskać efekt ciągłości
for (let i = 0; i < marqueeElementsDisplayed; i++) {
  marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true));
}

// Funkcja do ustawienia prędkości animacji
function updateAnimationSpeed(speed) {
  marqueeContent.style.animationDuration = `${Math.max(1, speed)}s`;
}

// Ustawienie początkowej prędkości animacji
let animationSpeed = 10; // Domyślna prędkość
updateAnimationSpeed(animationSpeed);

// Funkcja do obsługi przewijania
function handleScroll(event) {
  const delta = event.deltaY;

  // Zmiana prędkości animacji w zależności od scrolla
  animationSpeed += delta * 0.05; // Dostosuj wartość, aby uzyskać odpowiednią reakcję na przewijanie
  animationSpeed = Math.max(1, animationSpeed); // Minimalna prędkość animacji
  updateAnimationSpeed(animationSpeed);
}

// Dodaj zdarzenia do kontenera
marqueeContainer.addEventListener('wheel', handleScroll);

marqueeContainer.addEventListener('mouseover', () => {
  marqueeContent.style.animationPlayState = 'paused';
});

marqueeContainer.addEventListener('mouseout', () => {
  marqueeContent.style.animationPlayState = 'running';
});
