@extends('admin.app')

@section('content')

{{-- ============================================================
     E-SAPO Admin — Kelola Pengaduan
     Font: Sora (display) + DM Sans (body)
     Theme: Civic Dashboard — dark sidebar feel, clean data grid
     ============================================================ --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

<style>
/* ============================================================
   TOKENS
   ============================================================ */
:root {
    --c-bg:          #f2f5ef;
    --c-bg-2:        #eaeee5;
    --c-surface:     #ffffff;
    --c-surface-2:   #f7faf4;
    --c-ink:         #0f1f16;
    --c-ink-2:       #1b2e21;
    --c-muted:       #5e7166;
    --c-subtle:      #8fa396;
    --c-line:        rgba(15, 31, 22, 0.09);
    --c-line-2:      rgba(15, 31, 22, 0.05);

    /* Brand */
    --c-green:       #1daa6d;
    --c-green-dk:    #0e7a4a;
    --c-green-lt:    #e2f7ed;

    /* Status */
    --c-amber:       #e8a020;
    --c-amber-lt:    #fef3d0;
    --c-amber-dk:    #7a4d05;
    --c-blue:        #2b7de9;
    --c-blue-lt:     #deeeff;
    --c-blue-dk:     #0c4a8d;
    --c-teal:        #0f8a6a;
    --c-teal-lt:     #d6f5eb;
    --c-teal-dk:     #064d3a;
    --c-red:         #e03535;
    --c-red-lt:      #fee2e2;
    --c-red-dk:      #991b1b;

    /* Elevation */
    --shadow-sm:     0 2px 8px rgba(15,31,22,0.06), 0 1px 2px rgba(15,31,22,0.04);
    --shadow-md:     0 8px 28px rgba(15,31,22,0.09), 0 2px 8px rgba(15,31,22,0.05);
    --shadow-lg:     0 20px 56px rgba(15,31,22,0.12), 0 4px 12px rgba(15,31,22,0.06);
    --shadow-xl:     0 30px 80px rgba(15,31,22,0.16), 0 6px 18px rgba(15,31,22,0.08);

    /* Radii */
    --r-xs:  8px;
    --r-sm:  14px;
    --r-md:  20px;
    --r-lg:  28px;
    --r-xl:  36px;

    /* Typography */
    --font-display: 'Sora', ui-sans-serif, system-ui, sans-serif;
    --font-body:    'DM Sans', ui-sans-serif, system-ui, sans-serif;

    /* Motion */
    --ease-out:    cubic-bezier(0.16, 1, 0.3, 1);
    --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* ============================================================
   RESET
   ============================================================ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }

/* ============================================================
   PAGE
   ============================================================ */
.ap {
    width: 100%;
    min-height: calc(100vh - 120px);
    margin-top: -24px;
    padding: 0 0 100px;
    position: relative;
    overflow-x: hidden;
    color: var(--c-ink);
    font-family: var(--font-body);
    background: var(--c-bg);
}

/* Subtle grid pattern background */
.ap::before {
    content: '';
    position: fixed;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    opacity: 0.018;
    background-image:
        linear-gradient(var(--c-ink) 1px, transparent 1px),
        linear-gradient(90deg, var(--c-ink) 1px, transparent 1px);
    background-size: 48px 48px;
}

/* Ambient blobs */
.ap-blob {
    position: absolute;
    border-radius: 999px;
    pointer-events: none;
    filter: blur(100px);
    z-index: 0;
}
.ap-blob-1 {
    width: 500px; height: 500px;
    top: -160px; left: -200px;
    background: radial-gradient(circle, rgba(29,170,109,0.11) 0%, transparent 70%);
}
.ap-blob-2 {
    width: 400px; height: 400px;
    top: 80px; right: -180px;
    background: radial-gradient(circle, rgba(232,160,32,0.09) 0%, transparent 70%);
}

.ap-wrap {
    width: min(1200px, calc(100% - 40px));
    margin-inline: auto;
    position: relative;
    z-index: 2;
    padding-top: 48px;
}

/* ============================================================
   PAGE HEADER
   ============================================================ */
.ap-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 28px;
    animation: fadeUp 0.6s var(--ease-out) both;
}

.ap-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 32px;
    padding: 0 12px;
    border-radius: 999px;
    background: var(--c-green-lt);
    color: var(--c-green-dk);
    font-family: var(--font-display);
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
}
.ap-badge-dot {
    width: 6px; height: 6px;
    border-radius: 999px;
    background: var(--c-green);
    box-shadow: 0 0 0 3px rgba(29,170,109,0.22);
    animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 3px rgba(29,170,109,0.22); }
    50%       { box-shadow: 0 0 0 6px rgba(29,170,109,0.08); }
}

.ap-title {
    margin-top: 14px;
    font-family: var(--font-display);
    font-size: clamp(28px, 3vw, 44px);
    font-weight: 800;
    letter-spacing: -0.05em;
    color: var(--c-ink);
    line-height: 1.05;
}

.ap-subtitle {
    margin-top: 10px;
    font-size: 13.5px;
    line-height: 1.70;
    color: var(--c-muted);
    max-width: 560px;
}

.ap-back {
    flex-shrink: 0;
    margin-top: 4px;
    height: 44px;
    padding: 0 18px;
    border-radius: var(--r-sm);
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-sm);
    color: var(--c-ink);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: var(--font-display);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    transition: transform 0.22s var(--ease-spring), background 0.18s ease, box-shadow 0.18s ease;
    white-space: nowrap;
}
.ap-back:hover {
    transform: translateY(-2px);
    background: var(--c-green-lt);
    color: var(--c-green-dk);
    border-color: rgba(29,170,109,0.20);
    box-shadow: var(--shadow-md);
}

/* ============================================================
   SUMMARY CARDS
   ============================================================ */
.ap-summary {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 22px;
    animation: fadeUp 0.6s var(--ease-out) 0.08s both;
}

.ap-sum-card {
    border-radius: var(--r-lg);
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-sm);
    padding: 22px 20px;
    position: relative;
    overflow: hidden;
    transition: transform 0.24s var(--ease-spring), box-shadow 0.24s ease;
    cursor: default;
}
.ap-sum-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}
.ap-sum-card::before {
    content: '';
    position: absolute;
    width: 84px; height: 84px;
    right: -22px; top: -22px;
    border-radius: 999px;
    transition: transform 0.3s ease;
}
.ap-sum-card:hover::before { transform: scale(1.25); }
.ap-sum-card::after {
    content: '';
    position: absolute;
    left: 0; bottom: 0;
    width: 100%; height: 3px;
    border-radius: 0 0 var(--r-lg) var(--r-lg);
    opacity: 0;
    transition: opacity 0.24s ease;
}
.ap-sum-card:hover::after { opacity: 1; }

.ap-sum-total::before   { background: rgba(29,170,109,0.10); }
.ap-sum-total::after    { background: linear-gradient(90deg, var(--c-green), transparent); }
.ap-sum-pending::before { background: rgba(232,160,32,0.13); }
.ap-sum-pending::after  { background: linear-gradient(90deg, var(--c-amber), transparent); }
.ap-sum-proses::before  { background: rgba(43,125,233,0.12); }
.ap-sum-proses::after   { background: linear-gradient(90deg, var(--c-blue), transparent); }
.ap-sum-selesai::before { background: rgba(29,170,109,0.13); }
.ap-sum-selesai::after  { background: linear-gradient(90deg, var(--c-teal), transparent); }

.ap-sum-label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: 0.13em;
    text-transform: uppercase;
    color: var(--c-subtle);
    position: relative;
    z-index: 2;
}
.ap-sum-pip {
    width: 8px; height: 8px;
    border-radius: 999px;
    flex-shrink: 0;
}
.ap-sum-total   .ap-sum-pip { background: var(--c-green); }
.ap-sum-pending .ap-sum-pip { background: var(--c-amber); }
.ap-sum-proses  .ap-sum-pip { background: var(--c-blue); }
.ap-sum-selesai .ap-sum-pip { background: var(--c-teal); }

.ap-sum-val {
    display: block;
    margin-top: 12px;
    font-family: var(--font-display);
    font-size: 44px;
    font-weight: 800;
    line-height: 1;
    letter-spacing: -0.06em;
    color: var(--c-ink);
    position: relative;
    z-index: 2;
    transition: color 0.2s;
}
.ap-sum-pending:hover .ap-sum-val { color: var(--c-amber-dk); }
.ap-sum-proses:hover  .ap-sum-val { color: var(--c-blue-dk); }
.ap-sum-selesai:hover .ap-sum-val { color: var(--c-teal-dk); }

/* ============================================================
   TOOLBAR
   ============================================================ */
.ap-toolbar {
    margin-bottom: 22px;
    padding: 14px;
    border-radius: var(--r-lg);
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-sm);
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    animation: fadeUp 0.6s var(--ease-out) 0.16s both;
}

.ap-search-wrap {
    position: relative;
    flex: 1;
    min-width: min(380px, 100%);
}
.ap-search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--c-subtle);
    pointer-events: none;
    font-size: 14px;
}
.ap-search {
    width: 100%;
    height: 46px;
    padding: 0 16px 0 40px;
    border: 1.5px solid var(--c-line);
    border-radius: var(--r-sm);
    background: var(--c-surface-2);
    color: var(--c-ink);
    font-family: var(--font-body);
    font-size: 13.5px;
    font-weight: 400;
    outline: none;
    transition: border-color 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
}
.ap-search::placeholder { color: var(--c-subtle); }
.ap-search:focus {
    background: var(--c-surface);
    border-color: var(--c-green);
    box-shadow: 0 0 0 4px rgba(29,170,109,0.12);
}

.ap-filter {
    height: 46px;
    padding: 0 14px;
    border: 1.5px solid var(--c-line);
    border-radius: var(--r-sm);
    background: var(--c-surface-2);
    color: var(--c-ink);
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 500;
    outline: none;
    cursor: pointer;
    transition: border-color 0.18s ease;
}
.ap-filter:focus { border-color: var(--c-green); }

.ap-refresh-btn {
    height: 46px;
    padding: 0 20px;
    border: none;
    border-radius: var(--r-sm);
    background: var(--c-ink);
    color: #fff;
    font-family: var(--font-display);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(15,31,22,0.16);
    transition: transform 0.22s var(--ease-spring), background 0.18s ease, box-shadow 0.18s ease;
}
.ap-refresh-btn:hover {
    transform: translateY(-2px);
    background: #1c3626;
    box-shadow: 0 8px 22px rgba(15,31,22,0.22);
}
.ap-refresh-btn:active { transform: translateY(0); }

.ap-result-count {
    margin-left: auto;
    height: 36px;
    padding: 0 14px;
    border-radius: 999px;
    background: var(--c-surface-2);
    border: 1px solid var(--c-line);
    color: var(--c-muted);
    font-size: 11.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
}
.ap-result-count strong { color: var(--c-ink); }

/* ============================================================
   REPORT GRID
   ============================================================ */
.ap-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    animation: fadeUp 0.6s var(--ease-out) 0.24s both;
}

.ap-card {
    border-radius: var(--r-xl);
    overflow: hidden;
    background: var(--c-surface);
    border: 1px solid var(--c-line);
    box-shadow: var(--shadow-md);
    display: flex;
    flex-direction: column;
    transition: transform 0.28s var(--ease-spring), box-shadow 0.28s ease;
}
.ap-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-xl);
}

.ap-card-img {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: #d0dcd0;
    flex-shrink: 0;
}
.ap-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.85s var(--ease-out);
}
.ap-card:hover .ap-card-img img { transform: scale(1.10); }
.ap-card-img-grad {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 30%, rgba(10,22,14,0.55) 100%);
}

.ap-status {
    position: absolute;
    top: 12px; left: 12px;
    z-index: 3;
    height: 28px;
    padding: 0 11px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.13em;
    text-transform: uppercase;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.30);
}
.ap-status::before {
    content: '';
    width: 5px; height: 5px;
    border-radius: 999px;
}
.ap-status-pending {
    background: rgba(254,243,208,0.96);
    color: var(--c-amber-dk);
}
.ap-status-pending::before { background: var(--c-amber); }
.ap-status-proses {
    background: rgba(222,238,255,0.96);
    color: var(--c-blue-dk);
}
.ap-status-proses::before { background: var(--c-blue); }
.ap-status-selesai {
    background: rgba(214,245,235,0.97);
    color: var(--c-teal-dk);
}
.ap-status-selesai::before { background: var(--c-teal); }

.ap-loc {
    position: absolute;
    left: 12px; right: 12px; bottom: 12px;
    z-index: 3;
    padding: 9px 13px;
    border-radius: var(--r-sm);
    background: rgba(6,14,9,0.38);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    color: #fff;
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}
.ap-loc span:last-child {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    min-width: 0;
}

.ap-card-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 0;
}
.ap-card-title {
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 700;
    letter-spacing: -0.03em;
    color: var(--c-ink);
    line-height: 1.35;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.ap-card-desc {
    margin-top: 8px;
    font-size: 12.5px;
    line-height: 1.72;
    color: var(--c-muted);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.ap-reporter {
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--c-line);
    display: flex;
    align-items: center;
    gap: 10px;
}
.ap-avatar {
    width: 36px; height: 36px;
    border-radius: 12px;
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
.ap-reporter-role {
    display: block;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    color: var(--c-subtle);
    line-height: 1;
}
.ap-reporter-name {
    display: block;
    margin-top: 4px;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--c-ink-2);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 160px;
}

.ap-actions {
    margin-top: 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.ap-select {
    width: 100%;
    height: 42px;
    padding: 0 12px;
    border: 1.5px solid var(--c-line);
    border-radius: var(--r-sm);
    background: var(--c-surface-2);
    color: var(--c-ink);
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 500;
    outline: none;
    cursor: pointer;
    transition: border-color 0.18s ease, box-shadow 0.18s ease;
}
.ap-select:focus {
    border-color: var(--c-green);
    box-shadow: 0 0 0 3px rgba(29,170,109,0.12);
}

.ap-action-btns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

.ap-btn {
    height: 42px;
    border: none;
    border-radius: var(--r-sm);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-family: var(--font-display);
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    text-decoration: none;
    transition: transform 0.22s var(--ease-spring), box-shadow 0.22s ease, filter 0.18s ease;
}
.ap-btn:hover { transform: translateY(-2px); }
.ap-btn:active { transform: translateY(0); }

.ap-btn-update {
    background: var(--c-ink);
    color: #fff;
    box-shadow: 0 4px 12px rgba(15,31,22,0.16);
}
.ap-btn-update:hover {
    background: #1c3626;
    box-shadow: 0 8px 20px rgba(15,31,22,0.22);
}

.ap-btn-delete {
    background: var(--c-red-lt);
    color: var(--c-red-dk);
    border: 1px solid rgba(224,53,53,0.12);
}
.ap-btn-delete:hover {
    background: #fecaca;
    box-shadow: 0 4px 12px rgba(224,53,53,0.14);
}

.ap-select:disabled {
    background: #f0f4ee;
    color: var(--c-subtle);
    cursor: not-allowed;
    opacity: 0.7;
    border-color: var(--c-line);
}
.ap-btn-update:disabled,
.ap-btn-update[disabled] {
    background: #e4eae3;
    color: #9dab9f;
    box-shadow: none;
    cursor: not-allowed;
    transform: none !important;
    pointer-events: none;
}

.ap-done-badge {
    height: 42px;
    border-radius: var(--r-sm);
    background: var(--c-teal-lt);
    border: 1.5px solid rgba(15,138,106,0.18);
    color: var(--c-teal-dk);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-family: var(--font-display);
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    cursor: default;
    user-select: none;
}

/* ============================================================
   EMPTY / LOADING STATES
   ============================================================ */
.ap-empty {
    grid-column: 1 / -1;
    min-height: 340px;
    border-radius: var(--r-xl);
    background: var(--c-surface);
    border: 1px dashed rgba(15,31,22,0.13);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 48px 24px;
}
.ap-empty-inner { max-width: 360px; }
.ap-empty-icon {
    width: 76px; height: 76px;
    margin: 0 auto;
    border-radius: 24px;
    background: var(--c-green-lt);
    border: 1px solid rgba(29,170,109,0.14);
    display: grid;
    place-items: center;
    font-size: 32px;
}
.ap-empty h3 {
    margin-top: 18px;
    font-family: var(--font-display);
    font-size: 20px;
    font-weight: 700;
    letter-spacing: -0.04em;
    color: var(--c-ink);
}
.ap-empty p {
    margin-top: 9px;
    font-size: 13.5px;
    line-height: 1.70;
    color: var(--c-muted);
}

.ap-loading {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    font-size: 13.5px;
    font-weight: 500;
    color: var(--c-muted);
}
.ap-spinner {
    width: 22px; height: 22px;
    border: 2.5px solid var(--c-line);
    border-top-color: var(--c-green);
    border-radius: 999px;
    animation: spin 0.75s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ============================================================
   TOAST NOTIFICATION
   ============================================================ */
.ap-toast-wrap {
    position: fixed;
    bottom: 28px;
    right: 28px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    pointer-events: none;
}
.ap-toast {
    min-width: 280px;
    max-width: 380px;
    padding: 14px 18px;
    border-radius: var(--r-md);
    background: var(--c-ink);
    color: #fff;
    font-family: var(--font-body);
    font-size: 13.5px;
    font-weight: 500;
    line-height: 1.5;
    box-shadow: 0 12px 32px rgba(15,31,22,0.22);
    display: flex;
    align-items: flex-start;
    gap: 12px;
    pointer-events: all;
    animation: toastIn 0.4s var(--ease-out) both;
}
.ap-toast.success { background: #0a3320; border-left: 3px solid var(--c-green); }
.ap-toast.error   { background: #3a0e0e; border-left: 3px solid var(--c-red); }
.ap-toast.info     { background: #0d1e2e; border-left: 3px solid var(--c-blue); }
.ap-toast-icon { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
.ap-toast-dismiss {
    margin-left: auto;
    background: none;
    border: none;
    color: rgba(255,255,255,0.45);
    cursor: pointer;
    font-size: 16px;
    line-height: 1;
    padding: 0;
    flex-shrink: 0;
}
.ap-toast-dismiss:hover { color: #fff; }
@keyframes toastIn {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ============================================================
   ANIMATION
   ============================================================ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 980px) {
    .ap-summary { grid-template-columns: repeat(2, 1fr); }
    .ap-grid    { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 640px) {
    .ap { margin-top: -18px; }
    .ap-wrap { width: min(calc(100% - 28px), 1200px); padding-top: 28px; }
    .ap-header { flex-direction: column; }
    .ap-back { width: 100%; justify-content: center; }
    .ap-title { font-size: 28px; }
    .ap-summary { grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .ap-sum-card { padding: 16px; border-radius: var(--r-md); }
    .ap-sum-val { font-size: 36px; }
    .ap-toolbar { border-radius: var(--r-md); flex-direction: column; }
    .ap-search-wrap, .ap-filter, .ap-refresh-btn { width: 100%; }
    .ap-result-count { margin-left: 0; width: 100%; justify-content: center; }
    .ap-grid { grid-template-columns: 1fr; }
    .ap-card { border-radius: var(--r-lg); }
}

@media (max-width: 420px) {
    .ap-summary { grid-template-columns: 1fr; }
}
</style>

{{-- Toast container --}}
<div id="toast-wrap" class="ap-toast-wrap"></div>

<div class="ap">
    <div class="ap-blob ap-blob-1"></div>
    <div class="ap-blob ap-blob-2"></div>

    <div class="ap-wrap">

        {{-- Header --}}
        <div class="ap-header">
            <div class="ap-header-left">
                <div class="ap-badge">
                    <span class="ap-badge-dot"></span>
                    Panel Admin
                </div>
                <h1 class="ap-title">Data Pengaduan Masyarakat</h1>
                <p class="ap-subtitle">
                    Lihat semua laporan, cari data, ubah status penanganan,
                    dan hapus pengaduan yang sudah tidak diperlukan.
                </p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="ap-back">
                ← Dashboard
            </a>
        </div>

        {{-- Summary --}}
        <div class="ap-summary">
            <div class="ap-sum-card ap-sum-total">
                <span class="ap-sum-label">
                    <span class="ap-sum-pip"></span> Total Laporan
                </span>
                <span id="sum-total" class="ap-sum-val">0</span>
            </div>
            <div class="ap-sum-card ap-sum-pending">
                <span class="ap-sum-label">
                    <span class="ap-sum-pip"></span> Pending
                </span>
                <span id="sum-pending" class="ap-sum-val">0</span>
            </div>
            <div class="ap-sum-card ap-sum-proses">
                <span class="ap-sum-label">
                    <span class="ap-sum-pip"></span> Proses
                </span>
                <span id="sum-proses" class="ap-sum-val">0</span>
            </div>
            <div class="ap-sum-card ap-sum-selesai">
                <span class="ap-sum-label">
                    <span class="ap-sum-pip"></span> Selesai
                </span>
                <span id="sum-selesai" class="ap-sum-val">0</span>
            </div>
        </div>

        {{-- Toolbar --}}
        <div class="ap-toolbar">
            <div class="ap-search-wrap">
                <span class="ap-search-icon">🔍</span>
                <input
                    type="text"
                    id="search-input"
                    class="ap-search"
                    placeholder="Cari pelapor, desa, lokasi, atau deskripsi..."
                >
            </div>

            <select id="status-filter" class="ap-filter">
                <option value="all">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
            </select>

            <button type="button" id="refresh-btn" class="ap-refresh-btn">
                ↺ Refresh
            </button>

            <span class="ap-result-count" id="result-count">
                Menampilkan <strong id="result-num">—</strong> laporan
            </span>
        </div>

        {{-- Grid --}}
        <div id="pengaduan-grid" class="ap-grid">
            <div class="ap-empty">
                <div class="ap-loading">
                    <div class="ap-spinner"></div>
                    Memuat data pengaduan...
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // SINKRONISASI SESSIONSTORAGE: Membaca token & role dari sessionStorage (sama seperti dashboard)
    const token = sessionStorage.getItem('access_token') || sessionStorage.getItem('token');
    const rawRole = sessionStorage.getItem('user_role') || sessionStorage.getItem('role') || '';
    const role = String(rawRole).trim().toLowerCase();

    if (!token || role !== 'admin') {
        showToast('Akses ditolak. Halaman ini hanya untuk admin.', 'error');
        setTimeout(() => window.location.href = "{{ route('login') }}", 1800);
        return;
    }

    const grid         = document.getElementById('pengaduan-grid');
    const searchInput  = document.getElementById('search-input');
    const statusFilter = document.getElementById('status-filter');
    const refreshBtn   = document.getElementById('refresh-btn');
    const resultNum    = document.getElementById('result-num');

    const sumTotal   = document.getElementById('sum-total');
    const sumPending = document.getElementById('sum-pending');
    const sumProses  = document.getElementById('sum-proses');
    const sumSelesai = document.getElementById('sum-selesai');

    let allPengaduan = [];

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

    const normalizeStatus = (s) => {
        const v = safeText(s, 'pending').toLowerCase();
        if (['proses','diproses','process'].includes(v)) return 'proses';
        if (['selesai','done','completed'].includes(v))  return 'selesai';
        return 'pending';
    };

    const statusLabel = (s) =>
        s === 'proses' ? 'Proses' : s === 'selesai' ? 'Selesai' : 'Pending';

    /* ---- toast ---- */
    function showToast(msg, type = 'info') {
        const wrap = document.getElementById('toast-wrap');
        const icons = { success: '✅', error: '❌', info: 'ℹ️' };
        const t = document.createElement('div');
        t.className = `ap-toast ${type}`;
        t.innerHTML = `
            <span class="ap-toast-icon">${icons[type] || 'ℹ️'}</span>
            <span>${msg}</span>
            <button class="ap-toast-dismiss" onclick="this.closest('.ap-toast').remove()">✕</button>
        `;
        wrap.appendChild(t);
        setTimeout(() => t.remove(), 4500);
    }

    /* ---- counter animation ---- */
    const animateCount = (el, target) => {
        const start = performance.now();
        const from  = parseInt(el.innerText) || 0;
        const dur   = 700;
        const tick  = (now) => {
            const t = Math.min((now - start) / dur, 1);
            const e = 1 - Math.pow(1 - t, 3);
            el.innerText = Math.round(from + (target - from) * e);
            if (t < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };

    /* ---- summary ---- */
    const setSummary = () => {
        const pending = allPengaduan.filter(i => normalizeStatus(i.status) === 'pending').length;
        const proses  = allPengaduan.filter(i => normalizeStatus(i.status) === 'proses').length;
        const selesai = allPengaduan.filter(i => normalizeStatus(i.status) === 'selesai').length;
        animateCount(sumTotal,   allPengaduan.length);
        animateCount(sumPending, pending);
        animateCount(sumProses,  proses);
        animateCount(sumSelesai, selesai);
    };

    /* ---- render ---- */
    const renderData = () => {
        const keyword = searchInput.value.toLowerCase().trim();
        const filter  = statusFilter.value;

        const filtered = allPengaduan.filter(item => {
            const status    = normalizeStatus(item.status);
            const userName  = item.user ? safeText(item.user.name, 'Masyarakat') : 'Masyarakat';
            const desaName  = item.desa ? safeText(item.desa.nama_desa || item.desa.name, '') : '';
            const lokasi    = safeText(item.lokasi_spesifik, '');
            const deskripsi = safeText(item.deskripsi, '');
            const haystack  = `${userName} ${desaName} ${lokasi} ${deskripsi}`.toLowerCase();
            return haystack.includes(keyword) && (filter === 'all' || status === filter);
        });

        resultNum.innerText = filtered.length;

        if (filtered.length === 0) {
            grid.innerHTML = `
                <div class="ap-empty">
                    <div class="ap-empty-inner">
                        <div class="ap-empty-icon">🔍</div>
                        <h3>Tidak Ditemukan</h3>
                        <p>Tidak ada pengaduan yang cocok dengan pencarian atau filter yang dipilih.</p>
                    </div>
                </div>`;
            return;
        }

        grid.innerHTML = filtered.map((item, idx) => {
            const status   = normalizeStatus(item.status);
            const imageUrl = item.foto_url 
                ? item.foto_url 
                : (item.foto ? `/storage/${item.foto}` : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=900');
            const userName = item.user ? safeText(item.user.name, 'Masyarakat') : 'Masyarakat';
            const initial  = userName.charAt(0).toUpperCase();
            const desaName = item.desa ? safeText(item.desa.nama_desa || item.desa.name, 'Sektor Umum') : 'Sektor Umum';
            const rt       = item.rtrw ? safeText(item.rtrw.rt) : '-';
            const rw       = item.rtrw ? safeText(item.rtrw.rw) : '-';
            const lokasi   = safeText(item.lokasi_spesifik, 'Lokasi belum tersedia');
            const deskripsi = safeText(item.deskripsi, 'Tidak ada deskripsi tambahan.');

            return `
                <article class="ap-card" style="animation: fadeUp 0.5s var(--ease-out) ${idx * 0.06}s both">
                    <div class="ap-card-img">
                        <img src="${esc(imageUrl)}" alt="Foto laporan" loading="lazy">
                        <div class="ap-card-img-grad"></div>
                        <span class="ap-status ap-status-${status}">${statusLabel(status)}</span>
                        <div class="ap-loc">
                            <span>📍</span>
                            <span>${esc(desaName)} · RT ${esc(rt)}/RW ${esc(rw)}</span>
                        </div>
                    </div>

                    <div class="ap-card-body">
                        <h3 class="ap-card-title">${esc(lokasi)}</h3>
                        <p class="ap-card-desc">${esc(deskripsi)}</p>

                        <div class="ap-reporter">
                            <div class="ap-avatar">${esc(initial)}</div>
                            <div class="ap-reporter-info">
                                <span class="ap-reporter-role">Pelapor</span>
                                <span class="ap-reporter-name">${esc(userName)}</span>
                            </div>
                        </div>

                        <div class="ap-actions">
                            <select class="ap-select" id="status-${esc(item.id)}" ${status === 'selesai' ? 'disabled' : ''}>
                                <option value="pending" ${status === 'pending' ? 'selected' : ''}>⏳ Pending</option>
                                <option value="proses"  ${status === 'proses'  ? 'selected' : ''}>🔄 Proses</option>
                                <option value="selesai" ${status === 'selesai' ? 'selected' : ''}>✅ Selesai</option>
                            </select>

                            <div class="ap-action-btns">
                                ${status === 'selesai'
                                    ? '<div class="ap-done-badge">✅ Sudah Selesai</div>'
                                    : `<button class="ap-btn ap-btn-update" id="btn-update-${esc(item.id)}" onclick="updatePengaduanStatus(${esc(item.id)})">Simpan</button>`
                                }
                                <button class="ap-btn ap-btn-delete" onclick="deletePengaduan(${esc(item.id)})">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </article>`;
        }).join('');
    };

    /* ---- load ---- */
    const loadPengaduan = () => {
        grid.innerHTML = `
            <div class="ap-empty">
                <div class="ap-loading">
                    <div class="ap-spinner"></div>
                    Memuat data pengaduan...
                </div>
            </div>`;

        // ENDPOINT FIX: Diganti ke endpoint admin agar hak akses Bearer Token terbaca valid oleh server
        fetch('/api/admin/pengaduan', {
            method: 'GET',
            headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) throw data;
            return data;
        })
        .then(data => {
            if (!Array.isArray(data)) {
                grid.innerHTML = `
                    <div class="ap-empty">
                        <div class="ap-empty-inner">
                            <div class="ap-empty-icon">⚠️</div>
                            <h3>Response Tidak Valid</h3>
                            <p>API mengembalikan format yang tidak dikenali.</p>
                        </div>
                    </div>`;
                return;
            }
            allPengaduan = data;
            setSummary();
            renderData();
        })
        .catch(err => {
            console.error(err);
            grid.innerHTML = `
                <div class="ap-empty">
                    <div class="ap-empty-inner">
                        <div class="ap-empty-icon">❌</div>
                        <h3>Gagal Memuat Data</h3>
                        <p>Periksa API, token admin, atau koneksi database.</p>
                    </div>
                </div>`;
        });
    };

    /* ---- update status ---- */
    window.updatePengaduanStatus = function (id) {
        const select    = document.getElementById(`status-${id}`);
        const updateBtn = document.getElementById(`btn-update-${id}`);
        if (!select) { showToast('Status tidak ditemukan.', 'error'); return; }

        const status = select.value;

        if (updateBtn) {
            updateBtn.disabled = true;
            updateBtn.textContent = 'Menyimpan...';
        }

        fetch(`/api/admin/pengaduan/${id}`, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status })
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) throw data;

            showToast('Status pengaduan berhasil diubah.', 'success');

            if (status === 'selesai') {
                select.disabled = true;
                if (updateBtn) {
                    const badge = document.createElement('div');
                    badge.className = 'ap-done-badge';
                    badge.innerHTML = '✅ Sudah Selesai';
                    updateBtn.replaceWith(badge);
                }
                const local = allPengaduan.find(i => String(i.id) === String(id));
                if (local) local.status = 'selesai';
                setSummary();
                loadPengaduan();
            } else {
                const local = allPengaduan.find(i => String(i.id) === String(id));
                if (local) local.status = status;
                setSummary();
                if (updateBtn) {
                    updateBtn.disabled = false;
                    updateBtn.textContent = 'Simpan';
                }
                loadPengaduan();
            }
        })
        .catch(err => {
            console.error(err);
            const msg = err?.errors
                ? Object.values(err.errors)[0][0]
                : err?.message || 'Gagal mengubah status pengaduan.';
            showToast(msg, 'error');
            if (updateBtn) {
                updateBtn.disabled = false;
                updateBtn.textContent = 'Simpan';
            }
        });
    };

    /* ---- delete ---- */
    window.deletePengaduan = function (id) {
        if (!confirm('Yakin mau menghapus pengaduan ini? Data dan foto akan ikut dihapus.')) return;

        fetch(`/api/admin/pengaduan/${id}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) throw data;
            showToast('Pengaduan berhasil dihapus.', 'success');
            loadPengaduan();
        })
        .catch(err => {
            console.error(err);
            showToast(err?.message || 'Gagal menghapus pengaduan.', 'error');
        });
    };

    /* ---- events ---- */
    searchInput.addEventListener('input', renderData);
    statusFilter.addEventListener('change', renderData);
    refreshBtn.addEventListener('click', loadPengaduan);

    loadPengaduan();
});
</script>
@endpush