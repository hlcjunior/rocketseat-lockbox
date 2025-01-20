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
        <?php
        $view = $view ?? 'index';
        require "../views/$view.view.php";
        ?>
    </body>
</html>