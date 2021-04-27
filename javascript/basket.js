function fromBasket() {

    let id = event.target.closest('[data-id]').getAttribute('data-id');
    let size = event.target.closest('[data-size]').getAttribute('data-size');


    event.target.closest('.basket-item').remove();

    let xhr = new XMLHttpRequest();

    let url = 'http://localhost/system/controllers/basket/fromBasket.php';
    let str_get = '?id='+id+'&size='+size;
    url = url + str_get;

    let cost = event.target.closest('.basket-item-choice').querySelector('.basket-item-sum');
    let basketTotal = document.querySelector('.basket-total');
    let total = document.querySelector('.basket-input-total');

    xhr.open('GET', url, true);
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            if(Number(xhr.responseText) == 0) window.location.reload(true);
            document.getElementById('basket-count').innerHTML = xhr.responseText;
            document.getElementById('basket-count-adaptive').innerHTML = xhr.responseText;


            basketTotal.innerHTML = Number(basketTotal.innerHTML)-Number(cost.innerHTML);
            total.value = Number(basketTotal.innerHTML);
            sumEnd();
            
        }
    }
    xhr.send(null);
}

function plusBasket() {

    let id = event.target.closest('.basket-item-choice').querySelector('[data-id]').getAttribute('data-id');
    let size = event.target.closest('.basket-item-choice').querySelector('[data-size]').getAttribute('data-size');
    let sum = event.target.closest('.basket-item-choice').querySelector('[data-sum]').getAttribute('data-sum');
    

    let xhr = new XMLHttpRequest();

    let url = 'http://localhost/system/controllers/basket/toBasket.php';
    let str_get = '?id='+id+'&size='+size+'&sum='+sum;
    url = url + str_get;

    let count = event.target.closest('.quantity').querySelector('.quantity-count');
    let cost = event.target.closest('.basket-item-choice').querySelector('.basket-item-sum');
    let basketTotal = document.querySelector('.basket-total');
    let total = document.querySelector('.basket-input-total');
    
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            count.innerHTML = Number(count.innerHTML)+1;
            document.getElementById('basket-count').innerHTML = xhr.responseText;
            document.getElementById('basket-count-adaptive').innerHTML = xhr.responseText;
            
            cost.innerHTML = Number(sum)*Number(count.innerHTML);
            
            basketTotal.innerHTML = Number(basketTotal.innerHTML)+Number(sum);
            total.value = Number(basketTotal.innerHTML);
            sumEnd();
        }
    }
    xhr.send(null);
}

function minusBasket() {

    let id = event.target.closest('.basket-item-choice').querySelector('[data-id]').getAttribute('data-id');
    let size = event.target.closest('.basket-item-choice').querySelector('[data-size]').getAttribute('data-size');
    let sum = event.target.closest('.basket-item-choice').querySelector('[data-sum]').getAttribute('data-sum');

    let xhr = new XMLHttpRequest();

    let url = 'http://localhost/system/controllers/basket/minusBasket.php';
    let str_get = '?id='+id+'&size='+size+'&sum='+sum;
    url = url + str_get;

    let count = event.target.closest('.quantity').querySelector('.quantity-count');
    let item = event.target.closest('.basket-item');
    let cost = event.target.closest('.basket-item-choice').querySelector('.basket-item-sum');
    let basketTotal = document.querySelector('.basket-total');
    let total = document.querySelector('.basket-input-total');

    xhr.open('GET', url, true);
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){

            basketTotal.innerHTML = Number(basketTotal.innerHTML)-Number(sum);
            total.value = Number(basketTotal.innerHTML);

            if(Number(count.innerHTML)<=1) {
                item.remove();
            } else {
                count.innerHTML = Number(count.innerHTML)-1;
                cost.innerHTML = Number(sum)*Number(count.innerHTML);
            }
            if(Number(xhr.responseText) == 0) window.location.reload(true);
            document.getElementById('basket-count').innerHTML = xhr.responseText;
            document.getElementById('basket-count-adaptive').innerHTML = xhr.responseText;
            sumEnd();
        }
    }
    xhr.send(null);
}



document.getElementsByName('del_method')[0].addEventListener('change', function (e) {
    sumEnd();
    
});

function sumEnd() {
    let option = document.getElementsByName('del_method')[0].options[document.getElementsByName('del_method')[0].selectedIndex];
    let newSum = option.getAttribute('data-del');
    let delSum = document.getElementById('order-del');
    let allBasketSum = document.querySelector(".basket-input-total-del");
    let basketSum = document.querySelector(".basket-input-total");

    delSum.innerHTML = newSum;
    allBasketSum.value = Number(basketSum.value) + Number(newSum);
}

