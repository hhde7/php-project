<?php 
$dayReaders = $counterManager->getReaders(0);
$weekReaders = $counterManager->getReaders(6);
$monthReaders = $counterManager->getReaders(30);
$yearReaders = $counterManager->getReaders(364);
$allReaders = $counterManager->getReaders(364*10);

?>


<p>Nombre de lecteurs unique</p><br />
<p>Aujourd'hui : <?= $dayReaders ?></p>
<p>Cette semaine : <?= $weekReaders ?></p>
<p>Ce mois : <?= $monthReaders ?></p>
<p>Cette année : <?= $yearReaders ?></p>
<p>Total des lecteurs uniques : <?= $allReaders ?></p>
