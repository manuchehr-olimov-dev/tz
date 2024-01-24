<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

<div class="container mt-3">

    <h1>Ответить на заявку</h1>
    <hr>
    @if($request)
        <h4>Номер заявки № {{ $request->id }}</h4>
        <h4>Статус: {{ $request->status }}</h4>
        <p>Сообщение: </p>
        <p>{{ $request->message }}</p>

        <hr>
        <h3>Ответить на заявку: </h3>
        <form action="http://127.0.0.1:8000/api/v1/requests/{{$request->id}}" method="post" id="commentForm">
            @method('PUT')
            @csrf
            <label for="message" class="form-label">Сообщение: </label>
            <textarea name="comment" id="comment" class="form-control"></textarea>

            <input type="hidden" name="requestId" id="requestId" value="{{$request->id}}" required>
            <input type="hidden" name="email" id="email" value="{{$request->email}}" required>

            <button type="submit">Ответить</button>
        </form>
    @endif

</div>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>

    $("#commentForm").submit(function (e){
        e.preventDefault();

        const apiURL = this.getAttribute('action')
        const comment  = $("#comment").val();
        const email  = $("#email").val();
        const requestId  = $("#requestId").val();
        const _token    = $("input[name='_token']").val()


        $.ajax({
            url: apiURL,
            method: 'PUT',
            dataType: 'json',
            data: {
                requestId: requestId,
                email: email,
                comment: comment,
                _token: _token
            },
            success: function( response ) {
                console.log(response)
            }
        });
    })


</script>
</html>

