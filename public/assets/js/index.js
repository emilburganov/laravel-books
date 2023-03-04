const tabs = document.querySelector('.tabs');
const tabsBtns = document.querySelectorAll('.tab-btn');
const adminPages = document.querySelectorAll('.category-group');

if (localStorage.getItem('tabIndex')) {
    document.querySelector('.btn.tab-btn.active').classList.remove('active')
    adminPages.forEach(page => page.classList.remove('active'));
    adminPages[+JSON.parse(localStorage.getItem('tabIndex'))].classList.add('active');
    tabsBtns[JSON.parse(localStorage.getItem('tabIndex'))].classList.add('active');
}

tabs.addEventListener('click', (e) => {
    if (e.target.classList.contains('tab-btn')) {
        document.querySelector('.btn.tab-btn.active').classList.remove('active')
        adminPages.forEach(page => page.classList.remove('active'));
        adminPages[e.target.getAttribute('data-index') - 1].classList.add('active');
        e.target.classList.add('active');

        localStorage.setItem('tabIndex', JSON.stringify(e.target.getAttribute('data-index') - 1));
    }
});
