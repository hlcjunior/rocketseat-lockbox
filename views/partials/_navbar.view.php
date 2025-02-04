<div class="navbar bg-base-100">
    <div class="flex-1">
        <a href="<?=getBaseURL()?>notas" class="btn btn-ghost text-xl">LockBox</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li>
                <?php if(session()->get('mostrar')) : ?>
                    <a href="<?=getBaseURL()?>esconder">🔐</a>
                <?php else : ?>
                    <a href="<?=getBaseURL()?>mostrar">👁</a>
                <?php endif; ?>
            </li>
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