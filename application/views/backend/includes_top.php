<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">-->
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/neon-core.css">
<link rel="stylesheet" href="assets/css/neon-theme.css">
<link rel="stylesheet" href="assets/css/neon-forms.css">

<link rel="stylesheet" href="assets/css/custom.css">
<?php if ($text_align == 'right-to-left') :?>
	<link rel="stylesheet" href="assets/css/neon-rtl.css">
<?php endif;?>
<script src="assets/js/jquery-1.11.0.min.js"></script>

<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="shortcut icon" href="assets/images/favicon.png">
<link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/js/vertical-timeline/css/component.css">

<!--<link rel="stylesheet" type="text/css" href="assets/js/datatables/ajax/dataTables.bootstrap.css"/>-->

<!-- ajax datatable -->
<script type="text/javascript" src="assets/js/datatables/ajax/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/datatables/ajax/dataTables.bootstrap.js"></script>

<!-- emoji -->
<script src="//cdn.jsdelivr.net/emojione/1.4.1/lib/js/emojione.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/emojione/1.4.1/assets/css/emojione.min.css"/>

<style type="text/css">
    #map_canvas {
		width: 100%;
		height: 300px;
		margin-bottom: 5px;
	}

	/*#pickLocation {
		margin-left: 12px;
	}*/
	#mapContainer input {
		width: 130px;
		position: relative;
		top: 30px;
		left: 3px;
		z-index: 5;
		background-color: #fff;
		padding: 2px;
		border: 1px solid #999;
	}

</style>

<?php if($page_name == "manager_message"){?>
<script type="text/javascript" src="//cdn.jsdelivr.net/gmap3/5.0b/gmap3.min.js"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places" ></script>
<?php }?>

<?php if($page_name == "manager_location"){?>
    <script type="text/javascript" src="assets/js/dist/crs.min.js"></script>
		<link rel="stylesheet" href="assets/css/dist.css">

<!-- -->
<?php }?>
