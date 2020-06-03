

let app = {
  init: function(){
    console.log("Départ");

    var acc = document.getElementsByClassName("accordion");
    var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

// var target = $('.moyen_contact').val();

// console.log(target);
// $(".form_datetime").datepicker({
//   format: "dd MM yyyy - hh:ii"
// });
// $('#js-datepicker').datepicker({
//   language: 'fr',
// });


  // $('#tableau-bord').DataTable();

// jQuery('#datepicker').datepicker({
//   format: 'dd-mm-yyyy',
//   startDate: '+1d'
// });
  }
}

$(app.init);
