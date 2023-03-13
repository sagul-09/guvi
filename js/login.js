const form = document.querySelector(".right form");
const continueBtn = form.querySelector(".button input");

const email = form.querySelector(".email input");
const name = form.querySelector(".name input");

form.onsubmit = (e) => {
  e.preventDefault(); //prevent the form from submitting
};

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status == 200) {
      let data = xhr.response;
      // console.log(data);
      if (data == "done") {
        console.log(data);
      } else {
        alert(data);
        console.log(data);
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
