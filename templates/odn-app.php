<?php
/**
 * ODN Prints — standalone full-page app template.
 * Served verbatim by the plugin (no theme header/footer) so the page renders
 * exactly like the original ODN Prints single-page site.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ODN Prints — Custom 3D Models, Metal Prints &amp; Desk Mats</title>
<meta name="description" content="ODN Prints, Hisar — custom 3D-printed figurines, metal prints and desk mats. Send a photo, we make it real.">
<style>
/* =================== TOKENS =================== */
:root{
  --serif:"Iowan Old Style","Palatino Linotype",Palatino,Georgia,"Times New Roman",serif;
  --sans:system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  --mono:ui-monospace,"SF Mono","Cascadia Mono","Segoe UI Mono",Menlo,Consolas,monospace;
  --bg:#08090C; --bg-2:#0D0F14; --bg-3:#11141B;
  --surface:rgba(255,255,255,.045); --surface-2:rgba(255,255,255,.07); --solid:#12151C;
  --border:rgba(255,255,255,.10); --border-strong:rgba(255,255,255,.18);
  --text:#EDEFF5; --dim:#8A92A4; --faint:#5A6172;
  --accent:#F2A93B; --accent-2:#F8D281; --accent-ink:#F2A93B; --aqua:#5FE7DE;
  --shadow:0 30px 80px -40px rgba(0,0,0,.85); --glass-shadow:0 20px 60px -30px rgba(0,0,0,.7);
}
html[data-theme="light"]{
  --bg:#EDEEF2; --bg-2:#F6F7F9; --bg-3:#FFFFFF;
  --surface:rgba(255,255,255,.65); --surface-2:rgba(255,255,255,.85); --solid:#FFFFFF;
  --border:rgba(12,16,28,.10); --border-strong:rgba(12,16,28,.18);
  --text:#12151C; --dim:#586073; --faint:#8A92A4;
  --accent:#E0941F; --accent-2:#B96E0C; --accent-ink:#A85F0A; --aqua:#0FA9A0;
  --shadow:0 30px 70px -40px rgba(40,46,60,.45); --glass-shadow:0 18px 50px -28px rgba(40,46,60,.35);
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--bg);color:var(--text);font-family:var(--sans);font-size:17px;line-height:1.6;
  -webkit-font-smoothing:antialiased;overflow-x:hidden;transition:background .5s,color .5s}
body::before{content:"";position:fixed;inset:0;z-index:0;pointer-events:none;opacity:.7;transition:opacity .5s;
  background:radial-gradient(50% 38% at 78% 8%,color-mix(in srgb,var(--accent) 22%,transparent),transparent 70%),
             radial-gradient(46% 34% at 10% 22%,color-mix(in srgb,var(--aqua) 14%,transparent),transparent 70%)}
body::after{content:"";position:fixed;inset:0;z-index:0;pointer-events:none;opacity:.5;
  background-image:linear-gradient(var(--border) 1px,transparent 1px),linear-gradient(90deg,var(--border) 1px,transparent 1px);
  background-size:64px 64px;
  -webkit-mask-image:radial-gradient(120% 80% at 50% 0%,#000 30%,transparent 78%);mask-image:radial-gradient(120% 80% at 50% 0%,#000 30%,transparent 78%)}
a{color:inherit;text-decoration:none}
[hidden]{display:none!important}
.wrap{max-width:1200px;margin:0 auto;padding:0 26px;position:relative;z-index:2}
.mono{font-family:var(--mono);font-size:.7rem;letter-spacing:.2em;text-transform:uppercase}
#spot{position:fixed;width:480px;height:480px;border-radius:50%;left:0;top:0;z-index:1;pointer-events:none;
  transform:translate(-50%,-50%);opacity:0;transition:opacity .4s;
  background:radial-gradient(circle,color-mix(in srgb,var(--accent) 16%,transparent),transparent 60%)}

/* =================== NAV =================== */
header{position:sticky;top:0;z-index:60;background:color-mix(in srgb,var(--bg) 72%,transparent);
  backdrop-filter:blur(16px) saturate(1.3);-webkit-backdrop-filter:blur(16px) saturate(1.3);
  border-bottom:1px solid var(--border);transition:background .5s,border-color .5s}
.nav{display:flex;align-items:center;justify-content:space-between;height:72px}
.brand{display:flex;align-items:center;gap:11px;background:none;border:0;cursor:pointer;color:inherit}
.logo{width:30px;height:30px;border-radius:9px;display:grid;place-items:center;
  background:linear-gradient(140deg,var(--accent),var(--accent-2));color:#0b0b0b;
  font-family:var(--serif);font-weight:600;font-size:1rem;box-shadow:0 6px 18px -6px var(--accent)}
.brand b{font-family:var(--serif);font-weight:600;font-size:1.25rem;letter-spacing:-.01em}
.navlinks{display:flex;gap:28px;align-items:center}
.navlinks a,.navlinks button{color:var(--dim);font-size:.92rem;font-weight:500;transition:color .2s;position:relative;
  background:none;border:0;cursor:pointer;font-family:inherit}
.navlinks a:not(.navcta)::after,.navlinks button::after{content:"";position:absolute;left:0;bottom:-6px;height:1.5px;width:0;background:var(--accent);transition:width .25s}
.navlinks a:not(.navcta):hover,.navlinks button:hover,.navlinks button.active{color:var(--text)}
.navlinks button.active::after,.navlinks a:not(.navcta):hover::after,.navlinks button:hover::after{width:100%}
.navcta{border:1px solid var(--accent);color:var(--accent-ink)!important;padding:9px 18px;border-radius:999px;font-size:.85rem;font-weight:600;transition:all .2s}
.navcta:hover{background:var(--accent);color:#0b0b0b!important;box-shadow:0 8px 24px -8px var(--accent)}
.navcta::after{display:none}
.toolbtns{display:flex;align-items:center;gap:14px}
.toggle{width:54px;height:30px;border-radius:999px;border:1px solid var(--border-strong);background:var(--surface);position:relative;cursor:pointer;transition:all .3s;flex:none}
.toggle .knob{position:absolute;top:2px;left:2px;width:24px;height:24px;border-radius:50%;
  background:linear-gradient(140deg,var(--accent),var(--accent-2));display:grid;place-items:center;
  transition:transform .35s cubic-bezier(.65,0,.35,1);color:#0b0b0b}
html[data-theme="light"] .toggle .knob{transform:translateX(24px)}
.toggle svg{width:14px;height:14px}
.burger{display:none;background:none;border:0;color:var(--text);cursor:pointer;font-size:1.4rem}

/* =================== BUTTONS =================== */
.btn{font-family:inherit;font-weight:600;font-size:.95rem;padding:15px 28px;border-radius:999px;cursor:pointer;border:0;
  display:inline-flex;align-items:center;gap:9px;transition:transform .12s,box-shadow .25s,background .25s,color .25s,border-color .25s}
.btn-pri{background:linear-gradient(135deg,var(--accent),var(--accent-2));color:#0b0b0b;box-shadow:0 14px 34px -14px var(--accent)}
.btn-pri:hover{box-shadow:0 18px 44px -12px var(--accent)}
.btn-ghost{border:1px solid var(--border-strong);color:var(--text);background:var(--surface)}
.btn-ghost:hover{border-color:var(--accent)}
.btn-lg{padding:18px 42px;font-size:1.06rem}

/* =================== SHARED LAYOUT =================== */
.pad{padding:90px 0}
.sec-head{max-width:48em;margin-bottom:46px}
[data-view="home"] .sec-head{margin-left:auto;margin-right:auto;text-align:center}
.sec-head .k{color:var(--accent-ink);margin-bottom:14px;display:inline-block}
.sec-head h2{font-family:var(--serif);font-weight:500;font-size:clamp(2rem,4vw,3rem);line-height:1.06;letter-spacing:-.02em;margin-bottom:14px}
.sec-head p{color:var(--dim);font-size:1.05rem}
.eyebrow{display:inline-flex;align-items:center;gap:10px;color:var(--accent-ink);margin-bottom:22px;
  padding:7px 14px;border:1px solid var(--border);border-radius:999px;background:var(--surface)}
.eyebrow .dot{width:6px;height:6px;border-radius:50%;background:var(--accent);box-shadow:0 0 12px var(--accent);animation:pulse 2.4s ease-in-out infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.35}}
.back{display:inline-flex;align-items:center;gap:8px;color:var(--dim);font-size:.85rem;background:none;border:0;cursor:pointer;
  font-family:inherit;margin-bottom:18px;transition:color .2s}
.back:hover{color:var(--accent-ink)}

/* =================== HOME HERO =================== */
.hhero{padding:78px 0 34px;text-align:center}
.hhead{max-width:none}
h1{font-family:var(--serif);font-weight:500;font-size:clamp(2.6rem,6vw,4.4rem);line-height:1.02;letter-spacing:-.025em;margin-bottom:20px}
h1 em{font-style:italic;background:linear-gradient(120deg,var(--accent),var(--accent-2));-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.lede{font-size:1.13rem;color:var(--dim);max-width:34em;margin-bottom:30px}
.hhero .lede{margin-left:auto;margin-right:auto}
.hcta{display:flex;gap:14px;flex-wrap:wrap;justify-content:center}
.stats{margin-top:40px;display:flex;gap:34px;flex-wrap:wrap;justify-content:center}
.stat b{display:block;font-family:var(--serif);font-size:1.7rem;font-weight:600;line-height:1}
.stat span{font-size:.74rem;color:var(--dim)}

/* =================== PRODUCT TILES (grayscale -> colour) =================== */
.prods{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.prod{position:relative;text-align:left;border:1px solid var(--border);border-radius:22px;background:var(--surface);
  backdrop-filter:blur(12px);overflow:hidden;cursor:pointer;box-shadow:var(--glass-shadow);font-family:inherit;color:inherit;
  transition:transform .3s,border-color .3s,box-shadow .3s}
.prod:hover,.prod:focus-visible{transform:translateY(-8px);border-color:color-mix(in srgb,var(--accent) 55%,transparent);
  box-shadow:0 34px 70px -34px rgba(0,0,0,.7);outline:none}
.prod .shot{height:230px;display:grid;place-items:center;position:relative;border-bottom:1px solid var(--border);
  background:radial-gradient(130% 110% at 50% 0%,color-mix(in srgb,var(--accent) 16%,transparent),transparent 60%),var(--bg-3);
  filter:grayscale(1) contrast(.92) brightness(.92);transition:filter .5s ease,transform .5s ease}
.prod:hover .shot,.prod:focus-visible .shot{filter:grayscale(0) contrast(1) brightness(1)}
.prod .shot svg{width:62%;height:auto;transition:transform .5s ease}
.prod:hover .shot svg{transform:scale(1.06)}
.prod .bw-tag{position:absolute;top:14px;left:14px;font-family:var(--mono);font-size:.56rem;letter-spacing:.16em;
  text-transform:uppercase;padding:5px 10px;border-radius:999px;background:var(--surface-2);border:1px solid var(--border);
  color:var(--dim);backdrop-filter:blur(6px);transition:color .4s}
.prod:hover .bw-tag{color:var(--accent-ink)}
.prod .pinfo{padding:24px 26px 26px}
.prod .pinfo .no{font-family:var(--mono);font-size:.62rem;letter-spacing:.14em;text-transform:uppercase;color:var(--faint)}
.prod h3{font-family:var(--serif);font-weight:600;font-size:1.5rem;margin:8px 0 8px}
.prod p{color:var(--dim);font-size:.92rem;margin-bottom:16px}
.prod .go{display:inline-flex;align-items:center;gap:7px;color:var(--accent-ink);font-weight:600;font-size:.9rem}
.prod .go svg{width:16px;height:16px;transition:transform .25s}
.prod:hover .go svg{transform:translateX(4px)}
.hint{color:var(--faint);font-size:.84rem;margin-top:18px;display:flex;align-items:center;gap:8px}

/* =================== WHY (detailed) =================== */
.why-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.why-c{padding:24px;border:1px solid var(--border);border-radius:18px;background:var(--surface);transition:transform .25s,border-color .25s}
.why-c:hover{transform:translateY(-5px);border-color:color-mix(in srgb,var(--accent) 45%,transparent)}
.why-c .ic{width:30px;height:30px;color:var(--accent-ink);margin-bottom:13px}
.why-c h4{font-family:var(--serif);font-weight:600;font-size:1.1rem;margin-bottom:6px}
.why-c p{color:var(--dim);font-size:.86rem}

/* =================== PRODUCT PAGE HERO =================== */
.phero{padding:56px 0 20px}
.phero-grid{display:grid;grid-template-columns:1.05fr .95fr;gap:46px;align-items:center}
.phero h2{font-family:var(--serif);font-weight:500;font-size:clamp(2.2rem,5vw,3.6rem);line-height:1.03;letter-spacing:-.02em;margin-bottom:18px}
.phero h2 em{font-style:italic;background:linear-gradient(120deg,var(--accent),var(--accent-2));-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.pshow{border:1px solid var(--border-strong);border-radius:24px;aspect-ratio:5/4;display:grid;place-items:center;
  background:radial-gradient(120% 90% at 50% 0%,color-mix(in srgb,var(--accent) 14%,transparent),transparent 60%),var(--bg-3);
  box-shadow:var(--shadow)}
.pshow svg{width:62%;height:auto;filter:drop-shadow(0 18px 30px rgba(0,0,0,.45))}

/* before/after reveal (3D page) */
.ba{position:relative;width:100%;max-width:430px;aspect-ratio:5/6;margin:0 auto;border-radius:24px;overflow:hidden;
  border:1px solid var(--border-strong);box-shadow:var(--shadow);user-select:none;touch-action:none;
  background:radial-gradient(120% 90% at 50% 0%,color-mix(in srgb,var(--accent) 14%,transparent),transparent 60%),var(--bg-3)}
.ba .layer{position:absolute;inset:0;display:grid;place-items:center}
.ba svg{width:74%;height:74%}
.ba .photo{clip-path:inset(0 calc(100% - var(--pos,55%)) 0 0)}
.ba .scanlines{position:absolute;inset:0;opacity:.5;clip-path:inset(0 calc(100% - var(--pos,55%)) 0 0);
  background:repeating-linear-gradient(0deg,transparent 0 6px,color-mix(in srgb,var(--aqua) 35%,transparent) 6px 7px)}
.ba .divider{position:absolute;top:0;bottom:0;left:var(--pos,55%);width:2px;background:linear-gradient(var(--accent),var(--accent-2));transform:translateX(-1px);z-index:4}
.ba .handle{position:absolute;top:50%;left:var(--pos,55%);transform:translate(-50%,-50%);z-index:5;width:46px;height:46px;border-radius:50%;
  background:var(--solid);border:1.5px solid var(--accent);display:grid;place-items:center;cursor:ew-resize;color:var(--accent-ink);box-shadow:0 8px 22px -8px rgba(0,0,0,.6)}
.ba .lbl{position:absolute;top:14px;z-index:4;font-family:var(--mono);font-size:.6rem;letter-spacing:.18em;text-transform:uppercase;
  padding:5px 10px;border-radius:999px;background:var(--surface-2);border:1px solid var(--border);backdrop-filter:blur(6px)}
.ba .lbl.l{left:14px;color:var(--aqua)} .ba .lbl.r{right:14px;color:var(--accent-ink)}

/* style cards */
.grid7{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.tcard{position:relative;border-radius:20px;border:1px solid var(--border);background:var(--surface);backdrop-filter:blur(12px);
  padding:26px 24px 22px;transform-style:preserve-3d;transition:border-color .3s,box-shadow .3s;box-shadow:var(--glass-shadow);will-change:transform}
.tcard:hover{border-color:color-mix(in srgb,var(--accent) 55%,transparent)}
.tcard .glare{position:absolute;inset:0;border-radius:20px;pointer-events:none;opacity:0;transition:opacity .3s;
  background:radial-gradient(circle at var(--mx,50%) var(--my,50%),color-mix(in srgb,var(--accent) 28%,transparent),transparent 45%)}
.tcard:hover .glare{opacity:1}
.tcard .no{color:var(--faint);display:flex;justify-content:space-between;align-items:center}
.tcard .no .tag{color:var(--accent-ink)}
.tcard .stage{height:150px;display:grid;place-items:center;margin:8px 0 14px;position:relative;transform:translateZ(40px)}
.tcard h3{font-family:var(--serif);font-weight:600;font-size:1.28rem;transform:translateZ(28px)}
.tcard .line{color:var(--dim);font-size:.88rem;margin:8px 0 16px;min-height:3.4em;transform:translateZ(18px)}
.tcard .specs{display:flex;justify-content:space-between;border-top:1px solid var(--border);padding-top:13px}
.tcard .specs .k2{font-family:var(--mono);font-size:.56rem;letter-spacing:.1em;text-transform:uppercase;color:var(--faint);display:block;margin-bottom:2px}
.tcard .specs .v2{font-size:.8rem}
.fg .a{fill:var(--accent)} .fg .b{fill:var(--accent-2)} .fg .d{fill:var(--bg)}
.disclaim{color:var(--faint);font-size:.78rem;margin-top:26px;max-width:60em;line-height:1.55}

/* process */
.steps{display:grid;grid-template-columns:repeat(5,1fr);gap:0}
.step{padding:22px 16px 0 0;position:relative}
.step .ring{width:42px;height:42px;border-radius:50%;border:1px solid var(--accent);display:grid;place-items:center;font-family:var(--mono);
  font-size:.78rem;color:var(--accent-ink);background:var(--surface);margin-bottom:16px;box-shadow:0 0 0 5px color-mix(in srgb,var(--accent) 12%,transparent)}
.step::before{content:"";position:absolute;top:43px;left:42px;right:0;height:1px;background:var(--border)}
.step:last-child::before{display:none}
.step h4{font-family:var(--serif);font-weight:600;font-size:1.1rem;margin-bottom:7px}
.step p{color:var(--dim);font-size:.86rem;padding-right:8px}

/* sizes */
.size-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.size{border:1px solid var(--border);border-radius:20px;padding:30px 26px;background:var(--surface);backdrop-filter:blur(10px);
  display:flex;flex-direction:column;transition:transform .25s,border-color .25s}
.size:hover{transform:translateY(-6px)}
.size.feat{border-color:color-mix(in srgb,var(--accent) 55%,transparent);background:linear-gradient(180deg,color-mix(in srgb,var(--accent) 10%,var(--surface)),var(--surface))}
.size .badge{align-self:flex-start;font-family:var(--mono);font-size:.56rem;letter-spacing:.12em;text-transform:uppercase;color:#0b0b0b;
  background:linear-gradient(135deg,var(--accent),var(--accent-2));padding:5px 10px;border-radius:7px;margin-bottom:12px}
.size h4{font-family:var(--serif);font-weight:600;font-size:1.5rem}
.size .h{color:var(--dim);font-size:.86rem}
.size .price{font-family:var(--serif);font-size:2rem;margin-top:14px}
.size .price small{font-size:.76rem;color:var(--dim);font-family:inherit}
.size ul{list-style:none;margin-top:14px;display:flex;flex-direction:column;gap:8px}
.size li{font-size:.86rem;padding-left:22px;position:relative}
.size li::before{content:"";position:absolute;left:0;top:7px;width:11px;height:11px;border-radius:50%;
  background:radial-gradient(circle at 35% 35%,var(--accent-2),var(--accent));box-shadow:0 0 8px -1px var(--accent)}

/* feature mini grid (metal/deskmat) */
.feat4{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}

/* contact */
/* product detail page (PDP) */
.pdp{display:grid;grid-template-columns:1.05fr .95fr;gap:46px;align-items:start;margin-top:8px}
.pdp .gallery{display:flex;flex-direction:column;gap:14px}
.pdp .pmain{order:1}
.thumbs{order:2;display:flex;flex-direction:row;flex-wrap:wrap;gap:10px}
.thumb{border:1px solid var(--border);border-radius:12px;background:var(--surface);width:72px;height:72px;flex:none;cursor:pointer;display:grid;place-items:center;padding:7px;transition:border-color .2s}
.thumb.on{border-color:var(--accent)}
.thumb svg{width:100%;height:100%}
.pmain{border:1px solid var(--border-strong);border-radius:22px;aspect-ratio:1/1;display:grid;place-items:center;
  background:radial-gradient(120% 90% at 50% 0%,color-mix(in srgb,var(--accent) 14%,transparent),transparent 60%),var(--bg-3);box-shadow:var(--shadow)}
.pmain svg{width:64%;height:auto;filter:drop-shadow(0 18px 30px rgba(0,0,0,.45))}
.pdp .pmain-wrap{order:1;position:relative}
.pmain{cursor:zoom-in}
.pmain-nav{position:absolute;top:50%;transform:translateY(-50%);z-index:3;width:42px;height:42px;border-radius:50%;
  background:color-mix(in srgb,var(--solid) 78%,transparent);border:1px solid var(--border-strong);color:var(--text);
  display:grid;place-items:center;cursor:pointer;backdrop-filter:blur(6px);transition:background .2s,color .2s,transform .2s;opacity:0}
.pmain-wrap:hover .pmain-nav,.pmain-nav:focus-visible{opacity:1}
.pmain-nav:hover{background:var(--accent);color:#0b0b0b;transform:translateY(-50%) scale(1.06)}
.pmain-nav.prev{left:12px}.pmain-nav.next{right:12px}
.pmain-nav svg{width:20px;height:20px}
@media(pointer:coarse){.pmain-nav{opacity:1}}
/* Fullscreen product image */
.pfs{position:fixed;inset:0;z-index:95;background:rgba(0,0,0,.84);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);
  display:grid;place-items:center;padding:30px}
.pfs-art{width:min(82vw,640px);max-height:82vh;aspect-ratio:1/1;display:grid;place-items:center;
  background:radial-gradient(120% 90% at 50% 0%,color-mix(in srgb,var(--accent) 14%,transparent),transparent 60%),var(--bg-3);
  border:1px solid var(--border-strong);border-radius:24px;box-shadow:var(--shadow)}
.pfs-art svg{width:70%;height:auto;filter:drop-shadow(0 18px 30px rgba(0,0,0,.45))}
.pfs-nav{position:absolute;top:50%;transform:translateY(-50%);z-index:2;width:52px;height:52px;border-radius:50%;
  background:var(--surface);border:1px solid var(--border-strong);color:var(--text);display:grid;place-items:center;cursor:pointer;transition:background .2s,color .2s}
.pfs-nav:hover{background:var(--accent);color:#0b0b0b}
.pfs-nav.prev{left:24px}.pfs-nav.next{right:24px}
.pfs-nav svg{width:24px;height:24px}
.pfs-close{position:absolute;top:22px;right:24px;z-index:2;width:44px;height:44px;border-radius:50%;background:var(--surface);
  border:1px solid var(--border);color:var(--text);display:grid;place-items:center;cursor:pointer;transition:background .2s,transform .2s}
.pfs-close:hover{background:var(--bg-3);transform:rotate(90deg)}
@media(max-width:560px){.pfs-nav{width:44px;height:44px}.pfs-nav.prev{left:10px}.pfs-nav.next{right:10px}}
.buybox h2{font-family:var(--serif);font-weight:600;font-size:clamp(1.8rem,3.4vw,2.6rem);letter-spacing:-.01em;margin-bottom:5px}
.buybox .sub{color:var(--dim);font-size:.95rem;margin-bottom:16px}
.buybox .price{font-family:var(--serif);font-size:2rem;margin-bottom:6px}
.buybox .price small{font-family:var(--sans);font-size:.78rem;color:var(--dim)}
.rating{display:flex;align-items:center;gap:8px;color:var(--accent);font-size:.95rem;letter-spacing:.05em;margin-bottom:22px}
.rating span{color:var(--dim);letter-spacing:0}
.swatches-wrap{margin-bottom:20px}
.swatches-wrap .lbl{display:block;font-family:var(--mono);font-size:.6rem;letter-spacing:.12em;text-transform:uppercase;color:var(--faint);margin-bottom:10px}
.swatches{display:flex;flex-wrap:wrap;gap:9px}
.swatch{width:48px;height:48px;border-radius:12px;border:1px solid var(--border);background:var(--surface);cursor:pointer;display:grid;place-items:center;padding:5px;transition:border-color .2s,transform .2s}
.swatch:hover{transform:translateY(-2px)}
.swatch.on{border-color:var(--accent);box-shadow:0 0 0 3px color-mix(in srgb,var(--accent) 18%,transparent)}
.swatch svg{width:100%;height:100%}
.swatch .dot{width:26px;height:26px;border-radius:50%;border:1px solid rgba(255,255,255,.25)}
.buyrow{display:flex;flex-wrap:wrap;gap:14px;align-items:flex-end;margin-bottom:14px}
.field{display:flex;flex-direction:column;gap:7px}
.field .l{font-family:var(--mono);font-size:.6rem;letter-spacing:.12em;text-transform:uppercase;color:var(--faint)}
.field select{font-family:inherit;background:var(--surface);color:var(--text);border:1px solid var(--border-strong);border-radius:12px;padding:13px 14px;font-size:.92rem;cursor:pointer}
.field select option{background:var(--solid);color:var(--text)}
.qty{display:flex;align-items:center;border:1px solid var(--border-strong);border-radius:12px;overflow:hidden}
.qty button{background:var(--surface);border:0;color:var(--text);width:42px;height:46px;font-size:1.15rem;cursor:pointer}
.qty span{width:42px;text-align:center;font-weight:600}
.selnote{color:var(--dim);font-size:.84rem;margin-bottom:6px}
.support{border-top:1px solid var(--border);margin-top:20px;padding-top:18px;color:var(--dim);font-size:.86rem}
.support b{color:var(--text)}

/* cart */
.cartbtn{position:relative;background:var(--surface);border:1px solid var(--border-strong);border-radius:999px;width:40px;height:40px;display:grid;place-items:center;color:var(--text);cursor:pointer}
.cartbtn svg{width:18px;height:18px}
.cart-badge{position:absolute;top:-6px;right:-6px;min-width:18px;height:18px;border-radius:9px;background:var(--accent);color:#0b0b0b;font-size:.62rem;font-weight:700;display:grid;place-items:center;padding:0 4px}
.cart-backdrop{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:70;backdrop-filter:blur(3px)}
.cart{position:fixed;top:0;right:0;bottom:0;width:382px;max-width:92vw;z-index:80;background:var(--bg-2);border-left:1px solid var(--border);display:flex;flex-direction:column;box-shadow:-30px 0 80px -40px rgba(0,0,0,.8)}
.cart .chead{display:flex;align-items:center;justify-content:space-between;padding:22px;border-bottom:1px solid var(--border)}
.cart .chead h3{font-family:var(--serif);font-size:1.3rem;font-weight:600}
.cart .close{background:none;border:0;color:var(--dim);font-size:1.6rem;cursor:pointer;line-height:1}
.cart .items{flex:1;overflow:auto;padding:8px 22px}
.citem{display:flex;gap:12px;padding:15px 0;border-bottom:1px solid var(--border);align-items:center}
.citem .ci-art{width:54px;height:54px;border-radius:10px;background:var(--surface);border:1px solid var(--border);flex:none;display:grid;place-items:center;padding:6px}
.citem .ci-art svg{width:100%;height:100%}
.citem .ci-main{flex:1;min-width:0}
.citem .ci-t{font-weight:600;font-size:.92rem}
.citem .ci-d{color:var(--dim);font-size:.78rem;margin:2px 0 4px}
.citem .ci-x{background:none;border:0;color:var(--faint);cursor:pointer;font-size:.76rem;padding:0;text-decoration:underline}
.citem .ci-p{font-family:var(--serif);font-size:1rem;white-space:nowrap}
.cart .empty{color:var(--dim);text-align:center;padding:60px 20px}
.cart .cfoot{padding:20px 22px;border-top:1px solid var(--border)}
.cart .tot{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;font-size:1rem}
.cart .tot b{font-family:var(--serif);font-size:1.5rem}
.cart .fine{color:var(--faint);font-size:.74rem;margin-top:12px;text-align:center}

/* admin */
.adminlink{background:none;border:0;color:var(--faint);font-family:var(--mono);font-size:.7rem;letter-spacing:.16em;text-transform:uppercase;cursor:pointer;text-decoration:underline}
.adminlink:hover{color:var(--accent-ink)}
.adm-gate{max-width:360px;border:1px solid var(--border);border-radius:18px;background:var(--surface);padding:30px}
.adm-gate input{width:100%;background:var(--bg-3);color:var(--text);border:1px solid var(--border-strong);border-radius:10px;padding:12px 14px;font-family:inherit;font-size:.95rem;margin:12px 0}
.adm-err{color:#ff8e7a;font-size:.82rem;min-height:1em}
.adm-bar{display:flex;flex-wrap:wrap;gap:10px;align-items:center;margin-bottom:22px}
.adm-bar .status{color:var(--dim);font-size:.85rem;margin-left:auto}
.btn-sm{font-family:inherit;font-weight:600;font-size:.84rem;padding:10px 16px;border-radius:10px;cursor:pointer;border:1px solid var(--border-strong);background:var(--surface);color:var(--text);transition:border-color .2s}
.btn-sm:hover{border-color:var(--accent)}
.btn-sm.pri{background:linear-gradient(135deg,var(--accent),var(--accent-2));color:#0b0b0b;border-color:transparent}
.btn-sm.danger:hover{border-color:#ff8e7a;color:#ff8e7a}
.adm-prod{border:1px solid var(--border);border-radius:18px;background:var(--surface);padding:24px;margin-bottom:18px}
.adm-prod .ph{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:16px;flex-wrap:wrap}
.adm-prod .ph h3{font-family:var(--serif);font-size:1.3rem}
.adm-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-bottom:18px}
.adm-f{display:flex;flex-direction:column;gap:6px}
.adm-f label{font-family:var(--mono);font-size:.58rem;letter-spacing:.12em;text-transform:uppercase;color:var(--faint)}
.adm-f input{background:var(--bg-3);color:var(--text);border:1px solid var(--border);border-radius:9px;padding:10px 12px;font-family:inherit;font-size:.9rem}
.adm-sub{font-family:var(--mono);font-size:.6rem;letter-spacing:.12em;text-transform:uppercase;color:var(--accent-ink);margin:6px 0 10px;display:block}
.adm-row{display:flex;gap:8px;align-items:center;margin-bottom:8px;flex-wrap:wrap}
.adm-row input[type="text"]{flex:1;min-width:90px;background:var(--bg-3);color:var(--text);border:1px solid var(--border);border-radius:8px;padding:8px 10px;font-family:inherit;font-size:.85rem}
.adm-row input[type="number"]{width:96px;background:var(--bg-3);color:var(--text);border:1px solid var(--border);border-radius:8px;padding:8px 10px;font-family:inherit;font-size:.85rem}
.adm-row input[type="color"]{width:42px;height:36px;border:1px solid var(--border);border-radius:8px;background:var(--bg-3);padding:2px;cursor:pointer}
.adm-row .pop{display:flex;align-items:center;gap:5px;font-size:.74rem;color:var(--dim)}
.adm-row .x{background:none;border:0;color:var(--faint);cursor:pointer;font-size:1.1rem;line-height:1;padding:4px 8px}
.adm-row .x:hover{color:#ff8e7a}
.adm-toggle{display:flex;align-items:center;gap:8px;font-size:.85rem;color:var(--dim)}
.adm-tabs{display:flex;gap:6px;background:var(--bg-3);border:1px solid var(--border);border-radius:12px;padding:5px;margin-bottom:22px;width:fit-content;max-width:100%;overflow-x:auto;flex-wrap:nowrap}
.adm-tab{font-family:inherit;font-weight:600;font-size:.85rem;padding:9px 18px;border-radius:8px;border:0;background:none;color:var(--dim);cursor:pointer;white-space:nowrap;transition:background .2s,color .2s}
.dash-head{display:flex;align-items:center;gap:12px;margin:4px 0 14px;flex-wrap:wrap}
.dash-head h3{font-family:var(--serif);font-size:1.35rem;margin:0}
.dash-count{font-family:var(--mono);font-size:.66rem;color:var(--accent-ink);background:color-mix(in srgb,var(--accent) 16%,transparent);border-radius:999px;padding:3px 9px;margin-left:8px;vertical-align:middle}
.dash-search{flex:1;min-width:160px;background:var(--bg-3);border:1px solid var(--border);border-radius:9px;padding:9px 12px;color:var(--text);font-family:inherit;font-size:.86rem}
.dash-scroll{overflow-x:auto;border:1px solid var(--border);border-radius:12px}
.dash-table{width:100%;border-collapse:collapse;font-size:.84rem;min-width:640px}
.dash-table th{text-align:left;font-family:var(--mono);font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;color:var(--faint);padding:11px 10px;border-bottom:1px solid var(--border);white-space:nowrap}
.dash-table td{padding:5px 7px;border-bottom:1px solid var(--border)}
.dash-table tbody tr:last-child td{border-bottom:0}
.dash-table input{width:100%;min-width:84px;background:transparent;border:1px solid transparent;border-radius:7px;padding:7px 8px;color:var(--text);font-family:inherit;font-size:.84rem}
.dash-table input:hover{border-color:var(--border)}
.dash-table input:focus{border-color:var(--accent);background:var(--bg-3);outline:none}
.dash-empty{text-align:center;color:var(--dim);padding:22px!important}
.adm-tab:hover{color:var(--text)}
.adm-tab.on{background:var(--accent);color:var(--accent-ink)}
.adm-row select{flex:1;min-width:120px;background:var(--bg-3);color:var(--text);border:1px solid var(--border);border-radius:8px;padding:8px 10px;font-family:inherit;font-size:.85rem}
.adm-row select option{background:var(--solid);color:var(--text)}
.adm-row .btn-mini{font-family:inherit;font-size:.78rem;padding:7px 11px;border-radius:8px;border:1px solid var(--border-strong);background:var(--surface);color:var(--text);cursor:pointer;white-space:nowrap}
.adm-row .btn-mini.on{border-color:var(--accent);color:var(--accent-ink)}
.adm-row .adm-thumb{width:36px;height:36px;border-radius:7px;object-fit:cover;border:1px solid var(--border)}
@media(max-width:560px){.adm-grid{grid-template-columns:1fr}}

.contact{border-top:1px solid var(--border)}
.contact-grid{display:grid;grid-template-columns:1.05fr .95fr;gap:46px;align-items:center}
.contact h2{font-family:var(--serif);font-weight:500;font-size:clamp(2rem,4vw,3rem);line-height:1.04;letter-spacing:-.02em;margin-bottom:18px}
.contact h2 em{font-style:italic;background:linear-gradient(120deg,var(--accent),var(--accent-2));-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.picker{margin:24px 0}
.picker .k{display:block;margin-bottom:11px;color:var(--dim)}
.chips{display:flex;flex-wrap:wrap;gap:9px}
.chip{font-family:inherit;border:1px solid var(--border);background:var(--surface);color:var(--text);padding:9px 15px;border-radius:999px;font-size:.85rem;cursor:pointer;transition:all .18s}
.chip:hover{border-color:var(--border-strong)}
.chip.on{background:linear-gradient(135deg,var(--accent),var(--accent-2));color:#0b0b0b;border-color:transparent;font-weight:600;box-shadow:0 8px 22px -10px var(--accent)}
.cactions{display:flex;gap:13px;flex-wrap:wrap}
.ccard{border:1px solid var(--border);border-radius:22px;padding:32px;background:var(--surface);backdrop-filter:blur(12px);box-shadow:var(--glass-shadow)}
.ccard .row{display:flex;align-items:center;gap:15px;padding:17px 0;border-bottom:1px solid var(--border)}
.ccard .row:last-child{border-bottom:0}
.ccard .row .ic{width:36px;height:36px;border-radius:10px;flex:none;display:grid;place-items:center;background:var(--surface-2);color:var(--accent-ink)}
.ccard .row .ic svg{width:18px;height:18px}
.ccard .row .k{font-family:var(--mono);font-size:.6rem;letter-spacing:.12em;text-transform:uppercase;color:var(--faint);display:block}
.ccard .row .v{font-size:1rem}

footer{border-top:1px solid var(--border);padding:36px 0;color:var(--faint);font-size:.85rem}
.foot-legal{display:flex;flex-wrap:wrap;gap:8px 22px;margin-top:18px;padding-top:18px;border-top:1px solid var(--border)}
.foot-legal a{color:var(--faint);font-size:.82rem;transition:color .2s}
.foot-legal a:hover{color:var(--accent-ink)}
.foot{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:14px}

/* reveal */
.reveal{opacity:0;transform:translateY(24px);transition:opacity .7s,transform .7s}
.reveal.in{opacity:1;transform:none}

@media(max-width:900px){
  .prods{grid-template-columns:1fr}
  .why-grid{grid-template-columns:repeat(2,1fr)}
  .feat4{grid-template-columns:repeat(2,1fr)}
  .phero-grid{grid-template-columns:1fr;gap:36px}.ba,.pshow{order:-1}
  .grid7{grid-template-columns:repeat(2,1fr)}
  .steps{grid-template-columns:repeat(2,1fr);gap:8px 0}.step::before{display:none}
  .size-grid{grid-template-columns:1fr}
  .contact-grid{grid-template-columns:1fr;gap:30px}
  .pdp{grid-template-columns:1fr;gap:30px}.gallery{grid-template-columns:60px 1fr}
  .navlinks{display:none;position:absolute;top:72px;left:0;right:0;flex-direction:column;align-items:flex-start;
    background:var(--bg-2);border-bottom:1px solid var(--border);padding:20px 26px;gap:18px}
  .navlinks.open{display:flex}.burger{display:block}
}
@media(max-width:560px){.grid7{grid-template-columns:1fr}.why-grid{grid-template-columns:1fr}.feat4{grid-template-columns:1fr}.stats{gap:22px}}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important;scroll-behavior:auto}.reveal{opacity:1;transform:none}.prod .shot{filter:grayscale(0)}}
  /* ---- Gallery lightbox ---- */
  .lb-backdrop{position:fixed;inset:0;background:rgba(0,0,0,.66);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);z-index:90;opacity:0;animation:lbfade .22s ease forwards}
  .lightbox{position:fixed;inset:0;z-index:91;display:grid;place-items:center;padding:22px}
  .lb-panel{position:relative;background:var(--surface);border:1px solid var(--border-strong);border-radius:22px;max-width:520px;width:100%;box-shadow:var(--shadow);overflow:hidden;animation:lbpop .26s cubic-bezier(.2,.8,.25,1)}
  .lb-art{aspect-ratio:1/1;display:grid;place-items:center;padding:42px;background:radial-gradient(120% 100% at 50% 0%,color-mix(in srgb,var(--accent) 16%,transparent),transparent 64%),var(--bg-3);border-bottom:1px solid var(--border)}
  .lb-art svg{width:74%;max-height:330px;filter:drop-shadow(0 22px 40px rgba(0,0,0,.5))}
  .lb-art.has-img img{max-width:100%;max-height:340px;border-radius:12px;box-shadow:0 22px 40px rgba(0,0,0,.5)}
  .lb-info{padding:18px 22px 22px;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap}
  .lb-info h3{font-family:var(--serif);font-size:1.45rem;margin:0;line-height:1.1}
  .lb-info .gal-m{margin-top:5px}
  .lb-close{position:absolute;top:14px;right:14px;width:40px;height:40px;border-radius:50%;border:1px solid var(--border);background:color-mix(in srgb,var(--surface) 70%,transparent);color:var(--text);cursor:pointer;display:grid;place-items:center;z-index:2;transition:background .2s,transform .2s}
  .lb-close:hover{background:var(--bg-3);transform:rotate(90deg)}
  @keyframes lbfade{to{opacity:1}}
  @keyframes lbpop{from{opacity:0;transform:translateY(14px) scale(.96)}to{opacity:1;transform:none}}
  @media(prefers-reduced-motion:reduce){.lb-backdrop,.lb-panel{animation:none}}
  /* ---- Design gallery ---- */
  .gal-cats{display:flex;flex-wrap:wrap;gap:10px;align-items:center;justify-content:flex-start;min-height:0;margin:-4px 0 18px}
  .gal-cats:empty{margin:0}
  .gal-back{display:inline-flex;align-items:center;gap:6px;background:none;border:0;color:var(--dim);font-family:var(--mono);font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;padding:0;transition:color .2s}
  .gal-back:hover{color:var(--accent-ink)}
  .gal-curcat{font-family:var(--serif);font-size:1.25rem;font-weight:600}
  .gallery-cats{grid-template-columns:repeat(2,1fr)!important}
  @media(max-width:680px){.gallery-cats{grid-template-columns:1fr!important}}
  .gal-catcard{position:relative;display:block;text-align:left;border:1px solid var(--border);border-radius:18px;overflow:hidden;cursor:pointer;color:inherit;font-family:inherit;padding:0;background:var(--surface);transition:transform .28s,border-color .28s,box-shadow .28s}
  .gal-catcard:hover{transform:translateY(-5px);border-color:color-mix(in srgb,var(--accent) 55%,transparent);box-shadow:var(--shadow)}
  .gal-catcover{height:200px;display:grid;place-items:center;overflow:hidden;background:radial-gradient(120% 100% at 50% 0%,color-mix(in srgb,var(--accent) 16%,transparent),transparent 62%),var(--bg-3)}
  .gal-catcover img{width:100%;height:100%;object-fit:cover}
  .gal-catcover .cat-svg{width:44%}
  .gal-catcover .cat-svg svg{width:100%;filter:drop-shadow(0 14px 22px rgba(0,0,0,.42))}
  .gal-catfoot{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 16px}
  .gal-catname{display:block;font-family:var(--serif);font-weight:600;font-size:1.28rem;line-height:1.1}
  .gal-catcount{display:block;color:var(--dim);font-size:.78rem;font-family:var(--mono);margin-top:3px}
  .gal-catbtn{flex:none;background:linear-gradient(135deg,var(--accent),var(--accent-2));color:#0b0b0b;border-radius:9px;padding:8px 14px;font-weight:600;font-size:.82rem;white-space:nowrap}
  .gal-art.has-img{padding:0}
  .gal-art.has-img img{width:100%;height:100%;object-fit:cover;display:block}
  .gal-empty{grid-column:1/-1;text-align:center;color:var(--dim);padding:30px;font-size:.9rem}
  .gal-cat{border:1px solid var(--border);background:var(--surface);color:var(--dim);border-radius:999px;padding:7px 16px;font-family:var(--mono);font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;transition:color .2s,border-color .2s,background .2s,transform .2s}
  .gal-cat:hover{color:var(--text);border-color:color-mix(in srgb,var(--accent) 45%,transparent);transform:translateY(-1px)}
  .gal-cat.on{background:var(--accent);border-color:var(--accent);color:var(--accent-ink);font-weight:600}
  .gallery{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
  .gal-card{display:block;text-align:left;border:1px solid var(--border);border-radius:16px;background:var(--surface);overflow:hidden;cursor:pointer;color:inherit;font-family:inherit;padding:0;transition:transform .28s,border-color .28s,box-shadow .28s}
  .gal-card:hover{transform:translateY(-6px);border-color:color-mix(in srgb,var(--accent) 55%,transparent);box-shadow:var(--shadow)}
  .gal-art{aspect-ratio:1/1;display:grid;place-items:center;padding:18px;background:radial-gradient(120% 100% at 50% 0%,color-mix(in srgb,var(--accent) 13%,transparent),transparent 62%),var(--bg-3);border-bottom:1px solid var(--border)}
  .gal-art svg{width:66%;filter:drop-shadow(0 14px 22px rgba(0,0,0,.42))}
  .gal-cap{padding:12px 14px 14px}
  .gal-t{display:block;font-family:var(--serif);font-weight:600;font-size:1.04rem;line-height:1.15}
  .gal-m{display:block;color:var(--dim);font-size:.78rem;margin-top:3px;font-family:var(--mono);letter-spacing:.02em}
  .gal-cap{padding:12px 14px 8px}
  .gal-order{display:block;width:calc(100% - 28px);margin:2px 14px 14px;background:linear-gradient(135deg,var(--accent),var(--accent-2));color:#0b0b0b;border:0;border-radius:10px;padding:9px 12px;font-family:inherit;font-weight:600;font-size:.82rem;cursor:pointer;transition:transform .2s,box-shadow .2s}
  .gal-order:hover{transform:translateY(-1px);box-shadow:0 6px 16px color-mix(in srgb,var(--accent) 38%,transparent)}
  .gal-cta{text-align:center;margin-top:30px}
  @media(max-width:980px){.gallery{grid-template-columns:repeat(3,1fr)}}
  @media(max-width:680px){.gallery{grid-template-columns:repeat(2,1fr)}}
  /* ---- Order wizard ---- */
  .ord-products{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:8px}
  .ord-card{display:flex;gap:14px;align-items:center;text-align:left;border:1px solid var(--border);border-radius:18px;background:var(--surface);padding:18px;cursor:pointer;color:inherit;font-family:inherit;transition:transform .25s,border-color .25s,box-shadow .25s}
  .ord-card:hover{transform:translateY(-5px);border-color:color-mix(in srgb,var(--accent) 55%,transparent);box-shadow:var(--shadow)}
  .ord-art{width:78px;height:78px;flex:none;border-radius:13px;background:var(--bg-3);border:1px solid var(--border);display:grid;place-items:center;padding:9px}
  .ord-art svg{width:100%;height:100%}
  .ord-name{font-family:var(--serif);font-weight:600;font-size:1.22rem;line-height:1.1}
  .ord-from{color:var(--dim);font-size:.86rem;margin-top:4px}
  .ord-grid2{display:grid;grid-template-columns:.92fr 1.08fr;gap:38px;align-items:start;margin-top:10px}
  .ord-preview{position:sticky;top:92px}
  .ord-prev-art{border:1px solid var(--border-strong);border-radius:22px;aspect-ratio:1/1;display:grid;place-items:center;background:radial-gradient(120% 90% at 50% 0%,color-mix(in srgb,var(--accent) 14%,transparent),transparent 60%),var(--bg-3);box-shadow:var(--shadow)}
  .ord-prev-art svg{width:62%;filter:drop-shadow(0 18px 30px rgba(0,0,0,.45))}
  .ord-sec{margin-bottom:22px}
  .ord-lbl{display:block;font-family:var(--mono);font-size:.62rem;letter-spacing:.13em;text-transform:uppercase;color:var(--faint);margin-bottom:11px}
  .ord-opts{display:flex;flex-wrap:wrap;gap:9px}
  .ord-opt{display:flex;align-items:center;gap:9px;border:1px solid var(--border);background:var(--surface);color:var(--text);border-radius:13px;padding:9px 13px;cursor:pointer;font-family:inherit;font-size:.9rem;transition:border-color .2s,transform .2s,box-shadow .2s}
  .ord-opt:hover{transform:translateY(-2px)}
  .ord-opt.on{border-color:var(--accent);box-shadow:0 0 0 3px color-mix(in srgb,var(--accent) 16%,transparent)}
  .ord-opt small{color:var(--dim);font-size:.8rem;margin-left:2px}
  .ord-opt-art{width:30px;height:30px;flex:none;display:grid;place-items:center}
  .ord-opt-art svg{width:100%;height:100%}
  .ord-opt .dot{width:20px;height:20px;border-radius:50%;border:1px solid rgba(255,255,255,.3)}
  .ord-summary{display:flex;justify-content:space-between;align-items:center;border-top:1px solid var(--border);padding-top:16px;margin:4px 0 16px}
  .ord-summary b{font-weight:600}
  .ord-price{font-family:var(--serif);font-size:1.6rem;white-space:nowrap}
  .ord-done{margin-top:14px;padding:16px;border:1px solid color-mix(in srgb,var(--accent) 40%,transparent);border-radius:14px;background:color-mix(in srgb,var(--accent) 9%,var(--surface));color:var(--accent-ink);font-weight:600}
  .ord-done-actions{display:flex;gap:10px;margin-top:12px;flex-wrap:wrap}
  @media(max-width:900px){.ord-products{grid-template-columns:1fr}.ord-grid2{grid-template-columns:1fr;gap:24px}.ord-preview{position:static}.ord-prev-art{max-width:320px;margin:0 auto}}
  /* ===== Remos-style admin skin (scoped to admin view) ===== */
  [data-view="admin"]{background:#F2F7FB}
  [data-view="admin"] .wrap{max-width:1320px}
  [data-view="admin"] .back{color:#575864}
  [data-view="admin"] .back:hover{color:#111}
  [data-view="admin"] .sec-head{text-align:left}
  [data-view="admin"] .sec-head .k{color:#2275fc}
  [data-view="admin"] .sec-head h2{color:#111}
  [data-view="admin"] .sec-head p{color:#575864;margin-left:0}
  [data-view="admin"] .adm-shell{display:flex;gap:22px;align-items:flex-start}
  [data-view="admin"] .adm-side{flex:none;width:212px;position:sticky;top:88px;background:#fff;border:1px solid #ECF0F4;border-radius:16px;padding:14px;box-shadow:0 8px 28px rgba(17,17,17,.06)}
  [data-view="admin"] .adm-brand{font-family:var(--serif);font-weight:700;color:#111;font-size:1.18rem;padding:6px 8px 14px;border-bottom:1px solid #ECF0F4;margin-bottom:10px}
  [data-view="admin"] .adm-main{flex:1;min-width:0}
  [data-view="admin"] .adm-tabs{display:flex;flex-direction:column;gap:3px;background:none;border:0;padding:0;margin:0;width:auto;max-width:none;overflow:visible}
  [data-view="admin"] .adm-navlbl{font-family:var(--mono);font-size:.58rem;letter-spacing:.12em;text-transform:uppercase;color:#A6ADBB;padding:12px 10px 5px}
  [data-view="admin"] .adm-tab{display:block;width:100%;text-align:left;color:#575864;font-weight:600;font-size:.9rem;padding:10px 12px;border-radius:10px;white-space:normal}
  [data-view="admin"] .adm-tab:hover{background:#EDF1F5;color:#111}
  [data-view="admin"] .adm-tab.on{background:#2275fc;color:#fff}
  [data-view="admin"] .adm-bar{display:flex;flex-wrap:wrap;gap:9px;align-items:center;background:#fff;border:1px solid #ECF0F4;border-radius:14px;padding:12px;box-shadow:0 8px 28px rgba(17,17,17,.06);margin-bottom:18px}
  [data-view="admin"] .btn-sm{background:#fff;border:1px solid #ECF0F4;color:#111;border-radius:10px;font-weight:600;padding:9px 14px}
  [data-view="admin"] .btn-sm:hover{background:#EDF1F5}
  [data-view="admin"] .btn-sm.pri{background:#2275fc;border-color:#2275fc;color:#fff}
  [data-view="admin"] .btn-sm.pri:hover{filter:brightness(1.05)}
  [data-view="admin"] .btn-sm.danger{color:#EF4444;border-color:#F8717155}
  [data-view="admin"] .btn-sm.danger:hover{background:#FEF2F2}
  [data-view="admin"] .status{color:#22C55E;font-weight:600}
  [data-view="admin"] .adm-prod{background:#fff;border:1px solid #ECF0F4;border-radius:16px;padding:22px;box-shadow:0 8px 28px rgba(17,17,17,.06);margin-bottom:18px}
  [data-view="admin"] .adm-prod .ph h3,[data-view="admin"] .dash-head h3{color:#111}
  [data-view="admin"] .adm-sub{color:#858B93}
  [data-view="admin"] .adm-toggle{color:#575864}
  [data-view="admin"] .adm-f label{color:#858B93}
  [data-view="admin"] input[type=text],[data-view="admin"] input[type=number],[data-view="admin"] input[type=password],[data-view="admin"] .adm-row select,[data-view="admin"] .dash-search{background:#fff;border:1px solid #ECF0F4;color:#111;border-radius:10px}
  [data-view="admin"] input::placeholder{color:#9aa1ad}
  [data-view="admin"] input:focus,[data-view="admin"] select:focus{border-color:#2275fc;outline:none;box-shadow:0 0 0 3px rgba(34,117,252,.16)}
  [data-view="admin"] .adm-row select option{background:#fff;color:#111}
  [data-view="admin"] .adm-row .btn-mini{background:#fff;border-color:#ECF0F4;color:#111}
  [data-view="admin"] .adm-row .btn-mini.on{border-color:#2275fc;color:#2275fc}
  [data-view="admin"] .x{color:#9aa1ad}
  [data-view="admin"] .x:hover{color:#EF4444}
  [data-view="admin"] .dash-count{background:rgba(34,117,252,.12);color:#2275fc}
  [data-view="admin"] .dash-scroll{border-color:#ECF0F4;background:#fff;border-radius:14px;box-shadow:0 8px 28px rgba(17,17,17,.06)}
  [data-view="admin"] .dash-table th{color:#858B93;border-bottom-color:#ECF0F4;background:#F7FAFC}
  [data-view="admin"] .dash-table td{border-bottom-color:#ECF0F4}
  [data-view="admin"] .dash-table tbody tr:hover{background:#F7FAFC}
  [data-view="admin"] .dash-table input{color:#111}
  [data-view="admin"] .dash-table input:hover{border-color:#ECF0F4}
  [data-view="admin"] .dash-table input:focus{border-color:#2275fc;background:#fff}
  [data-view="admin"] .adm-gate{background:#fff;border:1px solid #ECF0F4;border-radius:16px;box-shadow:0 8px 28px rgba(17,17,17,.06)}
  [data-view="admin"] .adm-gate .adm-sub{color:#858B93}
  [data-view="admin"] .adm-err{color:#EF4444}
  @media(max-width:760px){
    [data-view="admin"] .adm-shell{flex-direction:column}
    [data-view="admin"] .adm-side{width:auto;position:static}
    [data-view="admin"] .adm-tabs{flex-direction:row;flex-wrap:wrap}
    [data-view="admin"] .adm-navlbl{width:100%;padding-top:6px}
  }
  [data-view="admin"] .ov-head{margin-bottom:18px}
  [data-view="admin"] .ov-head h2{font-family:var(--serif);color:#111;font-size:1.7rem;margin:0 0 4px}
  [data-view="admin"] .ov-head p{color:#858B93;margin:0;font-size:.9rem}
  [data-view="admin"] .ov-cards{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:18px}
  [data-view="admin"] .wg-card{background:#fff;border:1px solid #ECF0F4;border-radius:16px;padding:18px;box-shadow:0 8px 28px rgba(17,17,17,.06)}
  [data-view="admin"] .wg-card-top{display:flex;align-items:center;gap:12px}
  [data-view="admin"] .wg-badge{position:relative;width:46px;height:50px;flex:none}
  [data-view="admin"] .wg-badge .hex{position:absolute;inset:0;width:100%;height:100%}
  [data-view="admin"] .wg-badge .ico{position:absolute;inset:0;margin:auto;width:20px;height:20px;display:grid;place-items:center}
  [data-view="admin"] .wg-badge .ico svg{width:20px;height:20px}
  [data-view="admin"] .wg-meta{min-width:0}
  [data-view="admin"] .wg-lbl{color:#858B93;font-size:.8rem;margin-bottom:5px}
  [data-view="admin"] .wg-val{color:#111;font-weight:700;font-size:1.45rem;font-family:var(--serif);line-height:1}
  [data-view="admin"] .wg-trend{margin-left:auto;display:flex;align-items:center;gap:4px;font-size:.74rem;font-weight:600;padding:4px 8px;border-radius:8px;white-space:nowrap}
  [data-view="admin"] .wg-trend.up{color:#16A34A;background:#DCFCE7}
  [data-view="admin"] .wg-trend.down{color:#DC2626;background:#FEE2E2}
  [data-view="admin"] .wg-trend.flat{color:#64748B;background:#F1F5F9}
  [data-view="admin"] .wg-spark{margin-top:12px}
  [data-view="admin"] .wg-spark svg{width:100%;height:46px;display:block}
  [data-view="admin"] .ov-row{display:grid;grid-template-columns:1.6fr 1fr;gap:18px;margin-bottom:18px}
  [data-view="admin"] .ov-panel{background:#fff;border:1px solid #ECF0F4;border-radius:16px;padding:20px;box-shadow:0 8px 28px rgba(17,17,17,.06)}
  [data-view="admin"] .ov-panel h3{color:#111;font-family:var(--serif);font-size:1.15rem;margin:0 0 16px}
  [data-view="admin"] .ov-chart svg{width:100%;height:230px}
  [data-view="admin"] .ov-donut{display:flex;align-items:center;gap:22px;flex-wrap:wrap}
  [data-view="admin"] .ov-legend{display:flex;flex-direction:column;gap:9px;font-size:.84rem;color:#575864}
  [data-view="admin"] .ov-legend .dot{width:10px;height:10px;border-radius:3px;display:inline-block;margin-right:9px}
  [data-view="admin"] .ov-orders table{width:100%;border-collapse:collapse;font-size:.86rem}
  [data-view="admin"] .ov-orders th{text-align:left;color:#858B93;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:10px;border-bottom:1px solid #ECF0F4;white-space:nowrap}
  [data-view="admin"] .ov-orders td{padding:12px 10px;border-bottom:1px solid #ECF0F4;color:#111}
  [data-view="admin"] .ov-orders tbody tr:last-child td{border-bottom:0}
  [data-view="admin"] .pill{display:inline-block;padding:4px 11px;border-radius:999px;font-size:.74rem;font-weight:600}
  [data-view="admin"] .pill.green{background:#DCFCE7;color:#16A34A}
  [data-view="admin"] .pill.red{background:#FEE2E2;color:#DC2626}
  [data-view="admin"] .pill.orange{background:#FFEDD5;color:#EA580C}
  [data-view="admin"] .pill.gray{background:#F1F5F9;color:#64748B}
  @media(max-width:980px){[data-view="admin"] .ov-cards{grid-template-columns:repeat(2,1fr)}[data-view="admin"] .ov-row{grid-template-columns:1fr}}
  @media(max-width:560px){[data-view="admin"] .ov-cards{grid-template-columns:1fr}}
</style>
</head>
<body>
<div id="spot"></div>

<!-- ============ NAV ============ -->
<header>
  <div class="wrap nav">
    <button class="brand" data-go="home"><span class="logo">O</span><b>ODN Prints</b></button>
    <nav class="navlinks" id="menu">
      <button data-go="3d">3D Models</button>
      <button data-go="metal">Metal Prints</button>
      <button data-go="deskmat">Desk Mats</button>
      <a class="navcta" href="/contact-us/">Contact</a>
    </nav>
    <div class="toolbtns">
      <button class="cartbtn" id="cartBtn" aria-label="Open cart">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M6 6h15l-1.5 9h-12z"/><path d="M6 6L5 3H2"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/></svg>
        <span class="cart-badge" id="cartCount" hidden>0</span>
      </button>
      <button class="toggle" id="theme" aria-label="Toggle dark / light">
        <span class="knob"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="ico">
          <circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2M5 5l1.5 1.5M17.5 17.5L19 19M19 5l-1.5 1.5M6.5 17.5L5 19"/></svg></span>
      </button>
      <button class="burger" id="burger" aria-label="Menu">☰</button>
    </div>
  </div>
</header>

<!-- ================= HOME ================= -->
<main data-view="home">

  <!-- hero -->
  <section class="hhero wrap">
    <div class="hhead">
      <span class="eyebrow mono"><span class="dot"></span> Custom print studio · Hisar</span>
      <h1>One studio.<br><em>Three</em> ways to make it real.</h1>
    </div>
    <p class="lede">Turn a photo or a design into a 3D-printed figurine, a metal print, or a desk mat — sculpted, printed and finished by hand in Hisar.</p>
    <div class="hcta">
      <button class="btn btn-pri btn-lg" data-mag data-go="order">Start an order →</button>
    </div>
    <div class="stats">
      <div class="stat"><b data-count="3">0</b><span>Product lines</span></div>
      <div class="stat"><b data-count="7">0</b><span>Figurine styles</span></div>
      <div class="stat"><b data-count="100" data-suffix="%">0</b><span>Hand-finished</span></div>
      <div class="stat"><b>Pan-India</b><span>Shipping</span></div>
    </div>
  </section>

  <!-- product tiles -->
  <section class="pad" id="products" style="padding-top:64px">
    <div class="wrap">
      <div class="sec-head reveal">
        <span class="k mono">What we make</span>
        <h2>Pick a product.</h2>
        <p>Three things, one obsession with detail. Hover a tile to see it in colour — click to open its page.</p>
      </div>
      <div class="prods">

        <button class="prod reveal" data-go="3d" data-prod="figurine">
          <div class="shot"><span class="bw-tag">Hover for colour</span>
            <svg class="fg" viewBox="0 0 120 150" aria-hidden="true">
              <ellipse cx="60" cy="44" rx="36" ry="35" class="a"/><path d="M28 82 q32 -16 64 0 l-7 56 q-25 12 -50 0 Z" class="a"/>
              <ellipse cx="48" cy="44" rx="8" ry="10" fill="#fff"/><ellipse cx="72" cy="44" rx="8" ry="10" fill="#fff"/>
              <circle cx="49" cy="46" r="4.5" class="d"/><circle cx="71" cy="46" r="4.5" class="d"/>
              <path d="M49 62 q11 8 22 0" stroke="var(--bg)" stroke-width="3.5" fill="none" stroke-linecap="round"/>
              <rect x="44" y="134" width="32" height="9" rx="3" class="b" opacity=".7"/></svg>
          </div>
          <div class="pinfo">
            <span class="no">01 — Resin figurines</span>
            <h3>3D Models</h3>
            <p>Figurines sculpted from your photo, in seven collectible styles.</p>
            <span class="go">View models <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
          </div>
        </button>

        <button class="prod reveal" data-go="metal" data-prod="metal">
          <div class="shot"><span class="bw-tag">Hover for colour</span>
            <svg viewBox="0 0 200 150" aria-hidden="true">
              <defs>
                <linearGradient id="metalH" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#c9ced6"/><stop offset=".5" stop-color="#eef1f5"/><stop offset="1" stop-color="#a9afb9"/></linearGradient>
                <linearGradient id="skyH" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="var(--aqua)"/><stop offset="1" stop-color="var(--accent-2)"/></linearGradient>
              </defs>
              <rect x="38" y="18" width="124" height="114" rx="6" fill="url(#metalH)"/>
              <rect x="46" y="26" width="108" height="98" rx="3" fill="url(#skyH)"/>
              <circle cx="124" cy="52" r="11" fill="var(--accent)"/>
              <path d="M46 124 l26 -42 20 26 16 -30 46 46 Z" fill="#222732" opacity=".5"/>
              <polygon points="38,18 70,18 48,132 38,132" fill="#fff" opacity=".14"/></svg>
          </div>
          <div class="pinfo">
            <span class="no">02 — Aluminium</span>
            <h3>Metal Prints</h3>
            <p>Your photos fused into metal — vivid, glossy and fade-proof.</p>
            <span class="go">View prints <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
          </div>
        </button>

        <button class="prod reveal" data-go="deskmat" data-prod="deskmat">
          <div class="shot"><span class="bw-tag">Hover for colour</span>
            <svg viewBox="0 0 220 150" aria-hidden="true">
              <polygon points="28,46 192,46 208,112 12,112" fill="#191d24"/>
              <path d="M40 100 l30 -34 22 18 18 -24 40 40 Z" fill="var(--accent)" opacity=".85"/>
              <circle cx="150" cy="64" r="9" fill="var(--accent-2)"/>
              <polygon points="28,46 192,46 208,112 12,112" fill="none" stroke="var(--accent)" stroke-width="1.6" stroke-dasharray="4 4" opacity=".8"/>
              <rect x="64" y="86" width="60" height="15" rx="3" fill="#39414f"/><ellipse cx="150" cy="94" rx="11" ry="15" fill="#39414f"/></svg>
          </div>
          <div class="pinfo">
            <span class="no">03 — Stitched edge</span>
            <h3>Deskmats</h3>
            <p>Full-surface printed mats with stitched edges and a non-slip base.</p>
            <span class="go">View mats <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
          </div>
        </button>

      </div>
    </div>
  </section>

  <!-- why -->
  <section class="pad" id="why" style="padding-top:30px">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">Why ODN Prints</span><h2>Made by hand, made to last.</h2></div>
      <div class="why-grid">
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4M11 8v6M8 11h6"/></svg><h4>Detailed prints</h4><p>High-resolution detail in every sculpt and print — fine lines, real texture.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M8 12l2.5 2.5L16 9"/></svg><h4>Approved before print</h4><p>You sign off on the digital sculpt or proof before we commit it to production.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M14 3l7 7-9 9-7 1 1-7 8-10z"/><path d="M11 6l7 7"/></svg><h4>Hand-crafted</h4><p>Every piece is cleaned, cured and assembled by hand — not mass-moulded.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 21c2-1 3-3 3-5l9-9 3 3-9 9c-2 0-4 1-6 2z"/><path d="M14 5l5 5"/></svg><h4>Hand-painted</h4><p>Figurines finished with hand-applied colour for depth a printer can’t match.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21s-7-5.5-7-11a7 7 0 0 1 14 0c0 5.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg><h4>Local studio</h4><p>A real workshop in Hisar you can reach and visit — walk-in pickup welcome.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="3" width="8" height="8" rx="1.5"/><rect x="13" y="3" width="8" height="8" rx="1.5"/><rect x="8" y="13" width="8" height="8" rx="1.5"/></svg><h4>Three products, one studio</h4><p>Figurines, metal prints and desk mats — sourced and made under one roof.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 7l9-4 9 4-9 4-9-4z"/><path d="M3 7v10l9 4 9-4V7M12 11v10"/></svg><h4>Perfect packing</h4><p>Protective, gift-ready packaging so every order arrives flawless.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 7h11v8H3zM14 10h4l3 3v2h-7z"/><circle cx="7" cy="18" r="1.6"/><circle cx="17" cy="18" r="1.6"/></svg><h4>Pan-India shipping</h4><p>Carefully boxed and shipped to your door anywhere in the country.</p></div>
      </div>
    </div>
  </section>
</main>

<!-- ================= 3D MODELS ================= -->
<main data-view="3d" hidden>
  <section class="phero wrap">
    <button class="back" data-go="home"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg> All products</button>
    <div class="phero-grid">
      <div>
        <span class="eyebrow mono"><span class="dot"></span> 3D Models · Resin figurines</span>
        <h2>From a photo to a figure you <em>can hold.</em></h2>
        <p class="lede">We sculpt your subject, print it in detail resin, hand-paint it, and ship a collectible in any of seven styles. Drag the slider to watch a scan become resin.</p>
        <button class="btn btn-pri" data-mag data-shop="figurine">Order Figurine →</button>
      </div>
      <div class="ba" id="ba" style="--pos:55%">
        <span class="lbl l mono">Your photo</span><span class="lbl r mono">Resin figure</span>
        <div class="layer"><svg class="fg" viewBox="0 0 120 150" aria-hidden="true">
          <ellipse cx="60" cy="42" rx="36" ry="35" class="a"/><path d="M28 80 q32 -16 64 0 l-7 56 q-25 12 -50 0 Z" class="a"/>
          <ellipse cx="48" cy="42" rx="8" ry="10" fill="#fff"/><ellipse cx="72" cy="42" rx="8" ry="10" fill="#fff"/>
          <circle cx="49" cy="44" r="4.5" class="d"/><circle cx="71" cy="44" r="4.5" class="d"/>
          <path d="M49 60 q11 8 22 0" stroke="var(--bg)" stroke-width="3.5" fill="none" stroke-linecap="round"/>
          <rect x="44" y="132" width="32" height="9" rx="3" class="b" opacity=".7"/></svg></div>
        <div class="layer photo"><svg viewBox="0 0 120 150" aria-hidden="true" fill="none" stroke="var(--aqua)" stroke-width="1.4">
          <ellipse cx="60" cy="42" rx="36" ry="35"/><path d="M28 80 q32 -16 64 0 l-7 56 q-25 12 -50 0 Z"/>
          <ellipse cx="48" cy="42" rx="8" ry="10"/><ellipse cx="72" cy="42" rx="8" ry="10"/>
          <path d="M24 60 h72" opacity=".45"/><path d="M30 104 h60" opacity=".4"/><path d="M36 124 h48" opacity=".35"/></svg></div>
        <div class="scanlines"></div><div class="divider"></div>
        <div class="handle" id="handle" role="slider" aria-label="Reveal figure" tabindex="0"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-5 6 5 6M15 6l5 6-5 6"/></svg></div>
      </div>
    </div>
  </section>

  <section class="pad">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">The catalogue · 01–07</span><h2>Seven ways to be a figurine.</h2><p>Every style is sculpted from scratch around your photo. Tilt a card to explore.</p></div>
      <div class="grid7">
        <article class="tcard reveal" data-tilt><div class="glare"></div><div class="no mono"><span>CAT.01</span><span class="tag">Cinematic</span></div>
          <div class="stage"><svg class="fg" width="100" viewBox="0 0 120 150"><ellipse cx="60" cy="46" rx="38" ry="36" class="a"/><path d="M28 84 q32 -14 64 0 l-8 54 q-24 12 -48 0 Z" class="a"/><ellipse cx="47" cy="44" rx="9" ry="11" fill="#fff"/><ellipse cx="73" cy="44" rx="9" ry="11" fill="#fff"/><circle cx="49" cy="46" r="5" class="d"/><circle cx="71" cy="46" r="5" class="d"/><path d="M48 62 q12 9 24 0" stroke="var(--bg)" stroke-width="3.5" fill="none" stroke-linecap="round"/></svg></div>
          <h3>Pixar-style</h3><p class="line">Rounded, expressive, big-hearted — a movie character mid-scene.</p><div class="specs"><div><span class="k2">Best for</span><span class="v2">Family</span></div><div><span class="k2">Vibe</span><span class="v2">Wholesome</span></div></div></article>
        <article class="tcard reveal" data-tilt><div class="glare"></div><div class="no mono"><span>CAT.02</span><span class="tag">Shelf classic</span></div>
          <div class="stage"><svg class="fg" width="100" viewBox="0 0 120 150"><rect x="24" y="14" width="72" height="62" rx="10" class="a"/><rect x="40" y="78" width="40" height="58" rx="6" class="a"/><circle cx="48" cy="46" r="8" fill="#fff"/><circle cx="72" cy="46" r="8" fill="#fff"/><circle cx="48" cy="46" r="3" class="d"/><circle cx="72" cy="46" r="3" class="d"/></svg></div>
          <h3>Funko-style</h3><p class="line">Oversized square head, minimal body, iconic button eyes.</p><div class="specs"><div><span class="k2">Best for</span><span class="v2">Collectors</span></div><div><span class="k2">Vibe</span><span class="v2">Pop-culture</span></div></div></article>
        <article class="tcard reveal" data-tilt><div class="glare"></div><div class="no mono"><span>CAT.03</span><span class="tag">Kawaii</span></div>
          <div class="stage"><svg class="fg" width="100" viewBox="0 0 120 150"><circle cx="60" cy="50" r="44" class="a"/><path d="M36 96 q24 -8 48 0 l-4 38 q-20 9 -40 0 Z" class="a"/><ellipse cx="46" cy="52" rx="7" ry="10" class="d"/><ellipse cx="74" cy="52" rx="7" ry="10" class="d"/><circle cx="48" cy="49" r="2.5" fill="#fff"/><circle cx="76" cy="49" r="2.5" fill="#fff"/><ellipse cx="40" cy="64" rx="5" ry="3" class="b" opacity=".8"/><ellipse cx="80" cy="64" rx="5" ry="3" class="b" opacity=".8"/></svg></div>
          <h3>Nendoroid chibi</h3><p class="line">A giant head on a tiny posable body. Maximum sweetness.</p><div class="specs"><div><span class="k2">Best for</span><span class="v2">Anime fans</span></div><div><span class="k2">Vibe</span><span class="v2">Adorable</span></div></div></article>
        <article class="tcard reveal" data-tilt><div class="glare"></div><div class="no mono"><span>CAT.04</span><span class="tag">True likeness</span></div>
          <div class="stage"><svg class="fg" width="100" viewBox="0 0 120 150"><circle cx="60" cy="36" r="26" class="a"/><path d="M30 70 q30 -16 60 0 l-4 64 q-26 12 -52 0 Z" class="a"/><circle cx="51" cy="34" r="3.5" class="d"/><circle cx="69" cy="34" r="3.5" class="d"/><path d="M53 46 q7 5 14 0" stroke="var(--bg)" stroke-width="2.5" fill="none" stroke-linecap="round"/><rect x="38" y="86" width="44" height="2.5" class="b" opacity=".6"/><rect x="38" y="102" width="44" height="2.5" class="b" opacity=".45"/></svg></div>
          <h3>Photo to figurine</h3><p class="line">Realistic proportions sculpted from your photos — you, couples, pets.</p><div class="specs"><div><span class="k2">Best for</span><span class="v2">Gifts</span></div><div><span class="k2">Vibe</span><span class="v2">True-to-life</span></div></div></article>
        <article class="tcard reveal" data-tilt><div class="glare"></div><div class="no mono"><span>CAT.05</span><span class="tag">Art toy</span></div>
          <div class="stage"><svg class="fg" width="100" viewBox="0 0 120 150"><polygon points="60,8 92,40 78,78 42,78 28,40" class="a"/><polygon points="42,78 78,78 84,138 36,138" class="a"/><polygon points="60,8 92,40 78,78 60,60" class="b" opacity=".55"/><circle cx="50" cy="44" r="3.5" class="d"/><circle cx="70" cy="44" r="3.5" class="d"/></svg></div>
          <h3>Designer collectible</h3><p class="line">Bold, stylised, gallery-grade forms for brands and statements.</p><div class="specs"><div><span class="k2">Best for</span><span class="v2">Brands</span></div><div><span class="k2">Vibe</span><span class="v2">Edgy</span></div></div></article>
        <article class="tcard reveal" data-tilt><div class="glare"></div><div class="no mono"><span>CAT.06</span><span class="tag">It nods</span></div>
          <div class="stage"><svg class="fg" width="100" viewBox="0 0 120 150"><circle cx="60" cy="40" r="34" class="a"/><rect x="55" y="72" width="10" height="14" class="b"/><path d="M34 88 q26 -10 52 0 l-4 48 q-22 10 -44 0 Z" class="a"/><circle cx="50" cy="40" r="4" class="d"/><circle cx="70" cy="40" r="4" class="d"/><path d="M50 54 q10 7 20 0" stroke="var(--bg)" stroke-width="3" fill="none" stroke-linecap="round"/></svg></div>
          <h3>Bobblehead</h3><p class="line">An oversized head on a spring that nods at a tap.</p><div class="specs"><div><span class="k2">Best for</span><span class="v2">Desks &amp; cars</span></div><div><span class="k2">Vibe</span><span class="v2">Playful</span></div></div></article>
        <article class="tcard reveal" data-tilt><div class="glare"></div><div class="no mono"><span>CAT.07</span><span class="tag">Storybook</span></div>
          <div class="stage"><svg class="fg" width="100" viewBox="0 0 120 150"><ellipse cx="60" cy="38" rx="28" ry="30" class="a"/><path d="M40 66 q20 -10 40 0 l14 70 q-34 14 -68 0 Z" class="a"/><ellipse cx="50" cy="38" rx="5" ry="7" class="d"/><ellipse cx="70" cy="38" rx="5" ry="7" class="d"/><path d="M52 52 q8 6 16 0" stroke="var(--bg)" stroke-width="2.5" fill="none" stroke-linecap="round"/><path d="M60 8 l4 9 l-8 0 Z" class="b"/></svg></div>
          <h3>Disney-style</h3><p class="line">Graceful proportions and a fairy-tale finish.</p><div class="specs"><div><span class="k2">Best for</span><span class="v2">Keepsakes</span></div><div><span class="k2">Vibe</span><span class="v2">Magical</span></div></div></article>
      </div>
      <p class="disclaim">ODN Prints creates original, made-to-order figurines inspired by these popular art styles. We are an independent studio, not affiliated with, endorsed by, or licensed by Funko, Pixar, Disney, or Good Smile / Nendoroid, and we don’t reproduce protected characters — we sculpt your subject in the style you love.</p>
    </div>
  </section>

  <section class="pad gallery-sec" style="padding-top:0">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">Design gallery</span><h2>A few we’ve brought to life.</h2><p>Browse by category, then tap a design to enlarge it or start your order.</p></div>
      <div class="gal-cats reveal" id="galcat-figurine"></div>
      <div class="gallery reveal" id="gallery-figurine"></div>
      <div class="gal-cta reveal"><button class="btn btn-pri" data-mag data-go="order">Start your design →</button></div>
    </div>
  </section>

  <section class="pad" style="padding-top:0">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">From photo to shelf</span><h2>How your figure gets made.</h2></div>
      <div class="steps">
        <div class="step reveal"><div class="ring">01</div><h4>Send photos</h4><p>A clear front and side shot in good light.</p></div>
        <div class="step reveal"><div class="ring">02</div><h4>We sculpt</h4><p>You approve a 3D preview before printing.</p></div>
        <div class="step reveal"><div class="ring">03</div><h4>Print &amp; cure</h4><p>Detail resin, UV-cured, supports removed.</p></div>
        <div class="step reveal"><div class="ring">04</div><h4>Hand-finish</h4><p>Sanded, primed and painted by hand.</p></div>
        <div class="step reveal"><div class="ring">05</div><h4>Pack &amp; ship</h4><p>Boxed snug and shipped across India.</p></div>
      </div>
    </div>
  </section>

  <section class="pad" style="padding-top:0">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">Pick your scale</span><h2>Three sizes to suit the shelf.</h2><p>Starting prices for a single-figure design. Final quotes depend on detail, pose and number of people.</p></div>
      <div class="size-grid" id="sizes-figurine"></div>
    </div>
  </section>
</main>

<!-- ================= METAL PRINTS ================= -->
<main data-view="metal" hidden>
  <section class="phero wrap">
    <button class="back" data-go="home"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg> All products</button>
    <div class="phero-grid">
      <div>
        <span class="eyebrow mono"><span class="dot"></span> Metal Prints · Aluminium</span>
        <h2>Your photos, <em>fused into metal.</em></h2>
        <p class="lede">HD dye-sublimation bonds your image into a coated aluminium panel — colour that pops, surfaces that survive moisture and sunlight, and edges ready to hang straight from the box.</p>
        <button class="btn btn-pri" data-mag data-shop="metal">Order Metal print →</button>
      </div>
      <div class="pshow">
        <svg viewBox="0 0 200 150" aria-hidden="true">
          <defs>
            <linearGradient id="metalP" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#c9ced6"/><stop offset=".5" stop-color="#eef1f5"/><stop offset="1" stop-color="#a9afb9"/></linearGradient>
            <linearGradient id="skyP" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="var(--aqua)"/><stop offset="1" stop-color="var(--accent-2)"/></linearGradient>
          </defs>
          <rect x="30" y="14" width="140" height="124" rx="7" fill="url(#metalP)"/>
          <rect x="40" y="24" width="120" height="104" rx="4" fill="url(#skyP)"/>
          <circle cx="128" cy="52" r="13" fill="var(--accent)"/>
          <path d="M40 128 l30 -48 22 28 18 -34 50 54 Z" fill="#222732" opacity=".5"/>
          <polygon points="30,14 68,14 44,138 30,138" fill="#fff" opacity=".14"/>
          <rect x="30" y="14" width="140" height="124" rx="7" fill="none" stroke="#8a8f99" stroke-width="1" opacity=".5"/></svg>
      </div>
    </div>
  </section>

  <section class="pad" style="padding-top:24px">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">Why metal</span><h2>Built to outlast paper and canvas.</h2></div>
      <div class="feat4">
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="4"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/></svg><h4>HD sublimation</h4><p>Colour bonded into the coating, not sitting on top — sharp and brilliant.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M4 14l5-5 4 4 3-3 4 4"/></svg><h4>Gloss or matte</h4><p>Choose a high-gloss pop or a glare-free matte finish for your space.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3c4 4 6 7 6 10a6 6 0 0 1-12 0c0-3 2-6 6-10z"/></svg><h4>Waterproof &amp; fade-proof</h4><p>Resists moisture, scratches and UV — it won’t yellow or peel.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M12 3v4"/></svg><h4>Ready to hang</h4><p>Float-mounted or with hooks — up on the wall in seconds.</p></div>
      </div>
    </div>
  </section>

  <section class="pad gallery-sec" style="padding-top:0">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">Design gallery</span><h2>Prints off the wall.</h2><p>Browse by category, then tap a design to enlarge it or start your order.</p></div>
      <div class="gal-cats reveal" id="galcat-metal"></div>
      <div class="gallery reveal" id="gallery-metal"></div>
      <div class="gal-cta reveal"><button class="btn btn-pri" data-mag data-go="order">Start your design →</button></div>
    </div>
  </section>

  <section class="pad" style="padding-top:0">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">Sizes &amp; pricing</span><h2>Pick a size.</h2><p>Starting prices for a single panel. Custom and large-format sizes on request.</p></div>
      <div class="size-grid" id="sizes-metal"></div>
    </div>
  </section>
</main>

<!-- ================= DESKMATS ================= -->
<main data-view="deskmat" hidden>
  <section class="phero wrap">
    <button class="back" data-go="home"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg> All products</button>
    <div class="phero-grid">
      <div>
        <span class="eyebrow mono"><span class="dot"></span> Desk Mats · Stitched edge</span>
        <h2>Desk mats that <em>set the scene.</em></h2>
        <p class="lede">Your art, logo or photo printed corner to corner on a smooth cloth surface — finished with anti-fray stitched edges and a grippy non-slip base. Any size, any design.</p>
        <button class="btn btn-pri" data-mag data-shop="deskmat">Order Deskmat →</button>
      </div>
      <div class="pshow">
        <svg viewBox="0 0 220 150" aria-hidden="true">
          <polygon points="22,42 198,42 214,116 6,116" fill="#191d24"/>
          <path d="M38 104 l34 -40 24 20 20 -28 46 48 Z" fill="var(--accent)" opacity=".85"/>
          <circle cx="156" cy="62" r="11" fill="var(--accent-2)"/>
          <polygon points="22,42 198,42 214,116 6,116" fill="none" stroke="var(--accent)" stroke-width="1.8" stroke-dasharray="5 4" opacity=".85"/>
          <rect x="60" y="86" width="66" height="17" rx="3" fill="#39414f"/><ellipse cx="156" cy="96" rx="12" ry="16" fill="#39414f"/></svg>
      </div>
    </div>
  </section>

  <section class="pad" style="padding-top:24px">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">The details</span><h2>Made for everyday desks.</h2></div>
      <div class="feat4">
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/></svg><h4>Full-surface print</h4><p>Edge-to-edge colour with no border — your whole design, sharp and bright.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="7" width="16" height="10" rx="2" stroke-dasharray="3 3"/></svg><h4>Stitched edge</h4><p>Anti-fray stitched border keeps the mat crisp through years of use.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 16h16M6 16c0-3 2-5 6-5s6 2 6 5"/><path d="M4 19h16"/></svg><h4>Non-slip base</h4><p>Textured rubber backing stays put — no sliding mid-game or mid-call.</p></div>
        <div class="why-c reveal"><svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 9V5h4M20 9V5h-4M4 15v4h4M20 15v4h-4"/></svg><h4>Any size</h4><p>From compact to full-desk XL — sized to your setup.</p></div>
      </div>
    </div>
  </section>

  <section class="pad gallery-sec" style="padding-top:0">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">Design gallery</span><h2>Mats in the wild.</h2><p>Browse by category, then tap a design to enlarge it or start your order.</p></div>
      <div class="gal-cats reveal" id="galcat-deskmat"></div>
      <div class="gallery reveal" id="gallery-deskmat"></div>
      <div class="gal-cta reveal"><button class="btn btn-pri" data-mag data-go="order">Start your design →</button></div>
    </div>
  </section>

  <section class="pad" style="padding-top:0">
    <div class="wrap">
      <div class="sec-head reveal"><span class="k mono">Sizes &amp; pricing</span><h2>Pick a size.</h2><p>Starting prices for a single-design mat. Custom dimensions on request.</p></div>
      <div class="size-grid" id="sizes-deskmat"></div>
    </div>
  </section>
</main>

<!-- ================= PRODUCT DETAIL (SHOP) ================= -->
<main data-view="shop" hidden>
  <section class="phero wrap" style="padding-bottom:46px">
    <button class="back" data-go="home"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg> All products</button>
    <div class="pdp">
      <div class="gallery">
        <div class="thumbs" id="pdpThumbs"></div>
        <div class="pmain-wrap">
          <div class="pmain" id="pdpMain" title="Click to view full screen"></div>
          <button class="pmain-nav prev" id="pdpPrev" aria-label="Previous image"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg></button>
          <button class="pmain-nav next" id="pdpNext" aria-label="Next image"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6"/></svg></button>
        </div>
      </div>
      <div class="buybox">
        <h2 id="pdpTitle"></h2>
        <div class="sub" id="pdpSub"></div>
        <div class="price" id="pdpPrice"></div>
        <div class="rating" id="pdpRating"></div>
        <div class="swatches-wrap"><span class="lbl" id="pdpVarLabel"></span><div class="swatches" id="pdpSwatches"></div></div>
        <div class="buyrow">
          <div class="field"><span class="l">Size</span><select id="pdpSize"></select></div>
          <div class="field"><span class="l">Qty</span><div class="qty" id="pdpQtyWrap"><button data-q="-1" aria-label="Less">−</button><span id="pdpQtyVal">1</span><button data-q="1" aria-label="More">+</button></div></div>
          <button class="btn btn-pri" id="pdpAdd">Add to cart</button>
        </div>
        <p class="selnote">Final price is confirmed on WhatsApp once we see your photo or design.</p>
        <div class="support"><b>Need help choosing?</b> Message us on WhatsApp — we’ll guide sizing, style and turnaround before you pay.</div>
      </div>
    </div>
  </section>
</main>

<!-- ================= ORDER WIZARD (guided) ================= -->
<main data-view="order" hidden>
  <section class="wrap" style="padding:46px 0 64px">
    <button class="back" data-go="home" style="margin-bottom:18px"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg> Home</button>
    <div class="sec-head" style="text-align:left;margin-bottom:26px">
      <span class="k mono">Start an order</span>
      <h2 id="ordHead">What would you like to make?</h2>
      <p id="ordSub" style="margin-left:0">Pick a product to begin — you can add more items before checkout.</p>
    </div>
    <div id="ordStep1" class="ord-products"></div>
    <div id="ordStep2" hidden></div>
  </section>
</main>

<!-- ================= STUDIO ADMIN (local) ================= -->
<main data-view="admin" hidden>
  <section class="phero wrap" style="padding-bottom:50px">
    <button class="back" data-go="home"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg> Back to site</button>
    <div class="sec-head" style="margin-bottom:26px"><span class="k mono">Studio admin · local</span><h2>Manage your catalogue.</h2><p>Edit products, sizes, prices and variants. Changes save to this browser. Use Export to back up or publish.</p></div>
    <div id="adminApp"></div>
  </section>
</main>

<div class="cart-backdrop" id="cartBackdrop" hidden></div>
<aside class="cart" id="cart" hidden aria-label="Your order">
  <div class="chead"><h3>Your order</h3><button class="close" id="cartClose" aria-label="Close cart">×</button></div>
  <div class="items" id="cartItems"></div>
  <div class="cfoot">
    <div class="tot">Total <b id="cartTotal">₹0</b></div>
    <button class="btn btn-pri btn-lg" id="cartCheckout" style="width:100%;justify-content:center">Checkout on WhatsApp</button>
    <p class="fine">Indicative total — final quote confirmed on WhatsApp before any payment.</p>
  </div>
</aside>

<!-- ================= PRODUCT IMAGE FULLSCREEN ================= -->
<div class="pfs" id="pdpFs" hidden role="dialog" aria-modal="true" aria-label="Product image">
  <button class="pfs-close" id="pdpFsClose" aria-label="Close"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg></button>
  <button class="pfs-nav prev" id="pdpFsPrev" aria-label="Previous image"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg></button>
  <div class="pfs-art" id="pdpFsArt"></div>
  <button class="pfs-nav next" id="pdpFsNext" aria-label="Next image"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6"/></svg></button>
</div>

<!-- ================= GALLERY LIGHTBOX ================= -->
<div class="lb-backdrop" id="lbBackdrop" hidden></div>
<div class="lightbox" id="lightbox" hidden role="dialog" aria-modal="true" aria-label="Design preview">
  <div class="lb-panel">
    <button class="lb-close" id="lbClose" aria-label="Close preview"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg></button>
    <div class="lb-art" id="lbArt"></div>
    <div class="lb-info">
      <div><h3 id="lbTitle"></h3><span class="gal-m" id="lbMeta"></span></div>
      <button class="btn btn-pri" id="lbOrder" data-mag>Start an order →</button>
    </div>
  </div>
</div>

<section class="contact pad" id="contact">
  <div class="wrap contact-grid">
    <div class="reveal">
      <h2>Let’s make <em>your</em> order.</h2>
      <p class="lede">Pick what you want, then send a photo or design over WhatsApp or email. We reply with a quote and a timeline — usually within a day.</p>
      <div class="picker">
        <span class="k mono" id="pickerLabel">Choose a product</span>
        <div class="chips" id="chips"></div>
      </div>
      <div class="cactions">
        <a class="btn btn-pri" id="waBtn" data-mag href="#" target="_blank" rel="noopener">Send on WhatsApp</a>
        <a class="btn btn-ghost" id="mailBtn" href="#">Email us instead</a>
      </div>
    </div>
    <div class="ccard reveal">
      <div class="row"><span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M21 15.5a2 2 0 0 1-2 2 16 16 0 0 1-14-14 2 2 0 0 1 2-2h2.5a2 2 0 0 1 2 1.7l.4 2.5a2 2 0 0 1-.6 1.8l-1.2 1.2a13 13 0 0 0 5 5l1.2-1.2a2 2 0 0 1 1.8-.5l2.5.4a2 2 0 0 1 1.7 2z"/></svg></span><div><span class="k">WhatsApp</span><span class="v">+91 86074 50921</span></div></div>
      <div class="row"><span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span><div><span class="k">Email</span><span class="v">customercare@odnprint.com</span></div></div>
      <div class="row"><span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M12 21s-7-5.5-7-11a7 7 0 0 1 14 0c0 5.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span><div><span class="k">Studio</span><span class="v">Hisar, Haryana</span></div></div>
      <div class="row"><span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span><div><span class="k">Turnaround</span><span class="v">Typically 7–14 days</span></div></div>
    </div>
  </div>
</section>

<footer>
  <div class="wrap foot">
    <button class="brand" data-go="home"><span class="logo">O</span><b>ODN Prints</b></button>
    <div>3D models · Metal prints · Desk mats — hand-made in Hisar</div>
    <div class="mono">© <span id="yr"></span> ODN &amp; Sons</div>
  </div>
  <nav class="wrap foot-legal" aria-label="Policies">
    <a href="/terms-conditions/">Terms &amp; Conditions</a>
    <a href="/shipping-policy/">Shipping Policy</a>
    <a href="/returns/">Returns</a>
    <a href="/refund-policy/">Refund Policy</a>
    <a href="/privacy-policy/">Privacy Policy</a>
  </nav>
</footer>

<script>
(function(){
  var reduce=matchMedia('(prefers-reduced-motion: reduce)').matches;
  var fine=matchMedia('(pointer: fine)').matches;
  document.getElementById('yr').textContent=new Date().getFullYear();

  /* THEME */
  var root=document.documentElement, ico=document.getElementById('ico');
  var sun='<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2M5 5l1.5 1.5M17.5 17.5L19 19M19 5l-1.5 1.5M6.5 17.5L5 19"/>';
  var moon='<path d="M21 12.8A8.5 8.5 0 0 1 11.2 3 7 7 0 1 0 21 12.8z"/>';
  function setTheme(t){root.setAttribute('data-theme',t);ico.innerHTML=t==='light'?moon:sun;try{localStorage.setItem('odn-theme',t)}catch(e){}}
  var saved;try{saved=localStorage.getItem('odn-theme')}catch(e){}
  setTheme(saved||(matchMedia('(prefers-color-scheme: light)').matches?'light':'dark'));
  document.getElementById('theme').addEventListener('click',function(){setTheme(root.getAttribute('data-theme')==='light'?'dark':'light')});

  /* MOBILE MENU */
  var menu=document.getElementById('menu');
  document.getElementById('burger').addEventListener('click',function(){menu.classList.toggle('open')});

  /* IN-PAGE SCROLL (data-scroll, no hash navigation — avoids the sandbox external-link prompt) */
  document.addEventListener('click',function(e){
    var s=e.target.closest('[data-scroll]'); if(!s)return;
    e.preventDefault(); menu.classList.remove('open');
    var t=document.getElementById(s.dataset.scroll);
    if(t)t.scrollIntoView({behavior:reduce?'auto':'smooth',block:'start'});
  });

  /* CURSOR SPOTLIGHT */
  var spot=document.getElementById('spot');
  if(fine&&!reduce){addEventListener('pointermove',function(e){spot.style.opacity=.9;spot.style.left=e.clientX+'px';spot.style.top=e.clientY+'px'},{passive:true});}

  /* REVEAL */
  var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}})},{threshold:.12});
  function revealView(scope){
    if(!scope)return;
    scope.querySelectorAll('.reveal').forEach(function(el){
      var r=el.getBoundingClientRect();
      if(r.top<innerHeight*0.94){el.classList.add('in');} else {el.classList.remove('in');io.observe(el);}
    });
  }

  /* COUNTERS (home) */
  function runCounters(){
    document.querySelectorAll('[data-view="home"] [data-count]').forEach(function(el){
      var end=+el.dataset.count, suf=el.dataset.suffix||'';
      if(reduce){el.textContent=end+suf;return;}
      var t0=null;function tick(t){if(!t0)t0=t;var p=Math.min((t-t0)/900,1);el.textContent=Math.round(end*(1-Math.pow(1-p,3)))+suf;if(p<1)requestAnimationFrame(tick)}
      requestAnimationFrame(tick);
    });
  }

  /* VIEW ROUTER */
  var views=[].slice.call(document.querySelectorAll('[data-view]'));
  var navgo=[].slice.call(document.querySelectorAll('.navlinks [data-go]'));
  var curView='home';
  function render(view){
    if(!document.querySelector('[data-view="'+view+'"]'))view='home';
    curView=view;
    views.forEach(function(v){v.hidden=v.dataset.view!==view});
    navgo.forEach(function(b){b.classList.toggle('active',b.dataset.go===view)});
    menu.classList.remove('open');
    window.scrollTo(0,0);
    buildChips(view);
    if(view==='shop')renderPDP();
    if(view==='order')renderOrder();
    if(view==='admin')renderAdmin();
    if(view==='home')runCounters();
    revealView(document.querySelector('[data-view="'+view+'"]'));
    if(view==='3d')startHint();
  }
  function navigate(view){render(view);try{history.pushState({view:view},'','#'+view)}catch(e){}}
  document.addEventListener('click',function(e){var g=e.target.closest('[data-go]');if(!g)return;e.preventDefault();navigate(g.dataset.go);});
  addEventListener('popstate',function(e){render(e.state&&e.state.view?e.state.view:hashView())});
  function hashView(){var h=(location.hash||'').replace('#','');return ['home','3d','metal','deskmat','shop','order','admin'].indexOf(h)>=0?h:'home';}

  /* TILT + GLARE */
  if(fine&&!reduce){
    document.querySelectorAll('[data-tilt]').forEach(function(card){
      card.addEventListener('pointermove',function(e){var r=card.getBoundingClientRect(),x=(e.clientX-r.left)/r.width,y=(e.clientY-r.top)/r.height;
        card.style.transform='perspective(800px) rotateY('+((x-.5)*9)+'deg) rotateX('+((.5-y)*9)+'deg)';
        card.style.setProperty('--mx',(x*100)+'%');card.style.setProperty('--my',(y*100)+'%')});
      card.addEventListener('pointerleave',function(){card.style.transform=''});
    });
  }

  /* MAGNETIC BUTTONS */
  if(fine&&!reduce){
    document.querySelectorAll('[data-mag]').forEach(function(b){
      b.addEventListener('pointermove',function(e){var r=b.getBoundingClientRect();
        b.style.transform='translate('+((e.clientX-r.left-r.width/2)*.25)+'px,'+((e.clientY-r.top-r.height/2)*.35)+'px)'});
      b.addEventListener('pointerleave',function(){b.style.transform=''});
    });
  }

  /* BEFORE / AFTER SLIDER */
  var ba=document.getElementById('ba'), handle=document.getElementById('handle'), dragging=false, hintDone=false;
  function setPos(x){var r=ba.getBoundingClientRect();var p=((x-r.left)/r.width)*100;p=Math.max(4,Math.min(96,p));ba.style.setProperty('--pos',p+'%')}
  if(handle){
    handle.addEventListener('pointerdown',function(e){dragging=true;handle.setPointerCapture(e.pointerId)});
    addEventListener('pointermove',function(e){if(dragging)setPos(e.clientX)});
    addEventListener('pointerup',function(){dragging=false});
    ba.addEventListener('pointerdown',function(e){if(e.target!==handle)setPos(e.clientX)});
    handle.addEventListener('keydown',function(e){var cur=parseFloat(getComputedStyle(ba).getPropertyValue('--pos'))||55;
      if(e.key==='ArrowLeft')ba.style.setProperty('--pos',Math.max(4,cur-4)+'%');
      if(e.key==='ArrowRight')ba.style.setProperty('--pos',Math.min(96,cur+4)+'%')});
  }
  function startHint(){
    if(hintDone||reduce||!ba)return; hintDone=true;
    var seq=[40,68,55],i=0;
    var iv=setInterval(function(){ba.style.transition='--pos .6s ease';ba.style.setProperty('--pos',seq[i]+'%');
      if(++i>=seq.length){clearInterval(iv);setTimeout(function(){ba.style.transition=''},700)}},650);
    ba.addEventListener('pointerdown',function(){clearInterval(iv);ba.style.transition=''},{once:true});
  }

  /* ORDER PICKER (category-aware) */
  var PHONE='918607450921';        /* WhatsApp number, country code first, no + */
  var EMAIL='customercare@odnprint.com'; /* email */
  var chips=document.getElementById('chips'), pickerLabel=document.getElementById('pickerLabel');
  var waBtn=document.getElementById('waBtn'), mailBtn=document.getElementById('mailBtn');
  var chosen='Figurine';
  function isFig(name){return PDP.figurine.variants.some(function(v){return v.id===name})}
  function groupFor(view){
    if(view==='3d')return {label:'Choose a style',items:PDP.figurine.variants.map(function(v){return v.id})};
    if(view==='metal')return {label:'Choose a size',items:PDP.metal.sizes.map(function(s){return 'Metal print — '+s.id})};
    if(view==='deskmat')return {label:'Choose a size',items:PDP.deskmat.sizes.map(function(s){return 'Desk mat — '+s.id})};
    return {label:'Choose a product',items:['Figurine','Metal print','Desk mat']};
  }
  function orderMsg(){
    if(isFig(chosen)) return "Hi ODN Prints! I'd like a custom figurine in the "+chosen+" style. Here's my photo:";
    return "Hi ODN Prints! I'd like a custom "+chosen.toLowerCase()+". Here's my design:";
  }
  function refresh(){
    var msg=orderMsg();
    waBtn.href='https://wa.me/'+PHONE+'?text='+encodeURIComponent(msg);
    mailBtn.href='mailto:'+EMAIL+'?subject='+encodeURIComponent('Custom order — '+chosen)+'&body='+encodeURIComponent(msg+'\n\n(Please attach 1–2 clear photos.)');
  }
  function buildChips(view){
    var g=groupFor(view);
    pickerLabel.textContent=g.label;
    chips.innerHTML='';
    g.items.forEach(function(name,i){
      var b=document.createElement('button');
      b.className='chip'+(i===0?' on':''); b.dataset.style=name; b.textContent=name;
      chips.appendChild(b);
    });
    chosen=g.items[0]||'Figurine';
    refresh();
  }
  chips.addEventListener('click',function(e){
    var b=e.target.closest('.chip'); if(!b)return;
    chosen=b.dataset.style;
    chips.querySelectorAll('.chip').forEach(function(c){c.classList.toggle('on',c===b)});
    refresh();
  });

  /* =================== PRODUCT DETAIL + CART =================== */
  var STYLE_ART={
    'Photo to figurine':'<circle cx="60" cy="36" r="26" class="a"/><path d="M30 70 q30 -16 60 0 l-4 64 q-26 12 -52 0 Z" class="a"/><circle cx="51" cy="34" r="3.5" class="d"/><circle cx="69" cy="34" r="3.5" class="d"/><path d="M53 46 q7 5 14 0" stroke="var(--bg)" stroke-width="2.5" fill="none" stroke-linecap="round"/>',
    'Pixar-style':'<ellipse cx="60" cy="46" rx="38" ry="36" class="a"/><path d="M28 84 q32 -14 64 0 l-8 54 q-24 12 -48 0 Z" class="a"/><ellipse cx="47" cy="44" rx="9" ry="11" fill="#fff"/><ellipse cx="73" cy="44" rx="9" ry="11" fill="#fff"/><circle cx="49" cy="46" r="5" class="d"/><circle cx="71" cy="46" r="5" class="d"/><path d="M48 62 q12 9 24 0" stroke="var(--bg)" stroke-width="3.5" fill="none" stroke-linecap="round"/>',
    'Funko-style':'<rect x="24" y="14" width="72" height="62" rx="10" class="a"/><rect x="40" y="78" width="40" height="58" rx="6" class="a"/><circle cx="48" cy="46" r="8" fill="#fff"/><circle cx="72" cy="46" r="8" fill="#fff"/><circle cx="48" cy="46" r="3" class="d"/><circle cx="72" cy="46" r="3" class="d"/>',
    'Nendoroid chibi':'<circle cx="60" cy="50" r="44" class="a"/><path d="M36 96 q24 -8 48 0 l-4 38 q-20 9 -40 0 Z" class="a"/><ellipse cx="46" cy="52" rx="7" ry="10" class="d"/><ellipse cx="74" cy="52" rx="7" ry="10" class="d"/><circle cx="48" cy="49" r="2.5" fill="#fff"/><circle cx="76" cy="49" r="2.5" fill="#fff"/>',
    'Designer collectible':'<polygon points="60,8 92,40 78,78 42,78 28,40" class="a"/><polygon points="42,78 78,78 84,138 36,138" class="a"/><polygon points="60,8 92,40 78,78 60,60" class="b" opacity=".55"/><circle cx="50" cy="44" r="3.5" class="d"/><circle cx="70" cy="44" r="3.5" class="d"/>',
    'Bobblehead':'<circle cx="60" cy="40" r="34" class="a"/><rect x="55" y="72" width="10" height="14" class="b"/><path d="M34 88 q26 -10 52 0 l-4 48 q-22 10 -44 0 Z" class="a"/><circle cx="50" cy="40" r="4" class="d"/><circle cx="70" cy="40" r="4" class="d"/><path d="M50 54 q10 7 20 0" stroke="var(--bg)" stroke-width="3" fill="none" stroke-linecap="round"/>',
    'Disney-style':'<ellipse cx="60" cy="38" rx="28" ry="30" class="a"/><path d="M40 66 q20 -10 40 0 l14 70 q-34 14 -68 0 Z" class="a"/><ellipse cx="50" cy="38" rx="5" ry="7" class="d"/><ellipse cx="70" cy="38" rx="5" ry="7" class="d"/><path d="M52 52 q8 6 16 0" stroke="var(--bg)" stroke-width="2.5" fill="none" stroke-linecap="round"/><path d="M60 8 l4 9 l-8 0 Z" class="b"/>'
  };
  function metalInner(finish){var g=finish==='Matte'?'.05':'.16';
    return '<defs><linearGradient id="mG" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#c9ced6"/><stop offset=".5" stop-color="#eef1f5"/><stop offset="1" stop-color="#a9afb9"/></linearGradient><linearGradient id="sG" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="var(--aqua)"/><stop offset="1" stop-color="var(--accent-2)"/></linearGradient></defs><rect x="30" y="14" width="140" height="124" rx="7" fill="url(#mG)"/><rect x="40" y="24" width="120" height="104" rx="4" fill="url(#sG)"/><circle cx="128" cy="52" r="13" fill="var(--accent)"/><path d="M40 128 l30 -48 22 28 18 -34 50 54 Z" fill="#222732" opacity=".5"/><polygon points="30,14 68,14 44,138 30,138" fill="#fff" opacity="'+g+'"/>';
  }
  function deskInner(base){var f=base==='Slate'?'#222a36':'#191d24';
    return '<polygon points="22,42 198,42 214,116 6,116" fill="'+f+'"/><path d="M38 104 l34 -40 24 20 20 -28 46 48 Z" fill="var(--accent)" opacity=".85"/><circle cx="156" cy="62" r="11" fill="var(--accent-2)"/><polygon points="22,42 198,42 214,116 6,116" fill="none" stroke="var(--accent)" stroke-width="1.8" stroke-dasharray="5 4" opacity=".85"/><rect x="60" y="86" width="66" height="17" rx="3" fill="#39414f"/><ellipse cx="156" cy="96" rx="12" ry="16" fill="#39414f"/>';
  }
  function artFor(key,variant){
    if(key==='figurine')return {vb:'0 0 120 150',inner:(STYLE_ART[variant]||STYLE_ART['Photo to figurine'])};
    if(key==='metal')return {vb:'0 0 200 150',inner:metalInner(variant)};
    return {vb:'0 0 220 150',inner:deskInner(variant)};
  }
  function shot(key,variant,mode){
    var a=artFor(key,variant), p=a.vb.split(' '), W=+p[2], H=+p[3], pre='', post='', tf='';
    if(mode==='side')tf=' transform="translate('+W+' 0) scale(-1 1)"';
    if(mode==='base')post='<ellipse cx="'+(W/2)+'" cy="'+(H-5)+'" rx="'+(W*0.27)+'" ry="5" fill="rgba(0,0,0,.4)"/>';
    if(mode==='pack')pre='<rect x="'+(W*0.08)+'" y="'+(H*0.06)+'" width="'+(W*0.84)+'" height="'+(H*0.9)+'" rx="9" fill="none" stroke="var(--accent)" stroke-dasharray="6 5" opacity=".5"/>';
    return '<svg class="fg" viewBox="'+a.vb+'">'+pre+'<g'+tf+'>'+a.inner+'</g>'+post+'</svg>';
  }
  var INR=function(n){return '₹'+n.toLocaleString('en-IN')};
  var CAT_KEY='odn-catalog-v1';
  var DEFAULT_CATALOG={
    figurine:{key:'figurine',shopLabel:'3D Models',enabled:true,title:'Custom Resin Figurine',sub:'Photo to figurine · Hand-painted in Hisar',rating:4.9,reviews:128,vlabel:'Style',
      variants:[{id:'Photo to figurine'},{id:'Pixar-style'},{id:'Funko-style'},{id:'Nendoroid chibi'},{id:'Designer collectible'},{id:'Bobblehead'},{id:'Disney-style'}],
      sizes:[{id:'3 inch',price:1499,note:'≈ 7.6 cm tall'},{id:'5 inch',price:2799,note:'≈ 12.7 cm tall',popular:true},{id:'7 inch',price:4999,note:'≈ 17.8 cm tall'}]},
    metal:{key:'metal',shopLabel:'Metal Prints',enabled:true,title:'Metal Print',sub:'HD dye-sublimation on aluminium',rating:4.8,reviews:64,vlabel:'Finish',
      variants:[{id:'Gloss',swatch:'#e7ebf1'},{id:'Matte',swatch:'#aab0ba'}],
      sizes:[{id:'6 × 8 in',price:699,note:'Tabletop / small wall'},{id:'8 × 12 in',price:1199,note:'Portrait / feature',popular:true},{id:'12 × 18 in',price:2199,note:'Statement wall art'}]},
    deskmat:{key:'deskmat',shopLabel:'Desk Mats',enabled:true,title:'Desk Mat',sub:'Full-print · Stitched edge · Non-slip',rating:4.9,reviews:51,vlabel:'Base colour',
      variants:[{id:'Charcoal',swatch:'#191d24'},{id:'Slate',swatch:'#2a3340'}],
      sizes:[{id:'Standard 800×300',price:599,note:'800 × 300 mm'},{id:'XL 900×400',price:899,note:'900 × 400 mm',popular:true},{id:'Custom size',price:null,note:'Your dimensions'}]}
  };
  function clone(o){return JSON.parse(JSON.stringify(o))}
  function loadCatalog(){
    try{var s=localStorage.getItem(CAT_KEY);if(s){var p=JSON.parse(s);if(p&&p.figurine&&p.metal&&p.deskmat)return p;}}catch(e){}
    return clone(DEFAULT_CATALOG);
  }
  function saveCatalog(){try{localStorage.setItem(CAT_KEY,JSON.stringify(PDP));}catch(e){}}
  var PDP=loadCatalog();
  var pdpKey='figurine', pdpVar, pdpMode='front', pdpQty=1;
  var $=function(id){return document.getElementById(id)};
  function curSize(){var p=PDP[pdpKey];for(var i=0;i<p.sizes.length;i++){if(p.sizes[i].id===$('pdpSize').value)return p.sizes[i]}return p.sizes[0]}
  function updatePrice(){var s=curSize();$('pdpPrice').innerHTML=s.price?(INR(s.price)+' <small>/ '+pdpVar+'</small>'):'Custom quote';}
  var PDP_MODES=['front','side','base','pack'];
  function renderGallery(){
    $('pdpThumbs').innerHTML=PDP_MODES.map(function(m){return '<button class="thumb'+(m===pdpMode?' on':'')+'" data-mode="'+m+'">'+shot(pdpKey,pdpVar,m)+'</button>'}).join('');
    $('pdpMain').innerHTML=shot(pdpKey,pdpVar,pdpMode);
  }
  function setPdpMode(m){
    pdpMode=m;
    $('pdpMain').innerHTML=shot(pdpKey,pdpVar,pdpMode);
    var thumbs=$('pdpThumbs').querySelectorAll('.thumb');
    for(var i=0;i<thumbs.length;i++){thumbs[i].classList.toggle('on',thumbs[i].dataset.mode===m);}
    if(!$('pdpFs').hidden){$('pdpFsArt').innerHTML=shot(pdpKey,pdpVar,pdpMode);}
  }
  function stepPdpMode(dir){
    var i=PDP_MODES.indexOf(pdpMode); if(i<0){i=0;}
    setPdpMode(PDP_MODES[(i+dir+PDP_MODES.length)%PDP_MODES.length]);
  }
  function openPdpFs(){$('pdpFsArt').innerHTML=shot(pdpKey,pdpVar,pdpMode);$('pdpFs').hidden=false;}
  function closePdpFs(){$('pdpFs').hidden=true;}
  function renderPDP(){
    var p=PDP[pdpKey];
    var ok=false;for(var i=0;i<p.variants.length;i++){if(p.variants[i].id===pdpVar)ok=true}
    if(!ok)pdpVar=p.variants[0].id;
    pdpMode='front'; pdpQty=1; $('pdpQtyVal').textContent='1';
    $('pdpTitle').textContent=p.title; $('pdpSub').textContent=p.sub;
    $('pdpRating').innerHTML='★★★★★ <span>'+p.rating+' ('+p.reviews+' reviews)</span>';
    $('pdpVarLabel').textContent=p.vlabel;
    $('pdpSwatches').innerHTML=p.variants.map(function(v){
      var inner=v.swatch?('<span class="dot" style="background:'+v.swatch+'"></span>'):('<svg class="fg" viewBox="0 0 120 150">'+STYLE_ART[v.id]+'</svg>');
      return '<button class="swatch'+(v.id===pdpVar?' on':'')+'" data-variant="'+v.id+'" title="'+v.id+'">'+inner+'</button>';
    }).join('');
    $('pdpSize').innerHTML=p.sizes.map(function(s){return '<option value="'+s.id+'">'+s.id+(s.price?(' — '+INR(s.price)):' — Quote')+'</option>'}).join('');
    renderGallery(); updatePrice();
  }
  /* PDP events (delegated on persistent containers) */
  $('pdpSwatches').addEventListener('click',function(e){var b=e.target.closest('[data-variant]');if(!b)return;pdpVar=b.dataset.variant;
    this.querySelectorAll('.swatch').forEach(function(s){s.classList.toggle('on',s===b)});renderGallery();updatePrice();});
  $('pdpThumbs').addEventListener('click',function(e){var b=e.target.closest('[data-mode]');if(!b)return;setPdpMode(b.dataset.mode);});
  $('pdpPrev').addEventListener('click',function(e){e.stopPropagation();stepPdpMode(-1);});
  $('pdpNext').addEventListener('click',function(e){e.stopPropagation();stepPdpMode(1);});
  $('pdpMain').addEventListener('click',openPdpFs);
  $('pdpFsClose').addEventListener('click',closePdpFs);
  $('pdpFsPrev').addEventListener('click',function(){stepPdpMode(-1);});
  $('pdpFsNext').addEventListener('click',function(){stepPdpMode(1);});
  $('pdpFs').addEventListener('click',function(e){if(e.target===$('pdpFs'))closePdpFs();});
  document.addEventListener('keydown',function(e){
    if($('pdpFs').hidden)return;
    if(e.key==='Escape')closePdpFs();
    else if(e.key==='ArrowLeft')stepPdpMode(-1);
    else if(e.key==='ArrowRight')stepPdpMode(1);
  });
  $('pdpSize').addEventListener('change',updatePrice);
  $('pdpQtyWrap').addEventListener('click',function(e){var b=e.target.closest('[data-q]');if(!b)return;
    pdpQty=Math.max(1,pdpQty+(+b.dataset.q));$('pdpQtyVal').textContent=pdpQty;});
  $('pdpAdd').addEventListener('click',function(){
    var p=PDP[pdpKey], s=curSize();
    cart.push({key:pdpKey,title:p.title,variant:pdpVar,size:s.id,price:s.price,qty:pdpQty,art:shot(pdpKey,pdpVar,'front')});
    renderCart(); openCart();
  });
  function openShop(key){if(PDP[key]){pdpKey=key;pdpVar=PDP[key].variants[0].id;}navigate('shop');}
  document.addEventListener('click',function(e){var s=e.target.closest('[data-shop]');if(!s)return;e.preventDefault();openShop(s.dataset.shop);});

  /* CART */
  var cart=[];
  var cartEl=$('cart'), cartBackdrop=$('cartBackdrop');
  function openCart(){cartEl.hidden=false;cartBackdrop.hidden=false;}
  function closeCart(){cartEl.hidden=true;cartBackdrop.hidden=true;}
  $('cartBtn').addEventListener('click',openCart);
  $('cartClose').addEventListener('click',closeCart);
  cartBackdrop.addEventListener('click',closeCart);
  $('cartItems').addEventListener('click',function(e){var x=e.target.closest('[data-rm]');if(!x)return;cart.splice(+x.dataset.rm,1);renderCart();});
  function renderCart(){
    var n=0,tot=0,quote=false;
    cart.forEach(function(c){n+=c.qty;if(c.price)tot+=c.price*c.qty;else quote=true;});
    $('cartCount').textContent=n; $('cartCount').hidden=n===0;
    if(!cart.length){$('cartItems').innerHTML='<p class="empty">Your order is empty.<br>Browse a product and add it here.</p>';}
    else{$('cartItems').innerHTML=cart.map(function(c,i){
      return '<div class="citem"><div class="ci-art">'+c.art+'</div><div class="ci-main"><div class="ci-t">'+c.title+'</div><div class="ci-d">'+c.variant+' · '+c.size+' · ×'+c.qty+'</div><button class="ci-x" data-rm="'+i+'">Remove</button></div><div class="ci-p">'+(c.price?INR(c.price*c.qty):'Quote')+'</div></div>';
    }).join('');}
    $('cartTotal').textContent=(tot?INR(tot):'₹0')+(quote?' +':'');
  }
  $('cartCheckout').addEventListener('click',function(){
    if(!cart.length){return;}
    var lines=cart.map(function(c){return '• '+c.qty+'× '+c.title+' — '+c.variant+', '+c.size+(c.price?(' — '+INR(c.price*c.qty)):' — quote')}).join('\n');
    var tot=cart.reduce(function(a,c){return a+(c.price?c.price*c.qty:0)},0);
    var quote=cart.some(function(c){return !c.price});
    var msg="Hi ODN Prints! I'd like to order:\n"+lines+"\n\nIndicative total: "+INR(tot)+(quote?' + (custom items quoted separately)':'')+"\n\n(I'll share my photos / designs here.)";
    window.open('https://wa.me/'+PHONE+'?text='+encodeURIComponent(msg),'_blank');
  });
  renderCart();

  /* =================== CATALOGUE → STOREFRONT =================== */
  function sizeCardHTML(s){
    return '<div class="size'+(s.popular?' feat':'')+'">'+(s.popular?'<span class="badge">Most popular</span>':'')+
      '<h4>'+s.id+'</h4><span class="h">'+(s.note||'')+'</span>'+
      '<div class="price">'+(s.price!=null?(INR(s.price)+'<small> / start</small>'):'Quote')+'</div></div>';
  }
  function renderSizeCards(){
    ['figurine','metal','deskmat'].forEach(function(k){
      var el=document.getElementById('sizes-'+k); if(!el)return;
      el.innerHTML=PDP[k].sizes.map(sizeCardHTML).join('');
    });
  }
  function applyVisibility(){
    var map={figurine:'3d',metal:'metal',deskmat:'deskmat'};
    Object.keys(map).forEach(function(k){
      var on=PDP[k].enabled!==false;
      document.querySelectorAll('[data-prod="'+k+'"]').forEach(function(el){el.style.display=on?'':'none'});
      document.querySelectorAll('.navlinks [data-go="'+map[k]+'"]').forEach(function(el){el.style.display=on?'':'none'});
    });
  }
  function applyAll(){renderSizeCards();renderDesignGallery();applyVisibility();buildChips(curView);if(curView==='shop')renderPDP();}

  /* =================== DESIGN GALLERY =================== */
  var DEFAULT_GAL={
    figurine:{cats:['Couples','Family','Pets','Gaming','Kids'],items:[
      {c:'Couples',v:'Designer collectible',t:'Anniversary couple',m:'5 inch'},
      {c:'Couples',v:'Photo to figurine',t:'Wedding pair',m:'7 inch'},
      {c:'Family',v:'Photo to figurine',t:'Family of three',m:'7 inch'},
      {c:'Family',v:'Pixar-style',t:'Parents & kid',m:'5 inch'},
      {c:'Pets',v:'Photo to figurine',t:'Dog portrait',m:'3 inch'},
      {c:'Pets',v:'Nendoroid chibi',t:'Chibi kitten',m:'3 inch'},
      {c:'Gaming',v:'Funko-style',t:'Gamer avatar',m:'5 inch'},
      {c:'Gaming',v:'Designer collectible',t:'Esports mascot',m:'5 inch'},
      {c:'Kids',v:'Disney-style',t:'Little princess',m:'5 inch'},
      {c:'Kids',v:'Pixar-style',t:'Birthday gift',m:'5 inch'},
      {c:'Kids',v:'Bobblehead',t:'Cricket-fan kid',m:'5 inch'}
    ]},
    metal:{cats:['Landscape','Portrait','Pets','Wedding','Travel'],items:[
      {c:'Landscape',v:'Gloss',t:'Mountain sunrise',m:'12 × 18 · Gloss'},
      {c:'Landscape',v:'Matte',t:'Coastline',m:'12 × 18 · Matte'},
      {c:'Portrait',v:'Matte',t:'Studio portrait',m:'8 × 12 · Matte'},
      {c:'Portrait',v:'Gloss',t:'Black & white',m:'8 × 12 · Gloss'},
      {c:'Pets',v:'Gloss',t:'Dog portrait',m:'8 × 12 · Gloss'},
      {c:'Pets',v:'Matte',t:'Cat close-up',m:'6 × 8 · Matte'},
      {c:'Wedding',v:'Matte',t:'Wedding frame',m:'8 × 12 · Matte'},
      {c:'Wedding',v:'Gloss',t:'Couple memory',m:'12 × 18 · Gloss'},
      {c:'Travel',v:'Matte',t:'City skyline',m:'12 × 18 · Matte'},
      {c:'Travel',v:'Gloss',t:'Travel diary',m:'8 × 12 · Gloss'}
    ]},
    deskmat:{cats:['Gaming','Anime','Minimal','Branding','Photo'],items:[
      {c:'Gaming',v:'Charcoal',t:'Battlestation',m:'XL · Charcoal'},
      {c:'Gaming',v:'Slate',t:'Neon grid',m:'XL · Slate'},
      {c:'Anime',v:'Charcoal',t:'Anime scene',m:'XL · Charcoal'},
      {c:'Anime',v:'Slate',t:'Manga panel',m:'Standard · Slate'},
      {c:'Minimal',v:'Charcoal',t:'Minimal mono',m:'Standard · Charcoal'},
      {c:'Minimal',v:'Slate',t:'Gradient abstract',m:'XL · Slate'},
      {c:'Branding',v:'Slate',t:'Studio logo',m:'Standard · Slate'},
      {c:'Branding',v:'Charcoal',t:'Brand launch',m:'XL · Charcoal'},
      {c:'Photo',v:'Slate',t:'Custom photo',m:'Custom · Slate'},
      {c:'Photo',v:'Charcoal',t:'Travel collage',m:'XL · Charcoal'}
    ]}
  };
  var GAL_KEY='odn-gallery-v1';
  function loadGallery(){
    try{var s=localStorage.getItem(GAL_KEY);if(s){var g=JSON.parse(s);if(g&&g.figurine&&g.metal&&g.deskmat)return g;}}catch(e){}
    return clone(DEFAULT_GAL);
  }
  function saveGallery(){try{localStorage.setItem(GAL_KEY,JSON.stringify(GAL));}catch(e){}}
  var GAL=loadGallery();
  var galOpen={figurine:null,metal:null,deskmat:null};
  var GAL_HUE=[0,-26,32,56,-44,18,42,-14];
  var galReg=[];
  function galCardHTML(key,it){
    var idx=galReg.length;
    var vs=PDP[key].variants||[]; var vId=(vs.filter(function(v){return v.id===it.v})[0]||vs[0]||{}).id;
    var hue=key==='figurine'?0:GAL_HUE[idx%GAL_HUE.length];
    galReg.push({key:key,vId:vId,t:it.t,m:it.m,hue:hue,img:it.img||null});
    var art = it.img
      ? '<div class="gal-art has-img"><img src="'+it.img+'" alt="'+esc(it.t)+'" loading="lazy"></div>'
      : '<div class="gal-art" style="filter:hue-rotate('+hue+'deg)">'+shot(key,vId,'front')+'</div>';
    return '<div class="gal-card" data-galidx="'+idx+'">'+art+
      '<div class="gal-cap"><span class="gal-t">'+esc(it.t)+'</span><span class="gal-m">'+esc(it.m)+'</span></div>'+
      '<button class="gal-order" data-galorder data-gk="'+key+'">Start an order →</button></div>';
  }
  function galCatCardHTML(key,cat){
    var items=GAL[key].items.filter(function(it){return it.c===cat;});
    var cover=items[0], inner='';
    if(cover){
      if(cover.img) inner='<img src="'+cover.img+'" alt="'+esc(cat)+'" loading="lazy">';
      else{var vs=PDP[key].variants||[];var vId=(vs.filter(function(v){return v.id===cover.v})[0]||vs[0]||{}).id;inner='<div class="cat-svg" style="filter:hue-rotate('+(key==='figurine'?0:GAL_HUE[0])+'deg)">'+shot(key,vId,'front')+'</div>';}
    }
    return '<button class="gal-catcard" data-galcat="'+esc(cat)+'" data-gk="'+key+'">'+
      '<div class="gal-catcover'+(cover&&cover.img?' has-img':'')+'">'+inner+'</div>'+
      '<div class="gal-catfoot"><div><span class="gal-catname">'+esc(cat)+'</span>'+
        '<span class="gal-catcount">'+items.length+' design'+(items.length===1?'':'s')+'</span></div>'+
        '<span class="gal-catbtn">View →</span></div></button>';
  }
  var lbKey=null;
  function openLightbox(r){
    lbKey=r.key; var a=$('lbArt');
    if(r.img){a.classList.add('has-img');a.style.filter='';a.innerHTML='<img src="'+r.img+'" alt="'+esc(r.t)+'">';}
    else{a.classList.remove('has-img');a.style.filter='hue-rotate('+(r.hue||0)+'deg)';a.innerHTML=shot(r.key,r.vId,'front');}
    $('lbTitle').textContent=r.t||''; $('lbMeta').textContent=r.m||'';
    $('lightbox').hidden=false; $('lbBackdrop').hidden=false;
  }
  function closeLightbox(){$('lightbox').hidden=true;$('lbBackdrop').hidden=true;}
  document.addEventListener('click',function(e){
    var back=e.target.closest('[data-galback]');
    if(back){galOpen[back.dataset.gk]=null;renderDesignGallery();return;}
    var cc=e.target.closest('.gal-catcard');
    if(cc){galOpen[cc.dataset.gk]=cc.dataset.galcat;renderDesignGallery();
      var sec=document.getElementById('galcat-'+cc.dataset.gk);if(sec&&sec.scrollIntoView)sec.scrollIntoView({behavior:'smooth',block:'start'});return;}
    var go=e.target.closest('.gal-order');
    if(go){navigate('order');if(go.dataset.gk)renderStep2(go.dataset.gk);return;}
    var card=e.target.closest('.gal-card');
    if(card){var r=galReg[+card.dataset.galidx];if(r)openLightbox(r);return;}
  });
  $('lbClose').addEventListener('click',closeLightbox);
  $('lbBackdrop').addEventListener('click',closeLightbox);
  $('lbOrder').addEventListener('click',function(){var k=lbKey;closeLightbox();navigate('order');if(k)renderStep2(k);});
  document.addEventListener('keydown',function(e){if(e.key==='Escape'&&!$('lightbox').hidden)closeLightbox();});
  function renderDesignGallery(){
    galReg=[];
    ['figurine','metal','deskmat'].forEach(function(key){
      var cc=document.getElementById('galcat-'+key), g=document.getElementById('gallery-'+key);
      if(!g)return;
      var open=galOpen[key];
      if(open){
        if(cc)cc.innerHTML='<button class="gal-back" data-galback data-gk="'+key+'"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg> All categories</button><span class="gal-curcat">'+esc(open)+'</span>';
        g.classList.remove('gallery-cats');
        var items=GAL[key].items.filter(function(it){return it.c===open;});
        g.innerHTML=items.length?items.map(function(it){return galCardHTML(key,it);}).join(''):'<p class="gal-empty">No designs in this category yet.</p>';
      } else {
        if(cc)cc.innerHTML='';
        g.classList.add('gallery-cats');
        g.innerHTML=GAL[key].cats.length?GAL[key].cats.map(function(cat){return galCatCardHTML(key,cat);}).join(''):'<p class="gal-empty">No categories yet.</p>';
      }
    });
  }

  /* =================== STUDIO ADMIN (local) =================== */
  var ADMIN_PASS='odn';            /* change this passcode */
  var adminUnlocked=false, draft=clone(PDP), galDraft=clone(GAL), adminTab='products', adminApp=document.getElementById('adminApp');
  function setAdmStatus(t){var s=document.getElementById('admStatus');if(s)s.textContent=t||'';}
  function esc(s){return String(s==null?'':s).replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;')}
  function sizeRows(p){
    return draft[p].sizes.map(function(s,i){
      return '<div class="adm-row" data-i="'+i+'">'+
        '<input type="text" data-sfield="id" value="'+esc(s.id)+'" placeholder="Size name">'+
        '<input type="number" data-sfield="price" value="'+(s.price==null?'':s.price)+'" placeholder="Price (blank = quote)">'+
        '<input type="text" data-sfield="note" value="'+esc(s.note)+'" placeholder="Note">'+
        '<label class="pop"><input type="checkbox" data-sfield="popular" '+(s.popular?'checked':'')+'> popular</label>'+
        '<button class="x" data-act="del-size" data-p="'+p+'" data-i="'+i+'" title="Delete">✕</button></div>';
    }).join('');
  }
  function varRows(p){
    return draft[p].variants.map(function(v,i){
      var color = p==='figurine' ? '' : '<input type="color" data-vfield="swatch" value="'+(v.swatch||'#888888')+'">';
      return '<div class="adm-row" data-i="'+i+'">'+
        '<input type="text" data-vfield="id" value="'+esc(v.id)+'" placeholder="Variant name">'+color+
        '<button class="x" data-act="del-var" data-p="'+p+'" data-i="'+i+'" title="Delete">✕</button></div>';
    }).join('');
  }
  function galCatRows(p){
    return galDraft[p].cats.map(function(c,i){
      return '<div class="adm-row" data-i="'+i+'" data-p="'+p+'">'+
        '<input type="text" data-gcat="'+i+'" data-p="'+p+'" value="'+esc(c)+'" placeholder="Category name">'+
        '<button class="x" data-act="del-cat" data-p="'+p+'" data-i="'+i+'" title="Delete">✕</button></div>';
    }).join('');
  }
  function galItemRows(p){
    var cats=galDraft[p].cats, vs=PDP[p].variants;
    return galDraft[p].items.map(function(it,i){
      var catOpts=cats.map(function(c){return '<option'+(c===it.c?' selected':'')+'>'+esc(c)+'</option>'}).join('');
      var vOpts=vs.map(function(v){return '<option'+(v.id===it.v?' selected':'')+'>'+esc(v.id)+'</option>'}).join('');
      var hasImg=!!it.img;
      var photo=(hasImg?'<img class="adm-thumb" src="'+it.img+'" alt="">':'')+
        '<label class="btn-mini'+(hasImg?' on':'')+'" title="Upload a real photo">'+(hasImg?'Change photo':'+ Photo')+'<input type="file" data-gimg accept="image/*" hidden></label>'+
        (hasImg?'<button class="x" data-act="del-img" data-p="'+p+'" data-i="'+i+'" title="Remove photo">⌫</button>':'');
      return '<div class="adm-row" data-i="'+i+'" data-p="'+p+'">'+
        '<select data-gfield="c" title="Category">'+catOpts+'</select>'+
        '<select data-gfield="v" title="Design shown (used if no photo)">'+vOpts+'</select>'+
        '<input type="text" data-gfield="t" value="'+esc(it.t)+'" placeholder="Title">'+
        '<input type="text" data-gfield="m" value="'+esc(it.m)+'" placeholder="Caption / size">'+
        photo+
        '<button class="x" data-act="del-item" data-p="'+p+'" data-i="'+i+'" title="Delete">✕</button></div>';
    }).join('');
  }
  function galProdBlock(p){
    return '<div class="adm-prod" data-p="'+p+'">'+
      '<div class="ph"><h3>'+esc(PDP[p].shopLabel)+' gallery</h3></div>'+
      '<span class="adm-sub">Categories</span>'+galCatRows(p)+
      '<button class="btn-sm" data-act="add-cat" data-p="'+p+'" style="margin-top:6px">+ Add category</button>'+
      '<span class="adm-sub" style="margin-top:18px">Gallery pieces — pick the category and the design shown</span>'+galItemRows(p)+
      '<button class="btn-sm" data-act="add-item" data-p="'+p+'" style="margin-top:6px">+ Add piece</button>'+
    '</div>';
  }
  function prodBlock(p){
    var d=draft[p];
    return '<div class="adm-prod" data-p="'+p+'">'+
      '<div class="ph"><h3>'+esc(d.shopLabel)+'</h3>'+
        '<label class="adm-toggle"><input type="checkbox" data-p="'+p+'" data-field="enabled" '+(d.enabled!==false?'checked':'')+'> Show in store</label></div>'+
      '<div class="adm-grid">'+
        '<div class="adm-f"><label>Product title</label><input type="text" data-p="'+p+'" data-field="title" value="'+esc(d.title)+'"></div>'+
        '<div class="adm-f"><label>Subtitle</label><input type="text" data-p="'+p+'" data-field="sub" value="'+esc(d.sub)+'"></div>'+
        '<div class="adm-f"><label>Rating (0–5)</label><input type="number" step="0.1" min="0" max="5" data-p="'+p+'" data-field="rating" value="'+d.rating+'"></div>'+
        '<div class="adm-f"><label>Review count</label><input type="number" min="0" data-p="'+p+'" data-field="reviews" value="'+d.reviews+'"></div>'+
      '</div>'+
      '<span class="adm-sub">Sizes &amp; prices (₹)</span>'+sizeRows(p)+
      '<button class="btn-sm" data-act="add-size" data-p="'+p+'" style="margin-top:6px">+ Add size</button>'+
      '<span class="adm-sub" style="margin-top:16px">'+esc(d.vlabel)+' options</span>'+varRows(p)+
      '<button class="btn-sm" data-act="add-var" data-p="'+p+'" style="margin-top:6px">+ Add option</button>'+
      (p==='figurine'?'<p style="color:var(--faint);font-size:.76rem;margin-top:10px">New figurine styles use a generic figure illustration until art is added.</p>':'')+
    '</div>';
  }
  function renderAdmin(){
    if(!adminUnlocked){
      adminApp.innerHTML='<div class="adm-gate"><span class="adm-sub">Enter passcode</span>'+
        '<input type="password" id="admPass" placeholder="Passcode" autocomplete="off">'+
        '<div class="adm-err" id="admErr"></div>'+
        '<button class="btn-sm pri" data-act="unlock">Unlock admin</button></div>';
      var pw=document.getElementById('admPass'); if(pw){pw.focus();pw.addEventListener('keydown',function(e){if(e.key==='Enter')doUnlock();});}
      return;
    }
    var panel = adminTab==='gallery' ? (galProdBlock('figurine')+galProdBlock('metal')+galProdBlock('deskmat'))
      : (prodBlock('figurine')+prodBlock('metal')+prodBlock('deskmat'));
    adminApp.innerHTML=
      '<div class="adm-tabs">'+
        '<button class="adm-tab'+(adminTab==='products'?' on':'')+'" data-tab="products">Products &amp; sizes</button>'+
        '<button class="adm-tab'+(adminTab==='gallery'?' on':'')+'" data-tab="gallery">Design gallery</button>'+
      '</div>'+
      '<div class="adm-bar">'+
        '<button class="btn-sm pri" data-act="save">Save changes</button>'+
        '<button class="btn-sm" data-act="discard">Discard</button>'+
        '<button class="btn-sm" data-act="export">Export backup</button>'+
        '<label class="btn-sm" style="cursor:pointer">Import<input type="file" id="admImport" accept="application/json" hidden></label>'+
        '<button class="btn-sm danger" data-act="reset">Reset to defaults</button>'+
        '<span class="status" id="admStatus"></span>'+
      '</div>'+
      panel;
  }
  function doUnlock(){
    var v=(document.getElementById('admPass')||{}).value;
    if(v===ADMIN_PASS){adminUnlocked=true;draft=clone(PDP);galDraft=clone(GAL);renderAdmin();}
    else{var e=document.getElementById('admErr');if(e)e.textContent='Wrong passcode.';}
  }
  function exportCatalog(){
    var data={catalog:PDP,gallery:GAL};
    var blob=new Blob([JSON.stringify(data,null,2)],{type:'application/json'});
    var a=document.createElement('a');a.href=URL.createObjectURL(blob);a.download='odn-backup.json';
    document.body.appendChild(a);a.click();a.remove();setTimeout(function(){URL.revokeObjectURL(a.href)},800);
    setAdmStatus('Exported odn-backup.json');
  }
  adminApp.addEventListener('input',function(e){
    var t=e.target;
    if(t.dataset.field){var p=t.dataset.p,f=t.dataset.field;
      if(f==='rating'||f==='reviews')draft[p][f]=parseFloat(t.value)||0; else draft[p][f]=t.value;
    } else if(t.dataset.sfield){var row=t.closest('[data-i]'),pb=t.closest('[data-p]');if(!row||!pb)return;
      var p=pb.dataset.p,i=+row.dataset.i,f=t.dataset.sfield;
      if(f==='price')draft[p].sizes[i].price=(t.value===''?null:(parseFloat(t.value)||0));
      else draft[p].sizes[i][f]=t.value;
    } else if(t.dataset.vfield){var row2=t.closest('[data-i]'),pb2=t.closest('[data-p]');if(!row2||!pb2)return;
      draft[pb2.dataset.p].variants[+row2.dataset.i][t.dataset.vfield]=t.value;
    } else if(t.dataset.gfield){var rg=t.closest('[data-i]');if(!rg)return;var gf=t.dataset.gfield;
      if(gf==='t'||gf==='m')galDraft[rg.dataset.p].items[+rg.dataset.i][gf]=t.value;
    } else if(t.dataset.gcat!==undefined){var pg=t.dataset.p,gi=+t.dataset.gcat,oldc=galDraft[pg].cats[gi];
      galDraft[pg].cats[gi]=t.value; galDraft[pg].items.forEach(function(it){if(it.c===oldc)it.c=t.value;});
    }
  });
  adminApp.addEventListener('change',function(e){
    var t=e.target;
    if(t.dataset.field==='enabled'){draft[t.dataset.p].enabled=t.checked;return;}
    if(t.dataset.sfield==='popular'){var row=t.closest('[data-i]'),pb=t.closest('[data-p]');if(!row||!pb)return;
      var p=pb.dataset.p,i=+row.dataset.i;
      draft[p].sizes.forEach(function(s){s.popular=false});draft[p].sizes[i].popular=t.checked;renderAdmin();return;}
    if(t.dataset.gfield==='c'||t.dataset.gfield==='v'){var rg=t.closest('[data-i]');if(rg)galDraft[rg.dataset.p].items[+rg.dataset.i][t.dataset.gfield]=t.value;return;}
    if(t.dataset.gimg!==undefined){var rgi=t.closest('[data-i]');var fi=t.files&&t.files[0];if(!rgi||!fi)return;
      if(fi.size>2200000){setAdmStatus('That image is large (>2 MB) — it may not save. Try a smaller one.');}
      var rd=new FileReader();rd.onload=function(){galDraft[rgi.dataset.p].items[+rgi.dataset.i].img=rd.result;renderAdmin();setAdmStatus('Photo added — Save to apply.');};rd.readAsDataURL(fi);return;}
    if(t.id==='admImport'){var f=t.files&&t.files[0];if(!f)return;var r=new FileReader();
      r.onload=function(){try{var o=JSON.parse(r.result);
        if(o&&o.catalog&&o.gallery){draft=o.catalog;galDraft=o.gallery;renderAdmin();setAdmStatus('Imported — review, then Save to apply.');}
        else if(o&&o.figurine&&o.metal&&o.deskmat){draft=o;renderAdmin();setAdmStatus('Imported catalogue — review, then Save.');}
        else setAdmStatus('Invalid backup file.');
      }catch(err){setAdmStatus('Could not read that file.');}};
      r.readAsText(f);}
  });
  adminApp.addEventListener('click',function(e){
    var tab=e.target.closest('[data-tab]'); if(tab){adminTab=tab.dataset.tab;renderAdmin();return;}
    var b=e.target.closest('[data-act]'); if(!b)return;
    var act=b.dataset.act, p=b.dataset.p;
    if(act==='unlock'){doUnlock();return;}
    if(act==='add-size'){draft[p].sizes.push({id:'New size',price:0,note:''});renderAdmin();}
    else if(act==='del-size'){draft[p].sizes.splice(+b.dataset.i,1);renderAdmin();}
    else if(act==='add-var'){draft[p].variants.push(p==='figurine'?{id:'New style'}:{id:'New',swatch:'#888888'});renderAdmin();}
    else if(act==='del-var'){draft[p].variants.splice(+b.dataset.i,1);renderAdmin();}
    else if(act==='add-cat'){galDraft[p].cats.push('New category');renderAdmin();}
    else if(act==='del-cat'){var oc=galDraft[p].cats[+b.dataset.i];galDraft[p].cats.splice(+b.dataset.i,1);var fc=galDraft[p].cats[0]||'';galDraft[p].items.forEach(function(it){if(it.c===oc)it.c=fc;});renderAdmin();}
    else if(act==='add-item'){galDraft[p].items.push({c:(galDraft[p].cats[0]||''),v:(PDP[p].variants[0]||{}).id,t:'New piece',m:''});renderAdmin();}
    else if(act==='del-item'){galDraft[p].items.splice(+b.dataset.i,1);renderAdmin();}
    else if(act==='del-img'){delete galDraft[p].items[+b.dataset.i].img;renderAdmin();setAdmStatus('Photo removed — Save to apply.');}
    else if(act==='discard'){draft=clone(PDP);galDraft=clone(GAL);renderAdmin();setAdmStatus('Changes discarded.');}
    else if(act==='export'){exportCatalog();}
    else if(act==='save'){PDP=clone(draft);GAL=clone(galDraft);saveCatalog();saveGallery();applyAll();setAdmStatus('Saved. Live on this device.');}
    else if(act==='reset'){if(confirm('Reset products and gallery to defaults? This clears your saved changes.')){PDP=clone(DEFAULT_CATALOG);GAL=clone(DEFAULT_GAL);saveCatalog();saveGallery();draft=clone(PDP);galDraft=clone(GAL);applyAll();renderAdmin();setAdmStatus('Reset to defaults.');}}
  });

  /* =================== ORDER WIZARD (guided) =================== */
  var ord={product:null,variant:null,size:null};
  var ordStep1=document.getElementById('ordStep1'), ordStep2=document.getElementById('ordStep2');
  function minPrice(k){var ps=PDP[k].sizes.map(function(s){return s.price}).filter(function(v){return v!=null});return ps.length?Math.min.apply(null,ps):null;}
  function defSize(k){var pop=PDP[k].sizes.filter(function(s){return s.popular})[0];return (pop||PDP[k].sizes[0]||{}).id;}
  function findSize(k,id){var a=PDP[k].sizes;for(var i=0;i<a.length;i++)if(a[i].id===id)return a[i];return a[0];}

  function ordProductCards(){
    return ['figurine','metal','deskmat'].filter(function(k){return PDP[k].enabled!==false}).map(function(k){
      var p=PDP[k], mp=minPrice(k);
      return '<button class="ord-card" data-ordprod="'+k+'">'+
        '<div class="ord-art">'+shot(k,p.variants[0].id,'front')+'</div>'+
        '<div><div class="ord-name">'+esc(p.shopLabel)+'</div>'+
        '<div class="ord-from">'+(mp!=null?'from '+INR(mp):'Custom quote')+'</div></div></button>';
    }).join('');
  }
  function renderOrder(){
    ord={product:null,variant:null,size:null};
    document.getElementById('ordHead').textContent='What would you like to make?';
    document.getElementById('ordSub').textContent='Pick a product to begin — you can add more items before checkout.';
    ordStep1.hidden=false; ordStep1.innerHTML=ordProductCards();
    ordStep2.hidden=true; ordStep2.innerHTML='';
  }
  function styleOpt(v,sel){
    var art = v.swatch
      ? '<span class="dot" style="background:'+v.swatch+'"></span>'
      : '<svg class="fg" viewBox="0 0 120 150">'+(STYLE_ART[v.id]||STYLE_ART['Photo to figurine'])+'</svg>';
    return '<button class="ord-opt'+(sel?' on':'')+'" data-ordkind="variant" data-val="'+esc(v.id)+'"><span class="ord-opt-art">'+art+'</span><span>'+esc(v.id)+'</span></button>';
  }
  function sizeOpt(s,sel){
    return '<button class="ord-opt'+(sel?' on':'')+'" data-ordkind="size" data-val="'+esc(s.id)+'"><span>'+esc(s.id)+'</span><small>'+(s.price!=null?INR(s.price):'Quote')+'</small></button>';
  }
  function secHTML(lbl,opts){return '<div class="ord-sec"><span class="ord-lbl">'+esc(lbl)+'</span><div class="ord-opts">'+opts+'</div></div>';}
  function buildStep2HTML(k){
    var p=PDP[k];
    var vars=p.variants.map(function(v){return styleOpt(v,v.id===ord.variant)}).join('');
    var sizes=p.sizes.map(function(s){return sizeOpt(s,s.id===ord.size)}).join('');
    var secs = k==='figurine'
      ? secHTML('Model style',vars)+secHTML('Size',sizes)
      : secHTML('Size',sizes)+secHTML(p.vlabel,vars);
    return '<div class="ord-grid2">'+
      '<div class="ord-preview"><div class="ord-prev-art" id="ordPrevArt">'+shot(k,ord.variant,'front')+'</div></div>'+
      '<div class="ord-choices">'+
        '<button class="back" data-ordback style="margin-bottom:18px"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg> Different product</button>'+
        secs+
        '<div class="ord-summary"><div>Your pick: <b id="ordSel"></b></div><div class="ord-price" id="ordPrice"></div></div>'+
        '<button class="btn btn-pri btn-lg" id="ordAdd" data-ordadd style="width:100%;justify-content:center">Add to cart</button>'+
        '<div id="ordDone" class="ord-done" hidden>Added to cart ✓'+
          '<div class="ord-done-actions"><button class="btn-sm" data-ordmore>Add another item</button><button class="btn-sm pri" data-ordcheckout>View cart &amp; checkout</button></div></div>'+
      '</div></div>';
  }
  function renderStep2(k){
    ord.product=k; ord.variant=PDP[k].variants[0].id; ord.size=defSize(k);
    document.getElementById('ordHead').textContent='Customize your '+PDP[k].title;
    document.getElementById('ordSub').textContent = k==='figurine' ? 'Choose a model style, then a size.' : 'Choose a size, then a finish.';
    ordStep1.hidden=true;
    ordStep2.hidden=false; ordStep2.innerHTML=buildStep2HTML(k);
    updateOrderUI();
  }
  function updateOrderUI(){
    var k=ord.product; if(!k)return;
    var pa=document.getElementById('ordPrevArt'); if(pa)pa.innerHTML=shot(k,ord.variant,'front');
    var sel=document.getElementById('ordSel'); if(sel)sel.textContent=ord.variant+' · '+ord.size;
    var s=findSize(k,ord.size), pr=document.getElementById('ordPrice');
    if(pr)pr.textContent=(s&&s.price!=null)?INR(s.price):'Custom quote';
  }
  function ordAddToCart(){
    var k=ord.product, p=PDP[k], s=findSize(k,ord.size);
    cart.push({key:k,title:p.title,variant:ord.variant,size:ord.size,price:s?s.price:null,qty:1,art:shot(k,ord.variant,'front')});
    renderCart();
    var d=document.getElementById('ordDone'); if(d)d.hidden=false;
    var a=document.getElementById('ordAdd'); if(a)a.hidden=true;
  }
  ordStep1.addEventListener('click',function(e){
    var c=e.target.closest('[data-ordprod]'); if(c)renderStep2(c.dataset.ordprod);
  });
  ordStep2.addEventListener('click',function(e){
    var o=e.target.closest('[data-ordkind]');
    if(o){ if(o.dataset.ordkind==='variant')ord.variant=o.dataset.val; else ord.size=o.dataset.val;
      o.parentNode.querySelectorAll('.ord-opt').forEach(function(b){b.classList.toggle('on',b===o)});
      updateOrderUI(); return; }
    if(e.target.closest('[data-ordback]')){renderOrder();return;}
    if(e.target.closest('[data-ordadd]')){ordAddToCart();return;}
    if(e.target.closest('[data-ordmore]')){renderOrder();return;}
    if(e.target.closest('[data-ordcheckout]')){openCart();return;}
  });

  /* Hidden admin access — no link on the site.
     Open it by typing the secret word anywhere on the page (when not in a text field),
     or by adding #admin to the page URL. Change the secret word and passcode below. */
  var ADMIN_HOTKEY='odnadmin';
  var _akb='';
  document.addEventListener('keydown',function(e){
    var t=e.target, tag=(t&&t.tagName||'').toLowerCase();
    if(tag==='input'||tag==='textarea'||tag==='select'||(t&&t.isContentEditable))return;
    if(e.key&&e.key.length===1){
      _akb=(_akb+e.key.toLowerCase()).slice(-ADMIN_HOTKEY.length);
      if(_akb===ADMIN_HOTKEY.toLowerCase()){_akb='';navigate('admin');}
    }
  });

  /* INIT */
  renderSizeCards(); renderDesignGallery(); applyVisibility();
  document.querySelectorAll('#contact .reveal').forEach(function(el){io.observe(el)});
  render(hashView());
})();
</script>
</body>
</html>
