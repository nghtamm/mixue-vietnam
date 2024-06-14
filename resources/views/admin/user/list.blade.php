<tr>
    <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
    </th>
    <th scope="row">{{ $countUser }}</th>
    <td class="user-name">{{ $newUser->user_name }}</td>
    <td class="user-email">{{ $newUser->user_email }}</td>
    <td class="user-phone">{{ $newUser->user_phone }}</td>
    <td>
        <a type="button" onclick="Js_Payment.edit('{{ $newUser->user_id }}')">
            <i class="bi bi-pencil-square"></i>
        </a>
        |
        <a type="button" onclick="Js_Payment.confirmDelete('{{ $newUser->user_id }}')">
            <i class="bi bi-trash-fill"></i>
        </a>
    </td>
    <td>
        <div class="form-check form-switch">
            <input class="form-check-input default-checkbox" type="checkbox" role="switch"
                data-user-id="{{ $newUser->user_id }}" name="flexSwitchChecked"
                id="flexSwitchCheckChecked{{ $newUser->user_id }}" {{ $newUser->user_status == 1 ? 'checked' : '' }}>
        </div>
    </td>
</tr>
