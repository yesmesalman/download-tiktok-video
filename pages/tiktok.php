<div>
    <form method="POST" class="mt-2">
        <div class="form-group">
            <label for="tiktok-url">Paste URL & download video</label>
            <input class="form-control" type="text" placeholder="https://www.tiktok.com/@username/video/1234567890123456789" name="tiktok-url" />
        </div>
        <div class="form-group mt-3">
            <button class="btn btn-primary" type="submit">Download</button>
        </div>
    </form>

    <?php include('./components/tiktok.php'); ?>
    <?php
    $store_locally = true;

    if (isset($_GET['url']) && !empty($_GET['url'])) {
        if ($_SERVER['HTTP_REFERER'] != "") {
            $url = $_GET['url'];
            $name = downloadVideo($url);
            echo $name;
            exit();
        } else {
            echo "";
            exit();
        }
    }

    if (isset($_POST['tiktok-url']) && !empty($_POST['tiktok-url'])) {
        $url = trim($_POST['tiktok-url']);
        $resp = getContent($url);
        $check = explode('"downloadAddr":"', $resp);
        if (count($check) > 1) {
            $contentURL = explode("\"", $check[1])[0];
            $contentURL = escape_sequence_decode($contentURL);
            $thumb = explode("\"", explode('"dynamicCover":"', $resp)[1])[0];
            $thumb = escape_sequence_decode($thumb);
            $username = explode('/', explode('rel="canonical" href="https://www.tiktok.com/@', $resp)[1])[0];
            $create_time = explode('"', explode('"createTime":"', $resp)[1])[0];
            $dt = new DateTime("@$create_time");
            $create_time = $dt->format("d M Y H:i:s A");
            $videoKey = getKey($contentURL);
            if (!file_exists("user_videos") && $store_locally) {
                mkdir("user_videos");
            }
            if ($store_locally) {
    ?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#wmarked_link').text("Please wait ...");
                        $.get('./<?php echo basename($_SERVER['PHP_SELF']); ?>?url=<?php echo urlencode($contentURL); ?>').done(function(data) {
                            $('#wmarked_link').removeAttr('disabled');
                            $('#wmarked_link').attr('onclick', 'window.location.href="' + data + '"');
                            $('#wmarked_link').text("Download Video");
                        });
                    });
                </script>
            <?php
            }
            ?>
            <div class="border m-3 mb-5" id="result">
                <div class="row m-0 p-2">
                    <div class="col-sm-5 col-md-5 col-lg-5"><img width="250px" height="250px" src="<?php echo $thumb; ?>"></div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mt-5">
                        <ul style="list-style: none;padding: 0px">
                            <li>a video by <b>@<?php echo $username; ?></b></li>
                            <li>uploaded on <b><?php echo $create_time; ?></b></li>
                            <li><button id="wmarked_link" disabled="disabled" class="btn btn-primary mt-3" onclick="window.location.href='<?= ($store_locally) ? $filename : $contentURL ?>'">Download Video</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <script>
                $(document).ready(function() {
                    $('html, body').animate({
                        scrollTop: ($('#result').offset().top)
                    }, 1000);
                });
            </script>
            <div class="mx-5 px-5 my-3" id="result">
                <div class="alert alert-danger mb-0"><b>Please double check your url and try again.</b></div>
            </div>

    <?php
        }
    }
    ?>
    <div class="m-5">
        &nbsp;
    </div>
    <script type="text/javascript">
        window.setInterval(function() {
            if ($("input[name='tiktok-url']").attr("placeholder") == "https://www.tiktok.com/@username/video/1234567890123456789") {
                $("input[name='tiktok-url']").attr("placeholder", "https://vm.tiktok.com/a1b2c3/");
            } else {
                $("input[name='tiktok-url']").attr("placeholder", "https://www.tiktok.com/@username/video/1234567890123456789");
            }
        }, 3000);
    </script>
</div>