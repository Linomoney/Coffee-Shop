<x-filament-panels::page>
@assets
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
/* ─── ROOT TOKENS ──────────────────────────────────────────── */
:root {
  --espresso: #2C1810;
  --roast:    #6F4E37;
  --caramel:  #C4A882;
  --cream:    #F5EFE6;
  --foam:     #FBF7F2;
  --gold:     #D4A843;
  --surface:  rgba(255,255,255,0.04);
  --border:   rgba(255,255,255,0.09);
  --r-sm: 10px;
  --r-md: 14px;
  --r-lg: 20px;
  --r-xl: 24px;
}

/* ─── LAYOUT ───────────────────────────────────────────────── */
.kasir-wrap {
  display: flex;
  gap: 20px;
  height: calc(100vh - 120px);
  min-height: 600px;
  font-family: 'DM Sans', sans-serif;
  position: relative;
}

/* ─── LEFT PANEL ───────────────────────────────────────────── */
.kasir-menu-panel {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 14px;
  overflow: hidden;
  min-width: 0;
}

/* Search */
.kasir-search { position: relative; }
.kasir-search input {
  width: 100%;
  padding: 12px 18px 12px 46px;
  border-radius: var(--r-lg);
  border: 1.5px solid var(--border);
  background: var(--surface);
  color: inherit;
  font-size: 14px;
  font-family: 'DM Sans', sans-serif;
  outline: none;
  box-sizing: border-box;
  transition: border-color .2s, box-shadow .2s;
  letter-spacing: 0.01em;
}
.kasir-search input:focus {
  border-color: var(--roast);
  box-shadow: 0 0 0 3px rgba(111,78,55,0.18);
}
.kasir-search input::placeholder { color: rgba(255,255,255,0.3); }
.kasir-search .ico {
  position: absolute; left: 16px; top: 50%;
  transform: translateY(-50%);
  font-size: 17px; opacity: .5;
  pointer-events: none;
}

/* Category Tabs */
.kat-tabs {
  display: flex; gap: 8px;
  overflow-x: auto; padding-bottom: 4px;
  scrollbar-width: none;
}
.kat-tabs::-webkit-scrollbar { display: none; }
.kat-btn {
  flex-shrink: 0;
  padding: 7px 18px;
  border-radius: 999px;
  font-size: 12.5px;
  font-weight: 500;
  font-family: 'DM Sans', sans-serif;
  cursor: pointer;
  border: 1.5px solid var(--border);
  background: transparent;
  color: inherit;
  transition: all .2s;
  white-space: nowrap;
  letter-spacing: 0.02em;
}
.kat-btn:hover { border-color: var(--caramel); color: var(--caramel); }
.kat-btn.aktif {
  background: linear-gradient(135deg, var(--roast), #9B6B4A);
  border-color: transparent;
  color: #fff;
  box-shadow: 0 4px 14px rgba(111,78,55,0.45);
}

/* Menu Grid */
.menu-grid {
  flex: 1;
  overflow-y: auto;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  gap: 14px;
  padding-right: 6px;
  padding-bottom: 8px;
  scrollbar-width: thin;
  scrollbar-color: var(--roast) transparent;
  align-content: start;
}

/* Menu Card */
.menu-card {
  background: var(--surface);
  border: 1.5px solid var(--border);
  border-radius: var(--r-lg);
  overflow: hidden;
  cursor: pointer;
  transition: all .25s cubic-bezier(.34,1.56,.64,1);
  display: flex;
  flex-direction: column;
  position: relative;
}
.menu-card:hover {
  transform: translateY(-4px) scale(1.01);
  box-shadow: 0 16px 40px rgba(0,0,0,0.35);
  border-color: var(--roast);
}
.menu-card.habis { opacity: .55; pointer-events: none; }

.menu-card-img {
  height: 115px;
  background: linear-gradient(145deg, #2a1a10, #5a3522);
  display: flex; align-items: center; justify-content: center;
  font-size: 36px;
  position: relative; overflow: hidden;
}
.menu-card-img img { width: 100%; height: 100%; object-fit: cover; }
.menu-card-img::after {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, transparent 60%);
}

.badge-status {
  position: absolute; top: 8px; right: 8px;
  font-size: 10px; font-weight: 700;
  padding: 3px 9px; border-radius: 999px;
  letter-spacing: 0.04em;
  z-index: 1;
  backdrop-filter: blur(6px);
}
.badge-tersedia { background: rgba(34,197,94,0.9); color: #fff; }
.badge-habis    { background: rgba(239,68,68,0.9);  color: #fff; }

.menu-card-body {
  padding: 12px;
  display: flex;
  flex-direction: column;
  flex: 1;
}
.menu-card-nama {
  font-weight: 600;
  font-size: 13.5px;
  margin: 0 0 2px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  letter-spacing: 0.01em;
}
.menu-card-kat {
  font-size: 11px;
  color: var(--caramel);
  margin: 0 0 5px;
  font-weight: 500;
  letter-spacing: 0.04em;
  text-transform: uppercase;
}
.menu-card-desc {
  font-size: 11.5px;
  color: rgba(255,255,255,0.4);
  margin-bottom: 10px;
  line-height: 1.5;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  flex: 1;
}
.menu-card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: auto;
}
.menu-harga {
  font-weight: 700;
  font-size: 13px;
  color: var(--caramel);
  font-family: 'DM Mono', monospace;
}
.btn-plus {
  width: 30px; height: 30px;
  background: linear-gradient(135deg, var(--roast), #9B6B4A);
  color: #fff;
  border: none;
  border-radius: 9px;
  font-size: 20px; line-height: 1;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: all .2s;
  box-shadow: 0 3px 10px rgba(111,78,55,0.4);
  flex-shrink: 0;
}
.btn-plus:hover { transform: scale(1.1); box-shadow: 0 5px 16px rgba(111,78,55,0.55); }

/* ─── RIGHT PANEL: CART ────────────────────────────────────── */
.kasir-cart-panel {
  width: 330px;
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  background: rgba(20,12,8,0.6);
  border-radius: var(--r-xl);
  border: 1.5px solid var(--border);
  overflow: hidden;
  backdrop-filter: blur(20px);
  box-shadow: 0 24px 60px rgba(0,0,0,0.4);
  transition: transform .3s cubic-bezier(.4,0,.2,1), box-shadow .3s;
}

.cart-header {
  padding: 16px 18px;
  display: flex; align-items: center; justify-content: space-between;
  border-bottom: 1px solid var(--border);
  background: rgba(111,78,55,0.15);
  flex-shrink: 0;
}
.cart-header-left {
  display: flex; align-items: center; gap: 10px;
}
.cart-title-text {
  font-family: 'Playfair Display', serif;
  font-size: 17px;
  font-weight: 700;
  letter-spacing: 0.02em;
}
.cart-badge {
  background: var(--gold);
  color: #fff;
  font-size: 10px;
  font-weight: 800;
  min-width: 20px; height: 20px;
  border-radius: 999px;
  display: inline-flex;
  align-items: center; justify-content: center;
  padding: 0 5px;
  font-family: 'DM Mono', monospace;
}
.btn-kosongkan {
  font-size: 11.5px;
  opacity: .6;
  background: none; border: none;
  color: inherit; cursor: pointer;
  letter-spacing: 0.03em;
  transition: opacity .2s;
  padding: 4px 8px;
  border-radius: 6px;
}
.btn-kosongkan:hover { opacity: 1; background: rgba(239,68,68,0.15); color: #ef4444; }

/* Cart Fields */
.cart-fields {
  padding: 14px 16px;
  border-bottom: 1px solid var(--border);
  display: flex; flex-direction: column; gap: 10px;
  flex-shrink: 0;
}
.field-label {
  font-size: 10.5px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: rgba(255,255,255,0.35);
  margin-bottom: 5px;
}
.field-input {
  width: 100%;
  padding: 9px 12px;
  border-radius: var(--r-sm);
  border: 1.5px solid var(--border);
  background: rgba(255,255,255,0.05);
  color: inherit;
  font-size: 13px;
  font-family: 'DM Sans', sans-serif;
  outline: none;
  box-sizing: border-box;
  transition: border-color .2s, box-shadow .2s;
}
.field-input:focus { border-color: var(--roast); box-shadow: 0 0 0 3px rgba(111,78,55,0.18); }

.bayar-grid {
  display: grid;
  grid-template-columns: repeat(3,1fr);
  gap: 7px;
}
.bayar-btn {
  padding: 8px 4px;
  border-radius: var(--r-sm);
  border: 1.5px solid var(--border);
  background: rgba(255,255,255,0.04);
  color: inherit;
  font-size: 11.5px;
  font-weight: 500;
  font-family: 'DM Sans', sans-serif;
  cursor: pointer;
  transition: all .2s;
  text-align: center;
  letter-spacing: 0.02em;
}
.bayar-btn:hover { border-color: var(--caramel); color: var(--caramel); }
.bayar-btn.aktif {
  background: linear-gradient(135deg, var(--roast), #9B6B4A);
  border-color: transparent;
  color: #fff;
  box-shadow: 0 4px 12px rgba(111,78,55,0.4);
}

/* Cart Items */
.cart-items {
  flex: 1;
  overflow-y: auto;
  padding: 10px 14px;
  scrollbar-width: thin;
  scrollbar-color: rgba(111,78,55,0.4) transparent;
}

.cart-empty {
  height: 100%;
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  color: rgba(255,255,255,0.25);
  gap: 8px;
  font-size: 13px;
  padding: 20px;
  text-align: center;
}
.cart-empty-icon { font-size: 42px; opacity: .4; margin-bottom: 4px; }

.cart-item {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 11px 0;
  border-bottom: 1px solid var(--border);
  transition: background .15s;
}
.cart-item:last-child { border-bottom: none; }
.cart-item-info { flex: 1; min-width: 0; }
.cart-item-nama { font-weight: 600; font-size: 13px; margin-bottom: 2px; }
.cart-item-harga { font-size: 11.5px; color: rgba(255,255,255,0.4); font-family: 'DM Mono', monospace; }
.cart-item-note {
  width: 100%; margin-top: 6px;
  padding: 5px 9px;
  border-radius: 8px;
  border: 1px solid var(--border);
  background: rgba(255,255,255,0.04);
  color: inherit; font-size: 11px;
  font-family: 'DM Sans', sans-serif;
  outline: none; box-sizing: border-box;
  transition: border-color .2s;
}
.cart-item-note:focus { border-color: var(--roast); }
.cart-item-note::placeholder { color: rgba(255,255,255,0.25); }

.cart-item-ctrl {
  display: flex; flex-direction: column;
  align-items: flex-end; gap: 5px; flex-shrink: 0;
}
.qty-ctrl { display: flex; align-items: center; gap: 5px; }
.qty-btn {
  width: 26px; height: 26px;
  border-radius: 8px;
  border: 1.5px solid var(--border);
  background: rgba(255,255,255,0.06);
  color: inherit;
  font-size: 15px; font-weight: 600;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: all .15s;
}
.qty-btn:hover { border-color: rgba(255,255,255,0.25); background: rgba(255,255,255,0.12); }
.qty-btn.plus { background: var(--roast); border-color: transparent; color: #fff; }
.qty-btn.plus:hover { background: #5a3e2b; }
.qty-num {
  font-weight: 700; font-size: 13px;
  width: 22px; text-align: center;
  font-family: 'DM Mono', monospace;
}
.subtotal { font-weight: 700; font-size: 12px; color: var(--caramel); font-family: 'DM Mono', monospace; }
.btn-hapus {
  background: none; border: none;
  color: rgba(239,68,68,0.5); cursor: pointer;
  font-size: 13px; padding: 0;
  transition: color .2s;
}
.btn-hapus:hover { color: #ef4444; }

/* Cart Footer */
.cart-footer {
  padding: 16px;
  border-top: 1px solid var(--border);
  background: rgba(0,0,0,0.25);
  flex-shrink: 0;
}
.total-row {
  display: flex; justify-content: space-between; align-items: baseline;
  margin-bottom: 14px;
}
.total-label { font-size: 12px; color: rgba(255,255,255,0.4); letter-spacing: 0.06em; text-transform: uppercase; font-weight: 600; }
.total-nominal {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 700;
  color: var(--caramel);
  letter-spacing: 0.01em;
}
.btn-checkout {
  width: 100%; padding: 14px;
  background: linear-gradient(135deg, var(--roast) 0%, #9B6B4A 100%);
  color: #fff;
  border: none;
  border-radius: var(--r-md);
  font-size: 14.5px;
  font-weight: 700;
  font-family: 'DM Sans', sans-serif;
  cursor: pointer;
  transition: all .25s;
  box-shadow: 0 6px 20px rgba(111,78,55,0.45);
  letter-spacing: 0.04em;
  position: relative; overflow: hidden;
}
.btn-checkout::before {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
  opacity: 0; transition: opacity .2s;
}
.btn-checkout:hover::before { opacity: 1; }
.btn-checkout:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(111,78,55,0.55); }
.btn-checkout:disabled { opacity: .5; cursor: not-allowed; transform: none; box-shadow: none; }

/* ─── MOBILE CART TOGGLE BUTTON ────────────────────────────── */
.cart-fab {
  display: none;
  position: fixed;
  bottom: 24px;
  right: 20px;
  z-index: 500;
  width: 60px; height: 60px;
  border-radius: 999px;
  background: linear-gradient(135deg, var(--roast), #9B6B4A);
  border: none;
  color: #fff;
  font-size: 24px;
  box-shadow: 0 8px 28px rgba(111,78,55,0.55);
  cursor: pointer;
  align-items: center; justify-content: center;
  transition: transform .2s, box-shadow .2s;
}
.cart-fab:hover { transform: scale(1.08); box-shadow: 0 12px 36px rgba(111,78,55,0.65); }
.cart-fab-badge {
  position: absolute;
  top: -4px; right: -4px;
  background: var(--gold);
  color: #fff;
  font-size: 10px; font-weight: 800;
  min-width: 20px; height: 20px;
  border-radius: 999px;
  display: flex; align-items: center; justify-content: center;
  padding: 0 5px;
  font-family: 'DM Mono', monospace;
  border: 2px solid rgba(20,12,8,0.8);
}

/* Cart drawer overlay (mobile) */
.cart-overlay-bg {
  display: none;
  position: fixed;
  inset: 0;
  z-index: 490;
  background: rgba(0,0,0,0.55);
  backdrop-filter: blur(4px);
}

/* ─── MODAL DETAIL MENU ────────────────────────────────────── */
.modal-overlay {
  position: fixed; inset: 0; z-index: 9999;
  display: flex; align-items: center; justify-content: center;
  background: rgba(0,0,0,0.75);
  backdrop-filter: blur(8px);
  animation: fadeIn .2s ease;
  padding: 16px;
  box-sizing: border-box;
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

.modal-box {
  background: #1a100a;
  border: 1.5px solid rgba(196,168,130,0.2);
  border-radius: var(--r-xl);
  width: 100%; max-width: 460px;
  overflow: hidden;
  box-shadow: 0 32px 80px rgba(0,0,0,0.7);
  animation: slideUp .25s cubic-bezier(.34,1.56,.64,1);
  max-height: calc(100vh - 32px);
  overflow-y: auto;
}
@keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

.modal-img {
  height: 200px;
  background: linear-gradient(145deg, #1a100a, var(--roast));
  display: flex; align-items: center; justify-content: center;
  font-size: 72px; position: relative; overflow: hidden;
  flex-shrink: 0;
}
.modal-img img { width: 100%; height: 100%; object-fit: cover; }
.modal-img-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, #1a100a 0%, transparent 55%);
}

.modal-body { padding: 20px 22px 22px; }
.modal-nama {
  font-family: 'Playfair Display', serif;
  font-size: 20px; font-weight: 700;
  margin-bottom: 8px;
  letter-spacing: 0.01em;
}
.modal-meta { display: flex; gap: 8px; align-items: center; margin-bottom: 12px; flex-wrap: wrap; }
.modal-kat {
  font-size: 11.5px;
  background: rgba(196,168,130,0.12);
  color: var(--caramel);
  padding: 4px 12px;
  border-radius: 999px;
  font-weight: 600;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  border: 1px solid rgba(196,168,130,0.2);
}
.modal-status { font-size: 11.5px; padding: 4px 12px; border-radius: 999px; font-weight: 600; }
.modal-desc { font-size: 14px; color: rgba(255,255,255,0.55); line-height: 1.75; margin-bottom: 16px; }
.modal-harga {
  font-family: 'Playfair Display', serif;
  font-size: 26px; font-weight: 700;
  color: var(--caramel);
  margin-bottom: 18px;
  letter-spacing: 0.01em;
}
.modal-actions { display: flex; gap: 10px; }
.btn-modal-add {
  flex: 1; padding: 13px;
  background: linear-gradient(135deg, var(--roast), #9B6B4A);
  color: #fff; border: none;
  border-radius: var(--r-md);
  font-size: 14px; font-weight: 700;
  font-family: 'DM Sans', sans-serif;
  cursor: pointer; transition: all .2s;
  box-shadow: 0 4px 14px rgba(111,78,55,0.4);
  letter-spacing: 0.03em;
}
.btn-modal-add:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(111,78,55,0.55); }
.btn-modal-close {
  padding: 13px 18px;
  border: 1.5px solid var(--border);
  background: transparent; color: inherit;
  border-radius: var(--r-md);
  font-size: 14px; font-family: 'DM Sans', sans-serif;
  cursor: pointer; transition: background .2s;
}
.btn-modal-close:hover { background: rgba(255,255,255,0.07); }

/* ─── STRUK / RECEIPT ──────────────────────────────────────── */
.struk-box {
  width: 100%; max-width: 370px;
  border-radius: var(--r-xl);
  overflow: hidden;
  box-shadow: 0 32px 80px rgba(0,0,0,0.6);
  animation: slideUp .25s cubic-bezier(.34,1.56,.64,1);
  max-height: calc(100vh - 32px);
  overflow-y: auto;
}

.struk-header {
  background: linear-gradient(135deg, var(--espresso) 0%, var(--roast) 100%);
  padding: 28px 24px 24px;
  text-align: center; color: #fff; position: relative;
}
.struk-header::after {
  content: '';
  position: absolute; bottom: -1px; left: 0; right: 0;
  height: 20px;
  background: var(--foam);
  clip-path: polygon(0 100%, 5% 0, 10% 100%, 15% 0, 20% 100%, 25% 0, 30% 100%, 35% 0, 40% 100%, 45% 0, 50% 100%, 55% 0, 60% 100%, 65% 0, 70% 100%, 75% 0, 80% 100%, 85% 0, 90% 100%, 95% 0, 100% 100%);
}

.struk-logo-icon { font-size: 36px; margin-bottom: 10px; display: block; }
.struk-brand {
  font-family: 'Playfair Display', serif;
  font-size: 22px; font-weight: 700;
  letter-spacing: 0.05em;
  text-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
.struk-tagline { font-size: 11px; opacity: .7; margin-top: 4px; letter-spacing: 0.1em; text-transform: uppercase; }

.struk-body {
  background: var(--foam);
  color: #1a100a;
  padding: 26px 22px 18px;
  font-family: 'DM Sans', sans-serif;
}

.struk-meta-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-bottom: 18px;
}
.struk-meta-item {
  background: #fff;
  border-radius: 10px;
  padding: 10px 12px;
  border: 1px solid rgba(196,168,130,0.25);
}
.struk-meta-label {
  font-size: 9.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: rgba(44,24,16,0.4);
  margin-bottom: 3px;
}
.struk-meta-val {
  font-size: 13px;
  font-weight: 700;
  color: var(--espresso);
  font-family: 'DM Mono', monospace;
}

.struk-divider {
  border: none;
  margin: 0 0 16px;
  border-top: 2px dashed rgba(196,168,130,0.4);
}

.struk-items-head {
  display: flex; justify-content: space-between;
  font-size: 9.5px; font-weight: 700;
  text-transform: uppercase; letter-spacing: 0.1em;
  color: rgba(44,24,16,0.4);
  margin-bottom: 8px;
}

.struk-item {
  display: flex; justify-content: space-between; align-items: flex-start;
  padding: 7px 0;
  border-bottom: 1px solid rgba(196,168,130,0.15);
  font-size: 13px;
}
.struk-item:last-of-type { border-bottom: none; }
.struk-item-left { flex: 1; }
.struk-item-name { font-weight: 600; color: var(--espresso); line-height: 1.3; }
.struk-item-qty { font-size: 11px; color: rgba(44,24,16,0.45); margin-top: 1px; font-family: 'DM Mono', monospace; }
.struk-item-note { font-size: 10.5px; color: rgba(44,24,16,0.4); font-style: italic; margin-top: 2px; }
.struk-item-price { font-weight: 700; color: var(--espresso); font-family: 'DM Mono', monospace; text-align: right; white-space: nowrap; }

.struk-total-section {
  background: linear-gradient(135deg, var(--espresso), var(--roast));
  border-radius: 14px;
  padding: 16px 18px;
  margin-top: 16px;
}
.struk-total-row {
  display: flex; justify-content: space-between;
  align-items: baseline;
  color: rgba(255,255,255,0.65);
  font-size: 12px;
  margin-bottom: 4px;
}
.struk-total-main {
  display: flex; justify-content: space-between; align-items: baseline;
  color: #fff;
  margin-top: 10px;
  padding-top: 10px;
  border-top: 1px solid rgba(255,255,255,0.2);
}
.struk-total-label { font-size: 11px; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; }
.struk-total-amount {
  font-family: 'Playfair Display', serif;
  font-size: 24px; font-weight: 700;
  color: var(--caramel);
}
.struk-bayar-pill {
  display: inline-flex; align-items: center; gap: 6px;
  margin-top: 12px;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.2);
  color: rgba(255,255,255,0.8);
  font-size: 11px; font-weight: 600;
  padding: 5px 12px; border-radius: 999px;
  letter-spacing: 0.06em; text-transform: uppercase;
}

.struk-thanks {
  text-align: center;
  color: rgba(44,24,16,0.45);
  font-size: 11px;
  margin-top: 16px;
  letter-spacing: 0.06em;
  font-style: italic;
}

.struk-footer {
  background: var(--foam);
  padding: 14px 22px 20px;
  display: flex; gap: 10px;
  border-top: 1px solid rgba(196,168,130,0.2);
}
.btn-print {
  flex: 1; padding: 12px;
  background: linear-gradient(135deg, var(--espresso), var(--roast));
  color: #fff; border: none;
  border-radius: var(--r-md);
  font-size: 13.5px; font-weight: 700;
  font-family: 'DM Sans', sans-serif;
  cursor: pointer; letter-spacing: 0.03em;
  transition: all .2s;
  box-shadow: 0 4px 14px rgba(44,24,16,0.3);
}
.btn-print:hover { transform: translateY(-1px); box-shadow: 0 8px 22px rgba(44,24,16,0.4); }
.btn-close-struk {
  flex: 1; padding: 12px;
  border: 1.5px solid rgba(196,168,130,0.4);
  background: transparent;
  color: var(--roast); border-radius: var(--r-md);
  font-size: 13.5px; font-weight: 700;
  font-family: 'DM Sans', sans-serif;
  cursor: pointer; letter-spacing: 0.03em;
  transition: background .2s;
}
.btn-close-struk:hover { background: rgba(196,168,130,0.1); }

/* Kosong state */
.kosong-state {
  grid-column: 1 / -1;
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  padding: 60px 20px;
  color: rgba(255,255,255,0.25);
  gap: 10px;
}
.kosong-state-icon { font-size: 52px; opacity: .35; }

/* ═══════════════════════════════════════════════════════════
   RESPONSIVE — TABLET (≤ 900px)
   ═══════════════════════════════════════════════════════════ */
@media (max-width: 900px) {
  .kasir-wrap {
    height: auto;
    min-height: unset;
    flex-direction: column;
    gap: 16px;
  }

  .kasir-menu-panel {
    /* Full height for menu on tablet; cart goes below */
    height: auto;
  }

  .menu-grid {
    max-height: 55vh;
    grid-template-columns: repeat(auto-fill, minmax(145px, 1fr));
    gap: 12px;
  }

  .kasir-cart-panel {
    width: 100%;
    max-height: 480px;
  }
}

/* ═══════════════════════════════════════════════════════════
   RESPONSIVE — MOBILE (≤ 640px)
   ═══════════════════════════════════════════════════════════ */
@media (max-width: 640px) {
  .kasir-wrap {
    gap: 12px;
    padding-bottom: 80px; /* Space for FAB */
  }

  /* Menu panel takes all space */
  .kasir-menu-panel {
    height: auto;
  }

  /* Search smaller */
  .kasir-search input {
    font-size: 13px;
    padding: 10px 16px 10px 42px;
  }

  /* Category tabs smaller */
  .kat-btn {
    font-size: 11.5px;
    padding: 6px 14px;
  }

  /* Menu grid: 2 cols always on phone */
  .menu-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    max-height: calc(100vh - 220px);
    padding-right: 2px;
  }

  .menu-card-img {
    height: 95px;
    font-size: 28px;
  }

  .menu-card-body { padding: 9px 10px; }
  .menu-card-nama { font-size: 12.5px; }
  .menu-card-kat  { font-size: 10px; }
  .menu-card-desc { display: none; } /* Hide desc on small screens */
  .menu-harga     { font-size: 12px; }
  .btn-plus       { width: 27px; height: 27px; font-size: 18px; border-radius: 8px; }

  /* Cart panel: off-canvas drawer from bottom */
  .kasir-cart-panel {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    width: 100%;
    max-height: 85vh;
    border-radius: var(--r-xl) var(--r-xl) 0 0;
    z-index: 500;
    transform: translateY(100%);
    transition: transform .35s cubic-bezier(.4,0,.2,1);
    box-shadow: 0 -16px 60px rgba(0,0,0,0.6);
  }

  /* Cart open state */
  .kasir-cart-panel.cart-open {
    transform: translateY(0);
  }

  /* Drag handle on cart */
  .kasir-cart-panel::before {
    content: '';
    display: block;
    width: 40px; height: 4px;
    background: rgba(255,255,255,0.2);
    border-radius: 2px;
    margin: 10px auto 0;
    flex-shrink: 0;
  }

  /* Overlay bg shown when cart open */
  .cart-overlay-bg.cart-open {
    display: block;
  }

  /* FAB shown on mobile */
  .cart-fab {
    display: flex;
  }

  /* Cart header: add close btn affordance */
  .cart-header {
    padding: 12px 16px;
  }

  .cart-fields {
    padding: 12px 14px;
    gap: 8px;
  }

  .total-nominal {
    font-size: 22px;
  }

  .cart-footer {
    padding: 12px 14px;
  }

  /* Struk modal full screen on mobile */
  .modal-overlay {
    align-items: flex-end;
    padding: 0;
  }

  .struk-box {
    max-width: 100%;
    border-radius: var(--r-xl) var(--r-xl) 0 0;
    max-height: 90vh;
  }

  .modal-box {
    max-width: 100%;
    border-radius: var(--r-xl) var(--r-xl) 0 0;
    margin: 0;
    max-height: 90vh;
  }

  .struk-header { padding: 20px 18px 18px; }
  .struk-body   { padding: 20px 16px 14px; }
  .struk-footer { padding: 12px 16px 16px; }
}

/* ═══════════════════════════════════════════════════════════
   RESPONSIVE — SMALL PHONE (≤ 380px)
   ═══════════════════════════════════════════════════════════ */
@media (max-width: 380px) {
  .menu-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
  }

  .menu-card-img { height: 80px; font-size: 24px; }
  .menu-card-body { padding: 8px; }
  .menu-card-nama { font-size: 11.5px; }
  .menu-harga     { font-size: 11px; }
  .btn-plus       { width: 24px; height: 24px; font-size: 16px; border-radius: 7px; }

  .bayar-grid { grid-template-columns: repeat(3,1fr); gap: 5px; }
  .bayar-btn  { font-size: 10.5px; padding: 7px 2px; }

  .total-nominal { font-size: 20px; }
}

/* ─── PRINT STYLES ─────────────────────────────────────────── */
@media print {
  * {
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
  }

  html, body {
    width: 80mm !important;
    height: auto !important;
    margin: 0 !important; padding: 0 !important;
    background: white !important;
  }

  body * { visibility: hidden !important; }
  #struk-print, #struk-print * { visibility: visible !important; }

  #struk-print {
    position: fixed !important;
    top: 0 !important; left: 0 !important;
    width: 80mm !important;
  }

  #struk-print .modal-overlay {
    position: static !important;
    background: none !important;
    backdrop-filter: none !important;
    display: block !important;
    padding: 0 !important;
    animation: none !important;
  }

  .struk-box {
    width: 80mm !important;
    max-width: 80mm !important;
    margin: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    animation: none !important;
    overflow: visible !important;
    max-height: none !important;
  }

  .struk-header {
    background-color: #2C1810 !important;
    background-image: none !important;
    padding: 12px 10px 16px !important;
    color: #ffffff !important;
  }
  .struk-header::after { display: none !important; }
  .struk-brand {
    font-family: Georgia, 'Times New Roman', serif !important;
    font-size: 15px !important; font-weight: bold !important;
    color: #ffffff !important; text-shadow: none !important;
  }
  .struk-logo-icon { font-size: 22px !important; margin-bottom: 6px !important; color: #ffffff !important; }
  .struk-tagline { font-size: 8px !important; color: rgba(255,255,255,0.75) !important; margin-top: 2px !important; }

  .struk-body {
    background-color: #ffffff !important; background-image: none !important;
    padding: 12px 10px 8px !important;
    font-family: Arial, sans-serif !important; color: #1a100a !important;
  }
  .struk-meta-grid { gap: 5px !important; margin-bottom: 10px !important; }
  .struk-meta-item {
    background-color: #f7f0e8 !important; background-image: none !important;
    border: 1px solid #c8a87a !important; border-radius: 5px !important; padding: 6px 8px !important;
  }
  .struk-meta-label { font-size: 7.5px !important; color: #7a5a3a !important; font-family: Arial, sans-serif !important; }
  .struk-meta-val { font-size: 10.5px !important; color: #1a100a !important; font-family: 'Courier New', monospace !important; font-weight: bold !important; }
  .struk-divider { border: none !important; border-top: 1px dashed #b09070 !important; margin: 0 0 8px !important; }
  .struk-items-head { font-size: 7.5px !important; color: #7a5a3a !important; margin-bottom: 4px !important; font-family: Arial, sans-serif !important; }
  .struk-item { padding: 5px 0 !important; font-size: 11px !important; border-bottom: 1px solid #e0d0be !important; font-family: Arial, sans-serif !important; }
  .struk-item:last-of-type { border-bottom: none !important; }
  .struk-item-name { font-size: 11px !important; font-weight: bold !important; color: #1a100a !important; font-family: Arial, sans-serif !important; }
  .struk-item-qty { font-size: 9.5px !important; color: #7a5a3a !important; font-family: 'Courier New', monospace !important; }
  .struk-item-price { font-size: 11px !important; font-weight: bold !important; color: #1a100a !important; font-family: 'Courier New', monospace !important; }
  .struk-item-note { font-size: 9px !important; color: #9a7a5a !important; }
  .struk-total-section {
    background-color: #2C1810 !important; background-image: none !important;
    border-radius: 6px !important; padding: 10px 12px !important; margin-top: 10px !important;
  }
  .struk-total-main { margin-top: 8px !important; padding-top: 8px !important; border-top: 1px solid rgba(255,255,255,0.3) !important; }
  .struk-total-label { font-size: 9px !important; color: rgba(255,255,255,0.8) !important; font-family: Arial, sans-serif !important; }
  .struk-total-amount { font-family: Georgia, 'Times New Roman', serif !important; font-size: 20px !important; font-weight: bold !important; color: #C4A882 !important; }
  .struk-bayar-pill {
    font-size: 8.5px !important; padding: 3px 9px !important; margin-top: 8px !important;
    color: rgba(255,255,255,0.85) !important; border: 1px solid rgba(255,255,255,0.3) !important;
    background-color: rgba(255,255,255,0.1) !important; background-image: none !important;
    border-radius: 999px !important; display: inline-flex !important;
    font-family: Arial, sans-serif !important; font-weight: bold !important;
  }
  .struk-thanks { font-size: 9px !important; margin-top: 12px !important; color: #9a7a5a !important; font-family: Arial, sans-serif !important; }
  .struk-footer { display: none !important; }
  /* Hide FAB & overlay on print */
  .cart-fab, .cart-overlay-bg { display: none !important; }
}

@page { size: 80mm auto; margin: 0; }
</style>
@endassets

{{-- ═══════════════════════════════════════════════════════════ --}}
{{-- MODAL DETAIL MENU                                          --}}
{{-- ═══════════════════════════════════════════════════════════ --}}
@if($showDetail && $this->getDetailMenu())
@php $dm = $this->getDetailMenu(); @endphp
<div class="modal-overlay">
  <div class="modal-box">
    <div class="modal-img">
      @if($dm->gambar)
        <img src="{{ asset('storage/'.$dm->gambar) }}" alt="{{ $dm->nama }}">
      @else ☕ @endif
      <div class="modal-img-overlay"></div>
    </div>
    <div class="modal-body">
      <div class="modal-nama">{{ $dm->nama }}</div>
      <div class="modal-meta">
        <span class="modal-kat">{{ $dm->kategori->nama }}</span>
        <span class="modal-status {{ $dm->tersedia ? 'badge-tersedia' : 'badge-habis' }}">
          {{ $dm->tersedia ? '✅ Tersedia' : '❌ Habis' }}
        </span>
      </div>
      <div class="modal-harga">Rp {{ number_format($dm->harga, 0, ',', '.') }}</div>
      <p class="modal-desc">{{ $dm->keterangan ?: 'Tidak ada deskripsi untuk menu ini.' }}</p>
      <div class="modal-actions">
        @if($dm->tersedia)
        <button class="btn-modal-add" wire:click="tambahKeKeranjang({{ $dm->id }})">＋ Tambah ke Keranjang</button>
        @endif
        <button class="btn-modal-close" wire:click="tutupDetail">✕ Tutup</button>
      </div>
    </div>
  </div>
</div>
@endif

{{-- ═══════════════════════════════════════════════════════════ --}}
{{-- MODAL STRUK PEMBAYARAN                                     --}}
{{-- ═══════════════════════════════════════════════════════════ --}}
@if($showStruk && $strukData)
<div class="modal-overlay" id="struk-print">
  <div class="struk-box">

    <div class="struk-header">
      <span class="struk-logo-icon">☕</span>
      <div class="struk-brand">Kopi Nusantara</div>
      <div class="struk-tagline">Struk Pembayaran</div>
    </div>

    <div class="struk-body">

      <div class="struk-meta-grid">
        <div class="struk-meta-item">
          <div class="struk-meta-label">No. Order</div>
          <div class="struk-meta-val">{{ $strukData['kode'] }}</div>
        </div>
        <div class="struk-meta-item">
          <div class="struk-meta-label">Meja</div>
          <div class="struk-meta-val">{{ $strukData['meja'] }}</div>
        </div>
        <div class="struk-meta-item">
          <div class="struk-meta-label">Kasir</div>
          <div class="struk-meta-val">{{ $strukData['kasir'] }}</div>
        </div>
        <div class="struk-meta-item">
          <div class="struk-meta-label">Waktu</div>
          <div class="struk-meta-val" style="font-size:11px">{{ $strukData['waktu'] }}</div>
        </div>
      </div>

      <hr class="struk-divider">

      <div class="struk-items-head">
        <span>Item</span>
        <span>Subtotal</span>
      </div>

      @foreach($strukData['items'] as $item)
      <div class="struk-item">
        <div class="struk-item-left">
          <div class="struk-item-name">{{ $item['nama'] }}</div>
          <div class="struk-item-qty">{{ $item['jumlah'] }} × Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
          @if(!empty($item['catatan']))
          <div class="struk-item-note">↳ {{ $item['catatan'] }}</div>
          @endif
        </div>
        <div class="struk-item-price">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</div>
      </div>
      @endforeach

      <div class="struk-total-section">
        <div class="struk-total-main">
          <div>
            <div class="struk-total-label">Total Bayar</div>
            <div class="struk-bayar-pill">
              @if($strukData['cara_bayar'] === 'tunai') 💵
              @elseif($strukData['cara_bayar'] === 'qris') 📱
              @else 🏦 @endif
              {{ strtoupper($strukData['cara_bayar']) }}
            </div>
          </div>
          <div class="struk-total-amount">Rp {{ number_format($strukData['total'], 0, ',', '.') }}</div>
        </div>
      </div>

      <div class="struk-thanks">— Terima kasih telah berkunjung —</div>

    </div>

    <div class="struk-footer">
      <button class="btn-print" onclick="window.print()">🖨️ Print Struk</button>
      <button class="btn-close-struk" wire:click="tutupStruk">Tutup</button>
    </div>

  </div>
</div>
@endif

{{-- ═══════════════════════════════════════════════════════════ --}}
{{-- MOBILE: Cart Overlay Background                            --}}
{{-- ═══════════════════════════════════════════════════════════ --}}
<div class="cart-overlay-bg" id="cartOverlayBg" onclick="toggleCart(false)"></div>

{{-- ═══════════════════════════════════════════════════════════ --}}
{{-- MOBILE: Cart FAB                                           --}}
{{-- ═══════════════════════════════════════════════════════════ --}}
<button class="cart-fab" id="cartFab" onclick="toggleCart(true)" aria-label="Buka keranjang">
  🛒
  @if($this->getTotalKeranjang() > 0)
    <span class="cart-fab-badge" id="cartFabBadge">{{ $this->getTotalKeranjang() }}</span>
  @else
    <span class="cart-fab-badge" id="cartFabBadge" style="display:none">0</span>
  @endif
</button>

{{-- ═══════════════════════════════════════════════════════════ --}}
{{-- LAYOUT KASIR UTAMA                                         --}}
{{-- ═══════════════════════════════════════════════════════════ --}}
<div class="kasir-wrap">

  {{-- ── PANEL KIRI: MENU ──────────────────────────────────── --}}
  <div class="kasir-menu-panel">

    <div class="kasir-search">
      <span class="ico">🔍</span>
      <input wire:model.live.debounce.300ms="cariMenu"
             type="text"
             placeholder="Cari nama menu...">
    </div>

    <div class="kat-tabs">
      <button class="kat-btn {{ is_null($kategoriAktif) ? 'aktif' : '' }}" wire:click="setKategori(null)">
        Semua
      </button>
      @foreach($this->getKategoriList() as $kat)
      <button class="kat-btn {{ $kategoriAktif === $kat->id ? 'aktif' : '' }}" wire:click="setKategori({{ $kat->id }})">
        {{ $kat->nama }}
        <span style="opacity:.6;font-size:11px;margin-left:3px">({{ $kat->menu_count }})</span>
      </button>
      @endforeach
    </div>

    <div class="menu-grid">
      @forelse($this->getMenuList() as $menu)
      <div class="menu-card {{ !$menu->tersedia ? 'habis' : '' }}" wire:click="lihatDetail({{ $menu->id }})">
        <div class="menu-card-img">
          @if($menu->gambar)
            <img src="{{ asset('storage/'.$menu->gambar) }}" alt="{{ $menu->nama }}">
          @else ☕ @endif
          <span class="badge-status {{ $menu->tersedia ? 'badge-tersedia' : 'badge-habis' }}">
            {{ $menu->tersedia ? 'Tersedia' : 'Habis' }}
          </span>
        </div>
        <div class="menu-card-body">
          <p class="menu-card-nama">{{ $menu->nama }}</p>
          <p class="menu-card-kat">{{ $menu->kategori->nama }}</p>
          <p class="menu-card-desc">{{ Str::limit($menu->keterangan, 55) }}</p>
          <div class="menu-card-footer">
            <span class="menu-harga">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
            @if($menu->tersedia)
            <button class="btn-plus" wire:click.stop="tambahKeKeranjang({{ $menu->id }})" title="Tambah ke keranjang">+</button>
            @endif
          </div>
        </div>
      </div>
      @empty
      <div class="kosong-state">
        <div class="kosong-state-icon">☕</div>
        <p style="font-size:15px;font-weight:600;color:rgba(255,255,255,0.3)">Tidak ada menu ditemukan</p>
        <p style="font-size:12px;color:rgba(255,255,255,0.2)">Coba kata kunci lain</p>
      </div>
      @endforelse
    </div>

  </div>

  {{-- ── PANEL KANAN: KERANJANG ────────────────────────────── --}}
  <div class="kasir-cart-panel" id="kasirCartPanel">

    <div class="cart-header">
      <div class="cart-header-left">
        <span class="cart-title-text">Keranjang</span>
        @if($this->getTotalKeranjang() > 0)
          <span class="cart-badge">{{ $this->getTotalKeranjang() }}</span>
        @endif
      </div>
      <div style="display:flex;align-items:center;gap:8px">
        @if(!empty($keranjang))
        <button class="btn-kosongkan" wire:click="kosongkanKeranjang">🗑 Kosongkan</button>
        @endif
        {{-- Close button visible only on mobile --}}
        <button class="btn-kosongkan" id="cartCloseBtn" onclick="toggleCart(false)" style="display:none">✕ Tutup</button>
      </div>
    </div>

    <div class="cart-fields">
      <div>
        <div class="field-label">Nomor Meja</div>
        <input wire:model.live="nomorMeja"
               class="field-input"
               type="text"
               placeholder="Contoh: Meja 3">
      </div>
      <div>
        <div class="field-label">Cara Pembayaran</div>
        <div class="bayar-grid">
          <button wire:click="$set('caraBayar','tunai')"    class="bayar-btn {{ $caraBayar === 'tunai'    ? 'aktif' : '' }}">💵 Tunai</button>
          <button wire:click="$set('caraBayar','qris')"     class="bayar-btn {{ $caraBayar === 'qris'     ? 'aktif' : '' }}">📱 QRIS</button>
          <button wire:click="$set('caraBayar','transfer')" class="bayar-btn {{ $caraBayar === 'transfer' ? 'aktif' : '' }}">🏦 Transfer</button>
        </div>
      </div>
    </div>

    <div class="cart-items">
      @forelse($keranjang as $i => $item)
      <div class="cart-item">
        <div class="cart-item-info">
          <div class="cart-item-nama">{{ $item['nama'] }}</div>
          <div class="cart-item-harga">Rp {{ number_format($item['harga'], 0, ',', '.') }} / item</div>
          <input wire:model.live="keranjang.{{ $i }}.catatan"
                 class="cart-item-note"
                 type="text"
                 placeholder="Catatan (opsional)...">
        </div>
        <div class="cart-item-ctrl">
          <button class="btn-hapus" wire:click="hapusItem({{ $item['id'] }})" title="Hapus item">✕</button>
          <div class="qty-ctrl">
            <button class="qty-btn"      wire:click="kurangiItem({{ $item['id'] }})">−</button>
            <span class="qty-num">{{ $item['jumlah'] }}</span>
            <button class="qty-btn plus" wire:click="tambahKeKeranjang({{ $item['id'] }})">+</button>
          </div>
          <span class="subtotal">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
        </div>
      </div>
      @empty
      <div class="cart-empty">
        <div class="cart-empty-icon">🛒</div>
        <p style="font-weight:600;color:rgba(255,255,255,0.3)">Keranjang kosong</p>
        <p style="font-size:12px;color:rgba(255,255,255,0.2)">Pilih menu untuk mulai memesan</p>
      </div>
      @endforelse
    </div>

    <div class="cart-footer">
      <div class="total-row">
        <span class="total-label">Total Bayar</span>
        <span class="total-nominal">Rp {{ number_format($this->getTotalHarga(), 0, ',', '.') }}</span>
      </div>
      <button class="btn-checkout"
              wire:click="checkout"
              wire:loading.attr="disabled"
              wire:target="checkout">
        <span wire:loading.remove wire:target="checkout">✅&nbsp; Checkout Sekarang</span>
        <span wire:loading       wire:target="checkout">⏳&nbsp; Memproses...</span>
      </button>
    </div>

  </div>

</div>

{{-- ═══════════════════════════════════════════════════════════ --}}
{{-- MOBILE CART JAVASCRIPT                                     --}}
{{-- ═══════════════════════════════════════════════════════════ --}}
<script>
(function () {
  const MOBILE_BP = 640;

  function isMobile() {
    return window.innerWidth <= MOBILE_BP;
  }

  function toggleCart(open) {
    if (!isMobile()) return;
    const panel   = document.getElementById('kasirCartPanel');
    const overlay = document.getElementById('cartOverlayBg');
    const closeBtn = document.getElementById('cartCloseBtn');
    if (!panel) return;

    if (open) {
      panel.classList.add('cart-open');
      overlay.classList.add('cart-open');
      if (closeBtn) closeBtn.style.display = 'block';
      document.body.style.overflow = 'hidden';
    } else {
      panel.classList.remove('cart-open');
      overlay.classList.remove('cart-open');
      if (closeBtn) closeBtn.style.display = 'none';
      document.body.style.overflow = '';
    }
  }

  // Expose globally for onclick handlers
  window.toggleCart = toggleCart;

  // Handle resize: reset state when crossing breakpoint
  let lastMobile = isMobile();
  window.addEventListener('resize', function () {
    const nowMobile = isMobile();
    if (lastMobile !== nowMobile) {
      lastMobile = nowMobile;
      if (!nowMobile) {
        // Going to desktop: reset mobile drawer state
        const panel   = document.getElementById('kasirCartPanel');
        const overlay = document.getElementById('cartOverlayBg');
        const closeBtn = document.getElementById('cartCloseBtn');
        if (panel)   panel.classList.remove('cart-open');
        if (overlay) overlay.classList.remove('cart-open');
        if (closeBtn) closeBtn.style.display = 'none';
        document.body.style.overflow = '';
      }
    }
  });

  // Update FAB badge count whenever Livewire re-renders
  document.addEventListener('livewire:update', updateFabBadge);
  document.addEventListener('livewire:initialized', updateFabBadge);

  function updateFabBadge() {
    const badge = document.getElementById('cartFabBadge');
    if (!badge) return;
    // Read count from cart-badge element (already rendered by Livewire)
    const cartBadge = document.querySelector('.kasir-cart-panel .cart-badge');
    const count = cartBadge ? parseInt(cartBadge.textContent.trim()) || 0 : 0;
    badge.textContent = count;
    badge.style.display = count > 0 ? 'flex' : 'none';
  }

  // Swipe down to close cart drawer
  (function initSwipe() {
    let startY = 0;
    const panel = document.getElementById('kasirCartPanel');
    if (!panel) return;

    panel.addEventListener('touchstart', function (e) {
      startY = e.touches[0].clientY;
    }, { passive: true });

    panel.addEventListener('touchend', function (e) {
      if (!isMobile()) return;
      const deltaY = e.changedTouches[0].clientY - startY;
      // Swipe down ≥ 80px closes cart
      if (deltaY > 80) toggleCart(false);
    }, { passive: true });
  })();
})();
</script>
</x-filament-panels::page>