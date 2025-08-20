/* ------------------------------------------------------------- */
/* FILE: desti-view.js */
// Page behaviour: desti-view.js
// Adds client-side filtering/sorting, modal details rendering, favorites, saved filters, counts, share links.

document.addEventListener('DOMContentLoaded', function () {
  const cards = Array.from(document.querySelectorAll('.destination-card'));
  const searchInput = document.getElementById('searchInput');
  const regionSelect = document.getElementById('regionSelect');
  const difficultySelect = document.getElementById('difficultySelect');
  const activityButtons = Array.from(document.querySelectorAll('.activity-toggle'));
  const clearBtn = document.getElementById('clearFilters');
  const saveBtn = document.getElementById('saveFilters');
  const resultCount = document.getElementById('resultCount');
  const resultsGrid = document.getElementById('resultsGrid');
  let activeActivities = new Set();

  const storageKey = 'explorelanka.filters.v1';
  const favKey = 'explorelanka.favs.v1';

  // read URL params to prefill filters (shareable links)
  function readParams(){
    const p = new URLSearchParams(window.location.search);
    if (p.get('q')) searchInput.value = p.get('q');
    if (p.get('region')) regionSelect.value = p.get('region');
    if (p.get('difficulty')) difficultySelect.value = p.get('difficulty');
    if (p.get('activities')){
      p.get('activities').split(',').forEach(a=>{
        const btn = activityButtons.find(b=>b.dataset.activity===a);
        if (btn){ btn.classList.add('active'); activeActivities.add(a); }
      });
    }
  }

  // apply saved filters from localStorage
  function loadSaved(){
    try{
      const saved = JSON.parse(localStorage.getItem(storageKey) || 'null');
      if (saved){
        searchInput.value = saved.q || '';
        regionSelect.value = saved.region || 'any';
        difficultySelect.value = saved.difficulty || 'any';
        (saved.activities || []).forEach(a=>{
          const btn = activityButtons.find(b=>b.dataset.activity===a);
          if (btn){ btn.classList.add('active'); activeActivities.add(a); }
        });
      }
    }catch(e){ console.warn('Could not load saved filters', e); }
  }

  // save filters
  saveBtn.addEventListener('click', ()=>{
    const payload = { q: searchInput.value, region: regionSelect.value, difficulty: difficultySelect.value, activities: Array.from(activeActivities) };
    localStorage.setItem(storageKey, JSON.stringify(payload));
    // tiny UI feedback
    saveBtn.textContent = 'Saved';
    setTimeout(()=> saveBtn.textContent = 'Save', 1500);
  });

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
    updateActivityCounts();
  }

  // update small counts on activity buttons so user knows how many results per activity
  function updateActivityCounts(){
    activityButtons.forEach(btn => {
      const activity = btn.dataset.activity;
      let count = 0;
      for (let c of cards){
        const acts = (c.dataset.activities||'').toLowerCase().split(',').map(x=>x.trim());
        if (acts.includes(activity)) count++;
      }
      btn.querySelector('.activity-count').textContent = count;
    });
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

  // Favorites
  function loadFavs(){
    try{ return new Set(JSON.parse(localStorage.getItem(favKey) || '[]')); }catch(e){ return new Set(); }
  }
  function saveFavs(set){ localStorage.setItem(favKey, JSON.stringify(Array.from(set))); }
  const favs = loadFavs();
  document.querySelectorAll('.btn-fav').forEach(btn => {
    const card = btn.closest('.destination-card');
    const id = card.dataset.name;
    if (favs.has(id)) btn.textContent = '♥';
    btn.addEventListener('click', ()=>{
      if (favs.has(id)){ favs.delete(id); btn.textContent = '♡'; }
      else { favs.add(id); btn.textContent = '♥'; }
      saveFavs(favs);
    });
  });

  // details modal
  const modal = document.getElementById('detailModal');
  let map; let mapMarker;
  modal.addEventListener('show.bs.modal', function (ev) {
    const button = ev.relatedTarget; // button that triggered
    const card = button.closest('.destination-card');
    const name = card.dataset.name;
    const region = card.dataset.region;
    const difficulty = card.dataset.difficulty;
    const activities = card.dataset.activities;
    const duration = card.dataset.duration || 'N/A';
    const desc = card.querySelector('.card-text')?.textContent || '';
    const img = card.querySelector('img')?.src || '';
    const lat = parseFloat(card.dataset.lat || '');
    const lng = parseFloat(card.dataset.lng || '');

    const content = `
      <div class=\"row\">
        <div class=\"col-md-5\">
          <img src=\"${img}\" class=\"img-fluid rounded\" alt=\"${name}\">
        </div>
        <div class=\"col-md-7\">
          <h3>${name}</h3>
          <p class=\"small text-muted\">${desc}</p>
          <p><strong>Region:</strong> ${region} &nbsp; • &nbsp; <strong>Difficulty:</strong> ${difficulty} &nbsp; • &nbsp; <strong>Duration:</strong> ${duration}</p>
          <p><strong>Activities:</strong> ${activities.split(',').map(a=>a.trim()).filter(Boolean).join(', ')}</p>
        </div>
      </div>
    `;

    modal.querySelector('#detailModalLabel').textContent = name;
    modal.querySelector('#modalContent').innerHTML = content;
    modal.querySelector('#modalMoreLink').href = '#'; // replace with real link when available

    // show small map if coordinates present
    const mapEl = document.getElementById('modalMap');
    if (!isNaN(lat) && !isNaN(lng)){
      mapEl.style.display = 'block';
      setTimeout(()=>{
        if (!map){
          map = L.map('modalMap', { scrollWheelZoom: false }).setView([lat, lng], 10);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '' }).addTo(map);
          mapMarker = L.marker([lat, lng]).addTo(map);
        } else {
          map.invalidateSize();
          map.setView([lat, lng], 10);
          if (mapMarker) mapMarker.setLatLng([lat, lng]);
        }
      }, 200);
    } else {
      mapEl.style.display = 'none';
    }

    // wire copy link button
    document.getElementById('copyLinkBtn').onclick = function (){
      const params = new URLSearchParams();
      params.set('q', searchInput.value || '');
      params.set('region', regionSelect.value || 'any');
      params.set('difficulty', difficultySelect.value || 'any');
      if (activeActivities.size) params.set('activities', Array.from(activeActivities).join(','));
      params.set('dest', name);
      const url = window.location.origin + window.location.pathname + '?' + params.toString();
      navigator.clipboard.writeText(url).then(()=>{
        this.textContent = 'Copied';
        setTimeout(()=> this.textContent = 'Copy link', 1200);
      });
    };
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

  // keyboard shortcut: press / to focus search
  document.addEventListener('keydown', (e)=>{
    if (e.key === '/'){
      if (document.activeElement !== searchInput){
        e.preventDefault(); searchInput.focus();
      }
    }
  });

  // initialize: load from URL or storage
  readParams();
  loadSaved();
  render();
  updateActivityCounts();

});
