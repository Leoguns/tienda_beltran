function pregunta(){
    if (confirm('¿Estas seguro de enviar este formulario?')){
       document.tuformulario.submit()
    }
}

// function Pagar(event){
//   event.preventDefault();
//   swal({
//   title: "Desea realizar la compra?",
//   text: "Estas a punto de pagar con MercadoPago",
//   icon: "warning",
//   buttons: true,
//   dangerMode: true,
// })
// .then((willDelete) => {
//   if (willDelete) {
//     swal("Se ha completado la compra", {
//       icon: "success",
//     });
//   } else {
//     swal("Se ha cancelado la compra");

//   }
// });
// }


