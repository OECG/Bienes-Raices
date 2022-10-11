document.addEventListener('DOMContentLoaded',function () {
    // initApp();
    darkMode();
    // borraMensaje();
    // limpiarErrores();
    eventListeners();
})

function darkMode() {    
    const darkMode = document.querySelector('.dark-mode-button');
    const preferDark = window.matchMedia('{prefers-color.scheme: dark}')

    if(preferDark){
        document.body.classList.add('darkMode');
    }else{
        document.body.classList.remove('darkMode');
    }
    preferDark.addEventListener('change',function () {
        if(preferDark){
            document.body.classList.add('darkMode');
        }else{
            document.body.classList.remove('darkMode');
        }
    });

    darkMode.addEventListener('click', function () {
        document.body.classList.toggle('darkMode');
    })
}

// function borraMensaje() {
//     const mensajeConfirm = document.querySelector('.alerta');
    
//     if(mensajeConfirm){
//         setTimeout(function() {
//             const padre = mensajeConfirm.parentElement;
//             padre.removeChild(mensajeConfirm);
//         }, 3500);
//         console.log("Hay mensaje de error");
//     }else {
//         console.log("No hay mensaje de error");
//     }
// }

// function limpiarErrores(){
      
//     const errores = document.querySelectorAll('.alerta');
//     // console.log(errores.length);  // Cantidad;
//     if(errores.length !==null){
//         errores.forEach( error => {
//             setTimeout(() => {
//                 error.remove();
//             }, 3500)
//         } )
//     }
// }

function eventListeners(){
    const chexBox = document.querySelector('.input_M-pass');
    const mobileMenu = document.querySelector('.mobile-menu');  
    chexBox.addEventListener('click',mostrarPassword) 
    mobileMenu.addEventListener('click', navegacionResponsive)
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

function mostrarPassword() {
    const password = document.querySelector("#password");
    if (password.type === "password") {
      password.type = "text";
    } else {
      password.type = "password";
    }
  }

// DARK MODE

// function darkMode() {
//     // Comprueba si estaba habilidado dark mode
//     let darkLocal = window.localStorage.getItem('dark');
//     if(darkLocal === 'true') {
//         document.body.classList.add('dark-mode');
//     }
//     // Añadimos el evento de click al botón de dark mode
//     document.querySelector('.dark-mode-boton').addEventListener('click', darkChange);
// }
 
// function darkChange() {
//     let darkLocal = window.localStorage.getItem('dark');
 
//     if(darkLocal === null || darkLocal === 'false') {
//         // No está inicializado darkLocal o es falso
//         window.localStorage.setItem('dark', true);
//         document.body.classList.add('dark-mode');
//     } else {
//         // Está activado darkMode, por lo que se desactiva
//         window.localStorage.setItem('dark', false);
//         document.body.classList.remove('dark-mode');
//     }
// }



// function initApp() {
//     temporaryClass(document.querySelector('.navegacion'), 'visibilidadTemporal', 300);
//     const navegacion = document.querySelector('.navegacion');
//     if(window.innerWidth<=768 ){
//         navegacion.classList.add('no-mostrar');
//     }
// }

// function eventListeners() {
//     const mobileMenu = document.querySelector('.mobile-menu');      
//     window.addEventListener('resize',cambioTamano )    // Cambio de tamaño
//     window.addEventListener('resize',transicion )    // Cambio de tamaño
//     mobileMenu.addEventListener('click', navegacionResponsive)
// }
// function navegacionResponsive() {

//     const navegacion = document.querySelector('.navegacion');
//     navegacion.classList.toggle('mostrar');
//     navegacion.classList.toggle('no-mostrar');

// }

// function transicion() {
//     const navegacion = document.querySelector('.navegacion');
//     if(window.innerWidth<=768 ){
//         if(!navegacion.classList.contains('mostrar') && !navegacion.classList.contains('no-mostrar')){            
//             navegacion.classList.add('no-mostrar');
//         }
//     }else{
//         if( navegacion.classList.contains('mostrar') ){
//             navegacion.classList.remove('mostrar');
//         }else{
//             navegacion.classList.remove('no-mostrar');
//         }
       
//     }
// }

// let oldSize = window.innerWidth;
// function cambioTamano() {
//     const navegacion = document.querySelector('.navegacion');
//     let newSize = window.innerWidth;
//     if( newSize < 768 && newSize < oldSize && !navegacion.classList.contains('mostrar')) {
//         temporaryClass(navegacion, 'visibilidadTemporal', 300);
//     } 
//     oldSize = newSize;
// }

// function temporaryClass ( element, className, time ) {
//     element.classList.add(className);
//     setTimeout(() => {
//         element.classList.remove(className);
//     }, time);
// }