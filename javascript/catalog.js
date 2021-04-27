function renderGoods() {
    let xhr = new XMLHttpRequest();

    let url = 'http://localhost/system/controllers/goods/catalog/index.php';
    let str_get = window.location.search;
    url = url + str_get;

    xhr.open('GET', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-form-urlencode');
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('catalog').innerHTML = xhr.responseText;
        }
    }
    xhr.send(null);
}

document.getElementById('catalog').innerHTML = '<img class="preloader" src="images/icons/preloader.gif" alt="">';
setTimeout(function() {
    renderGoods();
}, 1000);

// фильтры -> выпадающий список 

let nav = document.querySelectorAll('.filters-item');

nav.forEach(item => {
    item.onclick = () => {
        let type = item.closest('.filters-item').querySelector('.filters-item-style');
        type.classList.toggle("filters-show");

        let arrow =item.closest('.filters-item').querySelector('.filters-arrow');
        arrow.classList.toggle("filters-arrow-rotate");
    }
});


