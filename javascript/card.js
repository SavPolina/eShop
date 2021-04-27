function toBasket() {
    let xhr = new XMLHttpRequest();

    let url = 'http://localhost/system/controllers/basket/toBasket.php';
    let str_get = window.location.search;

    let sizeBtn = document.getElementsByName('size');

    for (let size of sizeBtn) {
        if(size.checked) {
            str_get = str_get + '&size=' + size.value;
        }
    }

    url = url + str_get;

    xhr.open('GET', url, true);
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('basket-count').innerHTML = xhr.responseText;
            document.getElementById('basket-count-adaptive').innerHTML = xhr.responseText;
        }   

    }
    xhr.send(null);
    

    let basketBtn = document.getElementById('basket-button');
    basketBtn.innerHTML = `В корзине`;
    basketBtn.classList.add('in-basket');
    
    setTimeout(() => {
        basketBtn.innerHTML = `Добавить в корзину`; 
        basketBtn.classList.remove('in-basket');
    }, 700);
    
}