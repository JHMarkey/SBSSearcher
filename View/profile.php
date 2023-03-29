<?php
require("../View/_inc/head.php");
require("../View/_inc/sidebar.php");
?>

<div class="container">
<form>
  <label>
    <h1>Select an icon:</h1>
    <select name="icon">
      <option value="icon1">Icon 1</option>
      <option value="icon2">Icon 2</option>
      <option value="icon3">Icon 3</option>
    </select>
  </label>

  <label>
    <h1> Select a piece of equipment: </h1>
    <select name="equipment">
      <option value="equipment1">Equipment 1</option>
      <option value="equipment2">Equipment 2</option>
      <option value="equipment3">Equipment 3</option>
    </select>
  </label>
</form>

</div>

<script src="../View/scripts/Profile.js"></script>