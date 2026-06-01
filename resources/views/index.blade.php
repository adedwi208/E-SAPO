@extends('app')

@section('content')
</div>

<style>
    :root {
        --bg: #f6faf7;
        --card: rgba(255, 255, 255, 0.86);
        --card-solid: #ffffff;
        --dark: #10251b;
        --dark-2: #173927;
        --green: #17b86a;
        --green-2: #3ce39a;
        --mint: #dff9ec;
        --teal: #31d4c1;
        --yellow: #ffe7a1;
        --text: #17221c;
        --muted: #66756d;
        --soft: #e6eee9;
        --line: rgba(20, 48, 35, 0.1);
        --shadow-soft: 0 18px 60px rgba(20, 48, 35, 0.08);
        --shadow-card: 0 20px 55px rgba(15, 35, 25, 0.11);
        --radius-xl: 34px;
        --radius-lg: 26px;
        --radius-md: 18px;
    }

    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    .sapo-page {
        width: 100%;
        min-height: 100vh;
        margin-top: -32px;
        padding: 54px 0 90px;
        background:
            radial-gradient(circle at 6% 2%, rgba(68, 220, 146, 0.22), transparent 32%),
            radial-gradient(circle at 94% 18%, rgba(44, 196, 214, 0.16), transparent 30%),
            linear-gradient(180deg, #f9fcfa 0%, var(--bg) 44%, #f7fbf8 100%);
        position: relative;
        overflow: hidden;
        color: var(--text);
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .sapo-page::before,
    .sapo-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
        filter: blur(85px);
        opacity: 0.75;
        z-index: 0;
    }

    .sapo-page::before {
        width: 520px;
        height: 520px;
        top: -190px;
        left: -160px;
        background: rgba(57, 219, 142, 0.25);
    }

    .sapo-page::after {
        width: 480px;
        height: 480px;
        top: 250px;
        right: -190px;
        background: rgba(49, 180, 210, 0.19);
    }

    .sapo-container {
        width: min(1140px, calc(100% - 32px));
        margin-inline: auto;
        position: relative;
        z-index: 1;
    }

    .sapo-hero-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(340px, 0.85fr);
        gap: 24px;
        align-items: stretch;
    }

    .sapo-hero-card {
        min-height: 470px;
        padding: 42px;
        border-radius: var(--radius-xl);
        background:
            radial-gradient(circle at 88% 10%, rgba(60, 227, 154, 0.22), transparent 30%),
            radial-gradient(circle at 8% 90%, rgba(255, 231, 161, 0.16), transparent 26%),
            linear-gradient(135deg, #0f2b1d 0%, #143823 48%, #0b2117 100%);
        color: #ffffff;
        box-shadow: 0 30px 80px rgba(11, 33, 23, 0.22);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        isolation: isolate;
    }

    .sapo-hero-card::before {
        content: "";
        position: absolute;
        inset: 1px;
        border-radius: calc(var(--radius-xl) - 1px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        pointer-events: none;
        z-index: 2;
    }

    .sapo-hero-card::after {
        content: "";
        position: absolute;
        width: 360px;
        height: 360px;
        right: -140px;
        top: -120px;
        border-radius: 999px;
        background: conic-gradient(from 90deg, rgba(60, 227, 154, 0.22), rgba(49, 212, 193, 0.08), transparent);
        filter: blur(4px);
        opacity: 0.9;
        z-index: -1;
        transition: 0.7s ease;
    }

    .sapo-hero-card:hover::after {
        transform: scale(1.18) rotate(16deg);
        opacity: 1;
    }

    .sapo-eyebrow {
        display: inline-flex;
        width: fit-content;
        align-items: center;
        gap: 9px;
        padding: 8px 13px;
        border-radius: 999px;
        background: rgba(60, 227, 154, 0.1);
        border: 1px solid rgba(60, 227, 154, 0.22);
        color: #a8ffd3;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        backdrop-filter: blur(12px);
    }

    .sapo-dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--green-2);
        box-shadow: 0 0 0 6px rgba(60, 227, 154, 0.12);
        animation: sapoPulse 1.5s infinite;
    }

    @keyframes sapoPulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(0.75);
            opacity: 0.65;
        }
    }

    .sapo-hero-title {
        margin: 24px 0 0;
        font-size: clamp(38px, 5vw, 64px);
        line-height: 0.98;
        letter-spacing: -0.06em;
        font-weight: 950;
    }

    .sapo-gradient-text {
        color: transparent;
        background: linear-gradient(90deg, #9cffcc 0%, #d8ffef 46%, #ffe7a1 100%);
        -webkit-background-clip: text;
        background-clip: text;
    }

    .sapo-hero-desc {
        margin: 22px 0 0;
        max-width: 610px;
        color: rgba(229, 255, 239, 0.74);
        font-size: 14px;
        line-height: 1.85;
        font-weight: 600;
    }

    .sapo-hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        align-items: center;
        margin-top: 42px;
    }

    .sapo-btn-primary,
    .sapo-btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 50px;
        border-radius: 16px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 950;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: 0.28s ease;
        white-space: nowrap;
    }

    .sapo-btn-primary {
        padding: 0 22px;
        color: #08160f;
        background: linear-gradient(135deg, #4affaa 0%, #25d7bd 100%);
        box-shadow: 0 15px 35px rgba(37, 215, 189, 0.22);
    }

    .sapo-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 22px 45px rgba(37, 215, 189, 0.28);
    }

    .sapo-btn-primary svg {
        width: 17px;
        height: 17px;
        transition: 0.25s ease;
    }

    .sapo-btn-primary:hover svg {
        transform: translateX(4px);
    }

    .sapo-btn-secondary {
        padding: 0 16px;
        color: rgba(222, 255, 235, 0.84);
    }

    .sapo-btn-secondary:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.08);
    }

    .sapo-hero-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 26px;
    }

    .sapo-mini-badge {
        padding: 9px 12px;
        border-radius: 999px;
        color: rgba(235, 255, 243, 0.82);
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.08);
        font-size: 11px;
        font-weight: 800;
    }

    .sapo-side-card {
        border-radius: var(--radius-xl);
        padding: 18px;
        background: rgba(255, 255, 255, 0.82);
        border: 1px solid rgba(18, 48, 31, 0.08);
        box-shadow: var(--shadow-soft);
        backdrop-filter: blur(18px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        position: relative;
    }

    .sapo-side-card::before {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        right: -70px;
        bottom: -70px;
        border-radius: 999px;
        background: rgba(23, 184, 106, 0.12);
        filter: blur(18px);
    }

    .sapo-image-frame {
        height: 272px;
        border-radius: 25px;
        overflow: hidden;
        background: #e8f0eb;
        position: relative;
        box-shadow: inset 0 0 0 1px rgba(15, 35, 25, 0.08);
    }

    .sapo-image-frame img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .sapo-side-card:hover img {
        transform: scale(1.08);
    }

    .sapo-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 30%, rgba(4, 20, 13, 0.78) 100%);
    }

    .sapo-image-meta {
        position: absolute;
        left: 16px;
        right: 16px;
        bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        color: #ffffff;
    }

    .sapo-photo-label,
    .sapo-live-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border-radius: 999px;
        padding: 7px 10px;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        backdrop-filter: blur(12px);
    }

    .sapo-photo-label {
        background: rgba(0, 0, 0, 0.28);
        border: 1px solid rgba(255, 255, 255, 0.12);
    }

    .sapo-live-label {
        color: #a8ffd3;
        background: rgba(3, 23, 13, 0.38);
    }

    .sapo-live-dot {
        width: 7px;
        height: 7px;
        border-radius: 999px;
        background: var(--green-2);
        box-shadow: 0 0 0 5px rgba(60, 227, 154, 0.15);
    }

    .sapo-side-body {
        padding: 22px 4px 2px;
        position: relative;
        z-index: 1;
    }

    .sapo-side-body h3 {
        margin: 0;
        font-size: 22px;
        letter-spacing: -0.04em;
        color: #17221c;
        font-weight: 950;
    }

    .sapo-side-body p {
        margin: 10px 0 0;
        color: #69786f;
        font-size: 13px;
        line-height: 1.7;
        font-weight: 600;
    }

    .sapo-stats-wrap {
        margin-top: 32px;
    }

    .sapo-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        padding: 10px;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(18, 48, 31, 0.08);
        box-shadow: var(--shadow-soft);
        backdrop-filter: blur(18px);
    }

    .sapo-stat-card {
        min-height: 115px;
        padding: 20px;
        border-radius: 22px;
        background: linear-gradient(180deg, rgba(255,255,255,0.82), rgba(255,255,255,0.48));
        border: 1px solid transparent;
        transition: 0.28s ease;
    }

    .sapo-stat-card:hover {
        transform: translateY(-3px);
        background: #ffffff;
        border-color: rgba(20, 48, 35, 0.08);
        box-shadow: 0 14px 35px rgba(20, 48, 35, 0.08);
    }

    .sapo-stat-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.13em;
        text-transform: uppercase;
        color: #87948c;
    }

    .sapo-stat-icon {
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: #87948c;
    }

    .sapo-stat-icon.pending {
        background: #f1b832;
    }

    .sapo-stat-icon.proses {
        background: #38a8e8;
    }

    .sapo-stat-icon.selesai {
        background: #17b86a;
    }

    .sapo-stat-value {
        display: block;
        margin-top: 13px;
        font-size: 38px;
        line-height: 1;
        letter-spacing: -0.06em;
        font-weight: 950;
        color: #122018;
    }

    .sapo-section {
        margin-top: 58px;
    }

    .sapo-section-head {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 18px;
        padding-bottom: 19px;
        border-bottom: 1px solid rgba(18, 48, 31, 0.1);
    }

    .sapo-kicker {
        margin: 0;
        font-size: 11px;
        font-weight: 950;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: #7f8d84;
    }

    .sapo-section-title {
        margin: 6px 0 0;
        font-size: clamp(22px, 2.3vw, 31px);
        line-height: 1.12;
        letter-spacing: -0.045em;
        font-weight: 950;
        color: #142219;
    }

    .sapo-section-note {
        max-width: 340px;
        color: #748177;
        line-height: 1.65;
        font-size: 12px;
        font-weight: 650;
        text-align: right;
    }

    .sapo-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        margin-top: 28px;
    }

    .sapo-report-card {
        min-width: 0;
        background: var(--card-solid);
        border-radius: 30px;
        border: 1px solid rgba(18, 48, 31, 0.09);
        overflow: hidden;
        box-shadow: 0 8px 26px rgba(20, 48, 35, 0.05);
        transition: 0.3s ease;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .sapo-report-card:hover {
        transform: translateY(-7px);
        box-shadow: var(--shadow-card);
        border-color: rgba(23, 184, 106, 0.22);
    }

    .sapo-report-image {
        position: relative;
        height: 230px;
        overflow: hidden;
        background: #e8f0eb;
    }

    .sapo-report-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.75s ease;
    }

    .sapo-report-card:hover .sapo-report-image img {
        transform: scale(1.07);
    }

    .sapo-report-image::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.04) 0%, rgba(7, 22, 14, 0.55) 100%);
    }

    .sapo-status {
        position: absolute;
        z-index: 2;
        top: 15px;
        right: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 30px;
        padding: 0 12px;
        border-radius: 999px;
        font-size: 9px;
        font-weight: 950;
        letter-spacing: 0.13em;
        text-transform: uppercase;
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.35);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .sapo-status.pending {
        color: #7a4f00;
        background: rgba(255, 244, 211, 0.92);
    }

    .sapo-status.proses {
        color: #075985;
        background: rgba(224, 246, 255, 0.92);
    }

    .sapo-status.selesai {
        color: #047244;
        background: rgba(222, 255, 239, 0.94);
    }

    .sapo-report-body {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .sapo-location {
        display: flex;
        align-items: center;
        gap: 7px;
        min-width: 0;
        color: #87948c;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .sapo-location span:last-child {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .sapo-report-title {
        margin: 12px 0 0;
        color: #142219;
        font-size: 17px;
        line-height: 1.35;
        letter-spacing: -0.035em;
        font-weight: 950;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }

    .sapo-report-card:hover .sapo-report-title {
        color: #0b9d58;
    }

    .sapo-report-desc {
        margin: 10px 0 0;
        color: #64736a;
        font-size: 12px;
        line-height: 1.75;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .sapo-report-footer {
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid rgba(18, 48, 31, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .sapo-user {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 0;
    }

    .sapo-avatar {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #f3faf6, #e6f1eb);
        border: 1px solid rgba(18, 48, 31, 0.09);
        color: #263a2e;
        font-size: 12px;
        font-weight: 950;
    }

    .sapo-user-text {
        min-width: 0;
    }

    .sapo-user-label {
        display: block;
        color: #99a49d;
        font-size: 9px;
        font-weight: 950;
        letter-spacing: 0.11em;
        line-height: 1;
        text-transform: uppercase;
    }

    .sapo-user-name {
        display: block;
        margin-top: 5px;
        color: #33443a;
        font-size: 12px;
        font-weight: 850;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 125px;
    }

    .sapo-detail-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #0b9d58;
        font-size: 11px;
        font-weight: 950;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        text-decoration: none;
        transition: 0.2s ease;
        flex: 0 0 auto;
    }

    .sapo-detail-link:hover {
        color: #087c46;
    }

    .sapo-detail-link svg {
        width: 14px;
        height: 14px;
        transition: 0.2s ease;
    }

    .sapo-detail-link:hover svg {
        transform: translateX(3px);
    }

    .sapo-empty {
        grid-column: 1 / -1;
        min-height: 300px;
        border-radius: 32px;
        border: 1px solid rgba(18, 48, 31, 0.08);
        background: rgba(255,255,255,0.84);
        box-shadow: var(--shadow-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px 20px;
    }

    .sapo-empty-icon {
        width: 76px;
        height: 76px;
        margin-inline: auto;
        border-radius: 24px;
        display: grid;
        place-items: center;
        font-size: 34px;
        background: #f2faf5;
        border: 1px solid rgba(18, 48, 31, 0.08);
    }

    .sapo-empty h3 {
        margin: 18px 0 0;
        font-size: 21px;
        letter-spacing: -0.04em;
        font-weight: 950;
        color: #142219;
    }

    .sapo-empty p {
        max-width: 390px;
        margin: 9px auto 0;
        color: #718077;
        font-size: 13px;
        line-height: 1.7;
        font-weight: 600;
    }

    .sapo-skeleton {
        border-radius: 30px;
        overflow: hidden;
        border: 1px solid rgba(18, 48, 31, 0.08);
        background: #ffffff;
        box-shadow: 0 8px 26px rgba(20, 48, 35, 0.05);
    }

    .sapo-skeleton-img,
    .sapo-skeleton-line {
        background: linear-gradient(90deg, #ecf3ef 0%, #f7faf8 45%, #ecf3ef 100%);
        background-size: 220% 100%;
        animation: sapoLoading 1.25s ease-in-out infinite;
    }

    .sapo-skeleton-img {
        height: 230px;
    }

    .sapo-skeleton-body {
        padding: 22px;
    }

    .sapo-skeleton-line {
        height: 13px;
        border-radius: 999px;
        margin-bottom: 13px;
    }

    .sapo-skeleton-line.sm {
        width: 42%;
    }

    .sapo-skeleton-line.md {
        width: 76%;
        height: 18px;
    }

    .sapo-skeleton-line.lg {
        width: 100%;
    }

    @keyframes sapoLoading {
        0% {
            background-position: 100% 0;
        }
        100% {
            background-position: -100% 0;
        }
    }

    @media (max-width: 1024px) {
        .sapo-page {
            padding-top: 42px;
        }

        .sapo-hero-grid {
            grid-template-columns: 1fr;
        }

        .sapo-hero-card {
            min-height: 430px;
        }

        .sapo-image-frame {
            height: 310px;
        }

        .sapo-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 760px) {
        .sapo-page {
            margin-top: -24px;
            padding: 34px 0 68px;
        }

        .sapo-container {
            width: min(100% - 22px, 1140px);
        }

        .sapo-hero-grid {
            gap: 16px;
        }

        .sapo-hero-card {
            min-height: auto;
            padding: 26px 22px;
            border-radius: 28px;
        }

        .sapo-eyebrow {
            font-size: 9px;
            padding: 7px 10px;
        }

        .sapo-hero-title {
            margin-top: 20px;
            font-size: 35px;
            line-height: 1.02;
        }

        .sapo-hero-desc {
            margin-top: 16px;
            font-size: 12.5px;
            line-height: 1.75;
        }

        .sapo-hero-actions {
            margin-top: 28px;
            flex-direction: column;
            align-items: stretch;
        }

        .sapo-btn-primary,
        .sapo-btn-secondary {
            width: 100%;
            min-height: 48px;
        }

        .sapo-hero-badges {
            margin-top: 18px;
        }

        .sapo-mini-badge {
            font-size: 10px;
            padding: 8px 10px;
        }

        .sapo-side-card {
            padding: 13px;
            border-radius: 28px;
        }

        .sapo-image-frame {
            height: 220px;
            border-radius: 22px;
        }

        .sapo-image-meta {
            align-items: flex-start;
            flex-direction: column;
            gap: 8px;
        }

        .sapo-side-body {
            padding: 18px 5px 4px;
        }

        .sapo-side-body h3 {
            font-size: 19px;
        }

        .sapo-side-body p {
            font-size: 12px;
        }

        .sapo-stats-wrap {
            margin-top: 18px;
        }

        .sapo-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            border-radius: 24px;
            gap: 8px;
            padding: 8px;
        }

        .sapo-stat-card {
            min-height: 96px;
            padding: 15px;
            border-radius: 18px;
        }

        .sapo-stat-label {
            font-size: 8.5px;
            letter-spacing: 0.09em;
        }

        .sapo-stat-value {
            font-size: 31px;
        }

        .sapo-section {
            margin-top: 42px;
        }

        .sapo-section-head {
            display: block;
            padding-bottom: 16px;
        }

        .sapo-section-title {
            font-size: 23px;
        }

        .sapo-section-note {
            max-width: none;
            margin-top: 9px;
            text-align: left;
            font-size: 12px;
        }

        .sapo-grid {
            grid-template-columns: 1fr;
            gap: 18px;
            margin-top: 20px;
        }

        .sapo-report-card {
            border-radius: 26px;
        }

        .sapo-report-image {
            height: 215px;
        }

        .sapo-report-body {
            padding: 19px;
        }

        .sapo-report-title {
            font-size: 16px;
        }
    }

    @media (max-width: 380px) {
        .sapo-hero-title {
            font-size: 31px;
        }

        .sapo-stats {
            grid-template-columns: 1fr;
        }

        .sapo-report-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .sapo-detail-link {
            width: 100%;
            justify-content: center;
            min-height: 42px;
            border-radius: 14px;
            background: #ecfff5;
        }
    }
</style>

<div class="sapo-page">
    <section class="sapo-container">
        <div class="sapo-hero-grid">

            <div class="sapo-hero-card">
                <div>
                    <div class="sapo-eyebrow">
                        <span class="sapo-dot"></span>
                        Satu Data Pengelolaan
                    </div>

                    <h1 class="sapo-hero-title">
                        Menuju Indonesia<br>
                        <span class="sapo-gradient-text">Asri & Berkelanjutan</span>
                    </h1>

                    <p class="sapo-hero-desc">
                        Integrasi data pengaduan tumpukan sampah liar secara real-time.
                        Mempermudah koordinasi warga bersama petugas kebersihan daerah
                        agar laporan cepat diverifikasi dan ditangani.
                    </p>

                    <div class="sapo-hero-badges">
                        <span class="sapo-mini-badge">Realtime Report</span>
                        <span class="sapo-mini-badge">Verifikasi Petugas</span>
                        <span class="sapo-mini-badge">Data Terpusat</span>
                    </div>
                </div>

                <div class="sapo-hero-actions">
                    <a href="/create" class="sapo-btn-primary">
                        Laporkan Sampah Liar
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.6" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>

                    <a href="#katalog-laporan" class="sapo-btn-secondary">
                        Eksplorasi Dokumen ↓
                    </a>
                </div>
            </div>

            <aside class="sapo-side-card">
                <div class="sapo-image-frame">
                    <img
                        src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?q=80&w=900"
                        alt="Sistem Kebersihan"
                    >

                    <div class="sapo-image-overlay"></div>

                    <div class="sapo-image-meta">
                        <span class="sapo-photo-label">Katalog Foto</span>
                        <span class="sapo-live-label">
                            <span class="sapo-live-dot"></span>
                            Live Update
                        </span>
                    </div>
                </div>

                <div class="sapo-side-body">
                    <h3>E-SAPO Data Engine</h3>
                    <p>
                        Platform pemantauan kebersihan wilayah. Data yang masuk akan
                        diproses dan diverifikasi oleh petugas terkait secara bertahap.
                    </p>
                </div>
            </aside>

        </div>
    </section>

    <section class="sapo-container sapo-stats-wrap">
        <div class="sapo-stats">
            <div class="sapo-stat-card">
                <span class="sapo-stat-label">
                    <span class="sapo-stat-icon"></span>
                    Total Laporan
                </span>
                <span id="stat-total" class="sapo-stat-value">0</span>
            </div>

            <div class="sapo-stat-card">
                <span class="sapo-stat-label">
                    <span class="sapo-stat-icon pending"></span>
                    Verifikasi
                </span>
                <span id="stat-pending" class="sapo-stat-value">0</span>
            </div>

            <div class="sapo-stat-card">
                <span class="sapo-stat-label">
                    <span class="sapo-stat-icon proses"></span>
                    Penanganan
                </span>
                <span id="stat-proses" class="sapo-stat-value">0</span>
            </div>

            <div class="sapo-stat-card">
                <span class="sapo-stat-label">
                    <span class="sapo-stat-icon selesai"></span>
                    Selesai Tuntas
                </span>
                <span id="stat-selesai" class="sapo-stat-value">0</span>
            </div>
        </div>
    </section>

    <section id="katalog-laporan" class="sapo-container sapo-section">
        <div class="sapo-section-head">
            <div>
                <p class="sapo-kicker">Aktivitas Terbaru</p>
                <h2 class="sapo-section-title">Daftar Aduan Masuk Dari Masyarakat</h2>
            </div>

            <p class="sapo-section-note">
                Semua laporan masyarakat ditampilkan sebagai arsip publik untuk membantu
                proses pemantauan wilayah.
            </p>
        </div>

        <div id="container-pengaduan" class="sapo-grid">
            @for ($i = 0; $i < 3; $i++)
                <div class="sapo-skeleton">
                    <div class="sapo-skeleton-img"></div>
                    <div class="sapo-skeleton-body">
                        <div class="sapo-skeleton-line sm"></div>
                        <div class="sapo-skeleton-line md"></div>
                        <div class="sapo-skeleton-line lg"></div>
                        <div class="sapo-skeleton-line lg"></div>
                    </div>
                </div>
            @endfor
        </div>
    </section>
</div>

<div class="max-w-6xl mx-auto px-4">
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container   = document.getElementById('container-pengaduan');
    const statTotal   = document.getElementById('stat-total');
    const statPending = document.getElementById('stat-pending');
    const statProses  = document.getElementById('stat-proses');
    const statSelesai = document.getElementById('stat-selesai');

    const safeText = (value, fallback = '-') => {
        if (value === null || value === undefined || value === '') return fallback;
        return String(value);
    };

    const getStatusClass = (status) => {
        if (status === 'proses')  return 'proses';
        if (status === 'selesai') return 'selesai';
        return 'pending';
    };

    // Fetch stats dan list pengaduan secara paralel
    Promise.all([
        fetch('/api/pengaduan/stats', { headers: { 'Accept': 'application/json' } }).then(r => r.json()),
        fetch('/api/pengaduan',       { headers: { 'Accept': 'application/json' } }).then(r => r.json()),
    ])
    .then(([stats, data]) => {
        // Isi stats dari endpoint dedicated — akurat meski data dipaginasi nanti
        statTotal.innerText   = stats.total   ?? 0;
        statPending.innerText = stats.pending ?? 0;
        statProses.innerText  = stats.proses  ?? 0;
        statSelesai.innerText = stats.selesai ?? 0;

        container.innerHTML = '';

        if (!Array.isArray(data) || data.length === 0) {
            container.innerHTML = `
                <div class="sapo-empty">
                    <div>
                        <div class="sapo-empty-icon">🍃</div>
                        <h3>Kondisi Lingkungan Bersih</h3>
                        <p>Belum ada aduan penumpukan sampah liar yang masuk.
                        Mari jaga lingkungan sekitar agar tetap bersih dan nyaman.</p>
                    </div>
                </div>`;
            return;
        }

        data.forEach(item => {
            const statusClass = getStatusClass(item.status);
            const imgUrl = item.foto
                ? `/storage/${item.foto}`
                : 'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?q=80&w=900';

            const userName = item.user ? safeText(item.user.name, 'Masyarakat') : 'Masyarakat';
            const initial  = userName.charAt(0).toUpperCase();
            const desaName = item.desa ? safeText(item.desa.nama_desa, 'Sektor Umum') : 'Sektor Umum';
            const rt       = item.rtrw ? safeText(item.rtrw.rt) : '-';
            const rw       = item.rtrw ? safeText(item.rtrw.rw) : '-';

            container.insertAdjacentHTML('beforeend', `
                <article class="sapo-report-card">
                    <div class="sapo-report-image">
                        <img src="${imgUrl}" alt="Bukti Laporan Lapangan">
                        <span class="sapo-status ${statusClass}">${safeText(item.status, 'pending')}</span>
                    </div>
                    <div class="sapo-report-body">
                        <div class="sapo-location">
                            <span>📍</span>
                            <span>${desaName} • RT ${rt}/RW ${rw}</span>
                        </div>
                        <h3 class="sapo-report-title">${safeText(item.lokasi_spesifik, 'Lokasi belum tersedia')}</h3>
                        <p class="sapo-report-desc">${safeText(item.deskripsi, 'Tidak ada deskripsi tambahan.')}</p>
                        <div class="sapo-report-footer">
                            <div class="sapo-user">
                                <div class="sapo-avatar">${initial}</div>
                                <div class="sapo-user-text">
                                    <span class="sapo-user-label">Pelapor</span>
                                    <span class="sapo-user-name">${userName}</span>
                                </div>
                            </div>
                            <a href="/show/${item.id}" class="sapo-detail-link">
                                Detail
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.6" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            `);
        });
    })
    .catch(err => {
        console.error('Error:', err);
        container.innerHTML = `
            <div class="sapo-empty">
                <div>
                    <div class="sapo-empty-icon">⚠️</div>
                    <h3>Data Gagal Dimuat</h3>
                    <p>Terjadi masalah saat mengambil data laporan. Cek koneksi atau response API.</p>
                </div>
            </div>`;
    });
});
</script>
@endpush