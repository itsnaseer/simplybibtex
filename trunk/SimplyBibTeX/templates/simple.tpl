<div class="<?=$oddeven?> item">

	<div onclick="javascript:toggle('notes_<?=$number?>');" title="Click to know more about <?=$title?>" style="float:right"><img src="templates/images/toggle.gif" width="16" height="16" /></div>
	
	<?=$author?>, (<?=$year?>) <i><?=$title?>, <?=$journal?></i>
	<div id="notes_<?=$number?>" class="hidden">

		<div class="item_extended">
			<b>Author:</b>&nbsp;<?=$author?>
			<br/>
			<b>Title:</b>&nbsp;<?=$title?>
			<br/>
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
			<a href="<?=$link?>?id=<?=$number?>&amp;db=<?=$db?>">Backlink</a> | 
			<span onclick="javascript:toggle('comments_<?=$number?>')">Comment</span> | 
			<span onclick="javascript:toggle('edit_<?=$number?>')">Edit</span>
		</div>
		<![CDATA[
		<div id="comments_<?=$number?>" class="hidden">
			<div class="comment">
			Not yet implemented!
			</div>
		</div>
		<div id="edit_<?=$number?>" class="hidden">
			<div class="comment">
			<code>
			<?=$raw?>
			</code>
			</div>
		</div>
		]]>		

	</div>
</div>
