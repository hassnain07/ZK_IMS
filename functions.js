function total_price() {
  let total_price = document.getElementById("total_price");
  let unit_price = document.getElementById("item_price");
  let item_qty = document.getElementById("item_qty");
  let tot_price = document.getElementById("tot_rs");

  total_price.innerHTML =
    parseFloat(unit_price.value) * parseFloat(item_qty.value);
  tot_price.value = parseFloat(total_price.innerHTML);
}
function exist_total_price() {
  let total_price = document.getElementById("total_price");
  let unit_price = document.getElementById("exist_item_price");
  let item_qty = document.getElementById("exist_item_qty");
  let tot_price = document.getElementById("exist_tot_rs");

  total_price.innerHTML = parseInt(unit_price.value) * parseInt(item_qty.value);
  tot_price.value = total_price.innerText;
}
function getCat() {
  let sel_cat = document.getElementById("sel_cat");
  let category = document.getElementById("item_category");

  sel_cat.value = category.value;

  if (sel_cat.value == "school") {
    document.getElementById("getCategory").submit();
  }
}
function check_form() {
  let sel_cat = document.getElementById("sel_cat");

  if (sel_cat.value == "") {
    window.alert("Please select item category");
    return false;
  }
}
function show_row_size() {
  let size_row = document.getElementById("size_row");

  if (size_row.style.display === "none") {
    size_row.style.display = "block";
  } else {
    size_row.style.display = "none";
  }
}
function check_issuance_form() {
  let sel_item = document.getElementById("sel_item");

  if (sel_item.value == "") {
    window.alert("Please select item");
    return false;
  }
}
function check_qty() {
  let issued_qty = document.getElementById("avail_qty");
  let avail_qty = document.getElementById("issued_qty");

  console.log(parseInt(issued_qty.value));

  // if (sel_item.value == "") {
  //   window.alert("Please select item");
  //   return false;
  // }
}
