
const vegOnlySwitch = document.getElementById('vegOnlySwitch');
const menuItemsDiv = document.getElementById('menu-items');

vegOnlySwitch.addEventListener('change', function () {
    if (vegOnlySwitch.checked) {
        loadVegMenu();
    } else {
        menuItemsDiv.innerHTML = '';
    }
});

function loadVegMenu() {

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'vegapi.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            menuItemsDiv.innerHTML = xhr.responseText;
        } else {
            menuItemsDiv.innerHTML = '<p>Failed to load veg-only menu items.</p>';
        }
    };
    xhr.send();
}


