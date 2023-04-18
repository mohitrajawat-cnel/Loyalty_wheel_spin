
<style>
    .grab {
  cursor: grab;
}

.grabbed {
  box-shadow: 0 0 13px #000;
}

.grabCursor,
.grabCursor * {
  cursor: grabbing !important;
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<table>
  <tr>
    <th></th>
    <th>Table Header</th>
  </tr>
  <tr data-id="1" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 1</td>
  </tr>
  <tr data-id="2" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 2</td>
  </tr>
  <tr data-id="3" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 3</td>
  </tr>
  <tr data-id="4" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 4</td>
  </tr>
  <tr data-id="5" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 5</td>
  </tr>
  <tr data-id="6" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 6</td>
  </tr>
  <tr data-id="7" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 7</td>
  </tr>
  <tr data-id="8" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 8</td>
  </tr>
  <tr data-id="9" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 9</td>
  </tr>
  <tr data-id="10" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 10</td>
  </tr>
  <tr data-id="11" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 11</td>
  </tr>
  <tr data-id="12" class="banner_list_images_table">
    <td class="grab">&#9776;</td>
    <td>Table Cell 12</td>
  </tr>
</table>

<script>
    $(".grab").mousedown(function(e) {
      var tr = $(e.target).closest("TR"),
        si = tr.index(),
        sy = e.pageY,
        b = $(document.body),
        drag;
      if (si == 0) return;
      b.addClass("grabCursor").css("userSelect", "none");
      tr.addClass("grabbed");
    
      function move(e) {
        if (!drag && Math.abs(e.pageY - sy) < 10) return;
        drag = true;
        tr.siblings().each(function() {
          var s = $(this),
            i = s.index(),
            y = s.offset().top;
          if (i > 0 && e.pageY >= y && e.pageY < y + s.outerHeight()) {
            if (i < tr.index())
              tr.insertAfter(s);
            else
              tr.insertBefore(s);
            return false;
          }
        });
      }
    
      function up(e) {
        if (drag && si != tr.index()) {
          drag = false;
          alert("moved!");
          $(".banner_list_images_table").each(function() {
               var data_id = $(this).attr("data-id");
               alert(data_id);
            });
        }
        $(document).unbind("mousemove", move).unbind("mouseup", up);
        b.removeClass("grabCursor").css("userSelect", "none");
        tr.removeClass("grabbed");
      }
      $(document).mousemove(move).mouseup(up);
    });
</script>