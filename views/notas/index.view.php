<?php

use App\Models\Nota;

/** @var Nota[] $notas */
/** @var Nota $notaSelecionada */

$validacoes = flash()->get('validacoes');
?>
<div class="bg-base-300 rounded-l-box w-56 flex flex-col divide-y divide-base-100">
    <?php foreach ($notas as $key => $nota): ?>
        <a
            href="<?= getBaseURL() ?>notas?id=<?= $nota->id ?><?=request()->get('pesquisar','','&pesquisar=')?>"
            class="w-full p-2 cursor-pointer hover:bg-base-200
           <?php if ($key == 0): ?>rounded-tl-box <?php endif; ?>
           <?php if ($nota->id == $notaSelecionada->id): ?>bg-base-200 <?php endif; ?>"
        >
            <?= $nota->titulo ?><br>
            <span class="text-xs">id: <?= $nota->id ?></span>
        </a>
    <?php endforeach; ?>
</div>

<div class="bg-base-200 rounded-r-box w-full p-10 flex flex-col space-y-6">
    <form action="<?= getBaseURL() ?>nota" method="POST" class="flex flex-col space-y-6" id="form_atualizacao">
        <input type="hidden" name="__method" value="PUT">
        <input type="hidden" name="id" value="<?= $notaSelecionada->id ?? '' ?>">
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Título</span>
            </div>
            <input
                name="titulo" type="text" class="input input-bordered w-full"
                value="<?= $notaSelecionada->titulo ?? '' ?>"
            />
            <?php if (isset($validacoes['titulo'])): ?>
                <div class="label text-error text-xs"><?= $validacoes['titulo'][0] ?></div>
            <?php endif; ?>
        </label>

        <label class="form-control">
            <div class="label">
                <span class="label-text">Sua nota</span>
            </div>
            <textarea
                <?php if(!session()->get('mostrar')) : ?>readonly disabled<?php endif; ?>
                name="nota" class="textarea textarea-bordered h-24"><?= $notaSelecionada->nota() ?? '' ?></textarea>
            <?php if (isset($validacoes['nota'])): ?>
                <div class="label text-error text-xs"><?= $validacoes['nota'][0] ?></div>
            <?php endif; ?>
        </label>
    </form>
    <div class="flex justify-between items-center">
        <form action="<?= getBaseURL() ?>nota" method="POST">
            <input type="hidden" name="__method" value="DELETE">
            <input type="hidden" name="id" value="<?= $notaSelecionada->id ?? '' ?>">
            <button type="submit" class="btn btn-error">Deletar</button>
        </form>
        <button class="btn btn-primary" type="submit" form="form_atualizacao">Atualizar</button>
    </div>
</div>