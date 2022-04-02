let input = document.querySelector(".numeric-input");

// disable event function
const disableEvent = e => {
  e.preventDefault();
  e.stopPropagation();
};

// disable paste
input.addEventListener("paste", disableEvent);

// disable drag&drop
input.addEventListener("drop", disableEvent);

// remove string
input.addEventListener("keyup", function (e) {
  let tmp = [];

  this.value.split("").forEach(function (item, i) {
    if (item.match(/[0-9]/gi)) {
      tmp.push(item);
    }
  });

  if (tmp.length > 0) {
    this.value = tmp.join("");
  } else {
    this.value = "";
  }
});