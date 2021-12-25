<table>
    <thead>
        <tr>
            <th>姓名</th>
            <th>電話</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student['name'] }}</td>
                <td>{{ $student['phone'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
