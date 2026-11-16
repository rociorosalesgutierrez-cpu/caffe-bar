<?php if ($aviso): ?>
    <div
        class="aviso <?= $aviso['ok'] ? 'exito' : 'error' ?>"
        role="status"
    > <?= e($aviso['mensaje']) ?> </div>
<?php endif; ?>
<div
    id="toast"
    role="status"
    aria-live="polite"
    hidden
></div>
