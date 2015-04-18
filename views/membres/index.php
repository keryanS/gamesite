<h2>Liste des membres: </h2>
<table>
	<th class="header">Membre</th>
	<th class="header">eMail</th>
<?php foreach($member as $m): ?>
		<tr>
			<td><?php echo $m['usr']; ?></td>
			<td><a href="mailto: <?php echo $m['email'] ?>"> <?php echo $m['email']; ?></a>

		</tr>
<?php endforeach; ?>
</table>