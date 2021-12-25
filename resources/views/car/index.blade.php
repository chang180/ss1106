<?php
$strArr = ['By failing to prepare, you are preparing to fail.'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>
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

        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

    </style>

</head>

<body>
    <div class="center">
        <h3>車車</h3>
        <h5 style="margin-bottom:18px"></h5>
    </div>

    <div class="center">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('welcome') }}">回首頁</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('cars.create',['last_page'=>$lastpage]) }}">單筆新增</a>
        {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('cars.export') }}">下載報表</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('cars.export') }}">下載電話</a> --}}

    </div>
    <br>
    <div class="d-flex justify-content-center">
        {{ $page = $cars->links() }}
        {{-- 選擇頁數：<select name="" id="">
            @for($i=1;$i<=$lastpage;$i++)
            <option><a href="{{ route('students.page/'.$i) }}">第{{$i}}頁</a></option>
            @endfor
        </select> --}}
        {{-- {{dd($page)}} --}}
    </div>
    <table class="center" border="1px" width="80%">
        <tr>
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
    <br><br><br>

</body>

</html>
