<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
    <div class="col-span-2">
        <x-required-label for="categoria" value="Categoria del Servicio" />
        <select name="categoria_servicio_id" id="categoria"
            class="custom-select sm:text-sm" wire:model="categoria_id">
            <option value="" selected>Seleccionar</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
            @endforeach
        </select>
        <x-jet-input-error for="categoria" class="mt-2" />
    </div>
    <div class="col-span-3">
        <x-jet-label for="descripcion" value="Descripción del Servicio" />
        @if (!is_null($descripcion))
            <div class="border-gray-300 overscroll-auto overflow-y-scroll max-h-48 border mt-3 bg-gray-50 rounded-md shadow-sm mr-2 py-2 px-3">
                {!! Str::upper($descripcion) !!}
            </div>
        @endif
    </div>
</div>
