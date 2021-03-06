<?php
$strArr = ['By failing to prepare, you are preparing to fail.'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cars</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
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

        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

    </style>

</head>

<body>
    {{-- @include('layouts.navigation') --}}
    <div class="center">
        <h3>車車</h3>
        <h5 style="margin-bottom:18px"></h5>
    </div>
    {{-- {{dd($data)}} --}}
    <div class="center">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('welcome') }}">回首頁</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('cars.create', ['last_page' => $lastpage]) }}">單筆新增</a>
        {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('cars.export') }}">下載報表</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('cars.export') }}">下載電話</a> --}}

    </div>
    <br>
    <div class="d-flex justify-content-center">
        @csrf
        {{ $page = $cars->links() }}
        {{-- 選擇頁數：<select name="" id="">
            @for ($i = 1; $i <= $lastpage; $i++)
            <option><a href="{{ route('students.page/'.$i) }}">第{{$i}}頁</a></option>
            @endfor
        </select> --}}
        {{-- {{dd($page)}} --}}
    </div>
    <table class="center" border="1px" width="80%">
        <tr>
            <th>選擇框</th>
            <th>ID</th>
            <th>名字</th>
            <th>修改/刪除</th>

        </tr>
        {{-- {{dd($page)}} --}}
        @forelse ($cars as $car)
            @include('car.item',['car'=>$car,'page'=>$page->paginator->currentPage()])
        @empty
            @include('car.empty')
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
    @if ($cars)
        <button type="button" id="selectAll">全選</button>
        <button type="button" id="cancelAll">全不選</button>
        <button type="button" id="delAll">刪除</button>
    @endif
    <br><br><br>

</body>

</html>
<script>
    $('#selectAll').click(function() {
        $('input[type="checkbox"]').prop('checked', true);
    });
    $('#cancelAll').click(function() {
        $('input[type="checkbox"]').prop('checked', false);
    });
    $('#delAll').click(function(e) {
        let checkbox = $('input[type="checkbox"]');
        let checkbox_arr = [];
        let _token = $('input[name="_token"]').val();
        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                checkbox_arr.push(checkbox[i].value);
            }
        }
        if (checkbox_arr.length == 0) {
            alert('請選擇要刪除的資料');
        } else {
            if (confirm('確定要刪除嗎？')) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('cars.delAll') }}',
                    type: 'post',
                    data: {
                        ids: checkbox_arr,
                        _token: _token
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            alert('刪除成功');
                            location.reload();
                        } else {
                            alert('刪除失敗');
                        }
                    }
                });
            }
        }
    });
</script>
