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
                <th data-text="surnameModal"></th>
                <td>{{ $user->surname }}</td>
            </tr>
            <tr>
                <th data-text="surnameSecondModal"></th>
                <td>{{ $user->surnameSecond }}</td>
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
                            </button>
                        </span>
                    </form>
                </td>
            </tr>
            <tr>
                <th data-text="actions"></th>
                <td>
                    <button type="button" class="buttonTable__close" data-bs-toggle="modal"
                        data-bs-target="deleteUsersModal" title="Eliminar" data-id="{{ $user->id }}"
                        data-name="{{ $user->name }}"data-email="{{ $user->email }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    @include('modals/users.delete')
    @include('components.message')
</div>
