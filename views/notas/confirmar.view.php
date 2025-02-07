<?php
$validacoes = flash()->get('validacoes');
?>
<div class="bg-base-300 rounded-box w-full text-center text-3xl font-bold pt-20 flex flex-col items-center">
    <form action="<?= getBaseURL() ?>mostrar" method="POST" class="max-w-md flex flex-col gap-4">
        <div>Digite a sua senha novamente para começar a ver todas as suas notas descriptografadas</div>
        <label class="form-control">
            <div class="label">
                <span class="label-text">Senha</span>
            </div>
            <input
                type="password" name="senha" class="input input-bordered bg-white"
            />
            <?php if (isset($validacoes['senha'])): ?>
                <div class="label text-error text-xs"><?= $validacoes['senha'][0] ?></div>
            <?php endif; ?>
        </label>
        <button type="submit" class="btn btn-primary">Abrir minhas notas</button>



    </form>
</div>

