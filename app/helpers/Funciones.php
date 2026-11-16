<?php

declare(strict_types = 1);

require_once dirname(__DIR__, 2) . '/core/inicio.php';

function e(mixed $v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function url(string $ruta = ''): string
{
    return BASE_URL . '/' . ltrim($ruta, '/');
}
function redirigir(string $ruta): never
{
    header('Location: ' . url($ruta), true, 303);
    exit();
}
function bs(mixed $valor): string
{
    return 'Bs. ' . number_format((float) $valor, 2, ',', '.');
}

function fechaBolivia(string $fecha): string
{
    $instante = new DateTimeImmutable($fecha, new DateTimeZone('UTC'));

    return $instante->setTimezone(new DateTimeZone('America/La_Paz'))->format('d/m/Y H:i');
}
function centavos(string $precio): int
{
    [$entero, $decimal] = array_pad(explode('.', $precio), 2, '0');
    return (int) $entero * 100 + (int) str_pad($decimal, 2, '0');
}
function decimal(int $centavos): string
{
    return intdiv($centavos, 100) . '.' . str_pad((string) ($centavos % 100), 2, '0', STR_PAD_LEFT);
}
function flash(string $mensaje, bool $ok = true): void
{
    $_SESSION['flash'] = ['mensaje' => $mensaje, 'ok' => $ok];
}
function vista(string $archivo, array $datos = [], bool $panel = false): void
{
    Vista::mostrar($archivo, $datos, $panel);
}

function jsonRespuesta(array $datos, int $codigo = 200): never
{
    http_response_code($codigo);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit();
}
function postAccion(callable $accion, string $volver): never
{
    CsrfToken::verificar();
    try {
        $mensaje = $accion();
        flash(is_string($mensaje) ? $mensaje : 'Cambios guardados correctamente.');
    } catch (DomainException $ex) {
        flash($ex->getMessage(), false);
    } catch (PDOException $ex) {
        if ($ex->getCode() === '23000') {
            flash('No se puede guardar: hay un dato duplicado o registros relacionados.', false);
        } else {
            throw $ex;
        }
    }
    redirigir($volver);
}
