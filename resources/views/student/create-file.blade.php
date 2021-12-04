<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create file</title>
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
        <a href="{{ route('students.index') }}">回首頁</a>
    </div>
    <br>
    <form action="{{ route('students.store-file') }} " method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        {{-- {{ dd($student_id) }} --}}
        <input type="hidden" name="student_id" value="{{ $student_id }}">
        <input type="hidden" name="page" value="{{ $page }}">
        <h3 class="center">上傳檔案</h3>
        <table class="center" border="1px" width="80%">
            <tr>
                <th>檔案</th>
            </tr>
            <tr>
                <td>
                    @if (!empty($photo))
                        <img src="{{ asset('storage/images/' . $photo) }}" alt="" width="150px" height="100px">
                        <input type="file" name="file" class="" onchange="readURL(this);">
                    @else
                        <img src="" alt="" width="150px" height="100px">
                        <input type="file" name="file" class="photo" onchange="readURL(this);">
                    @endif
                </td>
            </tr>
            <tr>
                <td><button>送出</button></td>
            </tr>
        </table>
    </form>

</body>

</html>
<script>
    function readURL(input) {
        console.log(input);
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.class').attr('src', e.target.result).width(150).height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
