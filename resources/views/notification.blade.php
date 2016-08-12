<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Html5桌面通知(Web Notifications)</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h2>Html5桌面通知(Web Notifications)</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form role="form">
                        <div class="form-group">
                            <label for="title">標題</label>
                            <input type="text" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="msg">內容</label>
                            <input type="text" class="form-control" id="msg">
                        </div>
                        <div class="form-group">
                            <label for="url">超連結</label>
                            <input type="text" class="form-control" id="url" value="https://github.com/">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="showMsgNotification();">送出</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
            /**
                         * 通知訊息推播
                         * @param title   通知標題
                         * @param msg  通知內容
                         * @param url  通知連結網址
                       */
            function showMsgNotification () {
                var title = $('#title').val(), msg = $('#msg').val(), url = $('#url').val();
                var Notification = window.Notification || window.mozNotification || window.webkitNotification;

                if (Notification && Notification.permission === "granted") { /* 允許開啟通知 */
                    var instance = new Notification(
                            title, {
                                body: msg,
                                icon: "https://laravel.tw/assets/img/laravel-logo.png"
                            }
                    );
                    instance.onclick = function () {
                        // 點擊通知時執行
                        window.open(url);
                    };
                    instance.onerror = function () {
                        // 發生錯誤時執行
                    };
                    instance.onshow = function () {
                        // 顯示通知時執行
                        setTimeout(function () {
                            instance.close();
                        }, 5000);
                    };
                    instance.onclose = function () {
                        // 關閉通知時執行
                    };
                } else if (Notification && Notification.permission !== "denied") { /* chorme需手動觸發 */
                    Notification.requestPermission(function (status) {
                        if (Notification.permission !== status) {
                            Notification.permission = status;
                        }
                        // If the user said okay
                        if (status === "granted") {
                            var instance = new Notification(
                                    title, {
                                        body: msg,
                                        icon: "https://laravel.tw/assets/img/laravel-logo.png"
                                    }
                            );
                            instance.onclick = function () {
                                // 點擊通知時執行
                                window.open('https://github.com/');
                            };
                            instance.onerror = function () {
                                // 發生錯誤時執行
                            };
                            instance.onshow = function () {
                                // 顯示通知時執行
                                setTimeout(function () {
                                    instance.close();
                                }, 5000);
                            };
                            instance.onclose = function () {
                                // 關閉通知時執行
                            };

                        }else {
                            return false
                        }
                    });
                }else{
                    return false;
                }
            }
        </script>
    </body>
</html>
