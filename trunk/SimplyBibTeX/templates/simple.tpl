<div onMouseOver="changeClass(notes_<?=$number?>,'visible')" class="<?=$oddeven?> item" onMouseOut="changeClass(notes_<?=$number?>,'hidden')">

	<?=$author?>, (<?=$year?>) <i><?=$title?>, <?=$journal?></i>

	<div id="notes_<?=$number?>" class="hidden" >
		<b>Abstract:</b>&nbsp;<?=$abstract?>
		<br/>
		<b>Pages:</b>&nbsp;<?=$pages?>
		<br/>
		<b>Publisher:</b>&nbsp;<?=$publisher?>
		<br/>
		<b>Location:</b>&nbsp;<?=$address?>
		<br/>
		<b>BibTeX:</b><code>
			<?=$raw?>
		</code>
	</div>
</div>
