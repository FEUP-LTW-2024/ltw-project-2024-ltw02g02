const list = document.getElementById('menulist');
const cross = document.getElementById('menuclosed');
const menu = document.getElementById('menu');
list.addEventListener('click',function() {
    this.classList.toggle('dissapear');
    cross.classList.toggle('dissapear');
    menu.classList.toggle('open');
})
cross.addEventListener('click',function() {
    this.classList.toggle('dissapear');
    list.classList.toggle('dissapear');
    menu.classList.toggle('open');
})