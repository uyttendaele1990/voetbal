<!-- dit zijn de errors die worden weergeven als er een rule validation niet klopt -->
   @if(count($errors) > 0 )
      @foreach($errors->all() as $error)
          <p class='alert alert-danger'>{{ $error }}</p>
      @endforeach
   @endif