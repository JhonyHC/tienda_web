import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let app = {}

app.productsPage = {}
app.cartPage = {}
app.aux = {}

//AUX
app.aux.createCart = (itemId = "")=>{
    localStorage.setItem('cart',JSON.stringify({[itemId]:1}))
}
app.aux.updateCart = (cart,itemId = "", qty = 1)=>{
    if(cart[itemId] == undefined){
        cart[itemId] = 1
    }else{
        cart[itemId] += qty
    }

    localStorage.setItem('cart',JSON.stringify(cart))
}
app.aux.getCartIDs = ()=>{
    let cart = JSON.parse(localStorage.getItem('cart'))
    if(cart == null){
        return 0;
    }else{
        return Object.keys(cart).join()
    }
}
app.aux.deleteProduct = (productID)=>{
    let cart = JSON.parse(localStorage.getItem('cart'))
    delete cart[productID];
    localStorage.setItem('cart',JSON.stringify(cart))
}


//PRODUCTS
app.productsPage.btnListeners = () => {
    let btns = document.getElementsByClassName('btnCarrito')
    for(let btn of btns){
        btn.addEventListener('click',()=>{
            app.productsPage.addToCart(btn.id)
        })
    }
}
app.productsPage.addToCart = (itemId)=>{
    let cart = JSON.parse(localStorage.getItem('cart'))
    console.log(cart)
    if(cart == null){
        app.aux.createCart(itemId);
    }else{
        app.aux.updateCart(cart,itemId);
    }
    
}

//CART
app.cartPage.loadCartProducts = async () =>{
    const cartProductsIDs = app.aux.getCartIDs()
    let products = await fetch(`/api/products?id=${cartProductsIDs}`).then(response=>response.json())
    console.log(products)
    if(products.data.length !== 0){
        app.cartPage.printProducts(products.data)
    }else{
        app.cartPage.printProducts([])
    }
}

app.cartPage.printProducts = (products) =>{
    const container = document.getElementById('tableContent')
    let productsWithQty = app.cartPage.joinProductQty(products)
    let contentStr = ''
    let total = 0
    for(let product of productsWithQty){
        total += product.price * product.qty;
        contentStr +=`
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-10 h-10">
                        <img class="w-full h-full rounded-full"
                            src="https://cdn.tuk.dev/assets/templates/classified/Bitmap (1).png"
                            alt=""/>
                    </div>
                        <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap">
                                ${product.name}
                            </p>
                        </div>
                    </div>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">${product.stock}</p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">${product.price}</p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="${product.id}" type="number" min="1" max="${product.stock}" value=${product.qty}>
                
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                    ${Number(product.price * product.qty).toFixed(2)}
                </p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <button type="button" id="${product.id}" class="deleteProduct bg-red-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Quitar del carrito</button>
            </td>
        </tr>
        `
    }
    container.innerHTML = contentStr
    document.getElementById('cartTotal').innerHTML = `Total: `+ Number(total).toFixed(2)
}

app.cartPage.listenClicks = ()=>{
    
    document.addEventListener("click", function(e){
        const target = e.target.closest(".deleteProduct"); // Or any other selector.
        if(target){
            console.log(target)
            //Preguntar antes
            target.parentNode.parentNode.remove()
            app.aux.deleteProduct(target.id)
            app.cartPage.updateCartTotal()

        }
      });
}

app.cartPage.joinProductQty = (products)=>{
    let cart = JSON.parse(localStorage.getItem('cart'))
    for(let product of products){
        if(product.id in cart){
            product.qty = cart[product.id]
        }
    }
    return products
}
app.cartPage.updateCartTotal = ()=>{
    console.log("Pendiente")
}

//DASHBOARD
app.dashboardPage = ()=>{

}







app.init = ()=>{
    let pathname = window.location.pathname
    
    if(pathname.includes('/products')){
        console.log("Product Page")

        app.productsPage.btnListeners()
        
    }
    if(pathname.includes('/cart')){
        console.log("Cart Page")

        app.cartPage.loadCartProducts()
        app.cartPage.listenClicks()
        
    }
    if(pathname == '/dashboard'){
        console.log("Dashboard Page")
        app.dashboardPage()
    }
  
    console.log(pathname)
}


window.addEventListener('load', function() {
    app.init()
})