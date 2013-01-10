<?=get_messages_from_session()?>
<h1>Login</h1>
<p>Login using your acronym or email.</p>
<br/>

<?=$login_form->GetHTML('form')?>
  <fieldset>
    <?=$login_form['acronym']->GetHTML()?>
    <?=$login_form['password']->GetHTML()?>
    <?=$login_form['login']->GetHTML()?>
    <?php if($allow_create_user) : ?>
    	<a class='btn btn-primary' href='<?=$create_user_url?>' title='Create a new user account'>Create user</a></p>
    <?php endif; ?>
  </fieldset>
</form>
<br/>