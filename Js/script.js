//function to  increment and decrement the quantity
const plusButtons = document.querySelectorAll(".plus");
const minusButtons = document.querySelectorAll(".minus");
const numElements = document.querySelectorAll(".num");

plusButtons.forEach((plus, index) => {
  plus.addEventListener("click", () => {
    let a = parseInt(numElements[index].innerText);
    a++;
    a = (a < 10) ? "0" + a : a;
    numElements[index].innerText = a;
  });
});

minusButtons.forEach((minus, index) => {
  minus.addEventListener("click", () => {
    let a = parseInt(numElements[index].innerText);
    if (a > 1) {
      a--;
      a = (a < 10) ? "0" + a : a;
      numElements[index].innerText = a;
    }
  });
});
//function to hide and show the input fields
function mostrarOcultarInput() {
    var metodoPago = document.getElementById("metodoPago").value;
    var InputEfectivo = document.getElementById("InputEfectivo");
    var InputTarjeta = document.getElementById("InputTarjeta");

    if (metodoPago === "Efectivo") {
        InputEfectivo.style.display = "block";
        InputTarjeta.style.display = "none";
    } else if (metodoPago === "Tarjeta") {
        InputEfectivo.style.display = "none";
        InputTarjeta.style.display = "block";
    } else {
        InputEfectivo.style.display = "none";
        InputTarjeta.style.display = "none";
    }
}

//function to save the card info
function enviarPago() {
    var metodoPago = document.getElementById("metodoPago").value;
    if (metodoPago === "Tarjeta") {
        var numerosTarjeta = document.getElementById("numerosTarjeta").value;
        var vigencia = document.getElementById("vigencia").value;
        var cvv = document.getElementById("cvv").value;

        fetch("pago.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    numerosTarjeta: numerosTarjeta,
                    vigencia: vigencia,
                    cvv: cvv
                }),

            })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);
            })
            .catch((error) => {
                console.error("Error al enviar los datos de pago al servidor:", error);
            })
    }
}