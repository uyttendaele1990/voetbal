    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <meta name="description" content="">
    <meta name="author" content="">
 
    <title>Voetbal tracker</title>
    
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- Custom styles for this template -->
    <link href="{{ asset('user/css/clean-blog.min.css') }}" rel="stylesheet">
    <style>
    .dropdown-menu{
        opacity:0.8;
    }
a.dropdown-item:hover{
    font-size:25px;
    
}
.carousel-item {
  height: 65vh;
  min-height: 300px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
a {
    color:black;
}
    </style>
    <script>
        $(document).ready(function() {
            var btt = $('.back-to-top');
            $( ".back-to-top" ).click(function() {
                $('html','body').animate({
                    scrollTop: 0
                    }, 5000);
            });
            
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {        // If page is scrolled more than 50px
                    btt.fadeIn(200), {passive:true};    // Fade in the arrow
                } else {
                    btt.fadeOut(200), {passive:true};   // Else fade out the arrow
                }
            });
        });

    </script>
    @section('headSection')
         @show