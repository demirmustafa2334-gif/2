'use strict';
function estimate(){
  const fromSel = document.getElementById('fromId');
  const toSel = document.getElementById('toId');
  if(!fromSel || !toSel) return;
  const from = fromSel.value;
  const to = toSel.value;
  fetch(`/api/estimate?from=${encodeURIComponent(from)}&to=${encodeURIComponent(to)}&variant=home`)
    .then(r=>r.json())
    .then(d=>{
      const el = document.getElementById('price-result');
      if(!el) return;
      el.textContent = d.estimated ? `Tahmini Fiyat: ₺${d.estimated}` : 'Fiyat bulunamadı';
    })
    .catch(()=>{});
}
