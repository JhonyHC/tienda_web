import './bootstrap';

import 'flowbite'
import Swal from 'sweetalert2'
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

let app = {}

app.productsPage = {}
app.cartPage = {}
app.ordersPage = {}
app.aux = {}

//AUX
app.aux.createCart = (itemId = "")=>{
    localStorage.setItem('cart',JSON.stringify({[itemId]:1}))
}
app.aux.updateCart = (cart,itemId = "", qty = 1)=>{
    if(cart[itemId] == undefined){
        cart[itemId] = 1
    }else{
        if(qty == 1)
            cart[itemId] += qty
        else
            cart[itemId] = qty
    }

    localStorage.setItem('cart',JSON.stringify(cart))
}
app.aux.getCartIDs = ()=>{
    let cart = JSON.parse(localStorage.getItem('cart'))
    if(cart == null){
        return -1;
    }else{
        return Object.keys(cart).join()
    }
}
app.aux.deleteProduct = (productID)=>{
    let cart = JSON.parse(localStorage.getItem('cart'))
    delete cart[productID];
    localStorage.setItem('cart',JSON.stringify(cart))
}
app.aux.deleteCart = ()=>{
    Swal.fire({
        title: '¿Quieres eliminar todos los productos del carrito?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Vaciar carrito'
      }).then((result) => {
        if (result.isConfirmed) {
            localStorage.removeItem('cart')
            app.cartPage.loadCartProducts()
            Toastify({
                text: `Carrito eliminado`,
                duration: 3000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                  background: "linear-gradient(to right, #4FF6F1, #06A5A1)",
                },
              }).showToast();   
        }
      })
}
app.aux.cerrarSesion = ()=>{
    let btnCerrar = document.getElementsByClassName('cerrarSesion')[0]
    btnCerrar.addEventListener('click', e=>{
        localStorage.removeItem('cart')
    })
}
app.aux.getFormData = (form) =>{
    let formData = new FormData(form)
    return Object.fromEntries(formData)
} 
app.aux.postRequest = async (url,data)=>{
    let res = await fetch(url,{
        method: 'POST',
        headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })

    const content = await res.json()
    return content;
    /* if(res.ok){
        
        let ret = await res.json()
        console.log(ret)
        return JSON.parse(ret.data)
    }else{
        console.log(res)
        return `HTTP error: ${res.status}`
    } */

}


//PRODUCTS
app.productsPage.btnListeners = () => {
    let btns = document.getElementsByClassName('btnCarrito')
    const urlFull = location.protocol + '//' + location.host;
    for(let btn of btns){
        btn.addEventListener('click',()=>{
            app.productsPage.addToCart(btn.id)
            Toastify({
                text: `Producto agregado al carrito: ${btn.name}`,
                duration: 3000,
                destination: `${urlFull}/user/cart`,
                newWindow: false,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                  background: "linear-gradient(to right, #4FF6F1, #06A5A1)",
                },
              }).showToast();
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
    const urlFull = location.protocol + '//' + location.host;
    for(let product of productsWithQty){
        console.log(product)
        total += product.price * product.qty;
        contentStr +=`
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-10 h-10">
                        <img class="w-full h-full rounded-full"
                        src="${product.image ? urlFull.concat("/storage/",product.image) : urlFull.concat("/storage/images/no-image.jpg")}"
                            alt="image"/>
                    </div>
                        <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap">
                                ${product.name}
                            </p>
                        </div>
                    </div>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap" id="productStock_${product.id}">${product.stock}</p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p id="productPrice_${product.id}" class="text-gray-900 whitespace-no-wrap">${product.price}</p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <input productid="${product.id}" id="productQty_${product.id}" class="inputQty shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" min="1" max="${product.stock}" value=${product.qty}>
                
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap" id="productTotal_${product.id}">
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
    document.getElementById('btnPagar').innerHTML = `Hacer pedido $`+ Number(total).toFixed(2)
    document.getElementById('btnPagar').setAttribute('total',total)
    
}
app.cartPage.getTotal = async ()=>{
    let total = 0
    const cartProductsIDs = app.aux.getCartIDs()
    let products = await fetch(`/api/products?id=${cartProductsIDs}`).then(response=>response.json())
    if(products.data.length !== 0){
        let productsWithQty = app.cartPage.joinProductQty(products.data)
        console.log(productsWithQty)
        for(let product of productsWithQty){
            total += product.price * product.qty
        }
        console.log(total)
        return total
    }else{
        return Number(total).toFixed(2)
    }
}

/* app.cartPage.checkStocks = () =>{
    let cart = JSON.parse(localStorage.getItem('cart'))
    let qty, stock, flag = false
    for(id of Object.keys(cart)){
        qty = document.getElementById(`productQty_${id}`).value
        stock = document.getElementById(`productStock_${id}`).innerHTML
        if(qty > stock){
            flag = true
        }else{
            app.aux.updateCart(cart,id,qty)
        }
    }

} */

app.cartPage.updateProductTotal = (id,qty)=>{
    let totalContainer = document.getElementById(`productTotal_${id}`)
    let productPrice = document.getElementById(`productPrice_${id}`).innerHTML
    let total = Number(productPrice * qty).toFixed(2)
    totalContainer.innerHTML = total
}
app.cartPage.checkStocks = (id=0,qty=0,stock=0) =>{
    let cart = JSON.parse(localStorage.getItem('cart'))
    if(id == 0){
        let flag = false
        for(id of Object.keys(cart)){
            qty = Number(document.getElementById(`productQty_${id}`).value)
            stock = Number(document.getElementById(`productStock_${id}`).innerHTML)
            if(qty > stock){
                flag = true
            }else{
                if(qty <= 0){
                    flag = true
                }else{
                    app.aux.updateCart(cart,id,qty)
                    app.cartPage.updateProductTotal(id,qty)
                }
            }
        }
        console.log(2,flag)
        if(flag){
            return false;
        }else{
            return true
        }

    }else{
        if(qty > stock){
            Swal.fire(
                'Falta de Stock',
                'La cantidad que quieres de este producto es mayor al stock disponible.',
                'error'
            )
          }else{
            if(qty <=0){
                Swal.fire(
                    'Debes pedir mas cantidad',
                    'La cantidad que quieres de este es 0 o negativa.',
                    'error'
            )
            }else{
                app.aux.updateCart(cart,id,qty)
                app.cartPage.updateProductTotal(id,qty)
            }
          }
    }
    
}
app.cartPage.listenClicks = ()=>{
    let btnVaciarCarrito = document.getElementById('btnVaciar')
    let cartTotal = document.getElementById('cartTotal')
    let formCheckout = document.getElementById('formCheckout')
    document.addEventListener("click", function(e){
        const target = e.target.closest(".deleteProduct"); // Or any other selector.
        if(target){
            console.log(target)

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Este producto se eliminará del carrito",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Remover'
              }).then((result) => {
                if (result.isConfirmed) {
                    target.parentNode.parentNode.remove()
                    app.aux.deleteProduct(target.id)
                    app.cartPage.updateCartTotal()
                    Toastify({
                        text: `Producto eliminado`,
                        duration: 3000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                          background: "linear-gradient(to right, #4FF6F1, #06A5A1)",
                        },
                      }).showToast();
                  /* Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  ) */
                }
              })

        }
      });
      ['focusout','mouseup'].forEach( e =>{
          document.addEventListener(e, function(e){
              const target = e.target.closest(".inputQty"); // Or any other selector.
              if(target){
                  let id = target.getAttribute('productid')
                  let qty = Number(target.value)
                  let stock = Number(document.getElementById(`productStock_${id}`).innerHTML)
                  app.cartPage.checkStocks(id,qty,stock)
                  
              }
            },false);
      })


    btnVaciarCarrito.addEventListener("click", function(e){
        app.aux.deleteCart()
        /* const target = e.target.closest(".deleteProduct"); // Or any other selector.
        if(target){
            console.log(target)
            //Preguntar antes
            target.parentNode.parentNode.remove()
            app.aux.deleteProduct(target.id)
            app.cartPage.updateCartTotal()

        } */
      });
    cartTotal.addEventListener("click", function(e){
        app.cartPage.updateCartTotal()
        /* const target = e.target.closest(".deleteProduct"); // Or any other selector.
        if(target){
            console.log(target)
            //Preguntar antes
            target.parentNode.parentNode.remove()
            app.aux.deleteProduct(target.id)
            app.cartPage.updateCartTotal()

        } */
      });

      formCheckout.addEventListener('submit', async (e) =>{
        e.preventDefault()
        if(localStorage.getItem('cart')==null){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No tienes productos en el carrito'
              })
              return
        }
        let result = await Swal.fire({
            title: 'Orden Lista?',
            text: "Tu orden está a punto de crearse con los productos que tienes en el carrito",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#24ec8e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Crear Orden'
          })
          if(result.isConfirmed){
            let resultado = app.cartPage.checkStocks()
            if(resultado == false){
                Swal.fire({
                    icon: 'error',
                    title: 'Cantidades erroneas',
                    text: 'Tus productos exceden el stock o tienen datos equivocados, por favor revisalos antes de ordenar'
                  })
                return
            }
            
            let formData = app.aux.getFormData(e.target)
        formData.user_id = window.User.id
        formData.status = 0
        formData.total = await app.cartPage.getTotal()
        //parsearIDs
        let prodParsed = {}
        let productos = JSON.parse(localStorage.getItem('cart'))
        for(let id of Object.keys(productos)){
            prodParsed[id] = {}
            prodParsed[id].quantity = productos[id]
        }
        formData.products_array = prodParsed
        delete formData._token

        console.log(formData)
        console.log(JSON.stringify(formData))

        let data = await app.aux.postRequest('/api/orders', formData);
        console.log(data);
        if(data.data){
            Swal.fire({
                icon: 'success',
                title: 'Pedido creado',
                text: 'Puedes ver tus pedidos en la pestaña Orders'
              })
                localStorage.removeItem('cart')
                app.cartPage.loadCartProducts()
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error al crear tu pedido'
              })
        }
          }
            
      })

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
    app.cartPage.getTotal().then( total =>{
        let btnPagar = document.getElementById('btnPagar')
        console.log(total)
        document.getElementById('cartTotal').innerHTML = `Total: `+ Number(total).toFixed(2)
        btnPagar.innerHTML = `Hacer pedido: $`+ Number(total).toFixed(2)
        btnPagar.setAttribute('total',total)

    });
}

//ORDERS
app.ordersPage.events = ()=>{
    /* let btnVaciarCarrito = document.getElementById('btnVaciar')
    let formCheckout = document.getElementById('formCheckout') */
    let contador = 1;
    document.addEventListener("click", function(e){
        const target = e.target.closest(".btn"); // Or any other selector.
        if(target){
            if(contador){
                contador = 0
                console.log(target)
                let classes = [...target.classList]
                if(classes.indexOf('productos') != -1){
                    console.log('Mostrar Productos')
                    let orderID = target.parentNode.getAttribute('orderid')

                    document.getElementById(`modal${orderID}`).classList.remove('invisible')

                    /* Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Este producto se eliminará del carrito",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Remover'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            target.parentNode.parentNode.remove()
                            app.aux.deleteProduct(target.id)
                            app.cartPage.updateCartTotal()
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        }
                    }) */
                }else if(classes.indexOf('cancelar') != -1){
                    console.log('Cancelar pedido')
                }else if(classes.indexOf('archivar') != -1){
                    console.log('Archivar pedido')
                }else if(classes.indexOf('closeModal') != -1){
                    let orderID = target.getAttribute('orderid')
                    console.log(orderID)
                    document.getElementById(`modal${orderID}`).classList.add('invisible')
                }
                contador = 1
        }


        }
      });

    /* btnVaciarCarrito.addEventListener("click", function(e){
        app.aux.deleteCart()
      }); */

     /*  formCheckout.addEventListener('submit', async (e) =>{
        e.preventDefault()
        if(localStorage.getItem('cart')==null){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No tienes productos en el carrito'
              })
              return
        }
        let formData = app.aux.getFormData(e.target)
        formData.user_id = window.User.id
        formData.status = 0
        formData.total = await app.cartPage.getTotal()
        //parsearIDs
        let prodParsed = {}
        let productos = JSON.parse(localStorage.getItem('cart'))
        for(let id of Object.keys(productos)){
            prodParsed[id] = {}
            prodParsed[id].quantity = productos[id]
        }
        formData.products_array = prodParsed
        delete formData._token

        console.log(formData)
        console.log(JSON.stringify(formData))

        let data = await app.aux.postRequest('/api/orders', formData);
        console.log(data);
        if(data.data){
            Swal.fire({
                icon: 'success',
                title: 'Pedido creado',
                text: 'Puedes ver tus pedidos en la pestaña Orders'
              })
                localStorage.removeItem('cart')
                app.cartPage.loadCartProducts()
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error al crear tu pedido'
              })
        }
            
      }) */

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
    if(pathname.includes('/orders')){
        console.log("Orders Page")

        app.ordersPage.events()
        
    }
    if(pathname == '/dashboard'){
        console.log("Dashboard Page")
        app.dashboardPage()
    }

    app.aux.cerrarSesion()
  
    console.log(pathname)
}



window.addEventListener('load', function() {
    app.init()
})