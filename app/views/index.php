<div class="d-flex justify-content-center align-items-center">
<form method="POST" action="<?= route("login/auth") ?>">
    formulário
    <?= _csrf() ?>
    <button>Salvar</button>
</form>
</div>