<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Inventario de Repuestos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 14px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .08);
        }

        .login-header {
            text-align: center;
            padding: 30px 25px 15px;
        }

        .login-header h4 {
            font-weight: 700;
        }

        .login-body {
            padding: 20px 30px 30px;
        }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="login-header">
            <h4>Inventario de Repuestos</h4>
            <p class="text-muted mb-0">Ingresa tus credenciales para continuar</p>
        </div>

        <div class="login-body">

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="admin@gmail.com"
                        required
                        autofocus
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Ingresa tu contraseña"
                        required
                    >
                </div>

                <div class="form-check mb-4">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        class="form-check-input"
                        id="remember"
                    >
                    <label class="form-check-label" for="remember">
                        Recordar sesión
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Iniciar sesión
                </button>
            </form>

        </div>
    </div>

</body>
</html>