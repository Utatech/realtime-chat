<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <h2 class="text-center">RealTime Chat</h2><br>
    <div class="container tambahan">
        <div class="row">
            <div class="col-md-12">
                <div class="tempatnya" id="turun">

                </div>
                <!-- input chat -->
                <?php
                $namaa = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                ?>
                <div class="form-group">
                    <input type="text" name="nama" class="form-control name" value="<?php echo $namaa ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="pesan" class="form-control price" placeholder="Tulis Pesan">
                </div>
                <div class="form-group kanan">
                    <button type="submit" class="btn btn-primary btn-save">Kirim</button>
                </div>
                <!-- End input chat -->


            </div>
        </div>
    </div>





    <script src="assets/jquery.min.js"></script>
    <script src="assets/pusher.min.js"></script>
    <script src="assets/popper.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // CALL FUNCTION SHOW PRODUCT
            tempatnya();
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('27763f91179d21c27a1f', {
                cluster: 'ap1',
                forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                if (data.message === 'success') {
                    tempatnya();
                    $('.tempatnya').animate({
                        scrollTop: $(
                            '.tempatnya').get(0).scrollHeight
                    }, 500);
                }
            });

            // FUNCTION SHOW PRODUCT
            function tempatnya() {
                $.ajax({
                    url: '<?php echo site_url("Pesan/panggil_nama"); ?>',
                    type: 'GET',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var count = 1;
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<p class="box"><b>' + data[i].nama + '</b><br>' + data[i].pesan + '<br></p>';
                        }
                        $('.tempatnya').html(html);
                    }

                });
            }

            // CREATE NEW PRODUCT
            $('.btn-save').on('click', function() {
                var nama = $('.name').val();
                var pesan = $('.price').val();
                $.ajax({
                    url: '<?php echo site_url("Pesan/create"); ?>',
                    method: 'POST',
                    data: {
                        nama: nama,
                        pesan: pesan
                    },
                    success: function() {
                        $('.name').val("<?php echo $namaa ?>");
                        $('.price').val("");
                    }
                });
            });
            // END CREATE PRODUCT

        });
    </script>

    <script>
        window.__lc = window.__lc || {};
        window.__lc.license = 12221055;;
        (function(n, t, c) {
            function i(n) {
                return e._h ? e._h.apply(null, n) : e._q.push(n)
            }
            var e = {
                _q: [],
                _h: null,
                _v: "2.0",
                on: function() {
                    i(["on", c.call(arguments)])
                },
                once: function() {
                    i(["once", c.call(arguments)])
                },
                off: function() {
                    i(["off", c.call(arguments)])
                },
                get: function() {
                    if (!e._h) throw new Error("[LiveChatWidget] You can't use getters before load.");
                    return i(["get", c.call(arguments)])
                },
                call: function() {
                    i(["call", c.call(arguments)])
                },
                init: function() {
                    var n = t.createElement("script");
                    n.async = !0, n.type = "text/javascript", n.src = "https://cdn.livechatinc.com/tracking.js", t.head.appendChild(n)
                }
            };
            !n.__lc.asyncInit && e.init(), n.LiveChatWidget = n.LiveChatWidget || e
        }(window, document, [].slice))
    </script>
    <noscript><a href="https://www.livechatinc.com/chat-with/12221055/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
</body>

</html>