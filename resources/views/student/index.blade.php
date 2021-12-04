<?php
$strArr = ['By failing to prepare, you are preparing to fail.'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>students</title>
    <script src="./myJs.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.1.3/css/bootstrap.min.css') }} ">
    <script src="{{ asset('assets/bootstrap-5.1.3/js/bootstrap.bundle.js') }} "></script>
    <script src="{{ asset('assets/jquery/jquery-3.6.0.js') }}"></script>
    <style>
        td {
            height: 80px;
            width: 80px;
            text-align: center;
        }

        .center {
            margin: auto;
            text-align: center;
        }



        #example1 {
            border: 2px solid grey;
            border-radius: 25px;
        }

        a {
            text-decoration: none;
            color: inherit;
            font-size: 24px;
        }

        a:hover {
            color: grey;
            text-decoration: none;
            cursor: pointer;
        }

        h3 {
            font-family: Verdana;
        }

    </style>

</head>

<body>
    <div class="center">
        <h3>學生資料</h3>
        <h5 style="margin-bottom:18px"></h5>
    </div>

    <div class="center">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('welcome') }}">回首頁</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('students.create') }}">單筆新增</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('students.create-file') }}">create-file</a>

    </div>
    <br>
    <div class="d-flex justify-content-center">
        {{ $page = $students->links() }}
    </div>
    <table class="center" border="1px" width="80%">
        <tr>
            <th>ID</th>
            <th>圖片</th>
            <th>姓名</th>
            <th>國文</th>
            <th>英文</th>
            <th>數學</th>
            <th>地區</th>
            <th>電話</th>
            <th>嗜好</th>
            <th>修改/刪除</th>

        </tr>
        {{-- {{dd($students)}} --}}
        @forelse ($students as $student)
            <tr>
                <td> {{ $student->id }} </td>
                <td> 圖片 </td>
                <td> {{ $student->name }}</td>
                <td> {{ $student->chinese }}</td>
                <td> {{ $student->english }}</td>
                <td> {{ $student->math }}</td>
                <td> {{ $student->locationRelation->name ?? '' }}</td>
                <td> {{ $student->phoneRelation->phone ?? '' }}</td>
                <td>
                    @forelse ($student->hobbyRelation as $hobby)
                        {{ $hobby->hobby }}
                    @empty
                        沒有嗜好
                    @endforelse
                </td>
                <td>
                    <a href=" {{ route('students.create-file', ['id' => $student->id, 'current_page' => $page->paginator->currentPage()]) }} "
                        class="btn btn-success btn-sm" role="button">加圖片</a>
                    <a href=" {{ route('students.edit', [$student->id, 'current_page' => $page->paginator->currentPage()]) }} "
                        class="btn btn-info btn-sm" role="button">修改</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="刪除" name="submit" class="btn btn-danger btn-sm">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">
                    <h3>沒有資料</h3>
                </td>
            </tr>
        @endforelse
        <tr>
            <td colspan="8">
                <div id="example1">
                    <p>
                        <?= $strArr[0] ?><br>
                        {{ date('Y-m-d H:i:s') }}
                    </p>
                </div>
            </td>
        </tr>
    </table>
    <br><br><br>

</body>

</html>
