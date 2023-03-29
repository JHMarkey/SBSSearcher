<?php
// Get the selected icon and equipment values
$icon = $_POST['icon'];
$equipment = $_POST['equipment'];

// Display information about the selected icon and equipment
if ($icon == 'icon1' && $equipment == 'equipment1') {
  echo 'Information about Icon 1 and Equipment 1';
} elseif ($icon == 'icon2' && $equipment == 'equipment2') {
  echo 'Information about Icon 2 and Equipment 2';
} elseif ($icon == 'icon3' && $equipment == 'equipment3') {
  echo 'Information about Icon 3 and Equipment 3';
} else {
  echo 'Please select an icon and equipment';
}
?>