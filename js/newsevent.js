var request = new XMLHttpRequest();

request.open('GET', "https://hplussport.com/api/products");

request.onload = function() {
    var response = request.response;
    var productInfo = JSON.parse(response);
    console.log(productInfo);

    for (item in productInfo) {
        var name = productInfo[item].name;
        var sportsProducts = document.createElement('li');
        sportsProducts.innerHTML = name;
        document.getElementById("products-list").appendChild(sportsProducts);

        var imageUrl = productInfo[item].image;
        var images = document.createElement('img');
        images.setAttribute('src', imageUrl);
        document.getElementById("products-list").appendChild(images);

        var description = productInfo[item].description;
        var sportsProducts = document.createElement('li');
        sportsProducts.innerHTML = description;
        document.getElementById("description").appendChild(sportsProducts);
    }   
};

request.send();