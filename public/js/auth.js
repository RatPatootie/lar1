function openTab(tabName) {
    let tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(function(tab) {
        tab.classList.remove('active');
    });

    document.getElementById(tabName).classList.add('active');
}
