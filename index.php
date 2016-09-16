<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Code Compiler</title>
  </head>
  <body>

    <form action="controller.php" method="POST">
      <label for="c_code">Code</label>
      <textarea name="c_code" id="c_code" cols="30" rows="10"></textarea>

      <label for="stdin">Stdin</label>
      <textarea name="stdin" id="stdin" cols="30" rows="5"></textarea>
      <button type="submit">Submit</button>
    </form>

  </body>
</html>
