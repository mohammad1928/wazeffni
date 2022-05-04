<div wire:poll="mountData()" class="">
    <a wire:click="seeAll" href="/notifications" class="nav-link text-light notification-box" title="الإشعارات">
    <i  class="fas fa-bell"></i>
    @if($notification_count>0)
        <span  class="notification-counter">{{$notification_count}}</span>
    @endif
    </a>
</div>
