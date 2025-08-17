/* ------------------------------------------------------------- */
// <!-- FILE: desti-view.js -->
// Page behaviour: desti-view.js
// Adds client-side filtering/sorting and modal details rendering.

document.addEventListener('DOMContentLoaded', function () {
  const cards = Array.from(document.querySelectorAll('.destination-card'));
  const searchInput = document.getElementById('searchInput');
  const regionSelect = document.getElementById('regionSelect');
  const difficultySelect = document.getElementById('difficultySelect');
  const activityButtons = Array.from(document.querySelectorAll('.activity-toggle'));
  const clearBtn = document.getElementById('clearFilters');
  const resultCount = document.getElementById('resultCount');
  const resultsGrid = document.getElementById('resultsGrid');
  let activeActivities = new Set();

  function normalize(s){ return String(s||'').toLowerCase(); }

  function cardMatches(card){
    const name = normalize(card.dataset.name);
    const region = normalize(card.dataset.region);
    const difficulty = normalize(card.dataset.difficulty);
    const activities = normalize(card.dataset.activities).split(',').map(a=>a.trim()).filter(Boolean);
    const text = (name + ' ' + activities.join(' ') + ' ' + (card.querySelector('.card-text')?.textContent||'')).toLowerCase();

    // search
    const searchVal = normalize(searchInput.value);
    if (searchVal && !text.includes(searchVal)) return false;

    // region
    if (regionSelect.value !== 'any' && region !== regionSelect.value) return false;

    // difficulty
    if (difficultySelect.value !== 'any' && difficulty !== difficultySelect.value) return false;

    // activities (all active activities must be present)
    for (let act of activeActivities){ if (!activities.includes(act)) return false; }

    return true;
  }

  function render(){
    let visible = 0;
    for (let c of cards){
      if (cardMatches(c)){
        c.style.display = '';
        c.classList.add('match');
        visible++;
      } else {
        c.style.display = 'none';
        c.classList.remove('match');
      }
    }
    resultCount.textContent = visible;
  }

  // toggle activity buttons
  activityButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const a = btn.dataset.activity;
      if (btn.classList.contains('active')){
        btn.classList.remove('active');
        activeActivities.delete(a);
      } else {
        btn.classList.add('active');
        activeActivities.add(a);
      }
      render();
    });
  });

  // inputs
  [searchInput, regionSelect, difficultySelect].forEach(el => el.addEventListener('input', render));

  // clear
  clearBtn.addEventListener('click', () => {
    searchInput.value = '';
    regionSelect.value = 'any';
    difficultySelect.value = 'any';
    activeActivities.clear();
    activityButtons.forEach(b => b.classList.remove('active'));
    render();
  });

  // details modal
  const modal = document.getElementById('detailModal');
  modal.addEventListener('show.bs.modal', function (ev) {
    const button = ev.relatedTarget; // button that triggered
    const card = button.closest('.destination-card');
    const name = card.dataset.name;
    const region = card.dataset.region;
    const difficulty = card.dataset.difficulty;
    const activities = card.dataset.activities;
    const duration = card.dataset.duration || 'N/A';
    const desc = card.querySelector('.card-text')?.textContent || '';

    const content = `\n      <div class=\"row\">\n        <div class=\"col-md-5\">\n          <img src=\"${card.querySelector('img')?.src}\" class=\"img-fluid rounded\" alt=\"${name}\">\n        </div>\n        <div class=\"col-md-7\">\n          <h3>${name}</h3>\n          <p class=\"small text-muted\">${desc}</p>\n          <p><strong>Region:</strong> ${region} &nbsp; • &nbsp; <strong>Difficulty:</strong> ${difficulty} &nbsp; • &nbsp; <strong>Duration:</strong> ${duration}</p>\n          <p><strong>Activities:</strong> ${activities.split(',').map(a=>a.trim()).filter(Boolean).join(', ')}</p>\n        </div>\n      </div>\n    `;

    modal.querySelector('#detailModalLabel').textContent = name;
    modal.querySelector('#modalContent').innerHTML = content;
    modal.querySelector('#modalMoreLink').href = '#'; // replace with real link when available
  });

  // basic sorting (name / difficulty)
  document.getElementById('sortName').addEventListener('click', () => {
    const sorted = cards.sort((a,b)=> a.dataset.name.localeCompare(b.dataset.name));
    sorted.forEach(c => resultsGrid.appendChild(c));
  });
  document.getElementById('sortDifficulty').addEventListener('click', () => {
    const rank = { 'easy': 0, 'moderate': 1, 'hard': 2 };
    const sorted = cards.sort((a,b)=> (rank[a.dataset.difficulty]||0) - (rank[b.dataset.difficulty]||0));
    sorted.forEach(c => resultsGrid.appendChild(c));
  });

  // initial render
  render();
});
