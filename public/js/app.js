document.getElementById('toggleButton').addEventListener('click', function () {
    // Toggle visibility of child elements
    var childElements = document.getElementById('childElements');
    if (childElements.classList.contains('hidden')) {
        childElements.classList.remove('hidden');
    } else {
        childElements.classList.add('hidden');
    }
});

document.getElementById('toggleSidebar').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('md:-translate-x-full');
    sidebar.classList.toggle('sidebar-open');

    overlay.classList.toggle('hidden');
    overlay.classList.toggle('overlay-visible');
});

document.getElementById('overlay').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.remove('md:-translate-x-full');
    sidebar.classList.remove('sidebar-open');

    overlay.classList.add('hidden');
    overlay.classList.remove('overlay-visible');
});
