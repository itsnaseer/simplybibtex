<div class="<?=$oddeven?> item">

	<div onclick="javascript:toggle('notes_<?=$number?>');" title="Click to know more about <?=$title?>" style="float:right;clear:left;">
		<img src="templates/images/toggle.gif" width="16" height="16" />
	</div>
	
	<div class="item_short">
	<?=$author?>, (<?=$year?>) <i><?=$title?>, <?=$journal?></i>
	</div>
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
			<b>Notes:</b>&nbsp;<?=$notes?>
		</div>
		<div class="item_menu">
			<a href="<?=$link?>?id=<?=$number?>&amp;db=<?=$db?>">Backlink</a>&nbsp;
			<span class="link" onclick="javascript:toggle('edit_<?=$number?>')" title="Edit">Edit</span>&nbsp;
			<span onclick="javascript:toggle('comment_<?=$number?>')" title="Comment">Comment</span>
		</div>

		<div id="edit_<?=$number?>" class="hidden">
		
			<form class="item_edit" action="include/commit.php" method="post">
				
				<input type="hidden" name="linebegin" value="<?=$linebegin?>" />
				<input type="hidden" name="lineend" value="<?=$lineend?>" />
				<input type="hidden" name="command" value="update_item" />
				<input type="hidden" name="db" value="<?=$db?>" />

				<fieldset>
					<legend>BibTeX Entry</legend>
					<input type="submit" value="Update" />
					<input type="reset" value="Clear" />
					<textarea type="text" rows="20" cols="70" name="item"><?=$raw?></textarea>
				</fieldset>
				
				
			</form>
		</div>		

	</div>
</div>
