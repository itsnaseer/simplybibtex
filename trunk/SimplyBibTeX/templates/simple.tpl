<div class="<?=$oddeven?> item">

	<div onclick="javascript:toggle('notes_<?=$number?>');" title="Click to know more about <?=$title?>" style="float:right;border:1px dotted #e00;background-color:#d00;color:white;padding:0.1em;" >&nbsp;&nbsp;</div>
	
	<?=$author?>, (<?=$year?>) <i><?=$title?>, <?=$journal?></i>

	<div id="notes_<?=$number?>" class="hidden">

		<div class="item_extended">
			<b>Abstract:</b>&nbsp;<?=$abstract?>
			<br/>
			<b>Pages:</b>&nbsp;<?=$pages?>
			<br/>
			<b>Booktitle (Journal):</b>&nbsp;<?=$booktitle?> (<?=$journal?>)
			<br/>
			<b>Publisher:</b>&nbsp;<?=$publisher?>
			<br/>
			<b>Location:</b>&nbsp;<?=$address?>
			<br/>
			<b>URL:</b>&nbsp;<a href="<?=$url?>" target="_blank" title="<?=$title?>"><?=$url?></a>
			<br/>
		</div>
		<div class="item_menu">
			<a href="<?=$link?>?id=<?=$number?>&amp;db=<?=$db?>">Backlink</a>
		</div>

	</div>
</div>
