@extends('app')

@section('content')

{{-- ============================================================
    E-SAPO — Dashboard Masyarakat Premium
    Dashboard dibuat lebih ramai, lengkap, dan responsif
    ============================================================ --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

<style>
:root {
    --c-bg: #f4f6f1;
    --c-bg-2: #eef3ea;
    --c-surface: #ffffff;
    --c-surface-2: #f9faf6;
    --c-ink: #0f1f16;
    --c-ink-2: #1b2e21;
    --c-muted: #5e7166;
    --c-subtle: #8fa396;
    --c-line: rgba(15, 31, 22, 0.09);

    --c-green: #1daa6d;
    --c-green-dk: #0e7a4a;
    --c-green-lt: #e2f7ed;
    --c-green-soft: rgba(29, 170, 109, 0.12);

    --c-amber: #e8a020;
    --c-amber-lt: #fff5d9;
    --c-blue: #2b7de9;
    --c-blue-lt: #e4f1ff;
    --c-teal: #0f8a6a;
    --c-teal-lt: #d6f5eb;
    --c-red: #e05252;
    --c-red-lt: #fff0f0;

    --shadow-sm: 0 2px 8px rgba(15,31,22,0.06), 0 1px 2px rgba(15,31,22,0.04);
    --shadow-md: 0 8px 28px rgba(15,31,22,0.09), 0 2px 8px rgba(15,31,22,0.05);
    --shadow-lg: 0 20px 56px rgba(15,31,22,0.12), 0 4px 12px rgba(15,31,22,0.06);
    --shadow-xl: 0 30px 80px rgba(15,31,22,0.15), 0 8px 24px rgba(15,31,22,0.08);

    --r-xs: 8px;
    --r-sm: 14px;
    --r-md: 20px;
    --r-lg: 28px;
    --r-xl: 38px;

    --font-display: 'Sora', ui-sans-serif, system-ui, sans-serif;
    --font-body: 'DM Sans', ui-sans-serif, system-ui, sans-serif;

    --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
    --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
}

*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html {
    scroll-behavior: smooth;
    -webkit-font-smoothing: antialiased;
}

.ep {
    width: 100%;
    min-height: 100vh;
    margin-top: -24px;
    padding: 0 0 100px;
    position: relative;
    overflow-x: hidden;
    color: var(--c-ink);
    font-family: var(--font-body);
    background:
        radial-gradient(circle at 8% 8%, rgba(29,170,109,0.13), transparent 26%),
        radial-gradient(circle at 92% 12%, rgba(232,160,32,0.10), transparent 24%),
        linear-gradient(180deg, #fbfcf8 0%, var(--c-bg) 52%, #eef3ea 100%);
}

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

.ep-blob {
    position: absolute;
    border-radius: 999px;
    pointer-events: none;
    filter: blur(90px);
    z-index: 0;
    animation: blobDrift 14s ease-in-out infinite alternate;
}

.ep-blob-1 {
    width: 480px;
    height: 480px;
    top: -120px;
    left: -160px;
    background: radial-gradient(circle, rgba(29,170,109,0.13) 0%, transparent 70%);
}

.ep-blob-2 {
    width: 420px;
    height: 420px;
    top: 60px;
    right: -180px;
    background: radial-gradient(circle, rgba(232,160,32,0.10) 0%, transparent 70%);
    animation-delay: -5s;
}

.ep-blob-3 {
    width: 360px;
    height: 360px;
    bottom: 200px;
    left: 20%;
    background: radial-gradient(circle, rgba(29,170,109,0.08) 0%, transparent 70%);
    animation-delay: -8s;
}

@keyframes blobDrift {
    from { transform: translate(0, 0) scale(1); }
    to { transform: translate(30px, 20px) scale(1.06); }
}

.ep-wrap {
    width: min(1180px, calc(100% - 40px));
    margin-inline: auto;
    position: relative;
    z-index: 2;
}

/* ============================================================
GLOBAL SECTION
============================================================ */
.ep-section {
    margin-top: 28px;
    position: relative;
    z-index: 2;
}

.ep-kicker {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 32px;
    padding: 0 13px;
    border-radius: 999px;
    background: var(--c-green-lt);
    color: var(--c-green-dk);
    font-family: var(--font-display);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.13em;
    text-transform: uppercase;
}

.ep-kicker::before {
    content: '';
    width: 7px;
    height: 7px;
    border-radius: 999px;
    background: var(--c-green);
    box-shadow: 0 0 0 4px rgba(29,170,109,0.12);
}

.ep-section-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    padding-bottom: 22px;
    border-bottom: 1px solid var(--c-line);
    position: relative;
}

.ep-section-head::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -1px;
    width: 64px;
    height: 2px;
    background: var(--c-green);
    border-radius: 2px;
}

.ep-section-title {
    margin-top: 12px;
    font-family: var(--font-display);
    font-size: clamp(24px, 2.6vw, 36px);
    font-weight: 800;
    letter-spacing: -0.055em;
    color: var(--c-ink);
    line-height: 1.1;
}

.ep-section-note {
    max-width: 380px;
    font-size: 13px;
    line-height: 1.75;
    color: var(--c-muted);
    text-align: right;
}

/* ============================================================
HERO
============================================================ */
.ep-hero {
    padding-top: 56px;
}

.ep-hero-top {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 20px;
    align-items: stretch;
}

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

.ep-intro::before {
    content: '';
    position: absolute;
    width: 320px;
    height: 320px;
    right: -120px;
    top: -140px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(29,170,109,0.10) 0%, transparent 65%);
}

.ep-intro::after {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    left: -60px;
    bottom: -80px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(232,160,32,0.10) 0%, transparent 65%);
}

.ep-intro-grid {
    position: absolute;
    right: 0;
    top: 0;
    width: 260px;
    height: 260px;
    opacity: 0.04;
    background-image:
        linear-gradient(var(--c-ink) 1px, transparent 1px),
        linear-gradient(90deg, var(--c-ink) 1px, transparent 1px);
    background-size: 32px 32px;
    border-radius: 0 var(--r-xl) 0 0;
}

.ep-intro-top,
.ep-intro-bottom {
    position: relative;
    z-index: 2;
}

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
    font-weight: 800;
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
    50% { box-shadow: 0 0 0 5px rgba(29,170,109,0.14), 0 0 0 10px rgba(29,170,109,0.04); }
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

.ep-title em::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 100%;
    height: 3px;
    border-radius: 4px;
    background: linear-gradient(90deg, var(--c-green), rgba(29,170,109,0.3));
}

.ep-desc {
    margin-top: 18px;
    font-size: 14.5px;
    line-height: 1.80;
    color: var(--c-muted);
    max-width: 590px;
}

.ep-actions {
    margin-top: 26px;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

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
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    transition: transform 0.22s var(--ease-spring), box-shadow 0.22s ease, background 0.18s ease;
    position: relative;
    overflow: hidden;
}

.ep-btn:hover {
    transform: translateY(-2px);
}

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
    font-weight: 700;
    color: var(--c-subtle);
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.ep-metric-divider {
    width: 1px;
    height: 36px;
    background: var(--c-line);
}

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
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.9s var(--ease-out);
}

.ep-visual:hover img {
    transform: scale(1.06);
}

.ep-visual-grad {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(10,22,14,0) 30%, rgba(10,22,14,0.65) 100%);
}

.ep-visual-caption {
    position: absolute;
    left: 18px;
    right: 18px;
    bottom: 18px;
    padding: 18px 20px;
    border-radius: var(--r-md);
    background: rgba(255,255,255,0.84);
    border: 1px solid rgba(255,255,255,0.55);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
}

.ep-visual-caption strong {
    display: block;
    font-family: var(--font-display);
    font-size: 15px;
    font-weight: 800;
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
QUICK ACTIONS
============================================================ */
.ep-quick-grid {
    margin-top: 18px;
    display: grid;
    grid-template-columns: 1.1fr 1fr 1fr 1fr;
    gap: 14px;
}

.ep-quick-card {
    min-height: 122px;
    padding: 20px;
    border-radius: var(--r-lg);
    background: rgba(255,255,255,0.88);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-sm);
    text-decoration: none;
    color: var(--c-ink);
    position: relative;
    overflow: hidden;
    transition: transform 0.24s var(--ease-spring), box-shadow 0.24s ease;
}

.ep-quick-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.ep-quick-card::after {
    content: '';
    position: absolute;
    width: 95px;
    height: 95px;
    right: -30px;
    top: -30px;
    border-radius: 999px;
    background: var(--c-green-soft);
}

.ep-quick-icon {
    width: 44px;
    height: 44px;
    border-radius: 16px;
    display: grid;
    place-items: center;
    background: var(--c-green-lt);
    border: 1px solid rgba(29,170,109,0.16);
    font-size: 21px;
    position: relative;
    z-index: 2;
}

.ep-quick-card strong {
    display: block;
    margin-top: 14px;
    font-family: var(--font-display);
    font-size: 15px;
    font-weight: 800;
    letter-spacing: -0.03em;
    position: relative;
    z-index: 2;
}

.ep-quick-card span {
    display: block;
    margin-top: 6px;
    font-size: 12.5px;
    line-height: 1.55;
    color: var(--c-muted);
    position: relative;
    z-index: 2;
}

.ep-quick-main {
    background:
        radial-gradient(circle at top right, rgba(29,170,109,0.18), transparent 42%),
        var(--c-ink);
    color: #fff;
}

.ep-quick-main .ep-quick-icon {
    background: rgba(255,255,255,0.14);
    border-color: rgba(255,255,255,0.18);
}

.ep-quick-main span {
    color: rgba(255,255,255,0.72);
}

.ep-quick-main::after {
    background: rgba(255,255,255,0.08);
}

/* ============================================================
INFO + FLOW
============================================================ */
.ep-info-grid {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 18px;
    align-items: stretch;
}

.ep-about-card,
.ep-flow-card,
.ep-commit-card,
.ep-type-card,
.ep-guide-card,
.ep-tip-card,
.ep-faq-card,
.ep-banner-card {
    position: relative;
    overflow: hidden;
    border-radius: var(--r-xl);
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-md);
}

.ep-about-card {
    padding: 34px;
    min-height: 320px;
}

.ep-about-card::before {
    content: '';
    position: absolute;
    width: 260px;
    height: 260px;
    right: -90px;
    top: -100px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(29,170,109,0.12) 0%, transparent 68%);
}

.ep-about-card::after {
    content: '';
    position: absolute;
    width: 180px;
    height: 180px;
    left: -70px;
    bottom: -70px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(232,160,32,0.11) 0%, transparent 68%);
}

.ep-about-inner {
    position: relative;
    z-index: 2;
}

.ep-about-title {
    margin-top: 18px;
    font-family: var(--font-display);
    font-size: clamp(26px, 2.7vw, 42px);
    line-height: 1.08;
    letter-spacing: -0.055em;
    color: var(--c-ink);
    font-weight: 800;
}

.ep-about-title span {
    color: var(--c-green);
}

.ep-about-desc {
    margin-top: 16px;
    max-width: 650px;
    font-size: 14px;
    line-height: 1.85;
    color: var(--c-muted);
}

.ep-about-points {
    margin-top: 24px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.ep-about-point {
    min-height: 96px;
    padding: 16px;
    border-radius: var(--r-md);
    background: var(--c-surface-2);
    border: 1px solid var(--c-line);
}

.ep-about-point strong {
    display: block;
    font-family: var(--font-display);
    font-size: 13px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--c-ink);
}

.ep-about-point p {
    margin-top: 7px;
    font-size: 12.5px;
    line-height: 1.55;
    color: var(--c-muted);
}

.ep-flow-card {
    padding: 26px;
    display: flex;
    flex-direction: column;
}

.ep-card-title-main {
    font-family: var(--font-display);
    font-size: 20px;
    font-weight: 800;
    letter-spacing: -0.045em;
    color: var(--c-ink);
}

.ep-card-subtitle {
    margin-top: 8px;
    font-size: 13px;
    line-height: 1.65;
    color: var(--c-muted);
}

.ep-flow-list {
    margin-top: 22px;
    display: grid;
    gap: 14px;
}

.ep-flow-item {
    display: grid;
    grid-template-columns: 42px 1fr;
    gap: 12px;
    align-items: flex-start;
}

.ep-flow-number {
    width: 42px;
    height: 42px;
    border-radius: 15px;
    display: grid;
    place-items: center;
    background: var(--c-green-lt);
    color: var(--c-green-dk);
    font-family: var(--font-display);
    font-size: 13px;
    font-weight: 800;
    border: 1px solid rgba(29,170,109,0.16);
}

.ep-flow-text strong {
    display: block;
    font-family: var(--font-display);
    font-size: 13.5px;
    font-weight: 800;
    color: var(--c-ink);
    letter-spacing: -0.03em;
}

.ep-flow-text span {
    display: block;
    margin-top: 4px;
    font-size: 12.5px;
    line-height: 1.55;
    color: var(--c-muted);
}

.ep-commit-grid {
    margin-top: 18px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

.ep-commit-card {
    padding: 24px;
    min-height: 190px;
    transition: transform 0.25s var(--ease-spring), box-shadow 0.25s ease;
}

.ep-commit-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.ep-commit-icon {
    width: 48px;
    height: 48px;
    border-radius: 17px;
    display: grid;
    place-items: center;
    background: var(--c-green-lt);
    border: 1px solid rgba(29,170,109,0.16);
    font-size: 22px;
}

.ep-commit-card strong {
    display: block;
    margin-top: 18px;
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 800;
    color: var(--c-ink);
    letter-spacing: -0.035em;
}

.ep-commit-card p {
    margin-top: 9px;
    font-size: 13px;
    line-height: 1.7;
    color: var(--c-muted);
}

/* ============================================================
TYPE SECTION
============================================================ */
.ep-type-grid {
    margin-top: 24px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

.ep-type-card {
    padding: 22px;
    min-height: 220px;
    transition: transform 0.25s var(--ease-spring), box-shadow 0.25s ease;
}

.ep-type-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.ep-type-icon {
    width: 54px;
    height: 54px;
    border-radius: 18px;
    display: grid;
    place-items: center;
    font-size: 25px;
    background: var(--c-green-lt);
    border: 1px solid rgba(29,170,109,0.16);
}

.ep-type-card:nth-child(2) .ep-type-icon {
    background: var(--c-amber-lt);
}

.ep-type-card:nth-child(3) .ep-type-icon {
    background: var(--c-blue-lt);
}

.ep-type-card:nth-child(4) .ep-type-icon {
    background: var(--c-red-lt);
}

.ep-type-card strong {
    display: block;
    margin-top: 18px;
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 800;
    letter-spacing: -0.04em;
}

.ep-type-card p {
    margin-top: 9px;
    font-size: 13px;
    line-height: 1.7;
    color: var(--c-muted);
}

.ep-type-label {
    display: inline-flex;
    margin-top: 16px;
    height: 30px;
    padding: 0 12px;
    align-items: center;
    border-radius: 999px;
    background: var(--c-surface-2);
    border: 1px solid var(--c-line);
    color: var(--c-muted);
    font-size: 11px;
    font-weight: 800;
}

/* ============================================================
GUIDE + TIPS
============================================================ */
.ep-guide-layout {
    margin-top: 24px;
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    gap: 18px;
    align-items: stretch;
}

.ep-banner-card {
    padding: 30px;
    background:
        radial-gradient(circle at top right, rgba(29,170,109,0.20), transparent 42%),
        linear-gradient(135deg, #0f1f16, #1b3827);
    color: #fff;
    min-height: 360px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.ep-banner-card .ep-kicker {
    background: rgba(255,255,255,0.12);
    color: #fff;
}

.ep-banner-card .ep-kicker::before {
    background: #ffffff;
}

.ep-banner-title {
    margin-top: 18px;
    font-family: var(--font-display);
    font-size: clamp(26px, 2.8vw, 42px);
    line-height: 1.08;
    font-weight: 800;
    letter-spacing: -0.055em;
}

.ep-banner-desc {
    margin-top: 14px;
    color: rgba(255,255,255,0.72);
    font-size: 14px;
    line-height: 1.8;
}

.ep-banner-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 24px;
}

.ep-banner-btn {
    height: 44px;
    padding: 0 18px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-family: var(--font-display);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.ep-banner-btn.primary {
    background: #fff;
    color: var(--c-ink);
}

.ep-banner-btn.ghost {
    border: 1px solid rgba(255,255,255,0.18);
    color: #fff;
}

.ep-banner-mini {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-top: 26px;
}

.ep-banner-mini div {
    min-height: 70px;
    padding: 12px;
    border-radius: 18px;
    background: rgba(255,255,255,0.09);
    border: 1px solid rgba(255,255,255,0.12);
}

.ep-banner-mini strong {
    display: block;
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 800;
}

.ep-banner-mini span {
    display: block;
    margin-top: 4px;
    color: rgba(255,255,255,0.68);
    font-size: 11px;
    line-height: 1.4;
}

.ep-guide-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.ep-guide-card {
    padding: 22px;
    min-height: 172px;
}

.ep-guide-top {
    display: flex;
    justify-content: space-between;
    gap: 12px;
}

.ep-guide-icon {
    width: 44px;
    height: 44px;
    border-radius: 16px;
    display: grid;
    place-items: center;
    font-size: 20px;
    background: var(--c-green-lt);
    border: 1px solid rgba(29,170,109,0.16);
}

.ep-guide-badge {
    height: 30px;
    padding: 0 11px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    background: var(--c-surface-2);
    border: 1px solid var(--c-line);
    color: var(--c-muted);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.ep-guide-card strong {
    display: block;
    margin-top: 16px;
    font-family: var(--font-display);
    font-size: 15.5px;
    font-weight: 800;
    letter-spacing: -0.04em;
}

.ep-guide-card p {
    margin-top: 8px;
    font-size: 13px;
    line-height: 1.65;
    color: var(--c-muted);
}

/* ============================================================
FAQ
============================================================ */
.ep-faq-layout {
    margin-top: 24px;
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    gap: 18px;
}

.ep-faq-side {
    padding: 30px;
    border-radius: var(--r-xl);
    background:
        radial-gradient(circle at top right, rgba(232,160,32,0.16), transparent 42%),
        var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-md);
}

.ep-faq-side h3 {
    margin-top: 16px;
    font-family: var(--font-display);
    font-size: clamp(24px, 2.4vw, 34px);
    line-height: 1.1;
    font-weight: 800;
    letter-spacing: -0.05em;
}

.ep-faq-side p {
    margin-top: 12px;
    font-size: 14px;
    line-height: 1.8;
    color: var(--c-muted);
}

.ep-faq-list {
    display: grid;
    gap: 12px;
}

.ep-faq-card {
    padding: 0;
    box-shadow: var(--shadow-sm);
}

.ep-faq-card details {
    padding: 18px 20px;
}

.ep-faq-card summary {
    cursor: pointer;
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-family: var(--font-display);
    font-size: 14px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--c-ink);
}

.ep-faq-card summary::-webkit-details-marker {
    display: none;
}

.ep-faq-card summary::after {
    content: '+';
    width: 28px;
    height: 28px;
    flex: 0 0 28px;
    border-radius: 999px;
    background: var(--c-green-lt);
    color: var(--c-green-dk);
    display: grid;
    place-items: center;
    font-family: var(--font-display);
    font-size: 18px;
    font-weight: 800;
}

.ep-faq-card details[open] summary::after {
    content: '−';
}

.ep-faq-card p {
    margin-top: 12px;
    padding-right: 44px;
    font-size: 13px;
    line-height: 1.75;
    color: var(--c-muted);
}

/* ============================================================
REPORTS
============================================================ */
.ep-reports-section {
    margin-top: 46px;
    animation: fadeUp 0.7s var(--ease-out) 0.25s both;
}

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
    font-weight: 700;
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
    font-weight: 800;
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

.ep-grid {
    margin-top: 26px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
}

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
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.80s var(--ease-out);
}

.ep-card:hover .ep-card-img img {
    transform: scale(1.10);
}

.ep-card-img-grad {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 35%, rgba(10,22,14,0.55) 100%);
}

.ep-status {
    position: absolute;
    top: 14px;
    left: 14px;
    z-index: 3;
    min-height: 30px;
    padding: 0 12px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 9.5px;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.30);
}

.ep-status::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 999px;
}

.ep-status-pending {
    background: rgba(254,243,208,0.95);
    color: #7a4d05;
}

.ep-status-pending::before {
    background: var(--c-amber);
}

.ep-status-proses {
    background: rgba(222,238,255,0.95);
    color: #0c4a8d;
}

.ep-status-proses::before {
    background: var(--c-blue);
}

.ep-status-selesai {
    background: rgba(214,245,235,0.97);
    color: #064d3a;
}

.ep-status-selesai::before {
    background: var(--c-teal);
}

.ep-loc {
    position: absolute;
    left: 14px;
    right: 14px;
    bottom: 14px;
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
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.ep-loc span:last-child {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    min-width: 0;
}

.ep-card-body {
    padding: 22px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.ep-card-title {
    font-family: var(--font-display);
    font-size: 17px;
    font-weight: 800;
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
}

.ep-user {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}

.ep-avatar {
    width: 38px;
    height: 38px;
    border-radius: 13px;
    background: var(--c-green-lt);
    border: 1.5px solid rgba(29,170,109,0.15);
    color: var(--c-green-dk);
    display: grid;
    place-items: center;
    font-family: var(--font-display);
    font-size: 13px;
    font-weight: 800;
    flex-shrink: 0;
}

.ep-user-info {
    min-width: 0;
}

.ep-user-role {
    display: block;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    color: var(--c-subtle);
    line-height: 1;
}

.ep-user-name {
    display: block;
    margin-top: 4px;
    font-size: 12.5px;
    font-weight: 700;
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
    font-weight: 800;
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
SKELETON + EMPTY
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

.ep-skel-body {
    padding: 22px;
}

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
    0% { background-position: 100% 0; }
    100% { background-position: -100% 0; }
}

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

.ep-empty-inner {
    max-width: 390px;
}

.ep-empty-icon {
    width: 80px;
    height: 80px;
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
    font-weight: 800;
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
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}



/* ============================================================
PERBAIKAN DASHBOARD MASYARAKAT
============================================================ */
.ep-title em::after {
    display: none;
}

.ep-quick-main {
    background: rgba(255,255,255,0.88);
    color: var(--c-ink);
}

.ep-quick-main .ep-quick-icon {
    background: var(--c-green-lt);
    border-color: rgba(29,170,109,0.16);
    color: var(--c-ink);
}

.ep-quick-main span {
    color: var(--c-muted);
}

.ep-quick-main::after {
    background: var(--c-green-soft);
}

.ep-report-panel {
    margin-top: 22px;
    padding: 22px;
    border-radius: var(--r-xl);
    background:
        radial-gradient(circle at 96% 0%, rgba(29,170,109,0.12), transparent 34%),
        rgba(255,255,255,0.90);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-md);
}

.ep-report-panel-top {
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto;
    align-items: center;
    gap: 18px;
}

.ep-report-info {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    min-width: 0;
}

.ep-report-info-icon {
    width: 46px;
    height: 46px;
    border-radius: 17px;
    display: grid;
    place-items: center;
    flex: 0 0 46px;
    background: var(--c-green-lt);
    border: 1px solid rgba(29,170,109,0.16);
    color: var(--c-green-dk);
    font-size: 20px;
}

.ep-report-info strong {
    display: block;
    font-family: var(--font-display);
    font-size: 15px;
    font-weight: 800;
    letter-spacing: -0.035em;
    color: var(--c-ink);
    line-height: 1.3;
}

.ep-report-info p {
    max-width: 640px;
    margin-top: 6px;
    color: var(--c-muted);
    font-size: 13px;
    line-height: 1.75;
}

.ep-report-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    flex-wrap: wrap;
}

.ep-search-box {
    width: 320px;
    height: 46px;
    padding: 0 14px;
    border-radius: 15px;
    background: #ffffff;
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-sm);
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.22s ease;
}

.ep-search-box:focus-within {
    border-color: rgba(29,170,109,0.38);
    box-shadow: 0 0 0 4px rgba(29,170,109,0.10), var(--shadow-sm);
}

.ep-search-icon {
    font-size: 15px;
    flex-shrink: 0;
    opacity: 0.78;
}

.ep-search-box input {
    width: 100%;
    border: none;
    outline: none;
    background: transparent;
    color: var(--c-ink);
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 650;
}

.ep-search-box input::placeholder {
    color: var(--c-subtle);
    font-weight: 600;
}

.ep-report-tags {
    margin-top: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.ep-search-result-note {
    display: none;
    margin-top: 16px;
    color: var(--c-muted);
    font-size: 12.5px;
    line-height: 1.6;
    font-weight: 650;
}

.ep-search-result-note.show {
    display: block;
}

@media (max-width: 900px) {
    .ep-report-panel-top {
        grid-template-columns: 1fr;
    }

    .ep-report-actions {
        justify-content: flex-start;
    }

    .ep-search-box {
        width: 100%;
    }
}

@media (max-width: 760px) {
    .ep-report-panel {
        padding: 18px;
        border-radius: var(--r-lg);
    }

    .ep-report-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .ep-report-actions .ep-toolbar-btn {
        width: 100%;
        justify-content: center;
    }

    .ep-report-info {
        gap: 12px;
    }

    .ep-report-info-icon {
        width: 42px;
        height: 42px;
        flex-basis: 42px;
        border-radius: 15px;
    }
}

/* ============================================================
ANIMATION + RESPONSIVE
============================================================ */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(24px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 1080px) {
    .ep-hero-top,
    .ep-info-grid,
    .ep-guide-layout,
    .ep-faq-layout {
        grid-template-columns: 1fr;
    }

    .ep-visual {
        min-height: 300px;
    }

    .ep-quick-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .ep-type-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .ep-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 760px) {
    .ep {
        margin-top: -18px;
        padding-bottom: 70px;
    }

    .ep-wrap {
        width: min(calc(100% - 28px), 1180px);
    }

    .ep-hero {
        padding-top: 28px;
    }

    .ep-intro {
        padding: 28px 24px 24px;
        border-radius: var(--r-lg);
        gap: 20px;
    }

    .ep-title {
        font-size: 32px;
    }

    .ep-desc {
        font-size: 13.5px;
    }

    .ep-actions {
        flex-direction: column;
    }

    .ep-btn {
        width: 100%;
        height: 50px;
    }

    .ep-metric-strip {
        gap: 18px;
        flex-wrap: wrap;
    }

    .ep-metric-num {
        font-size: 20px;
    }

    .ep-visual {
        min-height: 240px;
        border-radius: var(--r-lg);
    }

    .ep-quick-grid,
    .ep-about-points,
    .ep-commit-grid,
    .ep-type-grid,
    .ep-guide-grid,
    .ep-grid {
        grid-template-columns: 1fr;
    }

    .ep-about-card,
    .ep-flow-card,
    .ep-commit-card,
    .ep-type-card,
    .ep-guide-card,
    .ep-faq-card,
    .ep-banner-card,
    .ep-faq-side {
        border-radius: var(--r-lg);
    }

    .ep-about-card,
    .ep-flow-card,
    .ep-banner-card,
    .ep-faq-side {
        padding: 24px 22px;
    }

    .ep-section-head {
        flex-direction: column;
        align-items: flex-start;
    }

    .ep-section-note {
        text-align: left;
        max-width: 100%;
    }

    .ep-toolbar {
        flex-direction: column;
        align-items: stretch;
    }

    .ep-toolbar-btn {
        width: 100%;
        justify-content: center;
    }

    .ep-card {
        border-radius: var(--r-lg);
    }

    .ep-card-img {
        height: 215px;
    }

    .ep-banner-mini {
        grid-template-columns: 1fr;
    }

    .ep-faq-card p {
        padding-right: 0;
    }
}

@media (max-width: 420px) {
    .ep-title {
        font-size: 28px;
    }

    .ep-metric-strip {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
    }

    .ep-metric-divider {
        display: none;
    }

    .ep-card-footer {
        flex-wrap: wrap;
    }

    .ep-detail-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="ep">
    <div class="ep-blob ep-blob-1"></div>
    <div class="ep-blob ep-blob-2"></div>
    <div class="ep-blob ep-blob-3"></div>

    {{-- ======================== HERO ======================== --}}
    <section class="ep-wrap ep-hero">
        <div class="ep-hero-top">
            <div class="ep-intro">
                <div class="ep-intro-grid"></div>

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
                        E-SAPO membantu masyarakat mengirim aduan sampah liar dengan titik lokasi map yang lebih akurat.
                        Warga dapat menentukan posisi masalah melalui peta interaktif, menambahkan patokan lokasi,
                        mengunggah foto lapangan, dan memantau laporan yang sudah masuk.
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
    </section>

    {{-- ======================== QUICK ACTIONS ======================== --}}
    <section class="ep-wrap ep-section">
        <div class="ep-quick-grid">
            <a href="/create" class="ep-quick-card ep-quick-main">
                <div class="ep-quick-icon">➕</div>
                <strong>Buat Aduan Baru</strong>
                <span>Laporkan titik sampah bermasalah secara cepat dan terarah.</span>
            </a>

            <a href="#alur-laporan" class="ep-quick-card">
                <div class="ep-quick-icon">🧭</div>
                <strong>Lihat Alur</strong>
                <span>Pahami langkah pelaporan sebelum mengirim aduan.</span>
            </a>

            <a href="#panduan-laporan" class="ep-quick-card">
                <div class="ep-quick-icon">📋</div>
                <strong>Panduan Laporan</strong>
                <span>Ikuti tips agar laporan lebih jelas dan mudah diverifikasi.</span>
            </a>

            <a href="#laporan-terbaru" class="ep-quick-card">
                <div class="ep-quick-icon">🗂️</div>
                <strong>Arsip Publik</strong>
                <span>Lihat daftar aduan masyarakat yang sudah masuk ke sistem.</span>
            </a>
        </div>
    </section>

    {{-- ======================== TENTANG + ALUR ======================== --}}
    <section id="alur-laporan" class="ep-wrap ep-section">
        <div class="ep-info-grid">
            <div class="ep-about-card">
                <div class="ep-about-inner">
                    <span class="ep-kicker">Tentang Website</span>

                    <h2 class="ep-about-title">
                        E-SAPO Membantu Warga Melaporkan
                        <span>Masalah Sampah</span> dengan Lebih Mudah.
                    </h2>

                    <p class="ep-about-desc">
                        Website ini menjadi ruang pelaporan masyarakat agar informasi mengenai tumpukan sampah,
                        lokasi bermasalah, dan kondisi lingkungan dapat tersampaikan dengan lebih akurat.
                        Dengan fitur titik lokasi map, warga dapat menandai posisi aduan secara spesifik
                        sehingga petugas bisa melihat lokasi laporan langsung melalui peta.
                    </p>

                    <div class="ep-about-points">
                        <div class="ep-about-point">
                            <strong>Data Lebih Rapi</strong>
                            <p>Laporan tersimpan berdasarkan desa, titik map, patokan lokasi, deskripsi, foto, dan status.</p>
                        </div>

                        <div class="ep-about-point">
                            <strong>Mudah Dipantau</strong>
                            <p>Masyarakat dapat melihat laporan yang sudah masuk secara publik.</p>
                        </div>

                        <div class="ep-about-point">
                            <strong>Lebih Terarah</strong>
                            <p>Titik map membantu petugas menemukan lokasi aduan tanpa harus menebak titik masalah.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ep-flow-card">
                <h3 class="ep-card-title-main">Alur Penggunaan</h3>
                <p class="ep-card-subtitle">
                    Proses pelaporan dibuat sederhana supaya masyarakat bisa mengirim aduan tanpa kebingungan.
                </p>

                <div class="ep-flow-list">
                    <div class="ep-flow-item">
                        <div class="ep-flow-number">01</div>
                        <div class="ep-flow-text">
                            <strong>Tentukan Titik Lokasi</strong>
                            <span>Pilih desa, tandai titik lokasi pada map, isi patokan, deskripsi masalah, dan bukti foto lapangan.</span>
                        </div>
                    </div>

                    <div class="ep-flow-item">
                        <div class="ep-flow-number">02</div>
                        <div class="ep-flow-text">
                            <strong>Data Masuk Sistem</strong>
                            <span>Laporan tersimpan dan dapat dilihat pada arsip publik masyarakat.</span>
                        </div>
                    </div>

                    <div class="ep-flow-item">
                        <div class="ep-flow-number">03</div>
                        <div class="ep-flow-text">
                            <strong>Dicek Lewat Titik Lokasi</strong>
                            <span>Petugas dapat melihat koordinat dan titik map agar pengecekan lokasi lebih tepat.</span>
                        </div>
                    </div>

                    <div class="ep-flow-item">
                        <div class="ep-flow-number">04</div>
                        <div class="ep-flow-text">
                            <strong>Status Diperbarui</strong>
                            <span>Status laporan dapat berubah menjadi pending, proses, atau selesai.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ep-commit-grid">
            <div class="ep-commit-card">
                <div class="ep-commit-icon">🌱</div>
                <strong>Peduli Lingkungan</strong>
                <p>
                    Setiap laporan kecil dapat membantu menciptakan lingkungan yang lebih bersih,
                    sehat, dan nyaman untuk warga sekitar.
                </p>
            </div>

            <div class="ep-commit-card">
                <div class="ep-commit-icon">🧭</div>
                <strong>Informasi Jelas</strong>
                <p>
                    Titik map, patokan lokasi, dan deskripsi laporan dibuat terstruktur agar petugas
                    lebih mudah menemukan lokasi aduan.
                </p>
            </div>

            <div class="ep-commit-card">
                <div class="ep-commit-icon">🤝</div>
                <strong>Partisipasi Warga</strong>
                <p>
                    Website ini mendorong masyarakat ikut menjaga kebersihan melalui pelaporan
                    yang mudah dan cepat.
                </p>
            </div>
        </div>
    </section>

    {{-- ======================== JENIS MASALAH ======================== --}}
    <section class="ep-wrap ep-section">
        <div class="ep-section-head">
            <div>
                <span class="ep-kicker">Kategori Aduan</span>
                <h2 class="ep-section-title">Jenis Masalah yang Bisa Dilaporkan</h2>
            </div>

            <p class="ep-section-note">
                Gunakan E-SAPO untuk melaporkan masalah kebersihan yang mengganggu lingkungan
                dan membutuhkan perhatian lebih lanjut.
            </p>
        </div>

        <div class="ep-type-grid">
            <div class="ep-type-card">
                <div class="ep-type-icon">🗑️</div>
                <strong>Tumpukan Sampah</strong>
                <p>Sampah menumpuk di pinggir jalan, lahan kosong, selokan, atau area umum warga.</p>
                <span class="ep-type-label">Paling Umum</span>
            </div>

            <div class="ep-type-card">
                <div class="ep-type-icon">🚧</div>
                <strong>Sampah Liar</strong>
                <p>Pembuangan sampah sembarangan di lokasi yang bukan tempat pembuangan resmi.</p>
                <span class="ep-type-label">Perlu Dicek</span>
            </div>

            <div class="ep-type-card">
                <div class="ep-type-icon">🌧️</div>
                <strong>Saluran Tersumbat</strong>
                <p>Sampah yang menutup aliran air dan berpotensi menyebabkan genangan atau banjir.</p>
                <span class="ep-type-label">Prioritas</span>
            </div>

            <div class="ep-type-card">
                <div class="ep-type-icon">⚠️</div>
                <strong>Bau Mengganggu</strong>
                <p>Kondisi sampah yang menimbulkan bau tidak sedap dan mengganggu aktivitas warga.</p>
                <span class="ep-type-label">Butuh Tindak Lanjut</span>
            </div>
        </div>
    </section>

    {{-- ======================== PANDUAN ======================== --}}
    <section id="panduan-laporan" class="ep-wrap ep-section">
        <div class="ep-section-head">
            <div>
                <span class="ep-kicker">Panduan Warga</span>
                <h2 class="ep-section-title">Biar Laporan Kamu Lebih Mudah Diproses</h2>
            </div>

            <p class="ep-section-note">
                Laporan yang jelas membantu petugas memahami kondisi lapangan lewat titik map,
                patokan lokasi, bukti foto, dan deskripsi masalah yang lengkap.
            </p>
        </div>

        <div class="ep-guide-layout">
            <div class="ep-banner-card">
                <div>
                    <span class="ep-kicker">Tips Cepat</span>

                    <h3 class="ep-banner-title">
                        Laporan yang lengkap bikin pengecekan jadi lebih cepat.
                    </h3>

                    <p class="ep-banner-desc">
                        Pastikan titik lokasi map, patokan lokasi, foto, dan deskripsi masalah diisi dengan jelas.
                        Semakin akurat titik yang dikirim, semakin mudah laporan ditemukan, dibaca, dan dipantau.
                    </p>

                    <div class="ep-banner-actions">
                        <a href="/create" class="ep-banner-btn primary">Buat Laporan</a>
                        <a href="#laporan-terbaru" class="ep-banner-btn ghost">Lihat Arsip</a>
                    </div>
                </div>

                <div class="ep-banner-mini">
                    <div>
                        <strong>Foto</strong>
                        <span>Ambil gambar yang jelas</span>
                    </div>

                    <div>
                        <strong>Map</strong>
                        <span>Tandai titik lokasi yang tepat</span>
                    </div>

                    <div>
                        <strong>Status</strong>
                        <span>Pantau perkembangan laporan</span>
                    </div>
                </div>
            </div>

            <div class="ep-guide-grid">
                <div class="ep-guide-card">
                    <div class="ep-guide-top">
                        <div class="ep-guide-icon">📸</div>
                        <span class="ep-guide-badge">Bukti</span>
                    </div>
                    <strong>Gunakan Foto yang Jelas</strong>
                    <p>Pastikan foto tidak blur dan memperlihatkan kondisi sampah secara langsung.</p>
                </div>

                <div class="ep-guide-card">
                    <div class="ep-guide-top">
                        <div class="ep-guide-icon">📍</div>
                        <span class="ep-guide-badge">Lokasi</span>
                    </div>
                    <strong>Pilih Titik Lokasi yang Tepat</strong>
                    <p>Tentukan titik aduan melalui map, lalu tambahkan patokan seperti dekat warung, gang, jembatan, atau fasilitas umum.</p>
                </div>

                <div class="ep-guide-card">
                    <div class="ep-guide-top">
                        <div class="ep-guide-icon">📝</div>
                        <span class="ep-guide-badge">Deskripsi</span>
                    </div>
                    <strong>Jelaskan Masalahnya</strong>
                    <p>Tulis kondisi singkat, misalnya sampah menumpuk, bau, atau menyumbat saluran.</p>
                </div>

                <div class="ep-guide-card">
                    <div class="ep-guide-top">
                        <div class="ep-guide-icon">✅</div>
                        <span class="ep-guide-badge">Cek Lagi</span>
                    </div>
                    <strong>Periksa Sebelum Kirim</strong>
                    <p>Pastikan titik map, patokan lokasi, dan foto sudah sesuai sebelum laporan dikirim.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ======================== FAQ ======================== --}}
    <section class="ep-wrap ep-section">
        <div class="ep-faq-layout">
            <div class="ep-faq-side">
                <span class="ep-kicker">Bantuan</span>
                <h3>Pertanyaan yang Sering Muncul</h3>
                <p>
                    Bagian ini membantu masyarakat memahami cara kerja E-SAPO,
                    mulai dari pengiriman aduan sampai pemantauan laporan.
                </p>
            </div>

            <div class="ep-faq-list">
                <div class="ep-faq-card">
                    <details open>
                        <summary>Apakah masyarakat harus login untuk membuat laporan?</summary>
                        <p>
                            Jika sistem sedang memakai token akun, masyarakat perlu masuk terlebih dahulu
                            agar laporan bisa terhubung dengan data pelapor.
                        </p>
                    </details>
                </div>

                <div class="ep-faq-card">
                    <details>
                        <summary>Apa saja data yang sebaiknya diisi?</summary>
                        <p>
                            Isi desa, titik lokasi map, patokan lokasi, deskripsi masalah, dan foto bukti lapangan
                            agar laporan lebih mudah dipahami.
                        </p>
                    </details>
                </div>

                <div class="ep-faq-card">
                    <details>
                        <summary>Apakah laporan bisa dilihat oleh masyarakat?</summary>
                        <p>
                            Ya, laporan yang masuk dapat tampil di arsip publik supaya masyarakat bisa
                            melihat dokumentasi aduan yang sudah dikirim.
                        </p>
                    </details>
                </div>

                <div class="ep-faq-card">
                    <details>
                        <summary>Apa arti status pending, proses, dan selesai?</summary>
                        <p>
                            Pending berarti menunggu verifikasi, proses berarti sedang ditangani,
                            dan selesai berarti laporan sudah dituntaskan.
                        </p>
                    </details>
                </div>
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
        </div>

        <div class="ep-report-panel">
            <div class="ep-report-panel-top">
                <div class="ep-report-info">
                    <div class="ep-report-info-icon">🗂️</div>

                    <div>
                        <strong>Dokumentasi laporan masyarakat yang masuk ke sistem</strong>
                        <p>
                            Setiap laporan ditampilkan sebagai arsip publik agar masyarakat bisa memantau
                            kondisi wilayah. Cari aduan berdasarkan desa, patokan lokasi, status, nama pelapor,
                            atau isi deskripsi laporan.
                        </p>
                    </div>
                </div>

                <div class="ep-report-actions">
                    <label class="ep-search-box" for="search-pengaduan">
                        <span class="ep-search-icon">🔍</span>
                        <input
                            type="text"
                            id="search-pengaduan"
                            placeholder="Cari aduan, desa, lokasi, status..."
                            autocomplete="off"
                        >
                    </label>

                    <a href="/create" class="ep-toolbar-btn">
                        + Tambah Laporan
                    </a>
                </div>
            </div>

            <div class="ep-report-tags">
                <span class="ep-tag">🌿 Realtime Data</span>
                <span class="ep-tag">📷 Bukti Foto</span>
                <span class="ep-tag">📌 Lokasi Laporan</span>
                <span class="ep-tag">🔎 Bisa Dicari</span>
            </div>

            <div id="search-result-note" class="ep-search-result-note"></div>
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
    const container = document.getElementById('container-pengaduan');
    const searchInput = document.getElementById('search-pengaduan');
    const searchResultNote = document.getElementById('search-result-note');

    let allPengaduan = [];

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

        if (['proses', 'diproses', 'process'].includes(s)) {
            return 'proses';
        }

        if (['selesai', 'done', 'completed'].includes(s)) {
            return 'selesai';
        }

        return 'pending';
    };

    const statusLabel = (s) =>
        s === 'proses' ? 'Proses' : s === 'selesai' ? 'Selesai' : 'Pending';

    const getImageUrl = (item) => {
        if (item.foto_url) {
            return item.foto_url;
        }

        if (item.foto) {
            return `/storage/${item.foto}`;
        }

        return 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=900';
    };

    const getUserName = (item) => {
        return item.user
            ? safeText(item.user.name, 'Masyarakat')
            : 'Masyarakat';
    };

    const getDesaName = (item) => {
        return item.desa
            ? safeText(item.desa.nama_desa || item.desa.name, 'Sektor Umum')
            : 'Sektor Umum';
    };

    const getRtRwText = (item) => {
        if (item.rtrw) {
            const rt = safeText(item.rtrw.rt, '-');
            const rw = safeText(item.rtrw.rw, '-');

            return `RT ${rt}/RW ${rw}`;
        }

        return 'RT -/RW -';
    };

    const makeSearchText = (item) => {
        const status = normalizeStatus(item.status);
        const statusText = statusLabel(status);
        const userName = getUserName(item);
        const desaName = getDesaName(item);
        const lokasi = safeText(item.lokasi_spesifik, '');
        const deskripsi = safeText(item.deskripsi, '');
        const rtRw = getRtRwText(item);

        return [
            status,
            statusText,
            userName,
            desaName,
            lokasi,
            deskripsi,
            rtRw
        ].join(' ').toLowerCase();
    };

    const renderEmpty = () => {
        container.innerHTML = `
            <div class="ep-empty">
                <div class="ep-empty-inner">
                    <div class="ep-empty-icon">🍃</div>
                    <h3>Belum Ada Laporan Masuk</h3>
                    <p>
                        Kondisi masih aman. Jika menemukan tumpukan sampah liar,
                        segera buat laporan agar petugas dapat menindaklanjuti.
                    </p>
                    <a href="/create" class="ep-empty-cta">Buat Laporan Pertama →</a>
                </div>
            </div>
        `;
    };

    const renderNoSearchResult = (keyword) => {
        container.innerHTML = `
            <div class="ep-empty">
                <div class="ep-empty-inner">
                    <div class="ep-empty-icon">🔎</div>
                    <h3>Aduan Tidak Ditemukan</h3>
                    <p>
                        Tidak ada aduan yang cocok dengan kata kunci
                        <strong>"${esc(keyword)}"</strong>. Coba cari berdasarkan desa,
                        lokasi, status, nama pelapor, atau deskripsi laporan.
                    </p>
                </div>
            </div>
        `;
    };

    const renderCards = (data) => {
        container.innerHTML = '';

        if (!Array.isArray(data) || data.length === 0) {
            renderEmpty();
            return;
        }

        data.forEach((item, idx) => {
            const status = normalizeStatus(item.status);
            const imageUrl = getImageUrl(item);

            const userName = getUserName(item);
            const initial = userName.charAt(0).toUpperCase();

            const desaName = getDesaName(item);
            const rtRw = getRtRwText(item);

            const lokasi = safeText(item.lokasi_spesifik, 'Lokasi belum tersedia');

            const deskripsi = safeText(
                item.deskripsi,
                'Tidak ada deskripsi tambahan untuk laporan ini.'
            );

            const card = `
                <article class="ep-card" style="animation: fadeUp 0.55s var(--ease-out) ${idx * 0.08}s both">
                    <div class="ep-card-img">
                        <img src="${esc(imageUrl)}" alt="Bukti laporan lapangan" loading="lazy">
                        <div class="ep-card-img-grad"></div>

                        <span class="ep-status ep-status-${status}">
                            ${statusLabel(status)}
                        </span>

                        <div class="ep-loc">
                            <span>📍</span>
                            <span>${esc(desaName)} · ${esc(rtRw)}</span>
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

                            <a href="/show/${esc(item.id)}" class="ep-detail-btn">
                                Detail →
                            </a>
                        </div>
                    </div>
                </article>
            `;

            container.insertAdjacentHTML('beforeend', card);
        });
    };

    const filterPengaduan = () => {
        const keyword = searchInput
            ? searchInput.value.trim().toLowerCase()
            : '';

        if (!keyword) {
            if (searchResultNote) {
                searchResultNote.classList.remove('show');
                searchResultNote.textContent = '';
            }

            renderCards(allPengaduan);
            return;
        }

        const filtered = allPengaduan.filter((item) => {
            return makeSearchText(item).includes(keyword);
        });

        if (searchResultNote) {
            searchResultNote.classList.add('show');
            searchResultNote.textContent = `Menampilkan ${filtered.length} dari ${allPengaduan.length} aduan untuk pencarian "${searchInput.value.trim()}".`;
        }

        if (filtered.length === 0) {
            renderNoSearchResult(searchInput.value.trim());
            return;
        }

        renderCards(filtered);
    };

    if (searchInput) {
        searchInput.addEventListener('input', filterPengaduan);
    }

    fetch('/api/pengaduan', {
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(async res => {
        const data = await res.json();

        if (!res.ok) {
            throw data;
        }

        return data;
    })
    .then(data => {
        allPengaduan = Array.isArray(data) ? data : [];

        if (allPengaduan.length === 0) {
            renderEmpty();
            return;
        }

        renderCards(allPengaduan);
    })
    .catch(err => {
        console.error('Error:', err);

        container.innerHTML = `
            <div class="ep-empty">
                <div class="ep-empty-inner">
                    <div class="ep-empty-icon error-icon">⚠️</div>
                    <h3>Data Gagal Dimuat</h3>
                    <p>
                        Terjadi masalah saat mengambil data laporan.
                        Cek kembali route API, koneksi database, atau response JSON dari server.
                    </p>
                </div>
            </div>
        `;
    });
});
</script>
@endpush
    