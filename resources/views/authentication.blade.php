<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Google reCAPTCHA</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h2>Google Authentication</h2>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <img src="{{$google2fa_url}}">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="secret">驗證碼</label>
                        <input type="text" class="form-control" id="secret" placeholder="輸入上面產生的動態驗證碼" maxlength="6">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary btn-sm">檢查</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div id="result-show" class="alert text-primary"></div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
            $(function () {
                $('.btn-primary').click(function () {
                    $.ajax({
                        url: 'authentication/check',
                        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
                        type: 'post',
                        dataType: 'json',
                        data: {secret : $('#secret').val()},
                        success: function (response) {
                            $('#result-show').html('驗證結果：' + response.result);
                        },
                        error: function () {
                            $('#result-show').html('系統異常中');
                        }
                    });
                });
            });
        </script>
    </body>
</html>