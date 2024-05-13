{{-- Id-> table-container Can't be deleted --}}

<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
            <tr>
                <th scope="col">
                    <span data-text="name" class="table__title"></span>
                    <a href="?orderByField=common_name&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=common_name&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col">
                    <span data-text="email" class="table__title"></span>
                    <a href="?orderByField=scientific_name&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=scientific_name&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                {{-- <th scope="col" data-text="registrationDate" class="table__title"></th> --}}
                <th scope="col" data-text="rolesUserHave" class="table__title"></th>
                <th scope="col" data-text="moreInfo" class="table__title"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    {{-- <td>{{ $user->created_at }}</td> --}}
                    <td>
                        @foreach ($user->roles as $rol)
                            -{{ $rol->role }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.user.details', [
                            'user' => $user->id,
                            'language' => $language,
                        ]) }}"
                            class="form__button__success">
                            <i class="fa-solid fa-circle-info"></i>
                            <span data-text="showDetails"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- @include('modals/species.edit') --}}
    {{-- @include('modals/species.delete') --}}
</div>

{{-- <nav aria-label="Page navigation example" class="pagination__box">
    <ul class="pagination">
        <li class="page-item {{ $species->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $species->previousPageUrl() }}">Back</a>
        </li>

        <li class="page-item {{ $species->currentPage() == 1 ? 'active' : '' }}">
            <a class="page-link" href="{{ $species->url(1) }}">1</a>
        </li>

        @if ($species->currentPage() > 3)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @for ($i = max(2, $species->currentPage() - 1); $i <= min($species->lastPage() - 1, $species->currentPage() + 1); $i++)
            <li class="page-item {{ $species->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $species->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($species->currentPage() < $species->lastPage() - 2)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @if ($species->lastPage() > 1)
            <li class="page-item {{ $species->currentPage() == $species->lastPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $species->url($species->lastPage()) }}">{{ $species->lastPage() }}</a>
            </li>
        @endif

        <li class="page-item {{ $species->currentPage() == $species->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $species->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav> --}}
