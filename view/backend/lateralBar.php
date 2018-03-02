<?php
if ($_GET['action'] != 'dashboard') {
    ?>
	<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs" id="menu">
<?php
} else {
        ?>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" id="menu">
<?php
    }
?>
		<h2 id="admin-title">ADMINISTRATION DU BLOG</h2>
		<?php
        include('menu.php');
        ?>

		<h2 id="posts-stats-title">MES ARTICLES</h2>
		<div id="posts-stats">
			<?php
            include('postsStats.php');
            ?>
		</div>

		<h2 id="readers-stats-title">MES LECTEURS</h2>
		<div id="readers-stats">
			<?php
            include('readersStats.php');
            ?>
		</div>

	</div>
