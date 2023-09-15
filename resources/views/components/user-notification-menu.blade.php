<div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Notifications
            @if ($unreadCount)
            <span class="badge bg-primary">{{$unreadCount}}</span>

            @endif
        </a>

          <ul class="dropdown-menu text-small " style="">
                @foreach ($notifications as $notification)
          <li><a class="dropdown-item" href="{{ $notification->data['link'] }}?nid={{$notification->id}}">
          @if ($notification->unread())<b>*</b>@endif
          {{$notification->data['body']}}
            <br>
            <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
          </a></li>
            <li>
                <hr class="dropdown-divider">
            </li>

            @endforeach
          </ul>
        </div>
