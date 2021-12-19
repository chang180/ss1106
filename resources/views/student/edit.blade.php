<?php
$strArr = ['By failing to prepare, you are preparing to fail.'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student init</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap-5.1.3/css/bootstrap.min.css')}} ">
    <script src="{{asset('assets/bootstrap-5.1.3/js/bootstrap.bundle.js')}} "></script>
    <script src="{{asset('assets/jquery/jquery-3.6.0.js')}}"></script>
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
        <h3>修改資料</h3>
        <h5 style="margin-bottom:18px"></h5>
    </div>

    <div class="center">
        <a href="{{ route('students.index') }}">回首頁</a>
    </div>
    <br>
    <form action="{{ route('students.update',[$student->id,'page'=>$page]) }} " method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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

            </tr>
            {{-- {{dd($student)}} --}}
            <tr>
                <td>{{ $student->id }} </td>
                <td><input type="file" name="photo" onchange="readURL(this)"><img src="{{ filter_var($student->photo, FILTER_VALIDATE_URL)?$student->photo:asset('storage/images/' . $student->photo) }}" class="photo"></td>
                <td><input type="text" name="name" id="name" value="{{ $student->name }}"></td>
                <td><input type="number" name="chinese" id="chinese" value="{{ $student->chinese }}"></td>
                <td><input type="text" name="english" id="english" value="{{ $student->english }}"></td>
                <td><input type="text" name="math" id="math" value="{{ $student->math }}"></td>
                <td><input type="text" name="location" id="location" value="{{ $student->locationRelation->name ?? '' }}"></td>
                <td><input type="text" name="phone" id="phone" value="{{ $student->phoneRelation->phone ?? '' }}">
                <td>
                    @each('hobby.item', $student->hobbyRelation, 'hobby', 'hobby.no-item')
                    {{-- @forelse ($student->hobbyRelation as $hobby)
                        @include('hobby.item',['hobby'=>$hobby])
                    @empty
                        @include('hobby.no-item')
                    @endforelse --}}
                    <button type="button" id="add_hobby">增加嗜好</button>
                </td>
            </tr>


            <tr>
                <td colspan="7">
                    <div id="example1">
                        <p>
                            <input type="hidden" name="id" value="{{ $student->id }}">
                            {{-- <input type="submit" value="submit" name="submit"> --}}
                            <button>submit</button>
                        </p>
                    </div>
                </td>

            </tr>
        </table>
    </form>

</body>

</html>
<script>
    $(document).ready(function() {
        $('#add_hobby').click(function() {
            $('#add_hobby').before('<input type="text" name="hobby[]">');
        });
    })

    function readURL(input) {
        // console.log(input.files);
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.photo').attr('src', e.target.result).width(150).height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
