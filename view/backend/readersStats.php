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
		<div>
			<p><?= '<strong>' . $dayReaders . '</strong>' ?><br />aujourd'hui</p>
			<p><?= '<strong>' . $weekReaders . '</strong>' ?><br />cette semaine</p>
		</div>
		<div>
			<p><?= '<strong>' . $monthReaders . '</strong>' ?><br />ce mois</p>
			<p><?= '<strong>' . $yearReaders . '</strong>' ?><br />cette année</p>
		</div>
	</div>

	<h2><i class="fas fa-calculator"></i> Total des lecteurs uniques : <?= '<strong>' . $allReaders . '</strong>' ?></h2>

</div>