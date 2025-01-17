<div class="grid grid-cols-2">
    <div class="hero min-h-screen flex ml-40">
        <div class="hero-content -mt-20">
            <div>
                <p class="py-2 text-xl">
                    Bem-vindo ao
                </p>
                <h1 class="text-6xl font-bold">LockBox</h1>
                <p class="pt-2 pb-4 text-xl">
                    Onde você guarda <span class="italic">tudo</span> com segurança.
                </p>
            </div>
        </div>
    </div>
    <div class="bg-white hero min-h-screen mr-40 text-black">
        <div class="hero-content -mt-20">
            <form action="./login" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Faça o seu login</div>
                        <?php
                        $validacoes = flash()->get('validacoes');
                        $mensagem = flash()->get('mensagem');
                        ?>
                        <?php if($mensagem) :?>
                        <div role="alert" class="alert alert-success">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 shrink-0 stroke-current"
                                fill="none"
                                viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span><?=$mensagem?></span>
                        </div>
                        <?php endif;?>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text text-black">Email</span>
                            </div>
                            <input
                                type="text" name="email" class="input input-bordered w-full max-w-xs
                            bg-white" value="<?= old('email')?>"
                            />
                            <?php if (isset($validacoes['email'])): ?>
                                <div class="label text-error text-xs"><?= $validacoes['email'][0] ?></div>
                            <?php endif; ?>
                        </label>

                        <label class="form-control">
                            <div class="label">
                                <span class="label-text text-black">Senha</span>
                            </div>
                            <input
                                type="password" name="senha" class="input input-bordered w-full max-w-xs
                            bg-white"
                            />
                            <?php if (isset($validacoes['senha'])): ?>
                                <div class="label text-error text-xs"><?= $validacoes['senha'][0] ?></div>
                            <?php endif; ?>
                        </label>

                        <div class="card-actions">
                            <button class="btn btn-primary btn-block">Login</button>
                            <a href="./registrar" class="btn btn-link">Quero me registrar</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>