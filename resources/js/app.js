import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let app = {}

app.productsPage = {}
app.aux = {}

//AUX
app.aux.createCart = (itemId = "")=>{
    localStorage.setItem('cart',JSON.stringify({[itemId]:1}))
}

app.aux.updateCart = (cart,itemId = "", qty = 1)=>{
    if(cart[itemId] == undefined){
        cart[itemId] = 1
    }else{
        cart[itemId]++
    }

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




//DASHBOARD
app.dashboardPage = ()=>{

}







app.init = ()=>{
    let pathname = window.location.pathname
    
    if(pathname.includes('/products')){
        console.log("Product Page")

        app.productsPage.btnListeners()
        
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