// Get the icon and equipment elements
const icons = document.querySelectorAll('.icon');
const equipment = document.querySelectorAll('.equipment');

// Add event listeners to the icons
icons.forEach(icon => {
  icon.addEventListener('click', () => {
    // Remove the selected class from all icons
    icons.forEach(icon => icon.classList.remove('selected'));
    // Add the selected class to the clicked icon
    icon.classList.add('selected');
  });
});

// Add event listeners to the equipment options
equipment.forEach(option => {
  option.addEventListener('click', () => {
    // Remove the selected class from all equipment options
    equipment.forEach(option => option.classList.remove('selected'));
    // Add the selected class to the clicked option
    option.classList.add('selected');
  });
});
