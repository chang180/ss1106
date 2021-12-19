<tr>
    <td> {{ $student->id }} </td>
    <td> 
        <img src=" {{ filter_var($student->photo, FILTER_VALIDATE_URL)?$student->photo:asset('storage/images/' . $student->photo) }} " alt="No image">
        <a href=" {{ route('students.create-file', ['id' => $student->id, 'current_page' => $page]) }} "
            class="btn btn-success btn-sm" role="button">圖片</a>
    </td>
    <td> {{ $student->name }}</td>
    <td> {{ $student->chinese }}</td>
    <td> {{ $student->english }}</td>
    <td> {{ $student->math }}</td>
    <td> {{ $student->locationRelation->name ?? '' }}</td>
    <td> {{ $student->phoneRelation->phone ?? '' }}</td>
    <td>
        @forelse ($student->hobbyRelation as $hobby)
            {{ $hobby->hobby }}<br>
        @empty
            沒有嗜好
        @endforelse
    </td>
    <td>
        <a href=" {{ route('students.edit', [$student->id, 'current_page' => $page]) }} "
            class="btn btn-info btn-sm" role="button">修改</a>
        <form
            action="{{ route('students.destroy', [$student->id, 'current_page' => $page]) }}"
            method="post">
            {{-- <form action="{{ route('students.destroy', $student->id) }}" method="post"> --}}
            @csrf
            @method('DELETE')
            <input type="submit" value="刪除" name="submit" class="btn btn-danger btn-sm">
        </form>
    </td>
</tr>