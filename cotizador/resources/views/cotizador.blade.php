<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CotizaPro — Calculadora Empresarial</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg:       #05080f;
            --surface:  #0c1120;
            --surface2: #101828;
            --border:   #1e2d47;
            --border2:  #243552;
            --gold:     #c9a84c;
            --gold-lt:  #e8c97a;
            --blue:     #3b82f6;
            --blue-lt:  #60a5fa;
            --text:     #e8edf5;
            --text2:    #94a3b8;
            --text3:    #4a5e7a;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3rem 1.5rem 4rem;
            background-image:
                radial-gradient(ellipse 80% 40% at 50% -10%, rgba(59,130,246,0.12) 0%, transparent 70%),
                radial-gradient(ellipse 50% 30% at 80% 100%, rgba(201,168,76,0.06) 0%, transparent 60%);
        }

        nav {
            width: 100%; max-width: 860px;
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 3.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .nav-brand { display: flex; align-items: center; gap: 0.6rem; }

        .nav-logo {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--blue), #6366f1);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; font-weight: 800; color: #fff;
        }

        .nav-name { font-size: 0.95rem; font-weight: 700; color: var(--text); }

        .nav-badge {
            background: rgba(59,130,246,0.12);
            border: 1px solid rgba(59,130,246,0.25);
            color: var(--blue-lt);
            font-size: 0.65rem; font-weight: 600;
            letter-spacing: 0.08em; text-transform: uppercase;
            padding: 0.3rem 0.75rem; border-radius: 999px;
        }

        .page-header { width: 100%; max-width: 860px; margin-bottom: 2.5rem; }

        .page-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.2rem);
            font-weight: 400; line-height: 1.1;
            color: var(--text); letter-spacing: -0.02em;
        }

        .page-header h1 em { font-style: italic; color: var(--gold-lt); }

        .page-header p {
            margin-top: 0.75rem;
            font-size: 0.95rem; color: var(--text2);
            font-weight: 300; max-width: 480px; line-height: 1.6;
        }

        .layout {
            width: 100%; max-width: 860px;
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 1.5rem;
            align-items: start;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
        }

        .card-title {
            font-size: 0.7rem; font-weight: 600;
            letter-spacing: 0.15em; text-transform: uppercase;
            color: var(--text3);
            margin-bottom: 1.5rem; padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .form-group { display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.25rem; }

        label { font-size: 0.8rem; font-weight: 500; color: var(--text2); }

        input, select {
            background: var(--surface2);
            border: 1px solid var(--border2);
            border-radius: 10px;
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem; font-weight: 400;
            padding: 0.75rem 1rem; width: 100%;
            transition: border-color 0.2s, box-shadow 0.2s;
            -webkit-appearance: none;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }

        input::placeholder { color: var(--text3); }
        select option { background: var(--surface2); }

        .input-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        .btn {
            width: 100%;
            background: linear-gradient(135deg, var(--blue) 0%, #6366f1 100%);
            color: #fff; border: none; border-radius: 10px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem; font-weight: 600;
            padding: 0.9rem 1.5rem; cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
            margin-top: 0.75rem;
            box-shadow: 0 4px 20px rgba(59,130,246,0.25);
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        }

        .btn:hover { opacity: 0.92; box-shadow: 0 6px 28px rgba(59,130,246,0.35); }
        .btn:active { transform: scale(0.98); }
        .btn svg { width: 16px; height: 16px; }

        .errors {
            background: rgba(239,68,68,0.07);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 10px; padding: 0.85rem 1rem;
            margin-bottom: 1.25rem;
            font-size: 0.82rem; color: #f87171;
        }
        .errors ul { padding-left: 1rem; }

        .result-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            position: sticky; top: 2rem;
            animation: fadeUp 0.4s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .result-top {
            background: linear-gradient(135deg, #0f1f3d 0%, #0d1a35 100%);
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .result-top .lbl {
            font-size: 0.65rem; letter-spacing: 0.15em;
            text-transform: uppercase; color: var(--text3);
            font-weight: 600; margin-bottom: 0.5rem;
        }

        .result-top .product {
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem; color: var(--text); line-height: 1.2;
        }

        .result-rows { padding: 1.25rem 1.5rem; }

        .result-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 0.65rem 0;
            border-bottom: 1px solid rgba(30,45,71,0.6);
            font-size: 0.88rem;
        }
        .result-row:last-child { border-bottom: none; }
        .result-row .rl { color: var(--text2); font-weight: 400; }
        .result-row .rv { color: var(--text); font-weight: 600; }

        .result-total {
            display: flex; justify-content: space-between; align-items: center;
            padding: 1.1rem 1.5rem;
            background: linear-gradient(135deg, rgba(201,168,76,0.07), rgba(201,168,76,0.03));
            border-top: 1px solid rgba(201,168,76,0.15);
        }
        .result-total .tl {
            font-size: 0.72rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase; color: var(--text2);
        }
        .result-total .tv {
            font-family: 'DM Serif Display', serif;
            font-size: 1.9rem; color: var(--gold-lt); letter-spacing: -0.02em;
        }

        .empty-card {
            background: var(--surface);
            border: 1px dashed var(--border2);
            border-radius: 16px;
            padding: 2.5rem 1.5rem;
            text-align: center;
            position: sticky; top: 2rem;
        }
        .empty-icon {
            width: 48px; height: 48px;
            background: var(--surface2); border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .empty-icon svg { opacity: 0.35; }
        .empty-card p { font-size: 0.85rem; color: var(--text3); line-height: 1.6; }

        @media (max-width: 700px) {
            .layout { grid-template-columns: 1fr; }
            .result-card, .empty-card { position: static; }
            .input-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-brand">
        <div class="nav-logo">C</div>
        <span class="nav-name">CotizaPro</span>
    </div>
    <span class="nav-badge">Versión Empresarial</span>
</nav>

<div class="page-header">
    <h1>Calculadora de<br><em>Cotización</em></h1>
    <p>Ingresa los datos del producto o servicio y obtén el desglose completo con IVA de forma inmediata.</p>
</div>

<div class="layout">

    <!-- FORMULARIO -->
    <div class="card">
        <p class="card-title">Datos de la cotización</p>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('calcular') }}">
            @csrf

            <div class="form-group">
                <label for="producto">Producto / Servicio</label>
                <input type="text" id="producto" name="producto"
                    placeholder="Ej: Desarrollo de sitio web"
                    value="{{ old('producto', $producto ?? '') }}" required>
            </div>

            <div class="input-row">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad"
                        placeholder="1" min="1" step="0.01"
                        value="{{ old('cantidad', $cantidad ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="precio_unitario">Precio Unitario ($)</label>
                    <input type="number" id="precio_unitario" name="precio_unitario"
                        placeholder="0.00" min="0" step="0.01"
                        value="{{ old('precio_unitario', $precio_unitario ?? '') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="iva">Tarifa de IVA</label>
                <select id="iva" name="iva">
                    <option value="0"  {{ (old('iva', $iva_pct ?? 19) == 0)  ? 'selected' : '' }}>0% — Exento de IVA</option>
                    <option value="5"  {{ (old('iva', $iva_pct ?? 19) == 5)  ? 'selected' : '' }}>5% — Tarifa diferencial</option>
                    <option value="19" {{ (old('iva', $iva_pct ?? 19) == 19) ? 'selected' : '' }}>19% — Tarifa general (Colombia)</option>
                </select>
            </div>

            <button type="submit" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a1 1 0 001-1V6a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1z" />
                </svg>
                Calcular Cotización
            </button>
        </form>
    </div>

    <!-- RESULTADO -->
    @isset($total)
    <div class="result-card">
        <div class="result-top">
            <p class="lbl">Resumen de cotización</p>
            <p class="product">{{ $producto }}</p>
        </div>
        <div class="result-rows">
            <div class="result-row">
                <span class="rl">Cantidad</span>
                <span class="rv">{{ number_format($cantidad, 2) }}</span>
            </div>
            <div class="result-row">
                <span class="rl">Precio unitario</span>
                <span class="rv">$ {{ number_format($precio_unitario, 2) }}</span>
            </div>
            <div class="result-row">
                <span class="rl">Subtotal</span>
                <span class="rv">$ {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="result-row">
                <span class="rl">IVA ({{ $iva_pct }}%)</span>
                <span class="rv">$ {{ number_format($iva, 2) }}</span>
            </div>
        </div>
        <div class="result-total">
            <span class="tl">Total a pagar</span>
            <span class="tv">$ {{ number_format($total, 2) }}</span>
        </div>
    </div>
    @else
    <div class="empty-card">
        <div class="empty-icon">
            <svg width="24" height="24" fill="none" stroke="#94a3b8" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
        </div>
        <p>El resumen de tu cotización<br>aparecerá aquí al calcular</p>
    </div>
    @endisset

</div>

</body>
</html>