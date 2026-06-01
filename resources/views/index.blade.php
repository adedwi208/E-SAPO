@extends('app')

@section('content')

<style>
    :root {
        --es-bg: #f6f8f3;
        --es-bg-soft: #eef5ee;
        --es-card: #ffffff;
        --es-dark: #102018;
        --es-dark-2: #1d3025;
        --es-text: #24352b;
        --es-muted: #6d7c72;
        --es-line: rgba(16, 32, 24, 0.10);
        --es-green: #16a765;
        --es-green-dark: #087a48;
        --es-green-soft: #def8e9;
        --es-yellow: #f4cf70;
        --es-blue: #2f80ed;
        --es-orange: #f2994a;
        --es-shadow: 0 18px 48px rgba(18, 34, 25, 0.08);
        --es-shadow-hover: 0 24px 64px rgba(18, 34, 25, 0.13);
        --es-radius-xl: 34px;
        --es-radius-lg: 26px;
        --es-radius-md: 18px;
    }

    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    .es-page {
        width: 100%;
        min-height: 100vh;
        margin-top: -24px;
        padding: 34px 0 82px;
        position: relative;
        overflow: hidden;
        color: var(--es-text);
        background:
            radial-gradient(circle at 6% 10%, rgba(22, 167, 101, 0.10), transparent 26%),
            radial-gradient(circle at 92% 4%, rgba(244, 207, 112, 0.16), transparent 22%),
            linear-gradient(180deg, #fbfcf8 0%, var(--es-bg) 45%, var(--es-bg-soft) 100%);
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .es-page::before,
    .es-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
        filter: blur(70px);
        z-index: 0;
    }

    .es-page::before {
        width: 300px;
        height: 300px;
        left: -110px;
        top: 230px;
        background: rgba(22, 167, 101, 0.10);
    }

    .es-page::after {
        width: 280px;
        height: 280px;
        right: -110px;
        bottom: 180px;
        background: rgba(244, 207, 112, 0.12);
    }

    .es-container {
        width: min(1160px, calc(100% - 34px));
        margin-inline: auto;
        position: relative;
        z-index: 2;
    }

    .es-hero {
        display: grid;
        grid-template-columns: minmax(0, 1fr);
        gap: 18px;
    }

    .es-hero-top {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 18px;
        align-items: stretch;
    }

    .es-intro-card {
        min-height: 360px;
        border-radius: var(--es-radius-xl);
        background: var(--es-card);
        border: 1px solid var(--es-line);
        box-shadow: var(--es-shadow);
        padding: 38px;
        position: relative;
        overflow: hidden;
    }

    .es-intro-card::before {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        right: -95px;
        top: -110px;
        border-radius: 999px;
        background: rgba(22, 167, 101, 0.08);
    }

    .es-intro-card::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        right: 95px;
        bottom: -90px;
        border-radius: 999px;
        background: rgba(244, 207, 112, 0.12);
    }

    .es-eyebrow {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 36px;
        padding: 0 13px;
        border-radius: 999px;
        background: var(--es-green-soft);
        color: var(--es-green-dark);
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        position: relative;
        z-index: 2;
    }

    .es-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--es-green);
        box-shadow: 0 0 0 5px rgba(22, 167, 101, 0.12);
    }

    .es-title {
        max-width: 720px;
        margin: 22px 0 0;
        color: var(--es-dark);
        font-size: clamp(38px, 4.5vw, 66px);
        line-height: 0.96;
        font-weight: 950;
        letter-spacing: -0.075em;
        position: relative;
        z-index: 2;
    }

    .es-title span {
        color: var(--es-green);
    }

    .es-desc {
        max-width: 680px;
        margin: 20px 0 0;
        color: var(--es-muted);
        font-size: 14px;
        line-height: 1.85;
        font-weight: 600;
        position: relative;
        z-index: 2;
    }

    .es-actions {
        margin-top: 28px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        position: relative;
        z-index: 2;
    }

    .es-btn-main,
    .es-btn-light {
        min-height: 52px;
        padding: 0 19px;
        border-radius: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        font-size: 12px;
        font-weight: 950;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: 0.24s ease;
    }

    .es-btn-main {
        color: #ffffff;
        background: var(--es-dark);
        box-shadow: 0 14px 28px rgba(16, 32, 24, 0.16);
    }

    .es-btn-main:hover {
        transform: translateY(-2px);
        background: #1a2d22;
    }

    .es-btn-light {
        color: var(--es-dark);
        background: #f1f5ee;
        border: 1px solid rgba(16, 32, 24, 0.08);
    }

    .es-btn-light:hover {
        transform: translateY(-2px);
        background: #e9efe6;
    }

    .es-visual-card {
        border-radius: var(--es-radius-xl);
        overflow: hidden;
        background: #dfe9df;
        border: 1px solid var(--es-line);
        box-shadow: var(--es-shadow);
        position: relative;
        min-height: 360px;
    }

    .es-visual-card img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        object-position: center;
        transition: 0.7s ease;
    }

    .es-visual-card:hover img {
        transform: scale(1.05);
    }

    .es-visual-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(8, 18, 12, 0.02) 20%, rgba(8, 18, 12, 0.58) 100%);
    }

    .es-visual-caption {
        position: absolute;
        left: 18px;
        right: 18px;
        bottom: 18px;
        padding: 16px;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.78);
        border: 1px solid rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(14px);
    }

    .es-visual-caption strong {
        display: block;
        color: var(--es-dark);
        font-size: 17px;
        line-height: 1.25;
        font-weight: 950;
        letter-spacing: -0.04em;
    }

    .es-visual-caption span {
        display: block;
        margin-top: 6px;
        color: var(--es-muted);
        font-size: 12px;
        line-height: 1.5;
        font-weight: 650;
    }

    .es-feature-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .es-feature-card {
        border-radius: var(--es-radius-lg);
        background: var(--es-card);
        border: 1px solid var(--es-line);
        box-shadow: var(--es-shadow);
        padding: 24px;
        min-height: 168px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: 0.24s ease;
    }

    .es-feature-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--es-shadow-hover);
    }

    .es-feature-icon {
        width: 46px;
        height: 46px;
        border-radius: 17px;
        display: grid;
        place-items: center;
        font-size: 20px;
        background: #f0f5ee;
        color: var(--es-dark);
    }

    .es-feature-card strong {
        display: block;
        margin-top: 20px;
        color: var(--es-dark);
        font-size: 18px;
        line-height: 1.2;
        font-weight: 950;
        letter-spacing: -0.04em;
    }

    .es-feature-card p {
        margin: 8px 0 0;
        color: var(--es-muted);
        font-size: 12.5px;
        line-height: 1.7;
        font-weight: 600;
    }

    .es-stats {
        margin-top: 22px;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .es-stat-card {
        min-height: 130px;
        border-radius: var(--es-radius-lg);
        background: var(--es-card);
        border: 1px solid var(--es-line);
        box-shadow: var(--es-shadow);
        padding: 22px;
        position: relative;
        overflow: hidden;
        transition: 0.24s ease;
    }

    .es-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--es-shadow-hover);
    }

    .es-stat-card::after {
        content: "";
        position: absolute;
        width: 92px;
        height: 92px;
        right: -30px;
        top: -30px;
        border-radius: 999px;
        background: rgba(22, 167, 101, 0.08);
    }

    .es-stat-card.pending::after {
        background: rgba(242, 153, 74, 0.12);
    }

    .es-stat-card.proses::after {
        background: rgba(47, 128, 237, 0.11);
    }

    .es-stat-card.selesai::after {
        background: rgba(22, 167, 101, 0.12);
    }

    .es-stat-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #7c8a82;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        position: relative;
        z-index: 2;
    }

    .es-stat-dot {
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: #94a3b8;
    }

    .es-stat-dot.pending {
        background: var(--es-orange);
    }

    .es-stat-dot.proses {
        background: var(--es-blue);
    }

    .es-stat-dot.selesai {
        background: var(--es-green);
    }

    .es-stat-number {
        display: block;
        margin-top: 16px;
        color: var(--es-dark);
        font-size: 42px;
        line-height: 1;
        font-weight: 950;
        letter-spacing: -0.08em;
        position: relative;
        z-index: 2;
    }

    .es-stat-text {
        display: block;
        margin-top: 8px;
        color: var(--es-muted);
        font-size: 12px;
        font-weight: 650;
        position: relative;
        z-index: 2;
    }

    .es-section {
        margin-top: 58px;
    }

    .es-section-head {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 24px;
        align-items: end;
        padding-bottom: 18px;
        border-bottom: 1px solid rgba(16, 32, 24, 0.10);
    }

    .es-kicker {
        margin: 0;
        color: #859189;
        font-size: 11px;
        font-weight: 950;
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    .es-section-title {
        margin: 8px 0 0;
        color: var(--es-dark);
        font-size: clamp(25px, 2.5vw, 35px);
        line-height: 1.08;
        font-weight: 950;
        letter-spacing: -0.06em;
    }

    .es-section-note {
        margin: 0;
        color: var(--es-muted);
        font-size: 12.5px;
        line-height: 1.7;
        font-weight: 600;
        text-align: right;
    }

    .es-toolbar {
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
    }

    .es-toolbar-badges {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .es-toolbar-badge {
        min-height: 38px;
        padding: 0 14px;
        border-radius: 999px;
        background: #ffffff;
        border: 1px solid rgba(16, 32, 24, 0.08);
        box-shadow: 0 6px 18px rgba(18, 34, 25, 0.04);
        color: var(--es-dark-2);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        font-weight: 850;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .es-toolbar-link {
        min-height: 42px;
        padding: 0 16px;
        border-radius: 14px;
        background: var(--es-dark);
        color: #ffffff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: 0.22s ease;
    }

    .es-toolbar-link:hover {
        transform: translateY(-2px);
        background: #1a2d22;
    }

    .es-report-grid {
        margin-top: 24px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .es-report-card {
        border-radius: 30px;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid rgba(16, 32, 24, 0.08);
        box-shadow: var(--es-shadow);
        display: flex;
        flex-direction: column;
        transition: 0.26s ease;
    }

    .es-report-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--es-shadow-hover);
    }

    .es-report-image {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: #e8eee8;
    }

    .es-report-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: 0.75s ease;
    }

    .es-report-card:hover .es-report-image img {
        transform: scale(1.08);
    }

    .es-report-status {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 2;
        min-height: 32px;
        padding: 0 12px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 950;
        letter-spacing: 0.13em;
        text-transform: uppercase;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.34);
    }

    .es-report-status.pending {
        background: rgba(254, 243, 199, 0.94);
        color: #7b4d08;
    }

    .es-report-status.proses {
        background: rgba(224, 246, 255, 0.94);
        color: #0b5a8d;
    }

    .es-report-status.selesai {
        background: rgba(220, 252, 231, 0.95);
        color: #047857;
    }

    .es-report-location {
        position: absolute;
        left: 14px;
        right: 14px;
        bottom: 14px;
        z-index: 2;
        min-width: 0;
        padding: 10px 12px;
        border-radius: 16px;
        background: rgba(0,0,0,0.28);
        backdrop-filter: blur(12px);
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 850;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .es-report-location span:last-child {
        min-width: 0;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .es-report-body {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .es-report-title {
        margin: 0;
        color: var(--es-dark);
        font-size: 18px;
        line-height: 1.34;
        font-weight: 950;
        letter-spacing: -0.04em;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .es-report-desc {
        margin: 11px 0 0;
        color: var(--es-muted);
        font-size: 12.8px;
        line-height: 1.8;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .es-report-footer {
        margin-top: auto;
        padding-top: 18px;
        border-top: 1px solid rgba(16, 32, 24, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .es-user {
        min-width: 0;
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .es-avatar {
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        border-radius: 15px;
        display: grid;
        place-items: center;
        background: #eef5ef;
        color: var(--es-dark);
        border: 1px solid rgba(16, 32, 24, 0.08);
        font-size: 12px;
        font-weight: 950;
    }

    .es-user-meta {
        min-width: 0;
    }

    .es-user-label {
        display: block;
        color: #9aa59e;
        font-size: 9px;
        font-weight: 950;
        letter-spacing: 0.11em;
        text-transform: uppercase;
        line-height: 1;
    }

    .es-user-name {
        display: block;
        margin-top: 5px;
        color: #33443a;
        font-size: 12px;
        font-weight: 850;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 130px;
    }

    .es-detail-link {
        min-height: 38px;
        padding: 0 13px;
        border-radius: 13px;
        background: #f2f5ef;
        color: var(--es-dark);
        border: 1px solid rgba(16, 32, 24, 0.08);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: 0.22s ease;
    }

    .es-detail-link:hover {
        background: #e9eee8;
        transform: translateY(-2px);
    }

    .es-empty {
        grid-column: 1 / -1;
        min-height: 320px;
        border-radius: 34px;
        background: #ffffff;
        border: 1px solid rgba(16, 32, 24, 0.08);
        box-shadow: var(--es-shadow);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px 20px;
    }

    .es-empty-icon {
        width: 78px;
        height: 78px;
        margin-inline: auto;
        border-radius: 24px;
        display: grid;
        place-items: center;
        font-size: 35px;
        background: #f2f7f2;
        border: 1px solid rgba(16, 32, 24, 0.08);
    }

    .es-empty h3 {
        margin: 18px 0 0;
        color: var(--es-dark);
        font-size: 22px;
        line-height: 1.15;
        font-weight: 950;
        letter-spacing: -0.04em;
    }

    .es-empty p {
        max-width: 430px;
        margin: 10px auto 0;
        color: var(--es-muted);
        font-size: 13px;
        line-height: 1.75;
        font-weight: 600;
    }

    .es-skeleton {
        border-radius: 30px;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid rgba(16, 32, 24, 0.08);
        box-shadow: var(--es-shadow);
    }

    .es-skeleton-img,
    .es-skeleton-line {
        background: linear-gradient(90deg, #edf2ec 0%, #f8faf7 45%, #edf2ec 100%);
        background-size: 220% 100%;
        animation: esLoading 1.25s ease-in-out infinite;
    }

    .es-skeleton-img {
        height: 220px;
    }

    .es-skeleton-body {
        padding: 22px;
    }

    .es-skeleton-line {
        height: 13px;
        border-radius: 999px;
        margin-bottom: 13px;
    }

    .es-skeleton-line.sm {
        width: 42%;
    }

    .es-skeleton-line.md {
        width: 76%;
        height: 18px;
    }

    .es-skeleton-line.lg {
        width: 100%;
    }

    @keyframes esLoading {
        0% {
            background-position: 100% 0;
        }

        100% {
            background-position: -100% 0;
        }
    }

    @media (max-width: 1080px) {
        .es-hero-top {
            grid-template-columns: 1fr;
        }

        .es-visual-card {
            min-height: 280px;
        }

        .es-feature-row {
            grid-template-columns: 1fr;
        }

        .es-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .es-report-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 760px) {
        .es-page {
            margin-top: -18px;
            padding: 24px 0 64px;
        }

        .es-container {
            width: min(100% - 22px, 1160px);
        }

        .es-intro-card {
            padding: 25px 22px;
            border-radius: 26px;
            min-height: auto;
        }

        .es-title {
            margin-top: 18px;
            font-size: 34px;
            line-height: 1.02;
        }

        .es-desc {
            font-size: 12.8px;
            line-height: 1.75;
        }

        .es-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .es-btn-main,
        .es-btn-light {
            width: 100%;
        }

        .es-visual-card {
            min-height: 220px;
            border-radius: 24px;
        }

        .es-visual-caption {
            left: 14px;
            right: 14px;
            bottom: 14px;
            padding: 13px;
            border-radius: 18px;
        }

        .es-visual-caption strong {
            font-size: 15px;
        }

        .es-visual-caption span {
            font-size: 11.5px;
        }

        .es-feature-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .es-feature-card {
            border-radius: 22px;
            min-height: auto;
        }

        .es-stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .es-stat-card {
            min-height: 110px;
            border-radius: 22px;
        }

        .es-stat-number {
            font-size: 36px;
        }

        .es-section {
            margin-top: 42px;
        }

        .es-section-head {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .es-section-note {
            text-align: left;
        }

        .es-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .es-toolbar-link {
            width: 100%;
        }

        .es-report-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .es-report-card {
            border-radius: 26px;
        }

        .es-report-image {
            height: 210px;
        }
    }

    @media (max-width: 420px) {
        .es-title {
            font-size: 30px;
        }

        .es-report-footer {
            flex-direction: column;
            align-items: flex-start;
        }

        .es-detail-link {
            width: 100%;
        }
    }
</style>

<div class="es-page">
    <section class="es-container es-hero">
        <div class="es-hero-top">
            <div class="es-intro-card">
                <div class="es-eyebrow">Sistem Pelaporan Publik</div>

                <h1 class="es-title">
                    Bantu Lingkungan Lebih <span>Bersih</span> Lewat Laporan yang Terarah
                </h1>

                <p class="es-desc">
                    E-SAPO membantu masyarakat mengirim aduan sampah liar dengan alur yang jelas,
                    data lokasi yang rapi, dan status penanganan yang mudah dipantau oleh warga
                    maupun petugas.
                </p>

                <div class="es-actions">
                    <a href="/create" class="es-btn-main">
                        Buat Laporan
                        <span>→</span>
                    </a>

                    <a href="#laporan-terbaru" class="es-btn-light">
                        Lihat Arsip Laporan
                    </a>
                </div>
            </div>

            <div class="es-visual-card">
                <img
                    src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200"
                    alt="Lingkungan hijau dan bersih"
                >

                <div class="es-visual-overlay"></div>

                <div class="es-visual-caption">
                    <strong>Lingkungan Bersih Dimulai dari Laporan Kecil</strong>
                    <span>Setiap aduan membantu petugas menentukan prioritas penanganan.</span>
                </div>
            </div>
        </div>

        <div class="es-feature-row">
            <div class="es-feature-card">
                <div>
                    <div class="es-feature-icon">📍</div>
                    <strong>Lokasi Terdokumentasi</strong>
                    <p>Data desa, RT, dan RW membantu petugas menelusuri titik laporan dengan lebih cepat.</p>
                </div>
            </div>

            <div class="es-feature-card">
                <div>
                    <div class="es-feature-icon">📸</div>
                    <strong>Bukti Foto Lapangan</strong>
                    <p>Laporan dapat menyertakan dokumentasi visual agar proses verifikasi lebih mudah dilakukan.</p>
                </div>
            </div>

            <div class="es-feature-card">
                <div>
                    <div class="es-feature-icon">📊</div>
                    <strong>Status Transparan</strong>
                    <p>Setiap laporan memiliki status sehingga masyarakat dapat melihat perkembangan penanganan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="es-container">
        <div class="es-stats">
            <div class="es-stat-card">
                <span class="es-stat-label">
                    <span class="es-stat-dot"></span>
                    Total Laporan
                </span>
                <span id="stat-total" class="es-stat-number">0</span>
                <span class="es-stat-text">Semua data yang masuk</span>
            </div>

            <div class="es-stat-card pending">
                <span class="es-stat-label">
                    <span class="es-stat-dot pending"></span>
                    Pending
                </span>
                <span id="stat-pending" class="es-stat-number">0</span>
                <span class="es-stat-text">Menunggu verifikasi</span>
            </div>

            <div class="es-stat-card proses">
                <span class="es-stat-label">
                    <span class="es-stat-dot proses"></span>
                    Proses
                </span>
                <span id="stat-proses" class="es-stat-number">0</span>
                <span class="es-stat-text">Sedang ditangani</span>
            </div>

            <div class="es-stat-card selesai">
                <span class="es-stat-label">
                    <span class="es-stat-dot selesai"></span>
                    Selesai
                </span>
                <span id="stat-selesai" class="es-stat-number">0</span>
                <span class="es-stat-text">Sudah dituntaskan</span>
            </div>
        </div>
    </section>

    <section id="laporan-terbaru" class="es-container es-section">
        <div class="es-section-head">
            <div>
                <p class="es-kicker">Arsip Publik</p>
                <h2 class="es-section-title">Aduan Terbaru dari Masyarakat</h2>
            </div>

            <p class="es-section-note">
                Setiap laporan ditampilkan sebagai dokumentasi publik untuk membantu
                pemantauan kebersihan wilayah dan tindak lanjut yang lebih terarah.
            </p>
        </div>

        <div class="es-toolbar">
            <div class="es-toolbar-badges">
                <span class="es-toolbar-badge">🌿 Realtime Data</span>
                <span class="es-toolbar-badge">📷 Bukti Foto</span>
                <span class="es-toolbar-badge">📌 Lokasi RT/RW</span>
            </div>

            <a href="/create" class="es-toolbar-link">
                Tambah Laporan
            </a>
        </div>

        <div id="container-pengaduan" class="es-report-grid">
            @for ($i = 0; $i < 3; $i++)
                <div class="es-skeleton">
                    <div class="es-skeleton-img"></div>
                    <div class="es-skeleton-body">
                        <div class="es-skeleton-line sm"></div>
                        <div class="es-skeleton-line md"></div>
                        <div class="es-skeleton-line lg"></div>
                        <div class="es-skeleton-line lg"></div>
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
        const statTotal = document.getElementById('stat-total');
        const statPending = document.getElementById('stat-pending');
        const statProses = document.getElementById('stat-proses');
        const statSelesai = document.getElementById('stat-selesai');

        const safeText = (value, fallback = '-') => {
            if (value === null || value === undefined || value === '') return fallback;
            return String(value);
        };

        const escapeHtml = (value) => {
            return safeText(value, '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        };

        const normalizeStatus = (status) => {
            const value = safeText(status, 'pending').toLowerCase();

            if (value === 'proses' || value === 'diproses' || value === 'process') {
                return 'proses';
            }

            if (value === 'selesai' || value === 'done' || value === 'completed') {
                return 'selesai';
            }

            return 'pending';
        };

        const statusLabel = (status) => {
            if (status === 'proses') return 'Proses';
            if (status === 'selesai') return 'Selesai';
            return 'Pending';
        };

        const setStats = (data) => {
            const pending = data.filter(item => normalizeStatus(item.status) === 'pending').length;
            const proses = data.filter(item => normalizeStatus(item.status) === 'proses').length;
            const selesai = data.filter(item => normalizeStatus(item.status) === 'selesai').length;

            statTotal.innerText = data.length;
            statPending.innerText = pending;
            statProses.innerText = proses;
            statSelesai.innerText = selesai;
        };

        fetch('/api/pengaduan', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {
            container.innerHTML = '';

            if (!Array.isArray(data) || data.length === 0) {
                setStats([]);

                container.innerHTML = `
                    <div class="es-empty">
                        <div>
                            <div class="es-empty-icon">🍃</div>
                            <h3>Belum Ada Laporan Masuk</h3>
                            <p>
                                Kondisi masih aman. Jika menemukan tumpukan sampah liar,
                                segera buat laporan agar petugas dapat menindaklanjuti.
                            </p>
                        </div>
                    </div>
                `;
                return;
            }

            setStats(data);

            data.forEach(item => {
                const status = normalizeStatus(item.status);

                const imageUrl = item.foto
                    ? `/storage/${item.foto}`
                    : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=900';

                const userName = item.user ? safeText(item.user.name, 'Masyarakat') : 'Masyarakat';
                const initial = userName.charAt(0).toUpperCase();

                const desaName = item.desa
                    ? safeText(item.desa.nama_desa || item.desa.name, 'Sektor Umum')
                    : 'Sektor Umum';

                const rt = item.rtrw ? safeText(item.rtrw.rt) : '-';
                const rw = item.rtrw ? safeText(item.rtrw.rw) : '-';

                const lokasi = safeText(item.lokasi_spesifik, 'Lokasi belum tersedia');
                const deskripsi = safeText(item.deskripsi, 'Tidak ada deskripsi tambahan untuk laporan ini.');

                const card = `
                    <article class="es-report-card">
                        <div class="es-report-image">
                            <img src="${escapeHtml(imageUrl)}" alt="Bukti laporan lapangan">

                            <span class="es-report-status ${status}">
                                ${statusLabel(status)}
                            </span>

                            <div class="es-report-location">
                                <span>📍</span>
                                <span>${escapeHtml(desaName)} • RT ${escapeHtml(rt)}/RW ${escapeHtml(rw)}</span>
                            </div>
                        </div>

                        <div class="es-report-body">
                            <h3 class="es-report-title">${escapeHtml(lokasi)}</h3>

                            <p class="es-report-desc">${escapeHtml(deskripsi)}</p>

                            <div class="es-report-footer">
                                <div class="es-user">
                                    <div class="es-avatar">${escapeHtml(initial)}</div>

                                    <div class="es-user-meta">
                                        <span class="es-user-label">Pelapor</span>
                                        <span class="es-user-name">${escapeHtml(userName)}</span>
                                    </div>
                                </div>

                                <a href="/show/${escapeHtml(item.id)}" class="es-detail-link">
                                    Detail →
                                </a>
                            </div>
                        </div>
                    </article>
                `;

                container.insertAdjacentHTML('beforeend', card);
            });
        })
        .catch(error => {
            console.error('Error:', error);

            statTotal.innerText = 0;
            statPending.innerText = 0;
            statProses.innerText = 0;
            statSelesai.innerText = 0;

            container.innerHTML = `
                <div class="es-empty">
                    <div>
                        <div class="es-empty-icon">⚠️</div>
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