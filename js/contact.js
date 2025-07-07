// On page load: animate brand glow and add pulsing effect
document.addEventListener('DOMContentLoaded', () => {
  const brand = document.querySelector('.brand');
  
  // Initial glow
  brand.style.textShadow = '0 0 12px #00ffff, 0 0 25px #00ffff';
  
  // Add pulsing effect
  setInterval(() => {
    brand.style.textShadow = brand.style.textShadow === '0 0 12px #00ffff, 0 0 25px #00ffff'
      ? '0 0 8px #00ffff, 0 0 18px #00ffff'
      : '0 0 12px #00ffff, 0 0 25px #00ffff';
  }, 1200);
});