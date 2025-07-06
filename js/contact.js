// Just a small effect: animate brand text glow on load
document.addEventListener('DOMContentLoaded', () => {
  const brand = document.querySelector('.brand');
  brand.style.transition = 'text-shadow 1.5s ease-in-out';
  brand.style.textShadow = '0 0 10px #00ffff, 0 0 20px #00ffff';
});