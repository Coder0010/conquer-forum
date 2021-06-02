<form class="contact-us" action="{{ route('leads.send') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')
    <h2>{{ __("site.contact_us") }}</h2>
    @include("global.partials._flash_messages")
    <input type="text" name="lead_subject" placeholder="{{ __("site.subject") }}" value="{{ old("lead_subject") }}" class="app-btn grey @error('lead_name') is-invalid @enderror">
    <textarea name="lead_description" placeholder="{{ __("site.description") }}" class="app-btn grey @error('lead_description') is-invalid @enderror" cols="10" rows="8">{{ old("lead_description") }}</textarea>
    <div class="text-center">
        <div class="d-inline-block @error('g-recaptcha-response') border border-danger @enderror" id="g-recaptcha-1"></div>
    </div>
    <button type="submit"  class="app-btn dark my-2">{{ __('site.send')  }}</button>
</form>
