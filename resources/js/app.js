import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const productsPage = ()=>{
    console.log("Product Page")
}

const dashboardPage = ()=>{
    console.log("Dashboard Page")
}



window.addEventListener('load', function() {
    let pathname = window.location.pathname
    
    if(pathname == '/products')
        productsPage()
    if(pathname == '/dashboard')
        dashboardPage()
  
    console.log(pathname)
})