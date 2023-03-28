const icons = document.querySelectorAll('.icons-group .draggable');
const equipment = document.querySelectorAll('.equipment-group .draggable');
const dropIcons = document.querySelector('.droppable-icon');
const dropEquipment = document.querySelector('.droppable-equipment');

let draggedItem = null;

// Add event listeners to all draggable items
[...icons, ...equipment].forEach(item => {
  item.addEventListener('dragstart', e => {
    draggedItem = e.target;
    e.dataTransfer.setData('text/plain', ''); // Firefox requires this
  });
});

// Add event listeners to drop zones
dropIcons.addEventListener('dragover', e => {
  e.preventDefault();
});
dropIcons.addEventListener('drop', e => {
  e.preventDefault();
  if (dropIcons.children.length === 0) {
    dropIcons.appendChild(draggedItem.cloneNode());
  }
});

dropEquipment.addEventListener('dragover', e => {
  e.preventDefault();
});
dropEquipment.addEventListener('drop', e => {
  e.preventDefault();
  if (dropEquipment.children.length === 0) {
    dropEquipment.appendChild(draggedItem.cloneNode());
  }
});
