
<div class="sign_container">
<form action="signin.php" method="post">
  <h2>Sign In</h2>
  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="hello@yellow.com" required></input>

  <label for="password">Password</label>
  <input type="password" name="password" id="password" required></input>

  <button type="submit">Connect</button>
</form>

<form action="signup.php" method="post">
  <h2>Sign Up</h2>
  <label for="name">Name</label>
  <input type="text" name="name" id="name" placeholder="Pepe" required></input>


  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="hello@yellow.com" required></input>

  <label for="password">Password</label>
  <input type="password" name="password" id="password" required></input>

  <button type="submit">Connect</button>
</form>

</div>

<style>
  .sign_container {
    display: flex;
    flex-flow: row wrap;
    justify-content: space-evenly;
  }
  label {
    font-size: bolder;
  }
  
  form {
    display: flex;
    flex-flow: column nowrap;
    align-items: baseline;
    gap: 0.5em;
    background-color: gold;
    border-radius: 0.5em;
    padding: 0.5em;
    margin: 0.5em;
    
    text-align: left;
  }
</style>