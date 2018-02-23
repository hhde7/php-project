<?php 
$dayReaders = $counterManager->getReaders(0);
$weekReaders = $counterManager->getReaders(6);
$monthReaders = $counterManager->getReaders(30);
$yearReaders = $counterManager->getReaders(364);
$allReaders = $counterManager->getReaders(364*10);

?>

<div>
	<h2><i class="fas fa-chart-line"></i> LECTEURS UNIQUES</h2>
	
	<div class="stats-square">
			<p class="col-lg-6"><?= '<strong>' . $dayReaders . '</strong>' ?><br />ce jour</p>
			<p class="col-lg-6"><?= '<strong>' . $weekReaders . '</strong>' ?><br />cette semaine</p>
			<p class="col-lg-6"><?= '<strong>' . $monthReaders . '</strong>' ?><br />ce mois</p>
			<p class="col-lg-6"><?= '<strong>' . $yearReaders . '</strong>' ?><br />cette année</p>
	</div>

	<h2><i class="fas fa-calculator"></i> Total des lecteurs uniques : <?= '<strong>' . $allReaders . '</strong>' ?></h2>

</div>