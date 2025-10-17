<?php /** @var array $meta */ ?>
<section class="hero">
  <div>
    <h1>İstanbul Evden Eve Nakliyat</h1>
    <p>Profesyonel ekip, sigortalı taşıma, hızlı randevu. Kadıköy, Beşiktaş, Üsküdar ve tüm ilçelerde hizmet.</p>
    <div style="display:flex; gap:12px; flex-wrap:wrap;">
      <a class="btn" href="/contact">Teklif Al</a>
      <a class="btn" style="background:#e5e7eb; color:#111827;" href="/services">Hizmetler</a>
    </div>
  </div>
  <div class="card">
    <h3>Hızlı Fiyat Tahmini</h3>
    <form onsubmit="return false;" id="price-form">
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px;">
        <select id="fromId" required>
          <option value="" disabled selected>Çıkış İlçe</option>
          <option value="1">Kadıköy</option>
          <option value="2">Beşiktaş</option>
          <option value="3">Üsküdar</option>
        </select>
        <select id="toId" required>
          <option value="" disabled selected>Varış İlçe</option>
          <option value="1">Kadıköy</option>
          <option value="2">Beşiktaş</option>
          <option value="3">Üsküdar</option>
        </select>
      </div>
      <button class="btn" style="width:100%; margin-top:10px;" onclick="estimate()">Hesapla</button>
    </form>
    <div id="price-result" style="margin-top:8px; font-weight:700"></div>
  </div>
</section>
<section style="padding:20px 0;">
  <div class="grid">
    <div class="card">
      <h3>Sigortalı Taşıma</h3>
      <p>Eşyalarınız taşıma boyunca güvence altındadır.</p>
    </div>
    <div class="card">
      <h3>Deneyimli Ekip</h3>
      <p>Profesyonel personel ve modern ekipman.</p>
    </div>
    <div class="card">
      <h3>Uygun Fiyat</h3>
      <p>Şeffaf ve rekabetçi fiyat politikası.</p>
    </div>
  </div>
</section>
