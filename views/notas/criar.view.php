<div class="bg-base-300 rounded-l-box w-56">
    <div class="bg-base-200 p-4">
        + Nota Nota
    </div>

</div>

<div class="bg-base-200 rounded-r-box w-full p-10">
    <form action="<?=getBaseURL()?>notas/criar" method="POST" class="flex flex-col space-y-6">
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Título</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full" />
        </label>

        <label class="form-control">
            <div class="label">
                <span class="label-text">Sua nota</span>
            </div>
            <textarea class="textarea textarea-bordered h-24" placeholder="Bio"></textarea>
        </label>

        <div class="flex justify-end items-center">
            <button class="btn btn-primary">Salvar</button>
        </div>

    </form>
</div>