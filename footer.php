
     <!-- /. WRAPPER  -->
    <!--Pesan-->
    <script type="text/javascript">
      $(document).ready(function(){
          $("#pesan").hide();
      });
    </script>
    <!--Tombol back to top-->
    <script>
    //deklarasi 
    var mybutton = document.getElementById("myBtn");

    //ketika halaman discroll ke bawah sebanyak 100px
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }
    //ketika tombol diclick
    function topFunction() {
       $("html, body").animate({scrollTop: 0}, 500);
    }
    </script>
        <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>