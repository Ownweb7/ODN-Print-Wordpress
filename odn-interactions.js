/* ODN Prints — interactive effects: cursor glow, tilt cards, before/after wiper */
(function () {
  function mq(q) { return window.matchMedia ? window.matchMedia(q) : { matches: false }; }
  var FINE = mq('(pointer: fine)').matches;
  var REDUCED = mq('(prefers-reduced-motion: reduce)').matches;

  /* ---------- 1) Cursor-follow amber glow (desktop only) ---------- */
  function initGlow() {
    if (!FINE || REDUCED) return;
    var spot = document.createElement('div');
    spot.id = 'odn-spot';
    spot.setAttribute('aria-hidden', 'true');
    document.body.appendChild(spot);
    var x = 0, y = 0, ticking = false;
    function place() { spot.style.transform = 'translate(' + x + 'px,' + y + 'px) translate(-50%,-50%)'; ticking = false; }
    window.addEventListener('mousemove', function (e) {
      x = e.clientX; y = e.clientY; spot.style.opacity = '1';
      if (!ticking) { ticking = true; requestAnimationFrame(place); }
    }, { passive: true });
    document.addEventListener('mouseleave', function () { spot.style.opacity = '0'; });
  }

  /* ---------- 2) 3D tilt + glare on cards (desktop only) ---------- */
  function initTilt() {
    if (!FINE || REDUCED) return;
    var sel = '.odn-tile, .odn-tilt, .wc-block-grid__product, ul.products li.product';
    document.querySelectorAll(sel).forEach(function (card) {
      if (card.dataset.odnTilt) return; card.dataset.odnTilt = '1';
      card.classList.add('odn-tilt');
      var glare = document.createElement('span');
      glare.className = 'odn-glare'; glare.setAttribute('aria-hidden', 'true');
      card.appendChild(glare);
      card.addEventListener('pointermove', function (e) {
        var r = card.getBoundingClientRect();
        var px = (e.clientX - r.left) / r.width, py = (e.clientY - r.top) / r.height;
        var rx = (py - 0.5) * -7, ry = (px - 0.5) * 7;
        card.style.transform = 'perspective(720px) rotateX(' + rx + 'deg) rotateY(' + ry + 'deg) translateY(-6px)';
        card.style.setProperty('--mx', (px * 100) + '%');
        card.style.setProperty('--my', (py * 100) + '%');
      });
      card.addEventListener('pointerleave', function () { card.style.transform = ''; });
    });
  }

  /* ---------- 3) Before/after wiper (mouse + touch) ---------- */
  function initWipers() {
    document.querySelectorAll('.odn-wiper').forEach(function (w) {
      if (w.dataset.odnReady) return; w.dataset.odnReady = '1';
      var pos = parseFloat(w.getAttribute('data-pos') || '55');
      function setPos(p) { pos = Math.max(2, Math.min(98, p)); w.style.setProperty('--pos', pos + '%'); }
      setPos(pos);
      var dragging = false;
      function move(e) {
        var r = w.getBoundingClientRect();
        var cx = e.touches ? e.touches[0].clientX : e.clientX;
        setPos(((cx - r.left) / r.width) * 100);
      }
      w.addEventListener('pointerdown', function (e) { dragging = true; move(e); });
      window.addEventListener('pointermove', function (e) { if (dragging) move(e); }, { passive: true });
      window.addEventListener('pointerup', function () { dragging = false; });
    });
  }

  function init() { initGlow(); initTilt(); initWipers(); }
  if (document.readyState !== 'loading') init();
  else document.addEventListener('DOMContentLoaded', init);
})();
