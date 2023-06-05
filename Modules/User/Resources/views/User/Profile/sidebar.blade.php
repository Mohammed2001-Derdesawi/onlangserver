
<ul>
    <li class="{{ route('profile.show')==url()->current()?'active':'' }}">

        <a href="{{ route('profile.show') }}">
            <i class="fas fa-home"></i>
          {{ trans('myProfile_trans.general') }}</a>
    </li>
    <li class="{{ route('profile')==url()->current()?'active':'' }}">
        <a href="{{ route('profile') }}">
            <i class="fas fa-play-circle"></i>
            {{ trans('myProfile_trans.account') }}</a>
    </li>

    <li class="{{ route('change-password')==url()->current()?'active':'' }}">
        <a href="{{ route('change-password') }}">
            <i class="fas fa-play-circle"></i>
            {{ trans('myProfile_trans.password') }}</a>
    </li>
    <li class="{{ route('user.message.index')==url()->current()?'active':'' }}">
        <a href="{{ route('user.message.index')}}" class="{{ route('user.message.index')==url()->current()?'active':'' }}">
            <i class="fas fa-circle"></i>
            {{ trans('myProfile_trans.message') }}</a>
    </li>
      <li class="{{ route('affiliate.my.statistics')==url()->current()?'active':'' }}">
        <a href="{{ route('affiliate.my.statistics')}}" class="{{ route('affiliate.my.statistics')==url()->current()?'active':'' }}">
            <i class="fas fa-money-bill"></i>

            {{ trans('myProfile_trans.affiliateMoney') }}</a>
    </li>

    @if (auth()->user()->campaign_type=='money' || auth()->user()->wallet)

      <li class="{{ route('affiliate.wallet.withdrawpage')==url()->current()?'active':'' }}">
        <a href="{{ route('affiliate.wallet.withdrawpage')}}" class="{{ route('affiliate.my.statistics')==url()->current()?'active':'' }}">
            <i class="fas fa-money-bill"></i>
            {{ trans('myProfile_trans.withdraw') }}</a>
    </li>

    @endif

    <li class="{{ route('user.myCourses')==url()->current()?'active':'' }}">
        <a href="{{ route('user.myCourses') }}">
            <i class="fas fa-film"></i>
            {{ trans('header_trans.my_courses')  }}</a>
    </li>

    <li>
        <a href="{{ route('subscription.Info') }}" class="{{ route('subscription.Info')==url()->current()?'active':'' }}">
            <i class="fas fa-money-bill"></i>
            {{ trans('myProfile_trans.sub') }}</a>
    </li>
    <li>
        <a href="{{ route('user.notification.all')}}" class="{{ route('user.notification.all')==url()->current()?'active':'' }}">
            <i class="fas fa-bell"></i>

            {{ trans('myProfile_trans.nofication') }}</a>
    </li>


</ul>
