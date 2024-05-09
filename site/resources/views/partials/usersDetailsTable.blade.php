{{-- Id-> table-container Can't be deleted --}}

<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
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
                <td>ID</td>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td><a href="mailto:{{ $user->email }}">
                        {{ $user->email }}
                    </a></td>
            </tr>
            <tr>
                <th>Data d'alta</th>
                <td>{{ $user->created_at ? $user->created_at : 'Desconegut' }}</td>
            </tr>
            <tr>
                <th>Data de verificació </th>
                <td>{{ $user->email_verified_at ? $user->email_verified_at : 'Sense verificar' }}
                </td>
            </tr>
            <tr>
                <th>Rols</th>
                <td>
                    @foreach ($user->roles as $rol)
                        <span class="d-inline-block w-50">
                            - {{ $rol->role }}
                        </span>
                        <form class="d-inline-block p-1" method="POST"
                            action="{{ route('admin.user.removeRole', ['language' => $language]) }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="role_id" value="{{ $rol->id }}">
                            <input type="submit" class="btn btn-danger form__button__close" value="Eliminar">
                        </form>
                        <br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Add Role</td>
                <td>
                    <form action="{{ route('admin.user.setRole', ['language' => $language]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <select class="form-control w-50 d-inline" name="role_id">
                            @foreach ($user->remainingRoles() as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->role }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-success px-3 ml-1" value="Add">
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
