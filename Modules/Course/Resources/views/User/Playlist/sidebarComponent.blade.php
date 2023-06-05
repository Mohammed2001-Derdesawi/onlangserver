<ul>
    <li  class="{{ route('home')==url()->current()?'active':'' }}" >

        <a href="{{ route('home') }}">
            <i class="fas fa-home"></i>
          {{ trans('profile.home') }}  </a>
    </li>


    <li  class="{{ route('user.myliked')==url()->current()?'active':'' }}">
        <a href="{{ route('user.myliked') }}">
            <i class="fas fa-heart"></i>
            {{ trans('profile.liked') }}   </a>
    </li>
    <li  class="{{ route('user.my.playlist')==url()->current()?'active':'' }}">
        <a href="{{ route('user.my.playlist') }}">
            <i class="fas fa-stream"></i>
            {{ trans('profile.playlist') }}   </a>
    </li>
    <li  class="{{ route('user.my.watchlater')==url()->current()?'active':'' }}">
        <a href="{{ route('user.my.watchlater') }}">
            <i class="fas fa-clock"></i>
            {{ trans('profile.watchlater') }}   </a>
    </li>
</ul>
