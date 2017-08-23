<div style="margin-top:30px;"></div>
<!--Footer-->
<footer>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="col-md-6">
        <ul>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Credits</a></li>
        </ul>
      </div>
      <div class="col-md-6 text-right copyright">
       Developed by <a href="#">Technology Incubator CEA</a>
      </div>
    </div>
  </div>
</footer>
<!--Footer-->
<script>
    $(document).ready(function () {
    $('.modal').on('show.bs.modal', function () {
        if ($(document).height() > $(window).height()) {
            // no-scroll
            $('body').addClass("modal-open-noscroll");
        }
        else {
            $('body').removeClass("modal-open-noscroll");
        }
    })
    $('.modal').on('hide.bs.modal', function () {
        $('body').removeClass("modal-open-noscroll");
    })
})
</script>
</html>