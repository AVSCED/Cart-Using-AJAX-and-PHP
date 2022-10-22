$(document).ready(function () {
  var k;
  // To display products dynamicakky using AJAX and PHP
  $.ajax({
    type: "POST",
    url: "prod_Display.php",
    contentType: "application/json",
    dataType: "json",
  }).done(function (data) {
    var k = data;
    var s;
    k.forEach((e) => {
      s +=
        '<div id="' +
        e.id +
        '" class="product"> <img src="images/' +
        e.image +
        '"><h3 class="title"><a href="#">Product ' +
        e.id +
        "</a></h3><span>Price: $" +
        e.price +
        '.00</span><a class="add-to-cart" onclick=addToCart(' +
        e.id +
        ")>Add To Cart</a></div>";
    });
    $("#products").html(s);
  });
});
//To add Product to the cart array  and fetch updated array
function addToCart(ind) {
  $.ajax({
    type: "POST",
    url: "cart_Script.php",
    data: {
      ind: ind,
      action: "add_to_cart",
    },
    dataType: "json",
  }).done(function (cart_Array) {
    displayCart(cart_Array);
    billAmount(cart_Array);
  });
}
//To Print the data present in the cart
function displayCart(data) {
  t =
    "<tr> <th><h3>Product ID:</h3></th> <th><h3>Name:</h3></th> <th><h3>Image:</h3></th> <th><h3>Price:</h3></th> <th><h3>Quantity:</h3></th> <th><h3>Delete Product:</h3></th>  </tr>";
  data.forEach((e) => {
    t +=
      "<tr><td><h3><b>" +
      e.id +
      "</b></h3></td>" +
      "<td><h3>" +
      e.name +
      "</h3></td>" +
      "<td>" +
      "<img src= 'images/" +
      e.image +
      "' style='height:50px ; width:50px ;'></td>" +
      "<td><h3>" +
      e.price +
      "</h3></td>" +
      "<td><p><button id='" +
      e.id +
      "'onclick='reduceQuant(this.id)' style='height:20px ; width:20px ;'>-</button><b>" +
      e.quantity +
      "</b><button id='" +
      e.id +
      "' onclick='addQuant(this.id)' style='height:20px ; width:20px ;'>+</button><p></td>" +
      "<td><button id='" +
      e.id +
      "' onclick=deleteRow(this.id)>Delete</button></tr>";
  });
  $("#cart").html(t);
  $("table").css("border", "1px");
  $("#cart").css("border", "solid");
  $("#cart").css("width", "90%");
  $("#cart").css("border-width", "2px");
  $("tr:even").css("background", "lightgrey");
}
// To Increment the quantity present in the cartt  and fetch updated array
function addQuant(j) {
  console.log(j);
  $.ajax({
    type: "POST",
    url: "cart_Script.php",
    data: {
      j: j,
      action: "add_Quant",
    },
    dataType: "json",
  }).done(function (cart_Array) {
    console.log(cart_Array);
    displayCart(cart_Array);
    billAmount(cart_Array);
  });

}
// To reduce the quantity present in the cart and fetch updated array
function reduceQuant(m) {
  $.ajax({
    type: "POST",
    url: "cart_Script.php",
    data: {
      m: m,
      action: "reduce_Quant",
    },
    dataType: "json",
  }).done(function (cart_Array) {
    console.log(cart_Array);
    displayCart(cart_Array);
   billAmount(cart_Array);
  });
}
//To delete an entire row and fetch updated array
function deleteRow(delId) {
  console.log(delId);
  $.ajax({
    type: "POST",
    url: "cart_Script.php",
    data: {
      delId: delId,
      action: "del_Row",
    },
    dataType: "json",
  }).done(function (cart_Array) {
    console.log(cart_Array);
    if (
      confirm("Are you Sure you Want to delete product form cart") == true
    ) {
      displayCart(cart_Array);
      billAmount(cart_Array);
    }

  });
}
//To fetch and display the total amount
function billAmount(billData) {
  $.ajax({
    type: "POST",
    url: "cart_Script.php",
    data: {
      billData: billData,
      action: "bill_Amount",
    },
    dataType: "text",
  }).done(function (bill) {
    $("#billAmmount").html("<b>Your Bill Amount = $" + bill + "</b>");
  });
}
