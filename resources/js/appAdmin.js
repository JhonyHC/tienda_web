import './bootstrap';

import Swal from 'sweetalert2'
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

let app = {}

app.productsPage = {}
app.ordersPage = {}















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




app.init = ()=>{
    let pathname = window.location.pathname
    
    if(pathname.includes('/products')){
        console.log("Product Page")

        /* app.productsPage.btnListeners() */
        
    }
    
    if(pathname.includes('/orders')){
        console.log("Orders Page")

        app.ordersPage.events()
        
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