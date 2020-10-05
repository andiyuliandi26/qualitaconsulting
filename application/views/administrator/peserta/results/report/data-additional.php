
<div style="padding:5px 0px;">
	<h2>Additional Result</h2>
	<table class="table-style">
		<tbody>
			<?php foreach($additionalResult as $items): ?>
			<tr style="border:1px solid #000000;">
				<th style="width:25%;"><?php echo $items->Item ?></th>
				<td style="width:75%">
					<?php echo $items->ItemDescription; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
