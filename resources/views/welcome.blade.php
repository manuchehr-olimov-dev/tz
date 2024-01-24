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
        <h1>Ваша заявка</h1>
        <form action="http://127.0.0.1:8000/api/v1/send-request" method="POST" id="applicationForm">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Ваше имя:</label>
                <input type="text" name="name" class="form-control" id="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Ваша почта: </label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Сообщение: </label>
                <textarea name="message" class="form-control" id="message" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
        <a class="btn btn-primary mt-3" href="/admin">Все заявки</a>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>

        $("#applicationForm").submit(function (e){
            e.preventDefault();

            const apiURL = this.getAttribute('action');

            const name      = $("#username").val();
            const email     = $("#email").val();
            const message   = $("#message").val();
            const _token    = $("input[name='_token']").val()

            $.ajax({
                url: apiURL,
                method: 'POST',
                dataType: 'json',
                data: {
                    name: name,
                    email: email,
                    message: message,
                    _token: _token
                },
                success: function( response ) {
                    alert(response.result)
                    $("#applicationForm")[0].reset();
                }
            });
        })

</script>

</html>
