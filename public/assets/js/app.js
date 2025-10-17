document.addEventListener('DOMContentLoaded',function(){
  const btn=document.querySelector('#priceCalc button');
  if(btn){btn.addEventListener('click',()=>{
    const res=document.getElementById('priceResult');
    if(res){res.innerHTML='<div class="alert alert-info">Örnek fiyat: 2499₺ – Admin paneli ile dinamik olacaktır.</div>'}
  })}
});