
<div style="padding:5px 0px;">
	<h2>Style</h2>
	<table class="table-style">
		<tbody>
			<?php foreach($styleResult as $items): ?>
			<tr style="border:1px solid #000000;">
				<th style="width:25%;"><?php echo $items->StyleDesc ?></th>
				<td style="width:75%">
					<?php echo $items->RedaksiResult; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
