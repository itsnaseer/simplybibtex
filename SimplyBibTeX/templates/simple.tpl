<div class="<?=$oddeven?> item">

	<div onmouseover="javascript:changeClass('notes_<?=$number?>','visible');" onmouseout="javascript:changeClass('notes_<?=$number?>','hidden');" style="float:right;background-color:#e00;color:white;padding:0.25em;" >&gt;</div>
	
	<?=$author?>, (<?=$year?>) <i><?=$title?>, <?=$journal?></i>

	<div id="notes_<?=$number?>" class="hidden">
		<b>Abstract:</b>&nbsp;<?=$abstract?>
		<br/>
		<b>Pages:</b>&nbsp;<?=$pages?>
		<br/>
		<b>Publisher:</b>&nbsp;<?=$publisher?>
		<br/>
		<b>Location:</b>&nbsp;<?=$address?>
		<br/>
		<b>URL:</b>&nbsp;<a href="<?=$url?>" target="_blank" title="<?=$title?>"><?=$url?></a>
		<br/>
		<b>BibTeX:</b>&nbsp;<?=$raw?>
		<br/>
	</div>
</div>
