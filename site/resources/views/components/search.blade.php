<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
    <input type="text" id="filtro" class="form-control" placeholder="Buscar especies..." aria-label="Buscar"
        aria-describedby="basic-addon1">
</div>

@push('scripts')
    <script type="module" src="{{ asset('js/components/search.js') }}" defer></script>
@endpush
