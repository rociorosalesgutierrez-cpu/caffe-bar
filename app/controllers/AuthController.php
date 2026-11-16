<?php

declare(strict_types = 1);

final class AuthController
{
    public function acceder(): void
    {
        vista('auth/acceder');
    }

    public function registro(): void
    {
        vista('auth/registro');
    }

    public function login(): void
    {
        CsrfToken::verificar();
        try {
            Intentos::registrar('login', 10, 900);
            $usuario = Validador::texto($_POST, 'usuario', 3, 40);
            $clave = $_POST['clave'] ?? null;
            if (!is_string($clave) || strlen($clave) > 72 || $clave === '') {
                throw new DomainException('Usuario o contraseña incorrectos.');
            }
            $u = (new UsuarioModel())->autenticar($usuario, $clave);
            if (!$u) {
                throw new DomainException('Usuario o contraseña incorrectos.');
            }
            AuthMiddleware::entrar($u);
            redirigir($u['rol'] === 'cliente' ? 'productos' : 'admin');
        } catch (DomainException $e) {
            flash($e->getMessage(), false);
            redirigir('acceder');
        }
    }

    public function registrar(): void
    {
        CsrfToken::verificar();
        try {
            Intentos::registrar('registro', 5, 900);
            $clave = Validador::clave($_POST);
            if ($clave !== ($_POST['confirmacion'] ?? null)) {
                throw new DomainException('Las contraseñas no coinciden.');
            }
            (new UsuarioModel())->guardar(Validador::persona($_POST), 'cliente', 1, null, $clave);
            flash('Cuenta creada. Ya puedes iniciar sesión.');
            redirigir('acceder');
        } catch (DomainException $e) {
            flash($e->getMessage(), false);
            redirigir('registro');
        } catch (PDOException $e) {
            if ($e->getCode() !== '23000') {
                throw $e;
            }
            flash('El usuario o correo ya está registrado.', false);
            redirigir('registro');
        }
    }

    public function salir(): void
    {
        AuthMiddleware::exigir();
        CsrfToken::verificar();
        AuthMiddleware::salir();
        redirigir('acceder');
    }
}
