<!DOCTYPE html>
<html>
<head>
    <title>Exam Paper</title>
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css')}}" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        th {
            background-color: #04AA6D;
            color: white;
        }
        h1{
            background-color: #c5af9e;
            color: white;
        }
        html,body{
            width: 100%;
            height: 100%;
            margin: 0; /* Space from this element (entire page) and others*/
            padding: 0; /*space from content and border*/
            border: solid blue;
            border-width: thin;
            overflow:hidden;
            display:block;
        }

    </style>

</head>
<body>
<header>
    <h1>Exam Paper</h1>
</header>
<body >


    <h1 style="background: #00aced">asdasdsa</h1>
    @foreach($questions as $question)

            <h2>{{$loop->iteration}}-{{$question['question']}}</h2>
            <ol type="a">
               @foreach($question['options'] as $option)
                    <li>{{$option}}</li>

                   @endforeach
            </ol>


        @endforeach
<table border="1">
    <tr>
        <td>Q</td>
        @foreach($questions as $question)
            <td>{{$loop->iteration}}</td>
        @endforeach

    </tr>
    <tr>
        <td>A</td>
        @foreach($questions as $question)
            <td> </td>
        @endforeach

    </tr>
</table>
</body>

<footer>
    <p>© 2023 Exam Company, Inc.</p>
</footer>
</body>
</html>
