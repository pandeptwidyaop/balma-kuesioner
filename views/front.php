<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Halo</title>
    <link rel="stylesheet" href="<?=public_path('css/style.css')?>">
  </head>
  <body>
    <form action="<?=base_url('main/store')?>" method="post">
      <input type="text" name="nim" >
      <input type="text" name="ip" >
      <input type="submit" value="OK">
    </form>
    <?php foreach ($data as $key => $value): ?>
      <?php echo $value->nim ?> <br>
    <?php endforeach; ?>
  </body>
</html>
