// Map real SVG path IDs to actual district names
const districtNames = {
    "LK11": "Colombo",
    "LK12": "Gampaha",
    "LK13": "Kalutara",
    "LK21": "Kandy",
    "LK22": "Matale",
    "LK23": "Nuwara Eliya",
    "LK31": "Galle",
    "LK32": "Matara",
    "LK33": "Hambantota",
    "LK41": "Jaffna",
    "LK42": "Kilinochchi",
    "LK43": "Mannar",
    "LK44": "Vavuniya",
    "LK45": "Mullaitivu",
    "LK51": "Batticaloa",
    "LK52": "Ampara",
    "LK53": "Trincomalee",
    "LK61": "Kurunegala",
    "LK62": "Puttalam",
    "LK71": "Anuradhapura",
    "LK72": "Polonnaruwa",
    "LK81": "Badulla",
    "LK82": "Monaragala",
    "LK91": "Ratnapura",
    "LK92": "Kegalle"
};

document.addEventListener('DOMContentLoaded', () => {
    const districts = document.querySelectorAll('#map-container path');
    const ghostTooltip = document.getElementById('ghost-tooltip');

    districts.forEach(d => {
        const districtId = d.id;
        const districtName = districtNames[districtId] || `Unknown (${districtId})`;

        // On click — you can call another function later
                d.addEventListener('click', () => {
            showPopup(districtName);
        });

        // Show tooltip on hover
        d.addEventListener('mouseenter', (e) => {
            ghostTooltip.textContent = districtName;
            ghostTooltip.classList.add('show');
            positionTooltip(e);
        });

        // Move tooltip with mouse
        d.addEventListener('mousemove', (e) => {
            positionTooltip(e);
        });

        // Hide tooltip on leave
        d.addEventListener('mouseleave', () => {
            ghostTooltip.classList.remove('show');
        });
    });

    function positionTooltip(e) {
        const x = e.clientX;
        const y = e.clientY;
        ghostTooltip.style.left = `${x + 20}px`;
        ghostTooltip.style.top = `${y - 40}px`;
    }
});

// District popup function
function showPopup(name) {
    const popup = document.getElementById('district-popup');
    const title = document.getElementById('popup-title');
    const desc = document.getElementById('popup-desc');

    title.textContent = name;
    desc.textContent = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae.";

    // === New: Shuffle gallery images each time popup shows ===
    shuffleGalleryImages();

    popup.classList.remove('hidden');
}

// Popup close button
document.getElementById('popup-close').addEventListener('click', () => {
    document.getElementById('district-popup').classList.add('hidden');
});

// District popup function
function showPopup(name) {
    const popup = document.getElementById('district-popup');
    const content = document.getElementById('popup-content');
    const title = document.getElementById('popup-title');
    const desc = document.getElementById('popup-desc');

    title.textContent = name;
    desc.textContent = "Lorem ipsum dolor sit amet...";

    // Reset animations
    content.classList.remove('closing', 'opening');

    // Show overlay
    popup.classList.add('visible');

    // Force reflow
    void content.offsetWidth;

    // Start opening animation
    content.classList.add('opening');

    // Shuffle images & start interval
    shuffleGalleryImages();
    startGalleryShuffleInterval();
}

document.getElementById('popup-close').addEventListener('click', () => {
    const popup = document.getElementById('district-popup');
    const content = document.getElementById('popup-content');

    // Remove opening class
    content.classList.remove('opening');

    // Force reflow
    void content.offsetWidth;

    // Start closing animation
    content.classList.add('closing');

    // After animation, hide popup & cleanup
    setTimeout(() => {
        popup.classList.remove('visible');
        content.classList.remove('closing');
        stopGalleryShuffleInterval();
    }, 400); // must match CSS animation time
});



// === Function to shuffle gallery images with animation ===
// === Keep track of last shuffled order ===
let lastShuffledOrder = [];

// === Derangement shuffle: no image keeps the same position ===
function shuffleGalleryImages() {
    const gallery = document.getElementById('popup-gallery');
    const images = Array.from(gallery.children);

    let newOrder = derangement(images, lastShuffledOrder);

    // Update last order
    lastShuffledOrder = newOrder;

    // Clear and re-add images with animations
    gallery.innerHTML = '';
    newOrder.forEach((img) => {
        img.style.animation = 'none';
        void img.offsetWidth;

        const animations = ['popscale', 'swingrotate', 'fadeinup', 'zoombounce', 'flipy', 'slideleft'];
        const animationName = animations[Math.floor(Math.random() * animations.length)];
        img.style.animation = `${animationName} 1s ease-in-out forwards`;

        gallery.appendChild(img);
    });
}

// === New helper: create derangement so no item stays at same index ===
function derangement(images, lastOrder) {
    const n = images.length;
    let result = images.slice();
    let tries = 0;

    do {
        result = images.slice().sort(() => Math.random() - 0.5);
        tries++;
        // Keep trying until no element stays in same position
    } while (result.some((img, idx) => lastOrder[idx] === img) && tries < 100);

    return result;
}

// === New helper: check if at least one image changed position ===
function isDifferentEnough(arr1, arr2) {
    if (arr1.length !== arr2.length) return true; // different length → OK
    // At least one item must be at a different index
    return arr1.some((el, idx) => el !== arr2[idx]);
}

// === New helper: compare two arrays ===
function arraysEqual(arr1, arr2) {
    if (arr1.length !== arr2.length) return false;
    return arr1.every((el, index) => el === arr2[index]);
}

// === New: variables to manage shuffle interval ===
let galleryShuffleTimer = null;

// === New: start interval to shuffle images every 3 seconds ===
function startGalleryShuffleInterval() {
    // Clear existing timer (if any)
    stopGalleryShuffleInterval();

    // Set new timer
    galleryShuffleTimer = setInterval(() => {
        shuffleGalleryImages();
    }, 3000); // change every 3 seconds
}

// === New: stop the shuffle interval ===
function stopGalleryShuffleInterval() {
    if (galleryShuffleTimer) {
        clearInterval(galleryShuffleTimer);
        galleryShuffleTimer = null;
    }
}