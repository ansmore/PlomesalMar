{{-- Id-> table-container Can't be deleted --}}

<div class="card" id="table-container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">
                    <span data-text="commonName" class="table__title"></span>
                </th>
                <th scope="col">
                    <span data-text="scientificName" class="table__title"></span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th data-text="id"></th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th data-text="name"></th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th data-text="email"></th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th data-text="registrationDate"></th>
                <td>{{ $user->created_at ? $user->created_at : 'Desconegut' }}</td>
            </tr>
            <tr>
                <th data-text="verificationDate"></th>
                <td>{{ $user->email_verified_at ? $user->email_verified_at : 'Sense verificar' }}
                </td>
            </tr>
            <tr>
                <th data-text="roles"></th>
                <td>
                    @foreach ($user->roles as $rol)
                        <span class="row">
                            <span>
                                - {{ $rol->role }}
                            </span>
                            <form method="POST"
                                action="{{ route('admin.user.removeRole', ['language' => $language]) }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="role_id" value="{{ $rol->id }}">
                                <button type="submit" class="form__button__close" value="Eliminar">
                                    <i class="fas fa-circle-minus"></i>
                                    <span data-text="deleteButton"></span>
                                    {{-- <input type="submit" class="btn btn-danger form__button__close" value="Eliminar"> --}}
                                </button>
                            </form>
                        </span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th data-text="addRole"></th>
                <td>
                    <form action="{{ route('admin.user.setRole', ['language' => $language]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <span class="row">
                            <select class="select" name="role_id">
                                @foreach ($user->remainingRoles() as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->role }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="form__button__success">
                                <i class="fas fa-plus-circle"></i>
                                <span data-text="addButton"></span>
                                {{-- <input type="submit" class="btn btn-success" value="Add"> --}}
                            </button>
                        </span>
                    </form>
                </td>
            </tr>
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
