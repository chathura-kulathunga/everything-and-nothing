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
            console.log(`You clicked: ${districtName}`);
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