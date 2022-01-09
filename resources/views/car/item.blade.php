<tr>
    <td> <input type="checkbox" class="checkbox check" name="del[]" value="{{ $car->id }}"> </td>
    <td> {{ $car->id }} </td>
    <td> {{ $car->name }}</td>
    <td>
        <a href=" {{ route('cars.edit', [$car->id, 'current_page' => $page]) }} "
            class="btn btn-info btn-sm" role="button">修改</a>
        <form
            action="{{ route('cars.destroy', [$car->id, 'current_page' => $page]) }}"
            method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="刪除" name="submit" class="btn btn-danger btn-sm">
        </form>
    </td>
</tr>