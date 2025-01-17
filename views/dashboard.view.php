<?php
use App\Models\Usuario;

/** @var Usuario $user */
?>
<div class="mx-auto max-w-screen-lg">
    <div class="navbar bg-base-100">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">LockBox</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a>👁️</a></li>
                <li>
                    <details>
                        <summary><?= $user->nome ?></summary>
                        <ul class="bg-base-100 rounded-t-none p-2">
                            <li><a href="./logout">Logout</a></li>
                        </ul>
                    </details>
                </li>
            </ul>
        </div>
    </div>

    <div class="flex space-x-4 w-full">
        <form action="" class="w-full">
            <label class="input input-bordered flex items-center gap-2 w-full">
                <input type="text" name="pesquisar" placeholder="Pesquisar notas no LockBox..." class="grow" />
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    class="h-4 w-4 opacity-70"
                >
                    <path
                        fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd"
                    />
                </svg>
            </label>
        </form>
        <a href="#" class="btn btn-primary">+ item</a>
    </div>

    <div class="h-svh flex p-y-6">
        <div class="menu bg-base-300 rounded-l-box w-56">
        </div>

        <div class="bg-base-200 rounded-r-box w-full p-10">
            Form
        </div>
    </div>
</div>