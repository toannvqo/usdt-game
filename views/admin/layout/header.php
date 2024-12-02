<?php if (!defined('IN_SITE')) {
	die('The Request Not Found');
} ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $body['title']; ?></title>
	<!-- Google Font: Source Sans Pro -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="rotkuma" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:title" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:description" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:image" content="social-image.png">
	<meta name="format-detection" content="telephone=no">
	<!-- PAGE TITLE HERE -->

	<link href="<?= BASE_URL(''); ?>public/hudadmin/assets/css/vendor.min.css" rel="stylesheet">
	<link href="<?= BASE_URL(''); ?>public/hudadmin/assets/css/app.min.css" rel="stylesheet">


	<!-- CUSTOM -->
	<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->



	<link class="main-stylesheet" href="<?= BASE_URL(''); ?>public/cute-alert/style.css" rel="stylesheet" type="text/css">
	<script src="<?= BASE_URL(''); ?>public/cute-alert/cute-alert.js"></script>
	<script src="<?= BASE_URL(''); ?>public/js/jquery-3.6.0.js"></script>
	<!-- <script src="../../assets/js/sweetalert2@11.js"></script> -->

	<!-- PAGE TITLE HERE -->

	<!-- Databse -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
	<!-- Databse -->

	<link href="<?= BASE_URL(''); ?>public/sweetalert2/default.css" rel="stylesheet" type="text/css" />
	<!-- Sweet Alerts js -->
	<script src="<?= BASE_URL(''); ?>public/sweetalert2/sweetalert2.js"></script>

    <link href="<?= BASE_URL(''); ?>public/hudadmin/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css" rel="stylesheet">
    <script src="<?= BASE_URL(''); ?>public/hudadmin/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js"></script>

	<?= $body['header']; ?>
</head>