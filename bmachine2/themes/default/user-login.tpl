{* Smarty *}

{include file='header.tpl'}

<h1>Login</h1>

<form name='login' method='POST' action='{$baseUri}user/login'>
      <label for='username'>Username:</label> <input type='text' name='username' />
      <br/>
      <label for='pass'>Password:</label> <input type='password' name='pass' />
      <br/>
      <input type='submit' name='submit' value='Login' />
</form>

{include file='footer.tpl'}

