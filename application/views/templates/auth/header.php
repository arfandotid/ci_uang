<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $judul; ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
</head>

<style type="text/css">
    html,
    body {
        height: 100%;
    }
</style>

<body class="bg-light">
    <div class="row justify-content-center h-100 m-0">
        <div class="col-md-4 col-sm-8 align-self-center">
            <?= form_open(); ?>
            <div class="card">
                <div class="card-body">