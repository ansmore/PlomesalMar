{{-- Id-> table-container Can't be deleted --}}

<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
            <tr>
                <th scope="col">
                    <span data-text="name" class="table__title"></span>
                    <a href="?orderByField=name&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=name&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col">
                    <span data-text="email" class="table__title"></span>
                    <a href="?orderByField=email&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=email&orderByDirection=desc" class="decoration">
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

<nav aria-label="Page navigation example" class="pagination__box">
    <ul class="pagination">
        <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $users->previousPageUrl() }}">Back</a>
        </li>

        <li class="page-item {{ $users->currentPage() == 1 ? 'active' : '' }}">
            <a class="page-link" href="{{ $users->url(1) }}">1</a>
        </li>

        @if ($users->currentPage() > 3)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @for ($i = max(2, $users->currentPage() - 1); $i <= min($users->lastPage() - 1, $users->currentPage() + 1); $i++)
            <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($users->currentPage() < $users->lastPage() - 2)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @if ($users->lastPage() > 1)
            <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a>
            </li>
        @endif

        <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
