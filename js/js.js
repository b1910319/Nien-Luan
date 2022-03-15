const open = document.querySelector('#open')
const close = document.querySelector('#close')
open.addEventListener("click", function(){ 
    document.querySelector(' .nav-list ').style.display = "flex"
})
close.addEventListener("click", function(){ 
    document.querySelector(' .nav-list ').style.display = "none"
})
