<?=get_messages_from_session()?>
<h1>Lanaya Guestbook Example</h1>
<p>Showing off how to implement a guestbook in Lanaya. Now saving to database.</p>

<form action="<?=$form_action?>" method='post'>
  	<p>
    	<br/><label>Name: <br/>
    	<input type="text" name="name"></label>
    	<br/><label>Message: <br/>
    	<textarea name='message'></textarea></label>
  	</p>
  	<p>
    	<input type='submit' class='btn btn-primary' name='doAdd' value='Add message' />
    	<input type='submit' class='btn btn-primary' name='doClear' value='Clear all messages' />
    	<input type='submit' class='btn btn-primary' name='doCreate' value='Create database table' />
	</p>
</form>

<h2>Current messages</h2>

<?php foreach($entries as $val):?>
	<div style='background-color:#f6f6f6;border:1px solid #ccc;margin-bottom:1em;padding:1em;'>
	  <p>[<?=$val['created']?>] <b><?=$val['name']?>:</b></p>
	  <p><?=$val['entry']?></p>
	</div>
<?php endforeach;?>