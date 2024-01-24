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
    <h1>Заявки</h1>
    <form action="http://127.0.0.1:8000/api/v1/get-requests" method="GET" id="filterForm">
        <select class="form-select" id="filterBy" name="filterBy" aria-label="Выберите способ фильтрации (по умолчанию: все заявки)">
            <option selected disabled>Выберите способ фильтрации (по умолчанию: все заявки)</option>
            <option value="all">Все заявки</option>
            <option value="byStatusResolved">По решенным заявкам</option>
            <option value="byStatusActive">По не решенным заявкам</option>
            <option value="byDate">По дате</option>
        </select>
    </form>

    <hr>

    <table class="table mt-5" id="requestsTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Ответить</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>

    $("#filterBy").on("change", function (e){
        e.preventDefault();

        const filterBy  = $("#filterBy").val();
        const _token    = $("input[name='_token']").val()

        $("#requestsTable").find("tr:not(:first)").remove();


        $.ajax({
            url: 'http://127.0.0.1:8000/api/v1/get-requests',
            method: 'GET',
            dataType: 'json',
            data: {
                filterBy: filterBy,
                _token: _token
            },
            success: function( response ) {

                const requests = response.requests;

                for(const request of requests){
                    $('#requestsTable > tbody:last-child').append('<tr></tr>');
                    $('#requestsTable > tbody:last-child > tr:last-child').append('<th>'+ request.id +'</th>')
                        .append(`<th>${request.name}</th>`)
                        .append(`<th>${request.email}</th>`)
                        .append(`<th>${request.status}</th>`)
                        .append(`<th><a href="/solve-request/${request.id}" class="btn btn-primary">Ответить</a></th>`);

                    console.log(request.id)
                }
            }
        });
    })


</script>
</html>
