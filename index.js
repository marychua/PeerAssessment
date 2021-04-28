
//Hompage Sidebar Toggle
$(document).ready(function () {                
    $('#sidebarCollapse').on('click', function () {
        
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        
        
    });
});

//function toggleSidebar() {
//    //     if ($('#sidebarCollapse span').text("Close")) 
//    //         $('#sidebarCollapse span').text("Open");
//    //     else $('#sidebarCollapse span').text("Close"); 
//    //     
//    
//    var toggle = document.getElementById("sidebar");
//    if (toggle.style.width > "200px") {
//        $('#sidebarCollapse span').text("Close");
//    } else if (toggle.style.width < "50px"){
//        $('#sidebarCollapse span').text("Open");
//    }
//    else $('#sidebarCollapse span').text("None");
//    
//}
    
    
    
var navToggled = false;
//document.getElementById("button").bgcolor="#Insert Color Here";
    
function toggleSidebar() {
    if (navToggled) {
        openNav();
        navToggled = false;
    } else {
        closeNav();
        navToggled = true;
    }
}
function openNav() {
    $('#sidebarCollapse span').text("Close");
    document.getElementById('sidebarCollapse').style.backgroundColor = '#FF6584';
    
    
}
    
function closeNav() {
    $('#sidebarCollapse span').text("Open");
    document.getElementById('sidebarCollapse').style.backgroundColor = '#1DA1F2';  
     
}


$(function() {

  $(".progress").each(function() {

    var value = $(this).attr('data-value');
    var left = $(this).find('.progress-left .progress-bar');
    var right = $(this).find('.progress-right .progress-bar');

    if (value > 0) {
      if (value <= 50) {
        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
      } else {
        right.css('transform', 'rotate(180deg)')
        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
      }
    }

  })

  function percentageToDegrees(percentage) {

    return percentage / 100 * 360

  }

});

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}


