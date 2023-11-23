// const toggle = document.getElementById('toggle');

// toggle.addEventListener('click', function() {
//     this.classList.toggle('active');
// });

const toggle = document.getElementById('toggle');
const menuList = document.querySelector('.menu-list');

toggle.addEventListener('click', function() {
    this.classList.toggle('active');
    if (this.classList.contains('active')) {
        const icons = document.querySelectorAll('.menu-list > li');
        icons.forEach(icon => {
            menuList.insertBefore(icon, toggle);
        });
    }
});