
document.addEventListener('DOMContentLoaded',()=>{
  const monthFilter = document.getElementById('monthFilter');
  const searchInput = document.getElementById('searchInput');
  const grid = document.getElementById('eventsGrid');
  const cards = Array.from(document.querySelectorAll('.event-card-wrap'));
  const modalEl = document.getElementById('eventModal');
  const bsModal = new bootstrap.Modal(modalEl);

  // filter function
  function applyFilter(){
    const month = monthFilter.value.toLowerCase();
    const q = searchInput.value.trim().toLowerCase();
    cards.forEach(card=>{
      const cardMonth = card.dataset.month.toLowerCase();
      const district = card.dataset.district.toLowerCase();
      const title = card.querySelector('.card-title').textContent.toLowerCase();
      const matchesMonth = (month==='all' || cardMonth===month);
      const matchesQuery = (q==='') || title.includes(q) || district.includes(q) || cardMonth.includes(q);
      card.style.display = (matchesMonth && matchesQuery) ? '' : 'none';
    });
  }

  monthFilter.addEventListener('change',applyFilter);
  searchInput.addEventListener('input',debounce(applyFilter,220));

  // detail buttons
  document.querySelectorAll('.btn-detail').forEach(btn=>{
    btn.addEventListener('click',e=>{
      const id = parseInt(e.currentTarget.dataset.id,10);
      const ev = SAMPLE_EVENTS.find(x=>x.id===id);
      if(!ev) return;
      document.getElementById('modalTitle').textContent = ev.name;
      document.getElementById('modalImg').src = `assets/event-images/${ev.img}`;
      document.getElementById('modalImg').alt = ev.name;
      document.getElementById('modalMonth').textContent = ev.month;
      document.getElementById('modalDistrict').textContent = ev.district;
      document.getElementById('modalDesc').textContent = ev.desc;
      bsModal.show();
    });
  });

  // simple keyboard accessibility: open card on Enter
  document.querySelectorAll('.event-card').forEach(card=>{
    card.addEventListener('keydown',e=>{ if(e.key==='Enter') card.querySelector('.btn-detail').click(); });
  });

  // helper debounce
  function debounce(fn,ms=200){let t;return (...a)=>{clearTimeout(t);t=setTimeout(()=>fn(...a),ms);}};

  // nice stagger reveal on load
  window.requestAnimationFrame(()=>{
    cards.forEach((c,i)=>{ setTimeout(()=>c.querySelector('.event-card').classList.add('animate-card'), i*60); });
  });

});
