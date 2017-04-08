</div>
  <HR>
    <div class="footer">
      <hr>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="col-md-8">
              <a href="#">Terms of Service</a> | <a href="#">Privacy</a>
            </div>
            <div class="col-md-4">
              <p class="muted pull-right">© 2017 SaLaDe. All rights reserved</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="info">
      <?php
      echo "<br>REMOTE_ADDR: $_SERVER[REMOTE_ADDR]";
      echo "<br>Сессия: ";
      print_r($_SESSION);
      echo "<br>POST: ";
    	print_r($_POST);
      ?>
    </div>
</BODY>

</HTML>
