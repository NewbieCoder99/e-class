@component('mail::message')
# Order Confirmed
Hi {{ $order->user->fname }} !!
<br>
{{ $x }}.
<br>
You can see invoice below.


@component('mail::button', ['url' => route('invoice.show', $order['id'])])
Invoice
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
