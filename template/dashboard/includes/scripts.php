<!-- Script LOGOUT-->
  <script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function() {
      window.location = "http://stock.alunos.esmonserrate.org/admin/login/phpcodes/logout.php";
    });
  }

  function onLoad() {
    gapi.load('auth2', function() {
      gapi.auth2.init();
    });
  }
</script>

<!-- Script JQUERY-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>  <!-- Script POPPER-->  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<!-- Script BOOTSTRAP-->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>  
  
<!-- Script Cookies--> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/latest/js.cookie.min.js"></script>
  
<!-- Script Scroolbar-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"></script>
<script src="../template/dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

<!-- Script Google -->
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
  <script src="../template/dashboard/assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../template/dashboard/assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../template/dashboard/assets/js/argon.min23cd.js?v=1.2.1"></script>
<!-- Argon JS -->
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script src="../template/dashboard/assets/js/components/calendario/calendario.js" type="text/javascript"></script>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
