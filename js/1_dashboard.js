document.querySelector('.menuInventory').addEventListener('mouseover', function() {
    const sub1 = document.querySelector('.subMenu .sub1');
    sub1.style.backgroundColor = 'aquamarine';
    sub1.style.top = '40px';
    sub1.style.display = 'block';
  });

  document.querySelector('.menuInventory').addEventListener('mouseout', function() {
    const sub1 = document.querySelector('.sub1');
    sub1.style.backgroundColor = '';
    sub1.style.top = '';
  });
