<li class="<?php echo $oddeven;?> item">
	<div class="item_short" onclick="javascript:toggle('notes_<?php echo $number;?>',this);">
	<?php echo $author;?>, (<? php echo $year;?>) <i><?php echo $title;?>, <?php echo $journal;?></i>
	</div>
	<div id="notes_<?php echo $number;?>" class="hidden">
		<div class="item_extended">
			<b>Author:</b>&nbsp;<?php echo $author;?>
			<br/>
			<b>Title:</b>&nbsp;<?php echo $title;?>
			<br/>
			<b>Abstract:</b>&nbsp;<?php echo $abstract;?>
			<br/>
			<b>Pages:</b>&nbsp;<?php echo $pages;?>
			<br/>
			<b>Booktitle (Journal):</b>&nbsp;<?php echo $booktitle;?> (<?php echo $journal;?>)
			<br/>
			<b>Publisher:</b>&nbsp;<?php echo $publisher;?>
			<br/>
			<b>Location:</b>&nbsp;<?php echo $address;?>
			<br/>
			<b>URL:</b>&nbsp;<a href="<?php echo $url;?>" target="_blank" title="<?php echo $title;?>"><?php echo $url;?></a>
			<br/>
			<b>Notes:</b>&nbsp;<?php echo $notes;?>
		</div>
		<div class="item_menu">
			<a href="<?php echo $link;?>?id=<?php echo $number;?>&amp;db=<?php echo $db;?>">Backlink</a>&nbsp;
			<span class="link" onclick="javascript:toggle('edit_<?php echo $number;?>')" title="Edit">Edit</span>&nbsp;
			<span class="link" onclick="javascript:toggle('comment_<?php echo $number;?>')" title="Comment">Comment</span>
		</div>

		<div id="edit_<?php echo $number;?>" class="hidden">
		
			<form class="item_edit" action="include/commit.php" method="post">
				
				<input type="hidden" name="linebegin" value="<?php echo $linebegin;?>" />
				<input type="hidden" name="lineend" value="<?php echo $lineend;?>" />
				<input type="hidden" name="command" value="update_item" />
				<input type="hidden" name="db" value="<?php echo $db;?>" />

				<fieldset>
					<legend>BibTeX Entry</legend>
					<input type="submit" value="Update" />
					<input type="reset" value="Clear" />
					<textarea type="text" rows="20" cols="70" name="item"><?php echo $raw;?></textarea>
				</fieldset>
				
				
			</form>
		</div>		

		<div id="comment_<?php echo $number;?>" class="hidden">

			<form class="item_comment" action="include/commit.php" method="post">
		
				<input type="hidden" name="command" value="comment_item" />
				<input type="hidden" name="id" value="<?php echo $number;?>" />
				<input type="hidden" name="db" value="<?php echo $db;?>" />

				<fieldset>
					<legend>Add Comment</legend>
					<textarea type="text" rows="10" cols="70" name="item"></textarea>
					<input type="submit" value="Submit" />
					<input type="reset" value="Forget" />					
				</fieldset>				
				
			</form>

			
		</div>

	</div>
</li>
