<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Form</title>
        <style>
            label, input{display:block;}
        </style>
    </head>
    <body>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        <form method="POST" action="/update">
            {{ csrf_field() }}
            <input type="text" name="first_name" id="first_name" value="{{old('first_name')}}" placeholder="John" />
            <input type="text" name="last_name" id="last_name" value="{{old('last_name')}}" placeholder="Doe" />
            <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="john.doe@example.com" />
            <button type="submit">Submit</button>
        </form>
    </body>
</html>
