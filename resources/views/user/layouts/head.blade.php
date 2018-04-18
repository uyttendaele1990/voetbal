    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Voetbal tracker</title>
    <!-- jquery voor de back to top -->
    <script
              src="https://code.jquery.com/jquery-3.3.1.js"
              integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
              crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="{{ asset('user/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link href="{{ asset('user/css/clean-blog.min.css') }}" rel="stylesheet">
    <style>
        .back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: grey;
    width: 50px;
    height: 50px;
    border-radius: 35px;
    display: none;
}
.back-to-top i {
    color: #fff;
    margin: 0;
    position: relative;
    left: 16px;
    top: 13px;
}
.back-to-top:hover {
    background:black;
}
.back-to-top:hover i {
    top: 5px;
}

    </style>
    <script>
        $(document).ready(function() {
            var btt = $('.back-to-top');
            $( ".back-to-top" ).click(function() {
                $('html','body').animate({
                    scrollTop: 0
                    }, 5000), {passive:true};
            }), {passive:true};
            
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {        // If page is scrolled more than 50px
                    btt.fadeIn(200), {passive:true};    // Fade in the arrow
                } else {
                    btt.fadeOut(200), {passive:true};   // Else fade out the arrow
                }
            }), {passive:true};
        }), {passive:true};

    </script>
    @section('headSection')
         @show