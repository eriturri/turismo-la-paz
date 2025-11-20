<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Lugares Turísticos</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos-crema.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: var(--cream-card);
            border-radius: 1.5rem;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.6);
            max-width: 450px;
            width: 100%;
            margin: 20px;
            padding: 3rem;
            border: 3px solid var(--border-color);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header h2 {
            color: var(--accent-gold);
            margin-bottom: 0.5rem;
            font-weight: 700;
            font-size: 2rem;
        }

        .login-header p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 0;
        }

        .login-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .form-label {
            color: var(--accent-gold-light);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Inputs específicos del login */
        .login-container .form-control {
            background-color: var(--cream-dark);
            border: 2px solid var(--border-color);
            color: var(--text-primary);
        }

        .login-container .form-control:focus {
            background-color: var(--cream-card);
            border-color: var(--accent-gold);
            color: var(--text-primary);
        }

        .login-container .form-control::placeholder {
            color: var(--text-secondary);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-brown) 100%);
            border: none;
            border-radius: 50px;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.5);
        }

        .btn-volver-login {
            width: 100%;
            padding: 12px;
            background-color: var(--cream-medium);
            border: 2px solid var(--cream-dark);
            border-radius: 50px;
            color: var(--text-primary);
            margin-top: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-volver-login:hover {
            background-color: var(--cream-dark);
            border-color: var(--accent-brown);
        }

        .top-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .alert-credenciales {
            background: linear-gradient(135deg, var(--cream-dark) 0%, var(--cream-medium) 100%);
            border: 2px solid var(--accent-gold);
            border-radius: 1rem;
            margin-top: 1.5rem;
            padding: 1rem;
        }

        .alert-credenciales strong {
            color: var(--accent-gold);
        }

        .alert-credenciales code {
            background-color: var(--cream-light);
            color: var(--accent-gold-light);
            padding: 2px 8px;
            border-radius: 5px;
            border: 1px solid var(--border-color);
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="top-buttons">
        <button id="btnModoOscuro" class="btn btn-secondary"> Modo Oscuro</button>
        <a href="index.php?c=lugares" class="btn btn-secondary"> Volver a Lugares</a>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="login-icon">CD</div>
            <h2>Acceso Admin</h2>
            <p>Lugares Turísticos - La Paz</p>
        </div>
        
        <form method="POST" action="index.php?c=auth&a=procesar_login">
            <div class="mb-3">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" placeholder="admin" required autofocus>
            </div>
            
            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn btn-login"> Iniciar Sesión</button>
            <a href="index.php" class="btn btn-volver-login">← Volver al Inicio</a>
        </form>

        <div class="alert alert-credenciales">
            <strong>💡 Credenciales de Prueba:</strong><br>
            Usuario: <code>admin</code><br>
            Contraseña: <code>admin123</code>
        </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/dark-mode-toggle.js"></script>
</body>
</html>