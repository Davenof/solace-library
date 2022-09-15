var fetch = document.querySelector("form");

fetch.addEventListener("submit", function (e) {
  e.preventDefault();
  var action = fetch.querySelector("input[type=text]");
  action.value = "DOL Catalogue Search" + action.value;
  fetch.submit();
  document.getElementById("submit").appendChild(action);
});

