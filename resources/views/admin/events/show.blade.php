@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Event Insights')
@section('header', 'Event Insights')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <a href="{{ route('admin.events.index') }}" style="color: var(--color-primary); text-decoration: none; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-arrow-left"></i> Back to Events</a>
        <h2 style="margin: 0.5rem 0 0; font-size: 1.45rem; font-weight: 700; color: #0f172a;">{{ $event->title }}</h2>
        <div style="margin: 0.4rem 0 0; color: #64748b; font-size: 0.9rem; display: flex; gap: 1rem; flex-wrap: wrap;">
            <span><i class="fa-regular fa-calendar" style="color: #cbd5e1;"></i> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y - h:i A') }}</span>
            @if($event->venue)
            <span><i class="fa-solid fa-location-dot" style="color: #cbd5e1;"></i> {{ $event->venue }}</span>
            @endif
        </div>
    </div>
    <a href="{{ route('events.show', $event->slug) }}" target="_blank" style="background: #fff; color: #0f172a; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.85rem; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: inline-flex; align-items: center; gap: 0.4rem;">
        <i class="fa-solid fa-arrow-up-right-from-square"></i> View Public Page
    </a>
</div>

<!-- Top Stats Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.3rem; margin-bottom: 2.5rem;">
    <!-- RSVPs -->
    <div style="background: #fff; border-radius: 12px; padding: 1.5rem; text-align: center; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: #ecfdf5; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
            <i class="fa-solid fa-users" style="font-size: 1.3rem; color: #059669;"></i>
        </div>
        <h3 style="margin: 0; font-size: 2rem; font-weight: 800; color: #0f172a;">{{ $event->rsvps->count() }}</h3>
        <p style="margin: 0.3rem 0 0; color: #64748b; font-size: 0.85rem; font-weight: 500; text-transform: uppercase;">Total RSVPs</p>
    </div>

    <!-- Reactions -->
    <div style="background: #fff; border-radius: 12px; padding: 1.5rem; text-align: center; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: #eff6ff; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
            <i class="fa-solid fa-face-smile" style="font-size: 1.3rem; color: #3b82f6;"></i>
        </div>
        <h3 style="margin: 0; font-size: 2rem; font-weight: 800; color: #0f172a;">{{ array_sum($reactionsCount) }}</h3>
        <p style="margin: 0.3rem 0 0; color: #64748b; font-size: 0.85rem; font-weight: 500; text-transform: uppercase;">Total Reactions</p>
        @if(array_sum($reactionsCount) > 0)
        <div style="display: flex; justify-content: center; gap: 0.6rem; margin-top: 0.8rem; font-size: 0.8rem;">
            @php $emojis = ['like'=>'👍','love'=>'❤️','dislike'=>'👎','insightful'=>'💡','angry'=>'😡']; @endphp
            @foreach($reactionsCount as $k => $v)
                <span title="{{ ucfirst($k) }}">{{ $emojis[$k] ?? '' }} {{ $v }}</span>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Comments -->
    <div style="background: #fff; border-radius: 12px; padding: 1.5rem; text-align: center; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: #fffbeb; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
            <i class="fa-solid fa-comments" style="font-size: 1.3rem; color: #d97706;"></i>
        </div>
        <h3 style="margin: 0; font-size: 2rem; font-weight: 800; color: #0f172a;">{{ $event->comments->count() }}</h3>
        <p style="margin: 0.3rem 0 0; color: #64748b; font-size: 0.85rem; font-weight: 500; text-transform: uppercase;">Comments</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- RSVPs List -->
    <div style="background: #fff; border-radius: 12px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); display: flex; flex-direction: column;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #f1f5f9;">
            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 600; color: #0f172a;"><i class="fa-solid fa-clipboard-list" style="color: var(--color-primary); margin-right: 0.5rem;"></i> RSVP List</h3>
            <p style="margin: 0.3rem 0 0; font-size: 0.85rem; color: #64748b;">People planning to attend this event.</p>
        </div>
        <div style="padding: 0; overflow-y: auto; max-height: 400px;">
            @if($event->rsvps->count())
                <ul style="list-style: none; margin: 0; padding: 0;">
                @foreach($event->rsvps as $rsvp)
                    <li style="padding: 1.2rem 1.5rem; border-bottom: 1px solid #f8fafc; display: flex; flex-direction: column; gap: 0.2rem;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <strong style="color: #1e293b; font-size: 0.95rem;">{{ $rsvp->name }}</strong>
                            <span style="font-size: 0.75rem; color: #94a3b8;">{{ $rsvp->created_at->diffForHumans() }}</span>
                        </div>
                        <div style="display: flex; gap: 1rem; font-size: 0.85rem; color: #64748b; margin-top: 0.3rem;">
                            @if($rsvp->email)<span><i class="fa-solid fa-envelope"></i> <a href="mailto:{{ $rsvp->email }}" style="color: var(--color-primary);">{{ $rsvp->email }}</a></span>@endif
                        </div>
                    </li>
                @endforeach
                </ul>
            @else
                <div style="padding: 3rem 1.5rem; text-align: center; color: #94a3b8;">
                    <i class="fa-solid fa-ghost" style="font-size: 2rem; margin-bottom: 0.8rem; color: #e2e8f0;"></i>
                    <p style="margin: 0; font-size: 0.9rem;">No RSVPs yet. Check back later.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Comments List -->
    <div style="background: #fff; border-radius: 12px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); display: flex; flex-direction: column;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #f1f5f9;">
            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 600; color: #0f172a;"><i class="fa-regular fa-comments" style="color: #d97706; margin-right: 0.5rem;"></i> Recent Comments</h3>
            <p style="margin: 0.3rem 0 0; font-size: 0.85rem; color: #64748b;">Feedback and discussions from users.</p>
        </div>
        <div style="padding: 0; overflow-y: auto; max-height: 400px;">
            @if($event->comments->count())
                <ul style="list-style: none; margin: 0; padding: 0;">
                @foreach($event->comments as $comment)
                    <li style="padding: 1.2rem 1.5rem; border-bottom: 1px solid #f8fafc;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <strong style="color: #1e293b; font-size: 0.9rem;">{{ $comment->display_name }}</strong>
                            <span style="font-size: 0.75rem; color: #94a3b8;">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p style="margin: 0 0 0.8rem; font-size: 0.88rem; color: #475569; line-height: 1.5;">{{ $comment->body }}</p>
                        
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div>
                                @if(!$comment->is_approved)
                                    <span style="font-size: 0.7rem; background: #fff4f2; color: #b91c1c; padding: 0.2rem 0.5rem; border-radius: 4px; font-weight: 600; text-transform: uppercase;"><i class="fa-solid fa-flag"></i> Flagged / Hidden</span>
                                @else
                                    <span style="font-size: 0.7rem; background: #ecfdf5; color: #047857; padding: 0.2rem 0.5rem; border-radius: 4px; font-weight: 600; text-transform: uppercase;"><i class="fa-solid fa-check"></i> Approved</span>
                                @endif
                            </div>
                            
                            <div style="display: flex; gap: 0.5rem;">
                                <form action="{{ route(Auth::guard('super_admin')->check() ? 'super-admin.comments.toggle-approval' : 'admin.comments.toggle-approval', $comment->id) }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button type="submit" style="background: none; border: 1px solid #e2e8f0; padding: 0.3rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; color: #475569; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#f8fafc';this.style.borderColor='#cbd5e1'" onmouseout="this.style.background='none';this.style.borderColor='#e2e8f0'">
                                        @if($comment->is_approved)
                                            <i class="fa-solid fa-flag" style="color: #d97706; margin-right: 2px;"></i> Flag
                                        @else
                                            <i class="fa-solid fa-check" style="color: #059669; margin-right: 2px;"></i> Approve
                                        @endif
                                    </button>
                                </form>
                                <form action="{{ route(Auth::guard('super_admin')->check() ? 'super-admin.comments.destroy' : 'admin.comments.destroy', $comment->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: 1px solid #fee2e2; padding: 0.3rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; color: #b91c1c; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='none'">
                                        <i class="fa-solid fa-trash-can" style="margin-right: 2px;"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            @else
                <div style="padding: 3rem 1.5rem; text-align: center; color: #94a3b8;">
                    <i class="fa-regular fa-comment-slash" style="font-size: 2rem; margin-bottom: 0.8rem; color: #e2e8f0;"></i>
                    <p style="margin: 0; font-size: 0.9rem;">No comments yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
