{* Smarty *}

{include file='header.tpl'}

<h1>Add a User</h1>

<form name='user-add' method='POST' action='{$baseUri}user/signup' >
      <label for='name'>Name:</label>
      <input name='name' type='text' />
      <br/>
      <label for='username'>Username:</label>
      <input name='username' type='text' />
      <br/>
      <label for='pass'>Password:</label>
      <input name='pass' type='password' />
      <br/>
      <label for='pass_confirm'>Confirm:</label>
      <input name='password_confirm' type='password' />
      <br/>
      <label for='email'>Email:</label>
      <input name='email' type='text' />
      <br/>
      <input name='signup' type='submit' value='Signup' />
</form>

{include file='footer.tpl'}

