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