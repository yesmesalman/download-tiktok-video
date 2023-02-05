<!DOCTYPE html>
<html>

<head>
    <title>TikTok System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/index.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Gotu&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container-fluid">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4 p-5">
                    <?php include('./includes/navbar.php'); ?>
                </div>
                <div class="col-md-8 p-5">
                    <?php include('./includes/router.php'); ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>