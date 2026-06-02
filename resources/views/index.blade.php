@extends('app')

@section('content')

{{-- ============================================================
     E-SAPO — Upgraded UI
     Font: Sora (display) + DM Sans (body)
     Theme: Natural Civic — earthy green, warm cream, confident
     ============================================================ --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

<style>
/* ============================================================
   TOKENS
   ============================================================ */
:root {
    /* Palette */
    --c-bg:         #f4f6f1;
    --c-bg-warm:    #ede9e0;
    --c-surface:    #ffffff;
    --c-surface-2:  #f9faf6;
    --c-ink:        #0f1f16;
    --c-ink-2:      #1b2e21;
    --c-muted:      #5e7166;
    --c-subtle:     #8fa396;
    --c-line:       rgba(15, 31, 22, 0.09);

    /* Brand */
    --c-green:      #1daa6d;
    --c-green-dk:   #0e7a4a;
    --c-green-lt:   #e2f7ed;
    --c-green-glow: rgba(29, 170, 109, 0.18);

    /* Status */
    --c-amber:      #e8a020;
    --c-amber-lt:   #fef3d0;
    --c-amber-dk:   #7a4d05;
    --c-blue:       #2b7de9;
    --c-blue-lt:    #deeeff;
    --c-blue-dk:    #0c4a8d;
    --c-teal:       #0f8a6a;
    --c-teal-lt:    #d6f5eb;
    --c-teal-dk:    #064d3a;

    /* Elevation */
    --shadow-sm:    0 2px 8px rgba(15,31,22,0.06), 0 1px 2px rgba(15,31,22,0.04);
    --shadow-md:    0 8px 28px rgba(15,31,22,0.09), 0 2px 8px rgba(15,31,22,0.05);
    --shadow-lg:    0 20px 56px rgba(15,31,22,0.12), 0 4px 12px rgba(15,31,22,0.06);
    --shadow-xl:    0 30px 80px rgba(15,31,22,0.15), 0 8px 24px rgba(15,31,22,0.08);

    /* Radii */
    --r-xs:  8px;
    --r-sm:  14px;
    --r-md:  20px;
    --r-lg:  28px;
    --r-xl:  38px;
    --r-2xl: 50px;

    /* Typography */
    --font-display: 'Sora', ui-sans-serif, system-ui, sans-serif;
    --font-body:    'DM Sans', ui-sans-serif, system-ui, sans-serif;

    /* Motion */
    --ease-out:     cubic-bezier(0.16, 1, 0.3, 1);
    --ease-spring:  cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* ============================================================
   RESET + BASE
   ============================================================ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }

/* ============================================================
   PAGE SHELL
   ============================================================ */
.ep {
    width: 100%;
    min-height: 100vh;
    margin-top: -24px;
    padding: 0 0 100px;
    position: relative;
    overflow-x: hidden;
    color: var(--c-ink);
    font-family: var(--font-body);
    background: var(--c-bg);
}

/* Ambient blobs */
.ep-blob {
    position: absolute;
    border-radius: 999px;
    pointer-events: none;
    filter: blur(90px);
    z-index: 0;
    animation: blobDrift 14s ease-in-out infinite alternate;
}
.ep-blob-1 {
    width: 480px; height: 480px;
    top: -120px; left: -160px;
    background: radial-gradient(circle, rgba(29,170,109,0.13) 0%, transparent 70%);
    animation-duration: 16s;
}
.ep-blob-2 {
    width: 420px; height: 420px;
    top: 60px; right: -180px;
    background: radial-gradient(circle, rgba(232,160,32,0.10) 0%, transparent 70%);
    animation-duration: 20s;
    animation-delay: -5s;
}
.ep-blob-3 {
    width: 360px; height: 360px;
    bottom: 200px; left: 20%;
    background: radial-gradient(circle, rgba(29,170,109,0.08) 0%, transparent 70%);
    animation-duration: 18s;
    animation-delay: -8s;
}
@keyframes blobDrift {
    0%   { transform: translate(0, 0) scale(1); }
    100% { transform: translate(30px, 20px) scale(1.06); }
}

/* Grain overlay */
.ep::after {
    content: '';
    position: fixed;
    inset: 0;
    z-index: 1;
    pointer-events: none;
    opacity: 0.025;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
    background-size: 180px;
}

.ep-wrap {
    width: min(1180px, calc(100% - 40px));
    margin-inline: auto;
    position: relative;
    z-index: 2;
}

/* ============================================================
   HERO SECTION
   ============================================================ */
.ep-hero {
    padding-top: 56px;
    display: grid;
    gap: 20px;
}

.ep-hero-top {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 20px;
    align-items: stretch;
}

/* Intro card */
.ep-intro {
    position: relative;
    border-radius: var(--r-xl);
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-lg);
    padding: 48px 44px 44px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 28px;
    animation: fadeUp 0.7s var(--ease-out) both;
}

.ep-intro-deco {
    position: absolute;
    pointer-events: none;
}
.ep-intro-deco-1 {
    width: 320px; height: 320px;
    right: -120px; top: -140px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(29,170,109,0.10) 0%, transparent 65%);
}
.ep-intro-deco-2 {
    width: 200px; height: 200px;
    left: -60px; bottom: -80px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(232,160,32,0.10) 0%, transparent 65%);
}
/* Grid lines deco */
.ep-intro-deco-grid {
    position: absolute;
    right: 0; top: 0;
    width: 260px; height: 260px;
    opacity: 0.04;
    background-image:
        linear-gradient(var(--c-ink) 1px, transparent 1px),
        linear-gradient(90deg, var(--c-ink) 1px, transparent 1px);
    background-size: 32px 32px;
    border-radius: 0 var(--r-xl) 0 0;
}

.ep-intro-top { position: relative; z-index: 2; }
.ep-intro-bottom { position: relative; z-index: 2; }

/* Eyebrow badge */
.ep-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 34px;
    padding: 0 14px;
    border-radius: 999px;
    background: var(--c-green-lt);
    color: var(--c-green-dk);
    font-family: var(--font-display);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
}
.ep-badge-dot {
    width: 7px;
    height: 7px;
    border-radius: 999px;
    background: var(--c-green);
    box-shadow: 0 0 0 3px rgba(29,170,109,0.20), 0 0 0 6px rgba(29,170,109,0.08);
    animation: pulse 2.2s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 3px rgba(29,170,109,0.20), 0 0 0 6px rgba(29,170,109,0.08); }
    50%       { box-shadow: 0 0 0 5px rgba(29,170,109,0.14), 0 0 0 10px rgba(29,170,109,0.04); }
}

.ep-title {
    margin-top: 22px;
    font-family: var(--font-display);
    font-size: clamp(36px, 4vw, 62px);
    font-weight: 800;
    line-height: 1.02;
    letter-spacing: -0.04em;
    color: var(--c-ink);
}
.ep-title em {
    font-style: normal;
    color: var(--c-green);
    position: relative;
    display: inline-block;
}
/* Underline accent on keyword */
.ep-title em::after {
    content: '';
    position: absolute;
    left: 0; bottom: -4px;
    width: 100%; height: 3px;
    border-radius: 4px;
    background: linear-gradient(90deg, var(--c-green), rgba(29,170,109,0.3));
}

.ep-desc {
    margin-top: 18px;
    font-size: 14.5px;
    line-height: 1.80;
    color: var(--c-muted);
    font-weight: 400;
    max-width: 560px;
}

.ep-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

/* Buttons */
.ep-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    height: 52px;
    padding: 0 24px;
    border-radius: var(--r-sm);
    text-decoration: none;
    font-family: var(--font-display);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    transition: transform 0.22s var(--ease-spring), box-shadow 0.22s ease, background 0.18s ease;
    position: relative;
    overflow: hidden;
}
.ep-btn::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0);
    transition: background 0.18s ease;
}
.ep-btn:hover::after { background: rgba(255,255,255,0.07); }
.ep-btn:hover { transform: translateY(-2px); }
.ep-btn:active { transform: translateY(0); }

.ep-btn-primary {
    background: var(--c-ink);
    color: #fff;
    box-shadow: 0 8px 24px rgba(15,31,22,0.20), 0 2px 6px rgba(15,31,22,0.12);
}
.ep-btn-primary:hover {
    box-shadow: 0 14px 32px rgba(15,31,22,0.25), 0 4px 10px rgba(15,31,22,0.14);
    background: #1c3626;
}
.ep-btn-ghost {
    background: transparent;
    color: var(--c-ink);
    border: 1.5px solid var(--c-line);
}
.ep-btn-ghost:hover {
    background: var(--c-surface-2);
    border-color: rgba(15,31,22,0.14);
}

/* Metric strip inside intro bottom */
.ep-metric-strip {
    display: flex;
    align-items: center;
    gap: 28px;
    padding-top: 24px;
    border-top: 1px solid var(--c-line);
}
.ep-metric {
    display: flex;
    flex-direction: column;
    gap: 3px;
}
.ep-metric-num {
    font-family: var(--font-display);
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.05em;
    color: var(--c-ink);
    line-height: 1;
}
.ep-metric-label {
    font-size: 10px;
    font-weight: 600;
    color: var(--c-subtle);
    letter-spacing: 0.08em;
    text-transform: uppercase;
}
.ep-metric-divider {
    width: 1px;
    height: 36px;
    background: var(--c-line);
}

/* Visual image card */
.ep-visual {
    border-radius: var(--r-xl);
    overflow: hidden;
    position: relative;
    min-height: 380px;
    background: #c8d8c8;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--c-line);
    animation: fadeUp 0.7s var(--ease-out) 0.12s both;
}
.ep-visual img {
    width: 100%; height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.9s var(--ease-out);
}
.ep-visual:hover img { transform: scale(1.06); }
.ep-visual-grad {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        rgba(10,22,14,0) 30%,
        rgba(10,22,14,0.65) 100%
    );
}
.ep-visual-caption {
    position: absolute;
    left: 18px; right: 18px; bottom: 18px;
    padding: 18px 20px;
    border-radius: var(--r-md);
    background: rgba(255,255,255,0.82);
    border: 1px solid rgba(255,255,255,0.55);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
}
.ep-visual-caption strong {
    display: block;
    font-family: var(--font-display);
    font-size: 15px;
    font-weight: 700;
    letter-spacing: -0.03em;
    color: var(--c-ink);
    line-height: 1.3;
}
.ep-visual-caption span {
    display: block;
    margin-top: 5px;
    font-size: 12px;
    color: var(--c-muted);
    line-height: 1.5;
}

/* ============================================================
   FEATURE CARDS
   ============================================================ */
.ep-features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    animation: fadeUp 0.7s var(--ease-out) 0.22s both;
}

.ep-feature {
    border-radius: var(--r-lg);
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-sm);
    padding: 26px;
    display: flex;
    flex-direction: column;
    gap: 14px;
    transition: transform 0.26s var(--ease-spring), box-shadow 0.26s ease;
    position: relative;
    overflow: hidden;
}
.ep-feature::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: var(--r-lg);
    background: linear-gradient(135deg, rgba(29,170,109,0.04) 0%, transparent 60%);
    opacity: 0;
    transition: opacity 0.26s ease;
}
.ep-feature:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}
.ep-feature:hover::before { opacity: 1; }

.ep-feature-icon {
    width: 50px; height: 50px;
    border-radius: 16px;
    background: var(--c-green-lt);
    display: grid;
    place-items: center;
    font-size: 22px;
    border: 1px solid rgba(29,170,109,0.15);
    flex-shrink: 0;
}
.ep-feature-text {}
.ep-feature-text strong {
    display: block;
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 700;
    letter-spacing: -0.03em;
    color: var(--c-ink);
    line-height: 1.3;
}
.ep-feature-text p {
    margin-top: 6px;
    font-size: 13px;
    line-height: 1.70;
    color: var(--c-muted);
}

/* ============================================================
   STATS
   ============================================================ */
.ep-stats-section {
    margin-top: 24px;
    animation: fadeUp 0.7s var(--ease-out) 0.32s both;
}

.ep-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
}

.ep-stat {
    border-radius: var(--r-lg);
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-sm);
    padding: 24px 22px;
    position: relative;
    overflow: hidden;
    transition: transform 0.24s var(--ease-spring), box-shadow 0.24s ease;
    cursor: default;
}
.ep-stat:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

/* Corner accent shape */
.ep-stat::before {
    content: '';
    position: absolute;
    width: 80px; height: 80px;
    right: -20px; top: -20px;
    border-radius: 999px;
    transition: transform 0.3s ease;
}
.ep-stat:hover::before { transform: scale(1.2); }

.ep-stat-total::before   { background: rgba(29,170,109,0.10); }
.ep-stat-pending::before { background: rgba(232,160,32,0.14); }
.ep-stat-proses::before  { background: rgba(43,125,233,0.12); }
.ep-stat-selesai::before { background: rgba(29,170,109,0.14); }

/* Bottom bar accent */
.ep-stat::after {
    content: '';
    position: absolute;
    left: 0; bottom: 0;
    width: 100%; height: 3px;
    border-radius: 0 0 var(--r-lg) var(--r-lg);
    opacity: 0;
    transition: opacity 0.24s ease;
}
.ep-stat:hover::after { opacity: 1; }
.ep-stat-total::after   { background: linear-gradient(90deg, var(--c-green), transparent); }
.ep-stat-pending::after { background: linear-gradient(90deg, var(--c-amber), transparent); }
.ep-stat-proses::after  { background: linear-gradient(90deg, var(--c-blue), transparent); }
.ep-stat-selesai::after { background: linear-gradient(90deg, var(--c-teal), transparent); }

.ep-stat-label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--c-subtle);
    position: relative;
    z-index: 2;
}
.ep-stat-pip {
    width: 8px; height: 8px;
    border-radius: 999px;
}
.ep-stat-total   .ep-stat-pip { background: var(--c-green); }
.ep-stat-pending .ep-stat-pip { background: var(--c-amber); }
.ep-stat-proses  .ep-stat-pip { background: var(--c-blue); }
.ep-stat-selesai .ep-stat-pip { background: var(--c-teal); }

.ep-stat-num {
    display: block;
    margin-top: 14px;
    font-family: var(--font-display);
    font-size: 46px;
    font-weight: 800;
    line-height: 1;
    letter-spacing: -0.06em;
    color: var(--c-ink);
    position: relative;
    z-index: 2;
    transition: color 0.2s;
}
.ep-stat-pending:hover .ep-stat-num { color: var(--c-amber-dk); }
.ep-stat-proses:hover  .ep-stat-num { color: var(--c-blue-dk); }
.ep-stat-selesai:hover .ep-stat-num { color: var(--c-teal-dk); }

.ep-stat-sub {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: var(--c-subtle);
    position: relative;
    z-index: 2;
}

/* ============================================================
   REPORTS SECTION
   ============================================================ */
.ep-reports-section {
    margin-top: 72px;
    animation: fadeUp 0.7s var(--ease-out) 0.4s both;
}

/* Section header */
.ep-section-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    padding-bottom: 22px;
    border-bottom: 1px solid var(--c-line);
    position: relative;
}
/* Decorative line accent */
.ep-section-head::after {
    content: '';
    position: absolute;
    left: 0; bottom: -1px;
    width: 64px; height: 2px;
    background: var(--c-green);
    border-radius: 2px;
}

.ep-kicker {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--c-green);
    margin-bottom: 8px;
}
.ep-section-title {
    font-family: var(--font-display);
    font-size: clamp(24px, 2.4vw, 34px);
    font-weight: 800;
    letter-spacing: -0.05em;
    color: var(--c-ink);
    line-height: 1.1;
}
.ep-section-note {
    max-width: 340px;
    font-size: 13px;
    line-height: 1.7;
    color: var(--c-muted);
    text-align: right;
}

/* Toolbar */
.ep-toolbar {
    margin-top: 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    flex-wrap: wrap;
}
.ep-tags {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.ep-tag {
    height: 36px;
    padding: 0 14px;
    border-radius: 999px;
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-sm);
    color: var(--c-ink-2);
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.04em;
}
.ep-toolbar-btn {
    height: 42px;
    padding: 0 20px;
    border-radius: var(--r-sm);
    background: var(--c-green);
    color: #fff;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: var(--font-display);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    box-shadow: 0 6px 18px rgba(29,170,109,0.30);
    transition: transform 0.22s var(--ease-spring), box-shadow 0.22s ease;
}
.ep-toolbar-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 26px rgba(29,170,109,0.38);
    background: var(--c-green-dk);
}

/* Report grid */
.ep-grid {
    margin-top: 26px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
}

/* Report card */
.ep-card {
    border-radius: var(--r-xl);
    overflow: hidden;
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-md);
    display: flex;
    flex-direction: column;
    transition: transform 0.28s var(--ease-spring), box-shadow 0.28s ease;
}
.ep-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.ep-card-img {
    position: relative;
    height: 230px;
    overflow: hidden;
    background: #d4e0d4;
    flex-shrink: 0;
}
.ep-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.80s var(--ease-out);
}
.ep-card:hover .ep-card-img img { transform: scale(1.10); }
.ep-card-img-grad {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 35%, rgba(10,22,14,0.55) 100%);
}

/* Status badge */
.ep-status {
    position: absolute;
    top: 14px; left: 14px;
    z-index: 3;
    height: 30px;
    padding: 0 12px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.30);
}
.ep-status::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 999px;
}
.ep-status-pending {
    background: rgba(254,243,208,0.95);
    color: var(--c-amber-dk);
}
.ep-status-pending::before { background: var(--c-amber); }
.ep-status-proses {
    background: rgba(222,238,255,0.95);
    color: var(--c-blue-dk);
}
.ep-status-proses::before { background: var(--c-blue); }
.ep-status-selesai {
    background: rgba(214,245,235,0.97);
    color: var(--c-teal-dk);
}
.ep-status-selesai::before { background: var(--c-teal); }

/* Location chip */
.ep-loc {
    position: absolute;
    left: 14px; right: 14px; bottom: 14px;
    z-index: 3;
    padding: 10px 14px;
    border-radius: var(--r-sm);
    background: rgba(8,16,10,0.36);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    color: #fff;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}
.ep-loc span:last-child {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    min-width: 0;
}

/* Card body */
.ep-card-body {
    padding: 22px;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 0;
}
.ep-card-title {
    font-family: var(--font-display);
    font-size: 17px;
    font-weight: 700;
    letter-spacing: -0.03em;
    color: var(--c-ink);
    line-height: 1.35;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.ep-card-desc {
    margin-top: 10px;
    font-size: 13px;
    line-height: 1.75;
    color: var(--c-muted);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.ep-card-footer {
    margin-top: auto;
    padding-top: 18px;
    border-top: 1px solid var(--c-line);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-top: 18px;
}
.ep-user {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}
.ep-avatar {
    width: 38px; height: 38px;
    border-radius: 13px;
    background: var(--c-green-lt);
    border: 1.5px solid rgba(29,170,109,0.15);
    color: var(--c-green-dk);
    display: grid;
    place-items: center;
    font-family: var(--font-display);
    font-size: 13px;
    font-weight: 700;
    flex-shrink: 0;
}
.ep-user-info { min-width: 0; }
.ep-user-role {
    display: block;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    color: var(--c-subtle);
    line-height: 1;
}
.ep-user-name {
    display: block;
    margin-top: 4px;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--c-ink-2);
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 140px;
}
.ep-detail-btn {
    height: 36px;
    padding: 0 14px;
    border-radius: var(--r-xs);
    background: var(--c-surface-2);
    border: 1px solid var(--c-line);
    color: var(--c-ink);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    transition: background 0.18s ease, transform 0.18s var(--ease-spring);
    white-space: nowrap;
}
.ep-detail-btn:hover {
    background: var(--c-green-lt);
    color: var(--c-green-dk);
    border-color: rgba(29,170,109,0.20);
    transform: translateY(-1px);
}

/* ============================================================
   SKELETON
   ============================================================ */
.ep-skeleton {
    border-radius: var(--r-xl);
    overflow: hidden;
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-sm);
}
.ep-skel-img {
    height: 230px;
    background: linear-gradient(90deg, #e8ede6 0%, #f5f8f3 50%, #e8ede6 100%);
    background-size: 300% 100%;
    animation: shimmer 1.4s ease-in-out infinite;
}
.ep-skel-body { padding: 22px; }
.ep-skel-line {
    height: 12px;
    border-radius: 999px;
    margin-bottom: 12px;
    background: linear-gradient(90deg, #e8ede6 0%, #f5f8f3 50%, #e8ede6 100%);
    background-size: 300% 100%;
    animation: shimmer 1.4s ease-in-out infinite;
}
.ep-skel-line.w-40 { width: 40%; }
.ep-skel-line.w-70 { width: 70%; height: 16px; }
.ep-skel-line.w-full { width: 100%; }
@keyframes shimmer {
    0%   { background-position: 100% 0; }
    100% { background-position: -100% 0; }
}

/* ============================================================
   EMPTY / ERROR STATE
   ============================================================ */
.ep-empty {
    grid-column: 1 / -1;
    min-height: 340px;
    border-radius: var(--r-xl);
    background: var(--c-surface);
    border: 1px dashed rgba(15,31,22,0.14);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 48px 24px;
}
.ep-empty-inner { max-width: 380px; }
.ep-empty-icon {
    width: 80px; height: 80px;
    margin: 0 auto;
    border-radius: 26px;
    background: var(--c-green-lt);
    border: 1px solid rgba(29,170,109,0.15);
    display: grid;
    place-items: center;
    font-size: 34px;
}
.ep-empty-icon.error-icon {
    background: #fef5e4;
    border-color: rgba(232,160,32,0.20);
}
.ep-empty h3 {
    margin-top: 20px;
    font-family: var(--font-display);
    font-size: 21px;
    font-weight: 700;
    letter-spacing: -0.04em;
    color: var(--c-ink);
}
.ep-empty p {
    margin-top: 10px;
    font-size: 13.5px;
    line-height: 1.75;
    color: var(--c-muted);
}
.ep-empty-cta {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 22px;
    height: 44px;
    padding: 0 22px;
    border-radius: var(--r-sm);
    background: var(--c-ink);
    color: #fff;
    text-decoration: none;
    font-family: var(--font-display);
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    transition: transform 0.22s var(--ease-spring), background 0.18s ease;
}
.ep-empty-cta:hover { transform: translateY(-2px); background: #1c3626; }

/* ============================================================
   ANIMATION
   ============================================================ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 1080px) {
    .ep-hero-top { grid-template-columns: 1fr; }
    .ep-visual { min-height: 300px; }
    .ep-features { grid-template-columns: repeat(3, 1fr); }
    .ep-stats { grid-template-columns: repeat(2, 1fr); }
    .ep-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 760px) {
    .ep { margin-top: -18px; }
    .ep-wrap { width: min(calc(100% - 28px), 1180px); }
    .ep-hero { padding-top: 28px; }

    .ep-intro { padding: 28px 24px 24px; border-radius: var(--r-lg); gap: 20px; }
    .ep-title { font-size: 32px; }
    .ep-desc { font-size: 13.5px; }
    .ep-actions { flex-direction: column; }
    .ep-btn { width: 100%; height: 50px; }
    .ep-metric-strip { gap: 18px; }
    .ep-metric-num { font-size: 20px; }

    .ep-visual { min-height: 240px; border-radius: var(--r-lg); }

    .ep-features { grid-template-columns: 1fr; gap: 12px; }
    .ep-feature { border-radius: var(--r-md); flex-direction: row; align-items: flex-start; }

    .ep-stats { grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .ep-stat { padding: 18px 16px; border-radius: var(--r-md); }
    .ep-stat-num { font-size: 38px; }

    .ep-reports-section { margin-top: 52px; }
    .ep-section-head { flex-direction: column; align-items: flex-start; }
    .ep-section-note { text-align: left; max-width: 100%; }
    .ep-toolbar { flex-direction: column; align-items: stretch; }
    .ep-toolbar-btn { width: 100%; justify-content: center; }
    .ep-grid { grid-template-columns: 1fr; gap: 16px; }
    .ep-card { border-radius: var(--r-lg); }
    .ep-card-img { height: 215px; }
}

@media (max-width: 420px) {
    .ep-features { grid-template-columns: 1fr; }
    .ep-stats { grid-template-columns: 1fr; }
    .ep-title { font-size: 28px; }
    .ep-card-footer { flex-wrap: wrap; }
    .ep-detail-btn { width: 100%; justify-content: center; }
}
</style>

<div class="ep">
    {{-- Ambient blobs --}}
    <div class="ep-blob ep-blob-1"></div>
    <div class="ep-blob ep-blob-2"></div>
    <div class="ep-blob ep-blob-3"></div>

    {{-- ======================== HERO ======================== --}}
    <section class="ep-wrap ep-hero">
        <div class="ep-hero-top">

            {{-- Intro card --}}
            <div class="ep-intro">
                <div class="ep-intro-deco ep-intro-deco-1"></div>
                <div class="ep-intro-deco ep-intro-deco-2"></div>
                <div class="ep-intro-deco ep-intro-deco-grid"></div>

                <div class="ep-intro-top">
                    <div class="ep-badge">
                        <span class="ep-badge-dot"></span>
                        Sistem Pelaporan Publik
                    </div>

                    <h1 class="ep-title">
                        Bantu Lingkungan Lebih<br>
                        <em>Bersih</em> Lewat Laporan<br>
                        yang Terarah
                    </h1>

                    <p class="ep-desc">
                        E-SAPO membantu masyarakat mengirim aduan sampah liar dengan alur yang jelas,
                        data lokasi yang rapi, dan status penanganan yang mudah dipantau oleh warga
                        maupun petugas.
                    </p>

                    <div class="ep-actions">
                        <a href="/create" class="ep-btn ep-btn-primary">
                            Buat Laporan Sekarang
                            <span>→</span>
                        </a>
                        <a href="#laporan-terbaru" class="ep-btn ep-btn-ghost">
                            Lihat Arsip
                        </a>
                    </div>
                </div>

                <div class="ep-intro-bottom">
                    <div class="ep-metric-strip">
                        <div class="ep-metric">
                            <span class="ep-metric-num">Gratis</span>
                            <span class="ep-metric-label">Tanpa biaya</span>
                        </div>
                        <div class="ep-metric-divider"></div>
                        <div class="ep-metric">
                            <span class="ep-metric-num">Real-time</span>
                            <span class="ep-metric-label">Pantau status</span>
                        </div>
                        <div class="ep-metric-divider"></div>
                        <div class="ep-metric">
                            <span class="ep-metric-num">Publik</span>
                            <span class="ep-metric-label">Transparan</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visual image --}}
            <div class="ep-visual">
                <img
                    src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200"
                    alt="Lingkungan hijau dan bersih"
                >
                <div class="ep-visual-grad"></div>
                <div class="ep-visual-caption">
                    <strong>Lingkungan Bersih Dimulai dari Laporan Kecil</strong>
                    <span>Setiap aduan membantu petugas menentukan prioritas penanganan.</span>
                </div>
            </div>
        </div>

        {{-- Feature cards --}}
        <div class="ep-features">
            <div class="ep-feature">
                <div class="ep-feature-icon">📍</div>
                <div class="ep-feature-text">
                    <strong>Lokasi Terdokumentasi</strong>
                    <p>Data desa, RT, dan RW membantu petugas menelusuri titik laporan dengan lebih cepat.</p>
                </div>
            </div>
            <div class="ep-feature">
                <div class="ep-feature-icon">📸</div>
                <div class="ep-feature-text">
                    <strong>Bukti Foto Lapangan</strong>
                    <p>Laporan dapat menyertakan dokumentasi visual agar proses verifikasi lebih mudah dilakukan.</p>
                </div>
            </div>
            <div class="ep-feature">
                <div class="ep-feature-icon">📊</div>
                <div class="ep-feature-text">
                    <strong>Status Transparan</strong>
                    <p>Setiap laporan memiliki status sehingga masyarakat dapat melihat perkembangan penanganan.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ======================== STATS ======================== --}}
    <section class="ep-wrap ep-stats-section">
        <div class="ep-stats">
            <div class="ep-stat ep-stat-total">
                <span class="ep-stat-label">
                    <span class="ep-stat-pip"></span>
                    Total Laporan
                </span>
                <span id="stat-total" class="ep-stat-num">0</span>
                <span class="ep-stat-sub">Semua data yang masuk</span>
            </div>
            <div class="ep-stat ep-stat-pending">
                <span class="ep-stat-label">
                    <span class="ep-stat-pip"></span>
                    Pending
                </span>
                <span id="stat-pending" class="ep-stat-num">0</span>
                <span class="ep-stat-sub">Menunggu verifikasi</span>
            </div>
            <div class="ep-stat ep-stat-proses">
                <span class="ep-stat-label">
                    <span class="ep-stat-pip"></span>
                    Proses
                </span>
                <span id="stat-proses" class="ep-stat-num">0</span>
                <span class="ep-stat-sub">Sedang ditangani</span>
            </div>
            <div class="ep-stat ep-stat-selesai">
                <span class="ep-stat-label">
                    <span class="ep-stat-pip"></span>
                    Selesai
                </span>
                <span id="stat-selesai" class="ep-stat-num">0</span>
                <span class="ep-stat-sub">Sudah dituntaskan</span>
            </div>
        </div>
    </section>

    {{-- ======================== REPORTS ======================== --}}
    <section id="laporan-terbaru" class="ep-wrap ep-reports-section">
        <div class="ep-section-head">
            <div>
                <span class="ep-kicker">Arsip Publik</span>
                <h2 class="ep-section-title">Aduan Terbaru dari Masyarakat</h2>
            </div>
            <p class="ep-section-note">
                Setiap laporan ditampilkan sebagai dokumentasi publik untuk membantu
                pemantauan kebersihan wilayah dan tindak lanjut yang lebih terarah.
            </p>
        </div>

        <div class="ep-toolbar">
            <div class="ep-tags">
                <span class="ep-tag">🌿 Realtime Data</span>
                <span class="ep-tag">📷 Bukti Foto</span>
                <span class="ep-tag">📌 Lokasi RT/RW</span>
            </div>
            <a href="/create" class="ep-toolbar-btn">
                + Tambah Laporan
            </a>
        </div>

        <div id="container-pengaduan" class="ep-grid">
            @for ($i = 0; $i < 3; $i++)
                <div class="ep-skeleton">
                    <div class="ep-skel-img"></div>
                    <div class="ep-skel-body">
                        <div class="ep-skel-line w-40"></div>
                        <div class="ep-skel-line w-70"></div>
                        <div class="ep-skel-line w-full"></div>
                        <div class="ep-skel-line w-full"></div>
                    </div>
                </div>
            @endfor
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container   = document.getElementById('container-pengaduan');
    const statTotal   = document.getElementById('stat-total');
    const statPending = document.getElementById('stat-pending');
    const statProses  = document.getElementById('stat-proses');
    const statSelesai = document.getElementById('stat-selesai');

    /* ---- helpers ---- */
    const safeText = (v, fallback = '-') =>
        (v === null || v === undefined || v === '') ? fallback : String(v);

    const esc = (v) =>
        safeText(v, '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');

    const normalizeStatus = (status) => {
        const s = safeText(status, 'pending').toLowerCase();
        if (['proses','diproses','process'].includes(s)) return 'proses';
        if (['selesai','done','completed'].includes(s))  return 'selesai';
        return 'pending';
    };

    const statusLabel = (s) =>
        s === 'proses' ? 'Proses' : s === 'selesai' ? 'Selesai' : 'Pending';

    /* ---- counter animation ---- */
    const animateCount = (el, target) => {
        const duration = 900;
        const start    = performance.now();
        const from     = parseInt(el.innerText) || 0;
        const update   = (now) => {
            const t = Math.min((now - start) / duration, 1);
            const ease = 1 - Math.pow(1 - t, 4);
            el.innerText = Math.round(from + (target - from) * ease);
            if (t < 1) requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
    };

    const setStats = (data) => {
        const pending = data.filter(i => normalizeStatus(i.status) === 'pending').length;
        const proses  = data.filter(i => normalizeStatus(i.status) === 'proses').length;
        const selesai = data.filter(i => normalizeStatus(i.status) === 'selesai').length;
        animateCount(statTotal,   data.length);
        animateCount(statPending, pending);
        animateCount(statProses,  proses);
        animateCount(statSelesai, selesai);
    };

    /* ---- fetch ---- */
    fetch('/api/pengaduan', {
        method: 'GET',
        headers: { 'Accept': 'application/json' }
    })
    .then(async res => {
        const data = await res.json();
        if (!res.ok) throw data;
        return data;
    })
    .then(data => {
        container.innerHTML = '';

        if (!Array.isArray(data) || data.length === 0) {
            setStats([]);
            container.innerHTML = `
                <div class="ep-empty">
                    <div class="ep-empty-inner">
                        <div class="ep-empty-icon">🍃</div>
                        <h3>Belum Ada Laporan Masuk</h3>
                        <p>Kondisi masih aman. Jika menemukan tumpukan sampah liar,
                        segera buat laporan agar petugas dapat menindaklanjuti.</p>
                        <a href="/create" class="ep-empty-cta">Buat Laporan Pertama →</a>
                    </div>
                </div>`;
            return;
        }

        setStats(data);

        data.forEach((item, idx) => {
            const status    = normalizeStatus(item.status);
            const imageUrl  = item.foto
                ? `/storage/${item.foto}`
                : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=900';
            const userName  = item.user ? safeText(item.user.name, 'Masyarakat') : 'Masyarakat';
            const initial   = userName.charAt(0).toUpperCase();
            const desaName  = item.desa
                ? safeText(item.desa.nama_desa || item.desa.name, 'Sektor Umum')
                : 'Sektor Umum';
            const rt        = item.rtrw ? safeText(item.rtrw.rt) : '-';
            const rw        = item.rtrw ? safeText(item.rtrw.rw) : '-';
            const lokasi    = safeText(item.lokasi_spesifik, 'Lokasi belum tersedia');
            const deskripsi = safeText(item.deskripsi, 'Tidak ada deskripsi tambahan untuk laporan ini.');

            const card = `
                <article class="ep-card" style="animation: fadeUp 0.55s var(--ease-out) ${idx * 0.08}s both">
                    <div class="ep-card-img">
                        <img src="${esc(imageUrl)}" alt="Bukti laporan lapangan" loading="lazy">
                        <div class="ep-card-img-grad"></div>
                        <span class="ep-status ep-status-${status}">${statusLabel(status)}</span>
                        <div class="ep-loc">
                            <span>📍</span>
                            <span>${esc(desaName)} · RT ${esc(rt)}/RW ${esc(rw)}</span>
                        </div>
                    </div>
                    <div class="ep-card-body">
                        <h3 class="ep-card-title">${esc(lokasi)}</h3>
                        <p class="ep-card-desc">${esc(deskripsi)}</p>
                        <div class="ep-card-footer">
                            <div class="ep-user">
                                <div class="ep-avatar">${esc(initial)}</div>
                                <div class="ep-user-info">
                                    <span class="ep-user-role">Pelapor</span>
                                    <span class="ep-user-name">${esc(userName)}</span>
                                </div>
                            </div>
                            <a href="/show/${esc(item.id)}" class="ep-detail-btn">Detail →</a>
                        </div>
                    </div>
                </article>`;

            container.insertAdjacentHTML('beforeend', card);
        });
    })
    .catch(err => {
        console.error('Error:', err);
        [statTotal, statPending, statProses, statSelesai].forEach(el => el.innerText = 0);
        container.innerHTML = `
            <div class="ep-empty">
                <div class="ep-empty-inner">
                    <div class="ep-empty-icon error-icon">⚠️</div>
                    <h3>Data Gagal Dimuat</h3>
                    <p>Terjadi masalah saat mengambil data laporan.
                    Cek kembali route API, koneksi database, atau response JSON dari server.</p>
                </div>
            </div>`;
    });
});
</script>
@endpush