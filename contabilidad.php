<?php
// Rutas de los enlaces principales que se usarán en los botones
$linkTransparencia = 'https://www.plataformadetransparencia.org.mx/Inicio';
$linkContabilidad = 'contabilidad.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOAPAS Rincon de Romos | Transparencia</title>
    <style>
        /* ==========================================================================
           IMPORTACIÓN DE FUENTES GOTHAM (.OTF)
           ========================================================================== */
        
        /* Gotham Regular para textos generales */
        @font-face {
            font-family: 'Gotham';
            src: url('assets/fonts/Gotham-Book.otf') format('opentype');
            font-weight: 400;
            font-style: normal;
        }

        /* Gotham Black para los títulos */
        @font-face {
            font-family: 'Gotham Black';
            src: url('assets/fonts/Gotham-Black.otf') format('opentype');
            font-weight: 900;
            font-style: normal;
        }

        /* Variables de colores globales. Al modificar un color aquí, se actualiza en todo el sitio web automáticamente. DANA */
        :root {
            --azul-institucional: #004370;
            --azul-claro: #74c8e1;
            --guindo: #9b2743;
            --guindo-oscuro: #64242e;
            --dorado: #b98e55;
            --dorado-claro: #f4daa8;
            --gris: #c5c5c5;
            --blanco: #ffffff;
            --tinta: #1e2630;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Gotham', Arial, Helvetica, sans-serif; /* ← ACTUALIZADO */
            color: var(--tinta);
            background: var(--blanco);
        }

        /* Aplicar Gotham Black a todos los títulos del sitio automáticamente */
        #intro-overlay {
            position: fixed;
            inset: 0;
            z-index: 3000;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .bloque {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 3000;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: moverDerecha 1.7s forwards;
            pointer-events: none;
        }

        .bloque:nth-child(1) { background: rgba(240,128,128,1); animation-delay: 1.5s; }
        .bloque:nth-child(2) { background: rgba(205,92,92,1); animation-delay: 1.1s; }
        .bloque:nth-child(3) { background: rgba(165,42,60,1); animation-delay: 0.8s; }
        .bloque:nth-child(4) { background: rgba(139,30,45,1); animation-delay: 0.5s; }

        @keyframes moverDerecha {
            from { transform: translateX(0); }
            to { transform: translateX(150%); }
        }

        .giroEje {
            width: 180px;
            transform-style: preserve-3d;
            animation: girarEje 3s linear infinite;
        }

        @keyframes girarEje {
            from { transform: rotateY(0deg); }
            to { transform: rotateY(360deg); }
        }

        h1, h2, h3 {
            font-family: 'Gotham Black', Arial, Helvetica, sans-serif; /* ← NUEVO */
            font-weight: 900;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* Estructura de la barra de navegación superior JORGE*/
        .topbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            border-bottom: 3px solid var(--dorado);
            background-color: var(--guindo);
            background-image: url("assets/noma.png");
            background-repeat: repeat;
            background-size: 450px 130px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.22);
        }

        .header-banner {
            width: 100%;
            padding: 0;
            background: var(--guindo-oscuro);
            line-height: 0;
        }

        .header-banner img {
            display: block;
            width: 100%;
            height: auto;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            width: min(1180px, calc(100% - 32px));
            min-height: 104px;
            margin: 0 auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
        }

        .brand-logos {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 0 0 auto;
        }

        .logo-badge {
            display: grid;
            place-items: center;
            width: 74px;
            height: 74px;
            border: 2px solid var(--dorado);
            border-radius: 50%;
            background: var(--blanco);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.18);
            overflow: hidden;
        }

        .logo-badge.rincon {
            width: 118px;
            border-radius: 999px;
            padding: 8px;
        }

        .logo-badge img {
            display: block;
            max-width: 86%;
            max-height: 86%;
            object-fit: contain;
        }

        .logo-badge.rincon img {
            max-width: 100%;
            max-height: 100%;
        }

        .brand-text {
            min-width: 0;
        }

        .brand-title {
            margin: 0;
            color: var(--blanco);
            font-size: clamp(1rem, 2vw, 1.45rem);
            font-weight: 800;
            line-height: 1.15;
        }

        .brand-subtitle {
            margin: 4px 0 0;
            color: var(--dorado-claro);
            font-size: 0.86rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: nowrap;
        }

        /* Estilos base para los botones del menú superior y preparación para su animación JORGE*/
        .nav-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 46px;
            padding: 0 18px 0 14px;
            border: 1px solid rgba(244, 218, 168, 0.72);
            border-radius: 999px;
            color: var(--blanco);
            font-size: 0.88rem;
            font-weight: 800;
            text-transform: uppercase;
            white-space: nowrap;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.16), 0 10px 22px rgba(54, 14, 26, 0.24);
            will-change: transform;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease, border-color 180ms ease;
        }

        .nav-button img {
            width: 24px;
            height: 24px;
            padding: 4px;
            border-radius: 50%;
            background: var(--blanco);
            object-fit: contain;
        }

        /* Animación hover: efecto de elevación y crecimiento al pasar el cursor JORGE       */
        .nav-button:hover,
        .nav-button:focus-visible {
            transform: translateY(-2px);
            border-color: var(--dorado-claro);
            background: rgba(185, 142, 85, 0.28);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.22), 0 14px 28px rgba(54, 14, 26, 0.3);
            outline: none;
        }

        /* Colores de fondo específicos para cada botón DANA*/
        .nav-button.transparencia {
            background: rgba(100, 36, 46, 0.72);
        }

        .nav-button.contabilidad {
            background: rgba(100, 36, 46, 0.72);
        }

        /* Sección principal (Hero banner) - ACTUALIZADO CON TEXTURA Y GRADIENTE CONTRAPUESTO */
        .hero {
            display: grid;
            align-items: center;
            min-height: calc(100vh - 104px);
            padding: 54px 16px;
            /* Se añade el degradado que se funde a blanco para legibilidad y la imagen de tus assets */
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.96) 55%, rgba(116, 200, 225, 0.18) 100%), 
                        url("assets/manual_p1_img1.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* Forma decorativa adicional sutil en el fondo del hero */
        .hero::before {
            content: "";
            position: absolute;
            top: 10%;
            right: 5%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(185, 142, 85, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-inner {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(280px, 0.8fr);
            gap: 34px;
            width: min(1180px, 100%);
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            align-self: center;
            color: var(--tinta);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            min-height: 34px;
            padding: 0 12px;
            border-left: 4px solid var(--dorado);
            color: var(--guindo-oscuro);
            font-size: 0.9rem;
            font-weight: 800;
            text-transform: uppercase;
            background: rgba(185, 142, 85, 0.14);
        }

        /* h1 - ACTUALIZADO CON NUEVA JERARQUÍA TIPOGRÁFICA */
        h1 {
            max-width: 760px;
            margin: 20px 0 18px;
            font-size: clamp(2.1rem, 6vw, 4.6rem);
            line-height: 1.05;
            letter-spacing: -0.02em;
            color: var(--guindo-oscuro);
        }

        /* Clase de realce para la palabra OOAPAS en dorado institucional */
        h1 .highlight {
            color: var(--dorado);
            display: inline-block;
            font-weight: 900;
        }

        .hero-content p {
            max-width: 660px;
            margin: 0;
            color: #47515d;
            font-size: clamp(1rem, 2vw, 1.22rem);
            line-height: 1.7;
        }

        .panel {
            align-self: stretch;
            display: grid;
            align-content: center;
            gap: 14px;
            padding: 28px;
            border: 1px solid rgba(185, 142, 85, 0.62);
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 18px 48px rgba(0, 67, 112, 0.12);
        }

        .panel h2 {
            margin: 0;
            color: var(--guindo-oscuro);
            font-size: 1.45rem;
            line-height: 1.25;
        }

        .panel p {
            margin: 0;
            color: #47515d;
            line-height: 1.6;
        }

        .quick-links {
            display: grid;
            gap: 10px;
            margin-top: 8px;
        }

        /* yo saul hice esto: relleno del espacio vacío del panel */
        .panel-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 4px;
        }

        .panel-metric {
            min-height: 78px;
            padding: 12px 10px;
            border: 1px solid rgba(185, 142, 85, 0.24);
            border-radius: 12px;
            background: linear-gradient(180deg, rgba(244, 218, 168, 0.18), rgba(255, 255, 255, 0.96));
            text-align: center;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }

        .panel-metric strong {
            display: block;
            color: var(--guindo-oscuro);
            font-size: 1.05rem;
            line-height: 1.1;
        }

        .panel-metric span {
            display: block;
            margin-top: 6px;
            color: #5f6874;
            font-size: 0.8rem;
            line-height: 1.25;
        }

        /* yo aron hice esto: botón de regreso */
        .panel-action {
            display: flex;
            justify-content: flex-start;
            margin-top: 4px;
        }

        .panel-back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 16px;
            border: 1px solid rgba(0, 67, 112, 0.24);
            border-radius: 999px;
            color: var(--guindo-oscuro);
            font-size: 0.92rem;
            font-weight: 800;
            background: rgba(255, 255, 255, 0.92);
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        }

        .panel-back-link:hover,
        .panel-back-link:focus-visible {
            transform: translateY(-2px);
            border-color: var(--dorado);
            box-shadow: 0 12px 24px rgba(0, 67, 112, 0.12);
            outline: none;
        }

        /* Estilos base y preparación de animación para los enlaces rápidos con flechas */
        .quick-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-height: 58px;
            padding: 0 14px;
            border: 1px solid rgba(185, 142, 85, 0.58);
            border-left: 5px solid var(--dorado);
            border-radius: 8px;
            color: var(--guindo-oscuro);
            font-weight: 800;
            background: linear-gradient(90deg, rgba(244, 218, 168, 0.18), #fff 42%);
            will-change: transform;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease, background 180ms ease;
        }

        /* Animación hover: efecto de elevación y cambio a borde dorado (INFORMACION DE EMPRESA) JORGE*/
        .quick-link:hover,
        .quick-link:focus-visible {
            transform: translateY(-2px);
            border-color: var(--dorado);
            background: linear-gradient(90deg, rgba(244, 218, 168, 0.3), #fff 45%);
            box-shadow: 0 12px 24px rgba(100, 36, 46, 0.12);
            outline: none;
        }

        .quick-link-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .quick-link-icon {
            display: block;
            width: 34px;
            height: 34px;
            padding: 5px;
            flex: 0 0 auto;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 6px 16px rgba(0, 67, 112, 0.1);
            object-fit: contain;
        }

        .quick-link-arrow {
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            flex: 0 0 auto;
            border-radius: 50%;
            color: var(--blanco);
            background: var(--dorado);
        }

        /* Secciones de contenido general */
        .content-section {
            padding: 24px 16px 64px;
            background: var(--blanco);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        /* Estilos base y preparación de animación para las tarjetas de información JORGE*/
        .info-card {
            min-height: 220px;
            padding: 28px;
            border: 1px solid rgba(185, 142, 85, 0.68);
            border-top: 5px solid var(--guindo);
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 16px 38px rgba(0, 67, 112, 0.1);
            will-change: transform;
            transition: transform 200ms ease, box-shadow 200ms ease, border-color 200ms ease;
        }

        /* Animación hover: elevación notoria de la tarjeta al pasar el mouse JORGE*/
        .info-card:hover {
            transform: translateY(-6px) scale(1.01);
            border-color: rgba(185, 142, 85, 0.95);
            box-shadow: 0 22px 48px rgba(0, 67, 112, 0.16);
        }

        .info-card h2 {
            margin: 0 0 14px;
            color: var(--guindo-oscuro);
            font-size: 1.55rem;
            line-height: 1.2;
        }

        .info-card p {
            margin: 0;
            color: #47515d;
            font-size: 1rem;
            line-height: 1.75;
        }

        .section-heading {
            width: min(1180px, 100%);
            margin: 0 auto 22px;
        }

        .section-heading h2 {
            margin: 0;
            color: var(--guindo-oscuro);
            font-size: clamp(1.7rem, 3vw, 2.4rem);
            line-height: 1.15;
        }

        .section-heading p {
            max-width: 720px;
            margin: 8px 0 0;
            color: #5f6874;
            line-height: 1.6;
        }

        /* realizado por ingrit - acomodo visual de tarjetas: 3 arriba y 2 abajo más anchas */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 22px;
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        .feature-card {
            position: relative;
            grid-column: span 2;
            min-height: 300px;
            overflow: hidden;
        }

        .feature-card.lgcg,
        .feature-card.transparencia-card {
            grid-column: span 3;
        }

        /* Línea inferior decorativa con degradado multicolor para las tarjetas JORGE*/
        .feature-card::after {
            content: "";
            position: absolute;
            inset: auto 0 0;
            height: 5px;
            background: linear-gradient(90deg, var(--guindo), var(--dorado), var(--azul-institucional));
        }

        .feature-icon {
            display: grid;
            place-items: center;
            width: 66px;
            height: 66px;
            margin-bottom: 18px;
            padding: 10px;
            border: 2px solid var(--dorado);
            border-radius: 50%;
            background: var(--blanco);
            box-shadow: 0 10px 22px rgba(0, 67, 112, 0.12);
        }

        .feature-icon img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Asignación de colores en los bordes para los diferentes iconos JORGE DANA*/
        .feature-card.normativo .feature-icon {
            border-color: rgba(0, 67, 112, 0.42);
        }

        .feature-card.cuenta .feature-icon {
            border-color: rgba(185, 142, 85, 0.72);
        }

        .feature-card.transparencia-card .feature-icon {
            border-color: rgba(155, 39, 67, 0.52);
        }

        /* yo aron hice esto: bloque de regreso al final */
        .return-strip {
            width: min(1180px, 100%);
            margin: 28px auto 0;
            padding: 20px 22px;
            border: 1px solid rgba(185, 142, 85, 0.4);
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.94), rgba(244, 218, 168, 0.24));
            box-shadow: 0 16px 34px rgba(0, 67, 112, 0.08);
        }

        .return-strip-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        .return-strip h2 {
            margin: 0;
            color: var(--guindo-oscuro);
            font-size: 1.2rem;
            line-height: 1.2;
        }

        .return-strip p {
            margin: 4px 0 0;
            color: #5f6874;
            line-height: 1.5;
        }

        .return-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 18px;
            border-radius: 999px;
            color: var(--blanco);
            font-weight: 800;
            background: linear-gradient(135deg, var(--guindo-oscuro), var(--azul-institucional));
            box-shadow: 0 14px 28px rgba(100, 36, 46, 0.18);
            transition: transform 180ms ease, box-shadow 180ms ease;
        }

        .return-button:hover,
        .return-button:focus-visible {
            transform: translateY(-2px);
            box-shadow: 0 18px 32px rgba(0, 67, 112, 0.2);
            outline: none;
        }

        /* Estructura del pie de página (Footer) - Mejoras visuales realizadas por Jorge */
        .site-footer {
            position: relative;
            overflow: hidden;
            padding: 52px 16px 30px;
            color: var(--blanco);
            background:
                radial-gradient(circle at top right, rgba(244, 218, 168, 0.18), transparent 28%),
                radial-gradient(circle at bottom left, rgba(116, 200, 225, 0.14), transparent 24%),
                linear-gradient(135deg, #4d1821 0%, var(--guindo-oscuro) 45%, var(--guindo) 100%);
            border-top: 4px solid var(--dorado);
        }

        .site-footer::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.07) 1px, transparent 1px);
            background-size: 28px 28px;
            opacity: 0.18;
            pointer-events: none;
        }

        .footer-inner {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
            gap: 22px;
            width: min(1180px, 100%);
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .footer-block {
            padding: 22px 22px 20px;
            border: 1px solid rgba(244, 218, 168, 0.18);
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.03));
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);
            backdrop-filter: blur(6px);
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 18px;
            padding-bottom: 18px;
            margin-bottom: 18px;
            border-bottom: 1px solid rgba(244, 218, 168, 0.22);
        }

        .footer-logo {
            display: grid;
            place-items: center;
            width: 78px;
            height: 78px;
            flex: 0 0 auto;
            border: 2px solid var(--dorado);
            border-radius: 50%;
            background: var(--blanco);
            overflow: hidden;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.18);
        }

        .footer-logo img {
            display: block;
            max-width: 86%;
            max-height: 86%;
            object-fit: contain;
        }

        .footer-brand h2 {
            margin: 0;
            font-size: 1.62rem;
            line-height: 1.2;
        }

        .footer-brand p {
            margin: 8px 0 0;
            color: var(--dorado-claro);
            font-weight: 700;
            line-height: 1.4;
        }

        .footer-block h3 {
            margin: 0 0 16px;
            color: var(--dorado-claro);
            font-size: 1.02rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .footer-list {
            display: grid;
            gap: 13px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .footer-list.compact {
            margin-top: 0;
        }

        .footer-list li {
            display: flex;
            gap: 12px;
            line-height: 1.55;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-list li:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .contact-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 4px 0;
            transition: transform 180ms ease, color 180ms ease, opacity 180ms ease;
        }

        .contact-link:hover,
        .contact-link:focus-visible {
            transform: translateX(3px);
            opacity: 0.98;
        }

        .contact-icon {
            width: 20px;
            height: 20px;
            flex: 0 0 auto;
            display: inline-block;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        .contact-icon.gmail {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Crect width='24' height='24' rx='4' fill='none'/%3E%3Cpath d='M4 6h16v12H4z' fill='%23fff'/%3E%3Cpath d='M4 7l8 6 8-6' fill='none' stroke='%23EA4335' stroke-width='2'/%3E%3Cpath d='M4 7l8 6 8-6' fill='none' stroke='%234285F4' stroke-width='2' stroke-dasharray='0 8'/%3E%3Cpath d='M4 7l8 6 8-6' fill='none' stroke='%23FBBC05' stroke-width='2' stroke-dasharray='8 8'/%3E%3Cpath d='M4 7l8 6 8-6' fill='none' stroke='%23EA4335' stroke-width='2' stroke-dashoffset='16' stroke-dasharray='8 8'/%3E%3C/svg%3E");
        }

        .contact-icon.facebook {
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.96);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Crect width='24' height='24' rx='4' fill='none'/%3E%3Cpath d='M14 8h2V5h-2c-2.2 0-4 1.8-4 4v2H8v3h2v5h3v-5h2.3l.7-3H13V9c0-.6.4-1 1-1z' fill='%231877F2'/%3E%3C/svg%3E");
        }

        .contact-icon.whatsapp {
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.96);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Ccircle cx='12' cy='12' r='10' fill='%2325D366'/%3E%3Cpath d='M9.2 7.8c.2-.5.5-.5.8-.5h.7c.2 0 .5.1.7.6l1 2.2c.1.3.1.6-.1.8l-.7.9c.7 1.3 1.8 2.3 3.1 3l.9-.7c.2-.2.5-.2.8-.1l2.2 1c.5.2.6.5.6.7v.7c0 .3 0 .6-.5.8-.5.3-1.2.5-2 .5-4.6 0-8.4-3.8-8.4-8.4 0-.8.2-1.5.5-2z' fill='%23fff'/%3E%3C/svg%3E");
        }

        .contact-icon.phone {
            border-radius: 4px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M7.4 4.5c.4-.4 1-.4 1.4 0l1.6 1.6c.4.4.4 1 0 1.4l-1 1c-.2.2-.3.5-.2.8.5 1.4 1.3 2.6 2.4 3.7 1.1 1.1 2.3 1.9 3.7 2.4.3.1.6 0 .8-.2l1-1c.4-.4 1-.4 1.4 0l1.6 1.6c.4.4.4 1 0 1.4l-1.2 1.2c-.7.7-1.8 1-2.8.8-2.7-.5-5.2-1.9-7.1-3.8s-3.3-4.4-3.8-7.1c-.2-1 .1-2.1.8-2.8L7.4 4.5z' fill='%23ffffff'/%3E%3C/svg%3E");
        }

        .footer-label {
            min-width: 88px;
            color: var(--dorado-claro);
            font-weight: 800;
            letter-spacing: 0.02em;
        }

        /* Estilo para los enlaces de contacto y redes en el footer JORGE Y DANA */
        .site-footer a {
            color: var(--blanco);
            font-weight: 800;
            text-decoration: underline;
            text-decoration-color: rgba(244, 218, 168, 0.78);
            text-underline-offset: 4px;
        }

        .footer-bottom {
            width: min(1180px, 100%);
            margin: 24px auto 0;
            padding-top: 18px;
            border-top: 1px solid rgba(244, 218, 168, 0.28);
            color: rgba(255, 255, 255, 0.84);
            font-size: 0.92rem;
            text-align: center;
            position: relative;
            z-index: 1;
            letter-spacing: 0.02em;
        }

        .footer-bottom strong {
            color: var(--dorado-claro);
        }

        /* Sección de video promocional - NUEVA SECCIÓN */
        .video-section {
            width: 100%;
            height: 500px;
            overflow: hidden;
            background: var(--guindo-oscuro);
        }

        .video-section video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* realizado por ingrit - ajuste responsivo del acomodo visual de tarjetas */
        @media (max-width: 980px) {
            .hero-inner,
            .footer-inner {
                grid-template-columns: 1fr;
            }

            .feature-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .feature-card,
            .feature-card.lgcg,
            .feature-card.transparencia-card {
                grid-column: auto;
            }
        }

        /* Reglas de diseño responsivo para adaptar el layout en dispositivos móviles */
        @media (max-width: 780px) {
            .nav {
                align-items: flex-start;
                flex-direction: column;
                padding: 16px 0;
            }

            .brand {
                align-items: flex-start;
            }

            .brand-logos {
                gap: 8px;
            }

            .logo-badge {
                width: 58px;
                height: 58px;
            }

            .logo-badge.rincon {
                width: 92px;
            }

            .nav-actions {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                width: 100%;
                justify-content: stretch;
            }

            .nav-button {
                min-width: 0;
                padding: 0 10px;
                font-size: 0.76rem;
                gap: 6px;
            }

            .nav-button img {
                width: 21px;
                height: 21px;
                padding: 3px;
            }

            .hero {
                min-height: auto;
                padding-top: 36px;
                background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 60%, rgba(116, 200, 225, 0.2) 100%), 
                            url("assets/manual_p1_img1.png");
            }

            .hero-inner {
                grid-template-columns: 1fr;
            }

            .panel {
                padding: 22px;
            }

            .panel-metrics {
                grid-template-columns: 1fr;
            }

            .return-strip {
                padding: 18px;
            }

            .return-strip-inner {
                align-items: flex-start;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .info-card {
                padding: 22px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .footer-inner {
                grid-template-columns: 1fr;
            }

            .footer-brand {
                align-items: flex-start;
            }

            .footer-list li {
                flex-direction: column;
                gap: 2px;
            }

            .footer-label {
                min-width: 0;
            }
        }
    </style>
</head>
<body>
    <div id="intro-overlay" aria-hidden="true">
        <div class="bloque bloque1"></div>
        <div class="bloque bloque2"></div>
        <div class="bloque bloque3"></div>
        <div class="bloque bloque4">
            <img src="assets/logo-ooapas.png" alt="OOAPAS" class="giroEje">
        </div>
    </div>

    <div class="header-banner" aria-label="OOAPAS Transparencia">
        <img src="assets/fondo.jpeg" alt="OOAPAS Transparencia">
    </div>

    <header class="topbar">
        <nav class="nav" aria-label="Navegacion principal">
 <!-- Ajuste de direccion a pagina de minicipio- sección ajustada por Emiliano -->
            <div class="brand" aria-label="OOAPAS Rincon de Romos">
    <span class="brand-logos">
        <a class="logo-badge ooapas" href="index.php" aria-label="Inicio OOAPAS Rincon de Romos">
            <img src="assets/logo-ooapas.png" alt="">
        </a>

        <a class="logo-badge rincon" href="https://rinconderomos.gob.mx" aria-label="Ir a la pagina de Presidencia">
            <img src="assets/logo-rincon.png" alt="">
        </a>
    </span>
                <span class="brand-text">
                    <span class="brand-title">OOAPAS Rincon de Romos</span>
                    <span class="brand-subtitle">Organismo operador de agua</span>
                </span>
            </a>

            <div class="nav-actions">
                <a class="nav-button transparencia" href="<?php echo htmlspecialchars($linkTransparencia, ENT_QUOTES, 'UTF-8'); ?>">
                    <img src="assets/icons/transparencia.svg" alt="">
                    Transparencia
                </a>
                <a class="nav-button contabilidad" href="<?php echo htmlspecialchars($linkContabilidad, ENT_QUOTES, 'UTF-8'); ?>">
                    <img src="assets/icons/cuenta-publica.svg" alt="">
                    Contabilidad
                </a>
            </div>
        </nav>
    </header>

    <section class="video-section" aria-label="Video promocional">
        <video autoplay loop muted playsinline controls preload="metadata">
            <source src="assets/0604.mp4" type="video/mp4">
            Tu navegador no soporta videos HTML5.
        </video>
    </section>

    <main class="hero">
        <section class="hero-inner" aria-label="Portal de transparencia">
            <div class="hero-content">
                <span class="eyebrow">Portal institucional</span>
                <h1>Transparencia <span class="highlight">OOAPAS</span></h1>
                <p>
                    Informacion publica del Organismo Operador de Agua Potable,
                    Alcantarillado y Saneamiento de Rincon de Romos.
                </p>
            </div>

            <aside class="panel" id="accesos-principales" aria-label="Accesos principales">
                <h2>Accesos principales</h2>
                <p>Consulta los apartados institucionales de transparencia y contabilidad.</p>
                <div class="quick-links">
                    <a class="quick-link" href="<?php echo htmlspecialchars($linkTransparencia, ENT_QUOTES, 'UTF-8'); ?>">
                        <span class="quick-link-label">
                            <img class="quick-link-icon" src="assets/icons/transparencia.svg" alt="">
                            Transparencia
                        </span>
                        <span class="quick-link-arrow" aria-hidden="true">&gt;</span>
                    </a>
                    <a class="quick-link" href="<?php echo htmlspecialchars($linkContabilidad, ENT_QUOTES, 'UTF-8'); ?>">
                        <span class="quick-link-label">
                            <img class="quick-link-icon" src="assets/icons/cuenta-publica.svg" alt="">
                            Contabilidad
                        </span>
                        <span class="quick-link-arrow" aria-hidden="true">&gt;</span>
                    </a>
                </div>
                <!-- yo saul hice esto: se rellena el espacio vacío del panel -->
                <div class="panel-metrics" aria-label="Datos destacados">
                    <div class="panel-metric">
                        <strong>24/7</strong>
                        <span>Consulta pública activa</span>
                    </div>
                    <div class="panel-metric">
                        <strong>2</strong>
                        <span>Accesos institucionales</span>
                    </div>
                    <div class="panel-metric">
                        <strong>OOAPAS</strong>
                        <span>Rincón de Romos</span>
                    </div>
                </div>
                <div class="panel-action">
                    <a class="panel-back-link" href="#informacion-institucional">Ver la información institucional</a>
                </div>
            </aside>
        </section>
    </main>

    <section class="content-section" aria-label="Mision y vision institucional">
        <div class="info-grid">
            <article class="info-card">
                <h2>Misión</h2>
                <p>
                    Brindar servicios de agua potable, alcantarillado y saneamiento de manera
                    eficiente, continua y de calidad a los habitantes de Rincón de Romos,
                    garantizando el uso responsable y sustentable de los recursos hídricos,
                    con transparencia, responsabilidad social and compromiso con el bienestar
                    de la comunidad.
                </p>
            </article>

            <article class="info-card">
                <h2>Visión</h2>
                <p>
                    Ser un organismo reconocido por su excelencia en la administración y
                    prestación de los servicios de agua potable, alcantarillado y saneamiento,
                    mediante la innovación, la mejora continua y el desarrollo sustentable,
                    contribuyendo al progreso y la calidad de vida de los habitantes de
                    Rincón de Romos.
                </p>
            </article>
        </div>
    </section>

    <section class="content-section" id="informacion-institucional" aria-label="Informacion institucional">
        <div class="section-heading">
            <h2>Información institucional</h2>
            <p>Conoce los fundamentos, documentos y principios que guían el trabajo del organismo.</p>
        </div>

        <div class="feature-grid">
            <article class="info-card feature-card quienes">
                <span class="feature-icon" aria-hidden="true">
                    <img src="assets/icons/quienes-somos.svg" alt="">
                </span>
                <h2>¿Quiénes Somos?</h2>
                <p>
                    El Organismo Operador de Agua Potable, Alcantarillado y Saneamiento
                    (OOAPAS) de Rincón de Romos es una entidad pública encargada de
                    administrar, operar y mantener los servicios de agua potable,
                    alcantarillado y saneamiento en el municipio. Nuestro compromiso es
                    garantizar un servicio eficiente, continuo y de calidad para contribuir
                    al bienestar y desarrollo de la población.
                </p>
            </article>

            <article class="info-card feature-card normativo">
                <span class="feature-icon" aria-hidden="true">
                    <img src="assets/icons/marco-normativo.svg" alt="">
                </span>
                <h2>Marco Normativo</h2>
                <p>
                    El OOAPAS desarrolla sus actividades con fundamento en la Constitución
                    Política de los Estados Unidos Mexicanos, la legislación estatal y
                    municipal aplicable, así como en las disposiciones que regulan la
                    administración pública, la gestión del agua, la transparencia y la
                    rendición de cuentas. Estas normas establecen los derechos y
                    obligaciones para la correcta prestación de los servicios públicos a
                    cargo del organismo.
                </p>
            </article>

            <article class="info-card feature-card cuenta">
                <span class="feature-icon" aria-hidden="true">
                    <img src="assets/icons/cuenta-publica.svg" alt="">
                </span>
                <h2>Cuenta Pública</h2>
                <p>
                    La Cuenta Pública es el informe mediante el cual el organismo presenta
                    los resultados de la gestión financiera y presupuestal realizada durante
                    un ejercicio fiscal. Este documento permite conocer el origen,
                    administración y destino de los recursos públicos, fortaleciendo la
                    transparencia y la rendición de cuentas ante la ciudadanía.
                </p>
            </article>

            <article class="info-card feature-card lgcg">
                <span class="feature-icon" aria-hidden="true">
                    <img src="assets/icons/ley-general-contabilidad.svg" alt="">
                </span>
                <h2>Ley General de Contabilidad Gubernamental</h2>
                <p>
                    La Ley General de Contabilidad Gubernamental tiene como objetivo
                    establecer los criterios generales que rigen la contabilidad y la
                    emisión de información financiera de los entes públicos. Su finalidad es
                    garantizar la armonización contable, la transparencia en el manejo de los
                    recursos públicos y la generación de información confiable, comparable y
                    oportuna para la toma de decisiones.
                </p>
            </article>

            <article class="info-card feature-card transparencia-card">
                <span class="feature-icon" aria-hidden="true">
                    <img src="assets/icons/transparencia.svg" alt="">
                </span>
                <h2>Transparencia</h2>
                <p>
                    La transparencia es el compromiso institucional de poner a disposición
                    de la ciudadanía información clara, accesible y actualizada sobre las
                    actividades, recursos, programas y resultados del organismo. A través de
                    este principio se fortalece la confianza pública, la rendición de cuentas
                    y la participación ciudadana en la gestión de los servicios de agua
                    potable, alcantarillado y saneamiento.
                </p>
            </article>
        </div>

        <!-- yo aron hice esto: botón de regreso -->
        <div class="return-strip" aria-label="Regreso a accesos principales">
            <div class="return-strip-inner">
                <div>
                    <h2>¿Listo para volver a los accesos principales?</h2>
                    <p>Regresa al bloque de transparencia y contabilidad con un solo clic.</p>
                </div>
                <a class="return-button" href="#accesos-principales">Volver a transparencia y contabilidad</a>
            </div>
        </div>
    </section>

    <!-- Footer principal - mejoras visuales realizadas por Jorge -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-block">
                <div class="footer-brand">
                    <span class="footer-logo" aria-hidden="true">
                        <img src="assets/logo-ooapas.png" alt="">
                    </span>
                    <div>
                        <h2>OOAPAS Rincón de Romos</h2>
                        <p>Organismo Operador de Agua Potable, Alcantarillado y Saneamiento</p>
                    </div>
                </div>

                <ul class="footer-list">
                    <li>
                        <span class="footer-label">Dirección</span>
                        <span>Zaragoza esquina Primo Verdad, Rincón de Romos Centro, Rincón de Romos, México.</span>
                    </li>
                    <li>
                        <span class="footer-label">Sitio web</span>
                        <a href="https://ooapasrincon.com" target="_blank" rel="noopener noreferrer">ooapasrincon.com</a>
                    </li>
                    <li>
                        <span class="footer-label">Facebook</span>
                        <a class="contact-link" href="https://www.facebook.com/share/1B8T9VWV6k/" target="_blank" rel="noopener noreferrer">
                            <span class="contact-icon facebook" aria-hidden="true"></span>
                            <span>Ooapas Rincón de Romos</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Bloque de contacto - ajustes realizados por Jorge -->
            <div class="footer-block">
                <h3>Información de contacto</h3>
                <ul class="footer-list compact">
                    <li>
                        <span class="footer-label">Usuario</span>
                        <span>@OOAPASRINCON</span>
                    </li>
                    <li>
                        <span class="footer-label">Teléfono</span>
                        <a class="contact-link" href="tel:4499408255">
                            <span class="contact-icon phone" aria-hidden="true"></span>
                            <span>449 940 8255</span>
                        </a>
                    </li>
                    <li>
                        <span class="footer-label">Correo</span>
                        <a class="contact-link" href="mailto:info@ooapasrincon.com">
                            <span class="contact-icon gmail" aria-hidden="true"></span>
                            <span>info@ooapasrincon.com</span>
                        </a>
                    </li>
                    <li>
                        <span class="footer-label">WhatsApp</span>
                        <a class="contact-link" href="https://wa.me/5214499408255" target="_blank" rel="noopener noreferrer">
                            <span class="contact-icon whatsapp" aria-hidden="true"></span>
                            <span>+52 1 449 940 8255</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Cierre del footer - sección ajustada por Jorge -->
        <div class="footer-bottom">
            <strong>OOAPAS Rincón de Romos</strong> 2024 - 2027. Transparencia y servicio para la comunidad.
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const last = document.querySelector('.bloque4');
            const overlay = document.getElementById('intro-overlay');

            if (last && overlay) {
                last.addEventListener('animationend', function () {
                    overlay.remove();
                }, { once: true });

                setTimeout(() => {
                    const intro = document.getElementById('intro-overlay');
                    if (intro) intro.remove();
                }, 2200);
            } else if (overlay) {
                overlay.remove();
            }
        });
    </script>
</body>
</html>