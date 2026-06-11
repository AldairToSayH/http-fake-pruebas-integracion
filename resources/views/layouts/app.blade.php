<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema academico')</title>
    <style>
        :root {
            --bg: #f8fafc;
            --text: #0f172a;
            --muted: #475569;
            --panel: #ffffff;
            --border: #cbd5e1;
            --border-soft: #94a3b8;
            --success-bg: #ecfdf5;
            --success-border: #34d399;
            --error-bg: #fef2f2;
            --error-border: #fca5a5;
            --error-text: #991b1b;
            --brand: #047857;
            --table-head: #eff6ff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 24px;
            font-family: Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
        }

        h1 {
            margin-top: 0;
        }

        .alert-success {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 16px;
        }

        .alert-error {
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            color: var(--error-text);
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
        }

        label {
            display: block;
            margin-top: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid var(--border-soft);
            border-radius: 8px;
        }

        button,
        a.button {
            display: inline-block;
            margin-top: 18px;
            padding: 10px 16px;
            background: var(--brand);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th,
        td {
            border: 1px solid var(--border);
            padding: 10px;
            text-align: left;
        }

        th {
            background: var(--table-head);
        }

        .muted {
            color: var(--muted);
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
