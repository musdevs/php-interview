# Шаблоны в DOM

## [An easier way to manage HTML DOM using Javascript](https://blog.freshbits.in/an-easier-way-to-manage-html-dom-using-javascript)

There is a template HTML tag that is not shown on the page by default. We can use it to host our HTML code like
```html
<template id="cart-item">
    <div>
        <img class="w-10 h-10 object-cover rounded-md cart-item-image" />
        <span class="ml-4 font-semibold text-sm cart-item-name"></span>
        <div class="cart-item-price"></div>
        <button class="px-3 py-1 rounded-md bg-red-300 text-white cart-item-delete">x</button>
    </div>
</template>
```

```javascript
function displayCart() {
    // Abbreviating other stuff to focus on the core topic...

    var template = document.getElementById('cart-item');

    for (let i = 0; i < cart.length; i++) {
        var cartItemTag = template.content.cloneNode(true);

        cartItemTag.querySelector("img.cart-item-image").src = cart[i].img;
        cartItemTag.querySelector("span.cart-item-name").innerHTML = cart[i].name;
        cartItemTag.querySelector("div.cart-item-price").innerHTML = cart[i].price;
        cartItemTag.querySelector("button.cart-item-delete").onclick = function() { removeFromCart(cart[i].id) };
    }
}
```
