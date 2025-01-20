<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--suppress JSUnresolvedLibraryURL -->
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <title>LockBox</title>
    </head>

    <body class="">
        <div class="mx-auto max-w-screen-lg h-screen flex flex-col">
            <div class="navbar bg-base-100">
                <div class="flex-1">
                    <a class="btn btn-ghost text-xl">LockBox</a>
                </div>
                <div class="flex-none">
                    <ul class="menu menu-horizontal px-1">
                        <li><a href="./mostrar">👁️</a></li>
                        <li>
                            <details>
                                <summary><?= auth()->nome ?></summary>
                                <ul class="bg-base-100 rounded-t-none p-2">
                                    <li><a href="<?=getBaseURL()?>logout">Logout</a></li>
                                </ul>
                            </details>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex space-x-4">
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
                <a href="<?=getBaseURL()?>notas/criar" class="btn btn-primary">+ item</a>
            </div>

            <div class="flex flex-grow p-y-6 mt-4">
                <?php
                $view = $view ?? 'index';
                require "../views/$view.view.php";
                ?>
            </div>
        </div>
    </body>
</html>
