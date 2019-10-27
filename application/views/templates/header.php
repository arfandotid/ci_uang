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

<body class="bg-light">

    <div class="row m-0 justify-content-center">
        <div class="col-lg-6 py-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <?= $this->session->flashdata('pesan'); ?>