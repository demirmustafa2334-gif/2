<div class="container py-5">
  <h1 class="h2 mb-4">Fiyat Listesi</h1>
  <p class="mb-4">İlçe veya semt seçerek tahmini fiyatı görüntüleyin.</p>
  <form class="row g-3" id="priceCalc">
    <div class="col-md-4">
      <label class="form-label">Nereden</label>
      <input type="text" class="form-control" placeholder="Örn: Kadıköy">
    </div>
    <div class="col-md-4">
      <label class="form-label">Nereye</label>
      <input type="text" class="form-control" placeholder="Örn: Beşiktaş">
    </div>
    <div class="col-md-4 d-grid align-items-end">
      <button type="button" class="btn btn-primary">Fiyat Hesapla</button>
    </div>
  </form>
  <div class="mt-4" id="priceResult"></div>
</div>
