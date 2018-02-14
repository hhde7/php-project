<?php 
$dayReaders = $counterManager->getReaders(0);
$weekReaders = $counterManager->getReaders(6);
$monthReaders = $counterManager->getReaders(30);
$yearReaders = $counterManager->getReaders(364);
$allReaders = $counterManager->getReaders(364*10);

?>


<p>Nombre de lecteurs unique</p><br />
<p><?= $dayReaders ?> aujourd'hui</p>
<p><?= $weekReaders ?> cette semaine</p>
<p><?= $monthReaders ?> ce mois</p>
<p><?= $yearReaders ?> cette année</p>
<p>Total des lecteurs uniques : <?= $allReaders ?></p>
