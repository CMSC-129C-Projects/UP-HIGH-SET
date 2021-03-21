<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/css/bootstrap-4.6.0/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/css/datatables/jquery.dataTables.min.css"/>
    <style>
        body {
            background-color: green;
        }
        table thead {
            background: yellow !important;
        }
        table td, table tr{
            background: transparent !important;
        }
    </style>
</head>
<body>
    <?= $this->renderSection('content');?>

    <script type="text/javascript" src="<?=base_url()?>/public/js/jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>/public/js/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>/public/js/custom/showList.js"></script>
</body>
</html>